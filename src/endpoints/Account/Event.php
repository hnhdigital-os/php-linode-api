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
 * This is the Event class.
 *
 * This file is automatically generated.
 *
 * @link https://developers.linode.com/api/v4#tag/Account-Events
 *
 * @author Rocco Howard <rocco@hnh.digital>
 */
class Event extends Base
{
    /**
     * Endpoint.
     *
     * @var string
     */
    protected $endpoint = 'account/events/%s';

    /**
     * Event Id.
     *
     * @var int
     */
    protected $event_id;

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
    public function __construct($event_id, $fill = [])
    {
        $this->event_id = $event_id;
        parent::__construct($event_id, $fill);
    }

    /**
     * Returns a single Event object.
     *
     * @link https://developers.linode.com/api/v4#operation/getEvent
     *
     * @return array
     */
    public function get()
    {
        return $this->apiCall('get', '', [], ['auto-fill' => true]);
    }

    /**
     * Marks a single Event as read.
     *
     * @param int $event_id The ID of the Event to designate as read.
     *
     * @link https://developers.linode.com/api/v4#operation/eventRead
     *
     * @return mixed
     */
    public function eventRead($optional = [])
    {
        return $this->apiCall('post', '/read', ['json' => array_merge([
            'event_id' => $event_id,
        ], $optional)]);
    }

    /**
     * Marks all Events up to and including this Event by ID as seen.
     *
     * @param int $event_id The ID of the Event to designate as seen.
     *
     * @link https://developers.linode.com/api/v4#operation/eventSeen
     *
     * @return mixed
     */
    public function eventSeen($optional = [])
    {
        return $this->apiCall('post', '/seen', ['json' => array_merge([
            'event_id' => $event_id,
        ], $optional)]);
    }
}
