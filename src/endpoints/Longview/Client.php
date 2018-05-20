<?php

namespace HnhDigital\LinodeApi\Longview;

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
 * This is the Client class.
 *
 * This file is automatically generated.
 *
 * @link https://developers.linode.com/api/v4#tag/Longview-Clients
 *
 * @author Rocco Howard <rocco@hnh.digital>
 */
class Client extends Base
{
    /**
     * Endpoint.
     *
     * @var string
     */
    protected $endpoint = 'longview/clients/%s';

    /**
     * Client Id.
     *
     * @var int
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
     * Returns a single Longview Client you can access.
     *
     * @link https://developers.linode.com/api/v4#operation/getLongviewClient
     *
     * @return array
     */
    public function get()
    {
        return $this->apiCall('get', '', [], ['auto-fill' => true]);
    }

    /**
     * Updates a Longview Client.  This cannot update how it monitors your server; use the Longview Client application on your
     * Linode for monitoring configuration.
     *
     * @param int $client_id The Longview Client ID to access.
     *
     * @link https://developers.linode.com/api/v4#operation/updateLongviewClient
     *
     * @return void
     */
    public function update($optional = [])
    {
        return $this->apiCall('put', '', ['json' => $this->getDirty($optional)]);
    }

    /**
     * Deletes a Longview Client from your Account.
     *
     * All information stored for this client will be lost.
     *
     * This _does not_ uninstall the Longview Client application for your Linode - you must do that manually.
     *
     * @param int $client_id The Longview Client ID to access.
     *
     * @link https://developers.linode.com/api/v4#operation/deleteLongviewClient
     *
     * @return void
     */
    public function delete()
    {
        return $this->apiCall('delete', '');
    }
}
