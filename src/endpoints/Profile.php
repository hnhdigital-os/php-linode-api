<?php

namespace HnhDigital\LinodeApi;

/*
 * This file is part of the PHP Linode API.
 *
 * (c) H&H|Digital <hello@hnh.digital>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

use HnhDigital\LinodeApi\Foundation\Base;

/**
 * This is the Profile class.
 *
 * This file is automatically generated.
 *
 * @link https://developers.linode.com/v4/reference/profile
 *
 * @author Rocco Howard <rocco@hnh.digital>
 */
class Profile extends Base
{
    /**
     * Endpoint.
     *
     * @var string
     */
    protected $endpoint = 'profile';

    /**
     * Grants.
     *
     * @var array
     */
    public $grants = [];

    /**
     * This model is fillable.
     *
     * @type bool
     */
    protected $fillable = true;

    /**
     * This model's method that provides the data to fill it.
     *
     * @type string
     */
    protected $fill_method = 'get';

    /**
     * Constructor.
     *
     * @return void
     */
    public function __construct($fill = [])
    {
        parent::__construct($fill);
    }

    /**
     * Returns your user information.
     *
     * @link https://developers.linode.com/v4/reference/endpoints/profile#GET
     *
     * @return array
     */
    public function get()
    {
        return $this->apiCall('get', '', [], ['auto-fill' => true]);
    }

    /**
     * Return grants for your user. If your user is unrestricted, this returns an error. Hides entities that your user has no access to that would be visible to an unrestricted user.
     *
     * @link https://developers.linode.com/v4/reference/endpoints/profile/grants#GET
     *
     * @return array
     */
    public function grants()
    {
        return $this->apiCall('get', '/grants', [], ['auto-fill' => 'grants']);
    }

    /**
     * Edits your user's profile.
     *
     * @link https://developers.linode.com/v4/reference/endpoints/profile#PUT
     *
     * @return void
     */
    public function update($optional = [])
    {
        return $this->apiCall('put', '', ['json' => $this->getDirty($optional)]);
    }

    /**
     * Edits your user's profile.
     *
     * @param string $password Password.
     *
     * @link https://developers.linode.com/v4/reference/endpoints/profile/password
     *
     * @return mixed
     */
    public function password($password)
    {
        return $this->apiCall('post', '/password', ['json' => [
            'password' => $password,
        ]]);
    }
}