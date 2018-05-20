<?php

namespace HnhDigital\LinodeApi\Managed;

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
 * This is the Contacts class.
 *
 * This file is automatically generated.
 *
 * @link https://developers.linode.com/api/v4#tag/Managed-Contacts
 *
 * @author Rocco Howard <rocco@hnh.digital>
 */
class Contacts extends Base
{
    /**
     * Endpoint.
     *
     * @var string
     */
    protected $endpoint = 'managed/contacts';

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
     * Returns a paginated list of Managed Contacts on your Account.
     *
     * @link https://developers.linode.com/api/v4#operation/getManagedContacts
     *
     * @return array
     */
    public function get()
    {
        return $this->apiSearch($this->endpoint, ['class' => 'Managed\Contact', 'parameters' => ['id']]);
    }

    /**
     * Creates a Managed Contact.  A Managed Contact is someone Linode special forces can contact in the course of attempting
     * to resolve an issue with a Managed Service.
     *
     * @link https://developers.linode.com/api/v4#operation/createManagedContact
     *
     * @return mixed
     */
    public function create()
    {
        return $this->apiCall('post', '');
    }
}
