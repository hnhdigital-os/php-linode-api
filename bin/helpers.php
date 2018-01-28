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
    include('class.tpl.php');
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
        $name = "\$fill";
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

    foreach (array_get($method_settings, 'parameters', []) as $name => $settings) {
        $result .= "     * @param ".array_get($settings, 'type')." \$$name ".array_get($settings, 'description');
        $result .= "\n";
        $count++;
    }

    foreach (array_get($method_settings, 'optional-parameters', []) as $name => $settings) {
        $result .= "     * @param ".array_get($settings, 'type')." \$$name (optional) ".array_get($settings, 'description');
        $result .= "\n";
        $count++;
    }

    $optional = array_get($method_settings, 'optional', []);
    if (is_array($optional) && count($optional) > 0) {
        $result .= "     * @param array \$optional \n";

        foreach ($optional as $name => $settings) {
            $default_value = array_get($settings, 'default', '');
            $default_value = array_get($settings, 'type') == 'boolean' ? (int) $default_value : $default_value;
            if (strlen($default_value)) {
                $default_value = '='.$default_value;
            }

            $result .= "     *      - [$name".$default_value."] (".array_get($settings, 'type').") ".array_get($settings, 'description');
            $result .= "\n";
        }
    }

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

    foreach (array_get($method_settings, 'parameters', []) as $name => $settings) {
        if (array_has($settings, 'self', false)) {
            continue;
        }

        $result[] = "\$$name";
    }

    foreach (array_get($method_settings, 'optional-parameters', []) as $name => $settings) {
        $default_value = array_get($settings, 'default', "null");
        
        $no_quotes = false;

        switch (array_get($settings, 'type')) {
            case 'array':
                $default_value = '[]';
                $no_quotes = true;
                break;
            case 'boolean':
                $default_value = $default_value ? "true" : "false";
                $no_quotes = true;
                break;
        }

        if (!$no_quotes && empty($default_value)) {
            $default_value = "null";
                $no_quotes = true;
        }

        if (!$no_quotes && !is_numeric($default_value) && is_string($default_value)) {
            $default_value = "'$default_value'";
        }

        $result[] = "\$$name = ".$default_value;
    }

    $optional = array_get($method_settings, 'optional', []);
    if (is_array($optional) && count($optional) > 0) {
        $result[] = "\$optional = []";
    }

    return implode(', ', $result);
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
        $result[] = "\$".(array_get($settings, 'self', false) ? 'this->' : '')."$name";
    }

    foreach (array_get($method_settings, 'optional-parameters', []) as $name => $settings) {
        $result[] = "\$$name";
    }

    return implode(', ', $result);
}

function generate_function_payload($method_settings)
{
    $parameters = array_get($method_settings, 'parameters', []);
    $optional_paramters = array_get($method_settings, 'optional-parameters', []);
    $optional = array_get($method_settings, 'optional', []);

    $result = '[]';

    return $result;
}