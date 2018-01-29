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
     * Constructor.
     *
     * @return void
     */
    public function __construct(...$args)
    {
        if ($this->fillable) {
            $fill = array_pop($args);

            if (count($fill)) {
                $this->setAttributes($fill);
            }
        }

        $this->endpoint_placeholders = $args;
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
        foreach ($data as $key => $value) {
            $this->attributes[$key] = $value;
        }

        $dirty = [];

        // Check attributes against the original attributes array.
        foreach ($this->attributes as $key => $value) {
            if (!isset($this->original_attributes[$key]) || $value != $this->original_attributes[$key]) {
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
        $result = $this->makeApiCall($method, $uri, $payload, $settings);

        // Fill this model with the returned data.
        if (isset($settings['auto-fill']) && $settings['auto-fill'] == true) {
            $this->setAttributes($result);
        }

        return $result;
    }

    /**
     * Search.
     *
     * @param string $endpoint
     *
     * @return ApiSearch
     */
    protected function apiSearch($endpoint, $factory_settings = [])
    {
        return new ApiSearch($endpoint, $this->endpoint_placeholders, $factory_settings);
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
