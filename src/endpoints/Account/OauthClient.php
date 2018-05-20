<?php

namespace HnhDigital\LinodeApi\Account;

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
 * This is the OauthClient class.
 *
 * This file is automatically generated.
 *
 * @link https://developers.linode.com/api/v4#tag/Account-OauthClients
 *
 * @author Rocco Howard <rocco@hnh.digital>
 */
class OauthClient extends Base
{
    /**
     * Endpoint.
     *
     * @var string
     */
    protected $endpoint = 'account/oauth-clients/%s';

    /**
     * Client Id.
     *
     * @var string
     */
    protected $client_id;

    /**
     * This model is fillable.
     *
     * @var bool
     */
    protected $fillable = true;

    /**
     * This model's method that provides the data to fill it.
     *
     * @var string
     */
    protected $fill_method = 'get';

    /**
     * Constructor.
     *
     * @return void
     */
    public function __construct($client_id, $fill = [])
    {
        $this->client_id = $client_id;
        parent::__construct($client_id, $fill);
    }

    /**
     * Returns information about a single OAuth client.
     *
     * @link https://developers.linode.com/api/v4#operation/getClient
     *
     * @return array
     */
    public function get()
    {
        return $this->apiCall('get', '', [], ['auto-fill' => true]);
    }

    /**
     * Returns the thumbnail for this OAuth Client.  This is a publicly-viewable endpoint, and can be accessed without
     * authentication.
     *
     * @link https://developers.linode.com/api/v4#operation/getClientThumbnail
     *
     * @return array
     */
    public function getClientThumbnail()
    {
        return $this->apiCall('get', '/thumbnail', [], ['auto-fill' => true]);
    }

    /**
     * Upload a thumbnail for a client you own.  You must upload an image file that will be returned when the thumbnail is
     * retrieved.  This image will be publicly-viewable.
     *
     * @param string $client_id The OAuth Client ID to look up.
     *
     * @link https://developers.linode.com/api/v4#operation/setClientThumbnail
     *
     * @return void
     */
    public function update($optional = [])
    {
        return $this->apiCall('put', '/thumbnail', ['json' => $this->getDirty($optional)]);
    }

    /**
     * Resets the OAuth Client secret for a client you own, and returns the OAuth Client with the plaintext secret. This secret
     * is not supposed to be publicly known or disclosed anywhere. This can be used to generate a new secret in case the one
     * you have has been leaked, or to get a new secret if you lost the original. The old secret is expired immediately, and
     * logins to your client with the old secret will fail.
     *
     * @param string $client_id The OAuth Client ID to look up.
     *
     * @link https://developers.linode.com/api/v4#operation/resetClientSecret
     *
     * @return mixed
     */
    public function resetClientSecret($optional = [])
    {
        return $this->apiCall('post', '/reset-secret', ['json' => array_merge([
            'client_id' => $client_id,
        ], $optional)]);
    }

    /**
     * Deletes an OAuth Client registered with Linode. The Client ID and Client secret will no longer be accepted by
     * https://login.linode.com, and all tokens issued to this client will be invalidated (meaning that if your application was
     * using a token, it will no longer work).
     *
     * @param string $client_id The OAuth Client ID to look up.
     *
     * @link https://developers.linode.com/api/v4#operation/deleteClient
     *
     * @return void
     */
    public function delete()
    {
        return $this->apiCall('delete', '');
    }
}
