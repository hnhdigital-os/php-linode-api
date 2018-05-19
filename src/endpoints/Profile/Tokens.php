<?php

namespace HnhDigital\LinodeApi\Profile;

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
 * This is the Tokens class.
 *
 * This file is automatically generated.
 *
 * @link https://developers.linode.com/api/v4#tag/Profile-Tokens
 *
 * @author Rocco Howard <rocco@hnh.digital>
 */
class Tokens extends Base
{
    /**
     * Endpoint.
     *
     * @var string
     */
    protected $endpoint = 'profile/tokens';


    /**
     * Constructor.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Returns a paginated list of Personal Access Tokens currently active for your User.
     *
     * @link https://developers.linode.com/api/v4#operation/getPersonalAccessTokens
     *
     * @return array
     */
    public function get()
    {
        return $this->apiCall('get', '');
    }

    /**
     * Creates a Personal Access Token for your User. The raw token will be returned in the response, but will never be
     * returned again afterward so be sure to take note of it. You may create a token with _at most_ the scopes of your current
     * token. The created token will be able to access your Account until the given expiry, or until it is revoked.
     *
     * @link https://developers.linode.com/api/v4#operation/createPersonalAccessToken
     *
     * @return mixed
     */
    public function createPersonalAccessToken()
    {
        return $this->apiCall('post', '');
    }
}
