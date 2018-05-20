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
 * This is the Services class.
 *
 * This file is automatically generated.
 *
 * @link https://developers.linode.com/api/v4#tag/Managed-Services
 *
 * @author Rocco Howard <rocco@hnh.digital>
 */
class Services extends Base
{
    /**
     * Endpoint.
     *
     * @var string
     */
    protected $endpoint = 'managed/services';

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
     * Returns a paginated list of Managed Services on your Account. These are the services Linode Managed is monitoring and
     * will report and attempt to resolve issues with.
     *
     * @link https://developers.linode.com/api/v4#operation/getManagedServices
     *
     * @return array
     */
    public function get()
    {
        return $this->apiSearch($this->endpoint, ['class' => 'Managed\Service', 'parameters' => ['id']]);
    }

    /**
     * Creates a Managed Service. Linode Managed will being monitoring this service and reporting and attempting to resolve any
     * Issues.
     *
     * @param int    $id=null                 (optional)This Service's unique ID.

     * @param string $status=null             (optional)The current status of this Service.

     * @param string $service_type=null       (optional)How this Service is monitored.

     * @param string $label=null              (optional)The label for this Service. This is for display purposes only.

     * @param string $address=null            (optional)The URL at which this Service is monitored.

     * @param int    $timeout=null            (optional)How long to wait, in seconds, for a response before considering the Service to be down.

     * @param string $body=null               (optional)What to expect to find in the response body for the Service to be considered up.

     * @param string $consultation_group=null (optional)The group of ManagedContacts who should be notified or consulted with when an Issue is detected.

     * @param string $notes=null              (optional)Any information relevant to the Service that Linode special forces should know when attempting to resolve Issues.

     * @param string $region=null             (optional)The Region in which this Service is located. This is required if address is a private IP, and may not be set otherwise.

     * @param array  $credentials=[]          (optional)An array of ManagedCredential IDs that should be used when attempting to resolve issues with this Service.

     * @param string $created=null            (optional)When this Managed Service was created.
     * @param string $updated=null            (optional)When this Managed Service was last updated.
     *
     * @link https://developers.linode.com/api/v4#operation/createManagedService
     *
     * @return mixed
     */
    public function create($optional = [])
    {
        return $this->apiCall('post', '', ['json' => array_merge([
        ], $optional)]);
    }
}
