<?php

/**
 * Generate the class using the supplied placeholders.
 *
 * @param array $placeholders
 *
 * @return string
 */
function generateClass($placeholders)
{
    ob_start();
    extract($placeholders);
    include 'class.tpl.php';
    $render = ob_get_contents();
    ob_clean();

    return $render;
}

/**
 * Generate the constructor parameters.
 *
 * @param array $parameters
 *
 * @return string
 */
function generate_constructor_parameters($spec, $endpoint_placholders = false)
{
    $result = [];

    foreach (array_get($spec, 'parameters', []) as $name => $settings) {
        $result[] = "\$$name";
    }

    if (array_has($spec, 'fillable')) {
        $name = '$fill';
        if (!$endpoint_placholders) {
            $name .= ' = []';
        }
        $result[] = $name;
    }

    return implode(', ', $result);
}

/**
 * Generate the parameter comments for a method.
 *
 * @param array $settings
 *
 * @return string
 */
function generate_parameter_comments($method_settings)
{
    $result = '';
    $count = 0;

    $entries = [];

    // Required parameters.
    foreach (array_get($method_settings, 'parameters', []) as $name => $settings) {
        $entries[] = [
            '     * @param '.array_get($settings, 'type'),
            "\$$name",
            array_get($settings, 'description')
        ];
        $count++;
    }

    // Optional parameters with default values.
    foreach (array_get($method_settings, 'optional-parameters', []) as $name => $settings) {
        $default_value = get_default_value($settings, ['with-equal' => true, 'exclude-null' => true]);
        $entries[] = [
            '     * @param '.array_get($settings, 'type'),
            "\$$name".$default_value,
            '(optional)'.array_get($settings, 'description')
        ];
        $count++;
    }

    // Really optional paramters provided via array.
    $optional = array_get($method_settings, 'optional', []);
    if (is_array($optional) && count($optional) > 0) {
        $entries[] = ['     * @param array', "\$optional", ''];
    }

    [$part1_length, $part2_length, $result] = code_alignment($entries, ['raw' => true]);

    if (is_array($optional) && count($optional) > 0) {
        foreach ($optional as $name => $settings) {
            $default_value = get_default_value($settings, ['with-equal' => true, 'exclude-null' => true]);

            $result .= '     *'.str_repeat(' ', $part1_length+$part2_length-4)."- [$name".$default_value.'] ('.array_get($settings, 'type').') '.array_get($settings, 'description');
            $result .= "\n";
        }
    }

    // Add a new comment line if we have parameters.
    if ($count) {
        $result .= "     *\n";
    }

    return $result;
}

/**
 * Generate the parameter comments for a method.
 *
 * @param array $settings
 *
 * @return string
 */
function generate_parameter_list($method_settings)
{
    $result = [];

    // Required parameters.
    foreach (array_get($method_settings, 'parameters', []) as $name => $settings) {
        if (array_has($settings, 'self', false)) {
            continue;
        }

        $result[] = "\$$name";
    }

    // Optional parameters with default values.
    foreach (array_get($method_settings, 'optional-parameters', []) as $name => $settings) {
        $result[] = "\$$name = ".get_default_value($settings);
    }

    $optional = array_get($method_settings, 'optional', []);
    if (is_array($optional) && count($optional) > 0) {
        $result[] = '$optional = []';
    }

    return implode(', ', $result);
}

/**
 * Get the default value.
 *
 * @param array $parameter_setting
 * @param array $options
 *
 * @return mixed
 */
function get_default_value($parameter_setting, $options = [])
{
    $default_value = array_get($parameter_setting, 'default', 'null');

    $no_quotes = false;

    switch (array_get($parameter_setting, 'type')) {
        case 'array':
            $default_value = '[]';
            $no_quotes = true;
            break;
        case 'boolean':
            $default_value = $default_value ? 'true' : 'false';
            $no_quotes = true;
            break;
    }

    if (!$no_quotes && empty($default_value)) {
        $default_value = 'null';
        $no_quotes = true;
    }

    if (!$no_quotes && !is_numeric($default_value) && is_string($default_value)) {
        $default_value = "'$default_value'";
    }

    if (array_has($options, 'with-equal')) {
        // Exclude null values
        if (array_has($options, 'exclude-null') && $default_value == "'null'") {
            $default_value = '';

        // Add the equal sign.
        } elseif (strlen($default_value)) {
            $default_value = '='.$default_value;
        }
    }

    return $default_value;
}

function api_search_factory($method_settings)
{
    $result = '';

    if (array_has($method_settings, 'factory')) {
        $class = array_get($method_settings, 'factory.class');
        $parameters = implode("', '", array_get($method_settings, 'factory.parameters'));
        $result = ", ['class' => '$class', 'parameters' => ['$parameters']]";
    }

    return $result;
}

/**
 * Generate a parameter list for creating a new class.
 *
 * @param array $method_settings
 *
 * @return string
 */
function generate_new_class_parameter_list($method_settings)
{
    $result = [];

    foreach (array_get($method_settings, 'parameters', []) as $name => $settings) {
        $result[] = '$'.(array_get($settings, 'self', false) ? 'this->' : '')."$name";
    }

    foreach (array_get($method_settings, 'optional-parameters', []) as $name => $settings) {
        $result[] = "\$$name";
    }

    return implode(', ', $result);
}

/**
 * Generate the endpoint entry. This is simply for the correct code style.
 *
 * @param array $method_settings
 *
 * @return string
 */
function generate_endpoint_entry($method_settings)
{
    $entry = array_get($method_settings, 'endpoint', '');

    if (stripos($entry, '$') !== false) {
        return '"$entry"';
    }

    return "'$entry'";
}

/**
 * Generate the payload for the put function.
 *
 * @param array $method_settings
 *
 * @return string
 */
function generate_put_function_payload($method_settings)
{
    // Uses the attributes array but also takes
    // the optional array to update the attributes
    // before checking the dirty ones.
    if (array_has($method_settings, 'attributes')) {
        return '$this->getDirty($optional)';
    }

    return '$optional';
}

/**
 * Generate the payload for the post function.
 *
 * @param array $method_settings
 *
 * @return string
 */
function generate_post_function_payload($method_settings)
{
    $result = "array_merge([\n";

    foreach (array_get($method_settings, 'parameters', []) as $name => $settings) {
        $result .= "            '".$name."' => \$".$name.",\n";
    }

    foreach (array_get($method_settings, 'optional-parameters', []) as $name => $settings) {
        $result .= "            '".$name."' => \$".$name.",\n";
    }


    $optional = array_get($method_settings, 'optional', []);

    return $result.'        ], $optional)';
}

function code_alignment($data, $options = [])
{
    $result = '';
    $part1_length = 0;
    $part2_length = 0;

    foreach ($data as $key => $value) {
        if (is_array($value)) {
            $key = $value[0];
        }

        if (($length = strlen($key)) > $part1_length) {
            $part1_length = $length;
        }

        if (isset($value[1])) {
            if (($length = strlen($value[1])) > $part2_length) {
                $part2_length = $length;
            }
        }
    }

    foreach ($data as $key => $value) {
        if (array_has($options, 'raw')) {
            $total_part1 = $part1_length - strlen($value[0]);
            $total_part2 =  $part2_length - strlen($value[1]);

            $total_part1 = $total_part1 < 0 ? 0 : $total_part1;
            $total_part2 = $total_part2 < 0 ? 0 : $total_part2;

            $result .= $value[0];
            $result .= str_repeat(' ', $total_part1).' ';
            $result .= $value[1];
            if (!empty($value[2])) {
                $result .= ' '.str_repeat(' ', $total_part2).$value[2];
            }
            $result .= "\n";
        } else {
            $result .= "        '$key'".str_repeat(' ', $part1_length-strlen($key))." => '$value',\n";
        }
    }

    return [
        $part1_length,
        $part2_length,
        $result
    ];
}
