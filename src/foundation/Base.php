<?php

namespace HnhDigital\LinodeApi\Foundation;

/*
 * This file is part of the PHP Linode API.
 *
 * (c) H&H|Digital <hello@hnh.digital>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

/**
 * This is the API Request class.
 *
 * @author Rocco Howard <rocco@hnh.digital>
 */
class Base
{
    use ApiRequestTrait;

    /**
     * Endpoint URI.
     *
     * @var string
     */
    protected $endpoint;

    /**
     * Endpoint placeholders.
     *
     * @var array
     */
    protected $endpoint_placeholders = [];

    /**
     * Attributes.
     *
     * @var array
     */
    protected $attributes = [];

    /**
     * Original attributes.
     *
     * @var array
     */
    protected $original_attributes = [];

    /**
     * Is fillable?
     *
     * @var bool
     */
    protected $fillable = false;

    /**
     * Method used to auto-fill.
     *
     * @var bool
     */
    protected $fill_method;

    /**
     * Constructor.
     *
     * @return void
     */
    public function __construct(...$args)
    {
        // Model is set be fillable, last item is our fill data or
        // indicator to run the fill method.
        if ($this->fillable) {
            $fill = array_pop($args);
        }

        // Set the endpoint placeholders. Endpoints use sprintf to generate.
        $this->endpoint_placeholders = $args;

        // Model is fillable, let's check the fill data or indicator to fill.
        if ($this->fillable) {

            // Fill is set to true, so we use the provided method
            // to auto-retrieve the data.
            if ($fill === true && is_string($this->fill_method)) {
                $method = $this->fill_method;
                $fill = $this->$method();
            }

            // The fill variable is an array and has items - allocate
            // these to the attributes array.
            if (is_array($fill) && count($fill)) {
                $this->setAttributes($fill);
            }
        }
    }

    /**
     * Assign data to the attributes of this model.
     *
     * @param array $attributes
     *
     * @return void
     */
    private function setAttributes($attributes)
    {
        // Allocate each key/value pair to the attributes array
        // and the original attributes array.
        // We compare these two array's to calculate what's dirty.
        foreach ($attributes as $key => $value) {
            $this->attributes[$key] = $value;
            $this->original_attributes[$key] = $value;
        }
    }

    /**
     * Get an array of attributes.
     *
     * @param array $data
     *
     * @return void
     */
    public function getAttributes()
    {
        return $this->attributes;
    }

    /**
     * Get an array of attributes.
     *
     * @param array $data
     *
     * @return void
     */
    public function getOriginalAttributes()
    {
        return $this->original_attributes;
    }

    /**
     * Get an array of changed attributes.
     *
     * @param array $data
     *
     * @return void
     */
    public function getDirty($data = [])
    {
        // Allocate provided values, so these can appear dirty.
        $this->setAttributes($data);

        $dirty = [];

        // Check attributes against the original attributes array.
        foreach ($this->attributes as $key => $value) {
            if (!isset($this->original_attributes[$key])
             || $value != $this->original_attributes[$key]) {
                $dirty[$key] = $value;
            }
        }

        return $dirty;
    }

    /**
     * Make an API call.
     *
     * @param string $method
     * @param string $uri
     * @param string $payload
     * @param string $settings
     *
     * @return array
     */
    protected function apiCall($method, $uri = '', $payload = [], $settings = [])
    {
        // Make the call to the endpoint with the given method, uri,
        // payload and any settings that we need to pass on.
        $result = $this->makeApiCall($method, $uri, $payload, $settings);

        // Fill this model with the returned data.
        if (isset($settings['auto-fill'])) {
            if ($settings['auto-fill'] === true) {
                $this->setAttributes($result);
            } elseif (strlen($var_name = $settings['auto-fill'])) {
                $this->$var_name = $result;
            }
        }

        return $result;
    }

    /**
     * This API call returns a search object that handles the more complex
     * needs of a search based request.
     *
     * @param string $endpoint
     *
     * @return ApiSearch
     */
    protected function apiSearch($endpoint, $factory_settings = [])
    {
        return new ApiSearch(
            $endpoint,
            $this->endpoint_placeholders,
            $factory_settings
        );
    }

    /**
     * Set the base endpoint.
     *
     * @return void
     */
    public static function endpoint($base_endpoint)
    {
        Auth::setBaseEndpoint($base_endpoint);
    }

    /**
     * Set the token.
     *
     * @return void
     */
    public static function token($token)
    {
        Auth::setToken($token);
    }

    /**
     * Get the value for this key.
     *
     * @param string $key
     *
     * @return mixed|null
     */
    public function __get($key)
    {
        if (isset($this->attributes[$key])) {
            return $this->attributes[$key];
        }
    }

    /**
     * Set the value for this key.
     *
     * @param string $key
     * @param mixed  $value
     *
     * @return $this
     */
    public function __set($key, $value)
    {
        if (isset($this->attributes[$key])) {
            return $this->attributes[$key] = $value;
        }

        return $this;
    }
}
