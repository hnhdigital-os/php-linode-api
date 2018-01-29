<?php

namespace HnhDigital\LinodeApi\Instance;

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
 * This is the Disks class.
 *
 * This file is automatically generated.
 *
 * @link https://developers.linode.com/v4/reference/endpoints/linode/instances/$id/disks
 *
 * @author Rocco Howard <rocco@hnh.digital>
 */
class Disks extends Base
{
    /**
     * Endpoint.
     *
     * @var string
     */
    protected $endpoint = 'linode/instances/%s/disks';
    /**
     * Linode Id.
     *
     * @var int
     */
    protected $linode_id;

    /**
     * Constructor.
     *
     * @return void
     */
    public function __construct($linode_id)
    {
        $this->linode_id = $linode_id;
        parent::__construct($linode_id);
    }

    /**
     * Returns a Backups Response with information on this Linode's available backups.
     *
     * @link https://developers.linode.com/v4/reference/endpoints/linode/instances/$id/backups#GET
     *
     * @return array
     */
    public function all()
    {
        return $this->apiSearch($this->endpoint);
    }

    /**
     * Creates a new disk.
     *
     * @param int    $size     Size in MB for this disk.
     * @param string $label    User-friendly string to name this disk.
     * @param array  $optional
     *                         - [image] (string) Optional image id to deploy the disk from. You may not provide image if distribution is provided. Official images start with "linode/", while your images start with "private/"
     *                         - [root_pass] (string) Root password to deploy distribution with.
     *                         - [authorized_keys=[]] (array) An array of public SSH keys to be installed into the distribution's default user's `authorized_keys` file when creating a new disk from a Linode provided distribution.
     *                         - [filesystem='ext4'] (string) A filesystem for this disk. Defaults to "ext4".
     *                         - [read_only=null] (boolean) If true, this disk is read-only.
     *                         - [stackscript_id] (int) The stackscript ID to deploy with this disk. Must provide a distribution. Distribution must be one that the stackscript can be deployed to.
     *                         - [stackscript_data] (json) UDF (user-defined fields) for this stackscript. Defaults to "{}". Must match UDFs required by stackscript.
     *
     *
     * @link https://developers.linode.com/v4/reference/endpoints/linode/instances/$id/backups#POST
     *
     * @return bool
     */
    public function create($size, $label, $optional = [])
    {
        return $this->call('post', '', array_merge([
            'size'  => $size
            'label' => $label
        , $optional]));
    }
}
