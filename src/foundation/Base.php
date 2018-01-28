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
     * Endpoint URI
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
                $this->assign($fill);
            }
        }

        $this->endpoint_placeholders = $args;
    }

    /**
     * Assign data to this object.
     *
     * @param array $fill
     *
     * @return void
     */
    private function assign($fill)
    {
        foreach ($fill as $key => $value) {
            $this->attributes[$key] = $value;
            $this->original_attributes[$key] = $value;
        }
    }

    /**
     * Search.
     *
     * @param string $endpoint
     *
     * @return ApiSearch
     */
    protected function apiSearch($endpoint, $factory_settings)
    {
        return new ApiSearch($endpoint, $factory_settings);
    }

    /**
     * Set the base endpoint.
     *
     * @return void
     */
    public static function endpoint($base_endpoint)
    {
        self::$base_endpoint = $base_endpoint;
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

        return null;
    }

    /**
     * Set the value for this key.
     *
     * @param string $key
     * @param mixed $value
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
