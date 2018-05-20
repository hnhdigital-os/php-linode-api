<?php

namespace HnhDigital\LinodeApi\Linode;

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
 * This is the Instance class.
 *
 * This file is automatically generated.
 *
 * @link https://developers.linode.com/api/v4#tag/Linode-Instances
 *
 * @author Rocco Howard <rocco@hnh.digital>
 */
class Instance extends Base
{
    /**
     * Endpoint.
     *
     * @var string
     */
    protected $endpoint = 'linode/instances/%s';

    /**
     * Linode Id.
     *
     * @var int
     */
    protected $linode_id;

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
    public function __construct($linode_id, $fill = [])
    {
        $this->linode_id = $linode_id;
        parent::__construct($linode_id, $fill);
    }

    /**
     * Get a specific Linode by ID.
     *
     * @link https://developers.linode.com/api/v4#operation/getLinodeInstance
     *
     * @return array
     */
    public function get()
    {
        return $this->apiCall('get', '', [], ['auto-fill' => true]);
    }

    /**
     * Returns information about this Linode's available backups.
     *
     * @link https://developers.linode.com/api/v4#operation/getBackups
     *
     * @return array
     */
    public function getBackups()
    {
        return $this->apiCall('get', '/backups', [], ['auto-fill' => true]);
    }

    /**
     * Lists Configuration profiles associated with a Linode.
     *
     * @link https://developers.linode.com/api/v4#operation/getLinodeConfigs
     *
     * @return array
     */
    public function getConfigs()
    {
        return $this->apiSearch($this->endpoint.'/configs', ['class' => 'Linode\Config', 'parameters' => ['id']]);
    }

    /**
     * View Disk information for Disks associated with this Linode.
     *
     * @link https://developers.linode.com/api/v4#operation/getLinodeDisks
     *
     * @return array
     */
    public function getDisks()
    {
        return $this->apiCall('get', '/disks', [], ['auto-fill' => true]);
    }

    /**
     * Returns networking information for a single Linode.
     *
     * @link https://developers.linode.com/api/v4#operation/getLinodeIPs
     *
     * @return array
     */
    public function getIPs()
    {
        return $this->apiCall('get', '/ips', [], ['auto-fill' => true]);
    }

    /**
     * Returns CPU, IO, IPv4, and IPv6 statistics for your Linode for the past 24 hours.
     *
     * @link https://developers.linode.com/api/v4#operation/getLinodeStats
     *
     * @return array
     */
    public function getStats()
    {
        return $this->apiCall('get', '/stats', [], ['auto-fill' => true]);
    }

    /**
     * View Block Storage Volumes attached to this Linode.
     *
     * @link https://developers.linode.com/api/v4#operation/getLinodeVolumes
     *
     * @return array
     */
    public function getVolumes()
    {
        return $this->apiCall('get', '/volumes', [], ['auto-fill' => true]);
    }

    /**
     * Updates a Linode that you have permission to `read_write`.
     *
     * @param int $linode_id ID of the Linode to look up
     *
     * @link https://developers.linode.com/api/v4#operation/updateLinodeInstance
     *
     * @return void
     */
    public function update($optional = [])
    {
        return $this->apiCall('put', '', ['json' => $this->getDirty($optional)]);
    }

    /**
     * Creates a snapshot Backup of a Linode.
     *  If you already have a snapshot of this Linode, this is a destructive action. The previous snapshot will be deleted.
     *
     * @param int $linode_id The ID of the Linode the backups belong to.
     *
     * @link https://developers.linode.com/api/v4#operation/createSnapshot
     *
     * @return mixed
     */
    public function createSnapshot($optional = [])
    {
        return $this->apiCall('post', '/backups', ['json' => array_merge([
            'linode_id' => $linode_id,
        ], $optional)]);
    }

    /**
     * Cancels the Backup service on the given Linode. Deletes all of this Linode's existing backups forever.
     *
     * @param int $linode_id The ID of the Linode to cancel backup service for.
     *
     * @link https://developers.linode.com/api/v4#operation/cancelBackups
     *
     * @return mixed
     */
    public function cancelBackups($optional = [])
    {
        return $this->apiCall('post', '/backups/cancel', ['json' => array_merge([
            'linode_id' => $linode_id,
        ], $optional)]);
    }

    /**
     * Enables backups for the specified Linode.
     *
     * @param int $linode_id The ID of the Linode to enable backup service for.
     *
     * @link https://developers.linode.com/api/v4#operation/enableBackups
     *
     * @return mixed
     */
    public function enableBackups($optional = [])
    {
        return $this->apiCall('post', '/backups/enable', ['json' => array_merge([
            'linode_id' => $linode_id,
        ], $optional)]);
    }

    /**
     * Boots a Linode you have permission to modify. If no parameters are given, a Config profile
     * will be chosen for this boot based on the following criteria:.
     *
     * - If there is only one Config profile for this Linode, it will be used.
     * - If there is more than one Config profile, the last booted config will be used.
     * - If there is more than one Config profile and none were the last to be booted (because the
     *   Linode was never booted or the last booted config was deleted) an error will be returned.
     *
     * @param int $linode_id The ID of the Linode to boot.
     *
     * @link https://developers.linode.com/api/v4#operation/bootLinodeInstance
     *
     * @return mixed
     */
    public function boot($optional = [])
    {
        return $this->apiCall('post', '/boot', ['json' => array_merge([
            'linode_id' => $linode_id,
        ], $optional)]);
    }

    /**
     * You can clone your Linode's existing Disks or Configuration profiles to another Linode on your Account. In order for
     * this request to complete successfully, your User must have the `add_linodes` grant. Cloning to a new Linode will incur a
     * charge on your Account.
     * If cloning to an existing Linode, any actions currently running or queued must be completed first before you can clone
     * to it.
     *
     * @param int $linode_id ID of the Linode to clone.
     *
     * @link https://developers.linode.com/api/v4#operation/cloneLinodeInstance
     *
     * @return mixed
     */
    public function cloneLinodeInstance($optional = [])
    {
        return $this->apiCall('post', '/clone', ['json' => array_merge([
            'linode_id' => $linode_id,
        ], $optional)]);
    }

    /**
     * Adds a new Configuration profile to a Linode.
     *
     * @param int $linode_id ID of the Linode to look up Configuration profiles for.
     *
     * @link https://developers.linode.com/api/v4#operation/addLinodeConfig
     *
     * @return mixed
     */
    public function addConfig($optional = [])
    {
        return $this->apiCall('post', '/configs', ['json' => array_merge([
            'linode_id' => $linode_id,
        ], $optional)]);
    }

    /**
     * Adds a new Disk to a Linode. You can optionally create a Disk from an Image (see [/images](/#operation/getImages) for a
     * list of available public images, or use one of your own), and optionally provide a StackScript to deploy with this Disk.
     *
     * @param int $linode_id ID of the Linode to look up.
     *
     * @link https://developers.linode.com/api/v4#operation/addLinodeDisk
     *
     * @return mixed
     */
    public function addDisk($optional = [])
    {
        return $this->apiCall('post', '/disks', ['json' => array_merge([
            'linode_id' => $linode_id,
        ], $optional)]);
    }

    /**
     * Allocates a public or private IPv4 address to a Linode. Public IP Addresses, after the one included with each Linode,
     * incur an additional monthly charge. If you need an additional public IP Address you must request one - please [open a
     * support ticket](/#operation/createTicket). You may not add more than one private IPv4 address to a single Linode.
     *
     * @param int $linode_id ID of the Linode to look up.
     *
     * @link https://developers.linode.com/api/v4#operation/addLinodeIP
     *
     * @return mixed
     */
    public function addIP($optional = [])
    {
        return $this->apiCall('post', '/ips', ['json' => array_merge([
            'linode_id' => $linode_id,
        ], $optional)]);
    }

    /**
     * Linodes created with now-deprecated Types are entitled to a free upgrade to the next generation. A mutating Linode will
     * be allocated any new resources the upgraded Type provides, and will be subsequently restarted if it was currently
     * running.
     * If any actions are currently running or queued, those actions must be completed first before you can initiate a mutate.
     *
     * @param int $linode_id ID of the Linode to mutate.
     *
     * @link https://developers.linode.com/api/v4#operation/mutateLinodeInstance
     *
     * @return mixed
     */
    public function mutate($optional = [])
    {
        return $this->apiCall('post', '/mutate', ['json' => array_merge([
            'linode_id' => $linode_id,
        ], $optional)]);
    }

    /**
     * Reboots a Linode you have permission to modify. If any actions are currently running or queued, those actions must be
     * completed first before you can initiate a reboot.
     *
     * @param int $linode_id ID of the linode to reboot.
     *
     * @link https://developers.linode.com/api/v4#operation/rebootLinodeInstance
     *
     * @return mixed
     */
    public function reboot($optional = [])
    {
        return $this->apiCall('post', '/reboot', ['json' => array_merge([
            'linode_id' => $linode_id,
        ], $optional)]);
    }

    /**
     * Rebuilds a Linode you have the `read_write` permission to modify.
     * A rebuild will first shut down the Linode, delete all disks and configs on the Linode, and then deploy a new `image` to
     * the Linode with the given attributes. Additionally:.
     *
     *   - Requires an `image` be supplied.
     *   - Requires a `root_pass` be supplied to use for the root User's Account.
     *   - It is recommended to supply SSH keys for the root User using the
     *     `authorized_keys` field.
     *
     * @param int   $linode_id ID of the Linode to rebuild.
     * @param array $optional
     *                         - [image=null] () 
     *                         - [root_pass=null] () 
     *                         - [authorized_keys=null] () 
     *                         - [stackscript_id=null] () 
     *                         - [stackscript_data=null] () 
     *                         - [booted=null] (boolean) This field defaults to `true` if the Linode is created
     *                           with an Image or from a Backup.
     *                           If it is deployed from an Image or a Backup and you
     *                           wish it to remain `offline` after deployment, set this
     *                           to `false`.
     *
     * @link https://developers.linode.com/api/v4#operation/rebuildLinodeInstance
     *
     * @return mixed
     */
    public function rebuild($optional = [])
    {
        return $this->apiCall('post', '/rebuild', ['json' => array_merge([
            'linode_id' => $linode_id,
        ], $optional)]);
    }

    /**
     * Rescue Mode is a safe environment for performing many system recovery and disk management tasks. Rescue Mode is based on
     * the Finnix recovery distribution, a self-contained and bootable Linux distribution. You can also use Rescue Mode for
     * tasks other than disaster recovery, such as formatting disks to use different filesystems, copying data between disks,
     * and downloading files from a disk via SSH and SFTP.
     * - Note that "sdh" is reserved and unavailable during rescue.
     *
     * @param int $linode_id ID of the Linode to rescue.
     *
     * @link https://developers.linode.com/api/v4#operation/rescueLinodeInstance
     *
     * @return mixed
     */
    public function rescue($optional = [])
    {
        return $this->apiCall('post', '/rescue', ['json' => array_merge([
            'linode_id' => $linode_id,
        ], $optional)]);
    }

    /**
     * Resizes a Linode you have the `read_write` permission to a different Type. If any actions are currently running or
     * queued, those actions must be completed first before you can initiate a resize. Additionally, the following criteria
     * must be met in order to resize a Linode:.
     *
     *   - Any pending free upgrades to the Linode's current Type must be performed
     *   before a resize can occur.
     *   - The Linode must not have a pending migration.
     *   - Your Account cannot have an outstanding balance.
     *   - The Linode must not have more disk allocation than the new Type allows.
     *     - In that situation, you must first delete or resize the disk to be smaller.
     *
     * @param int $linode_id ID of the Linode to resize.
     *
     * @link https://developers.linode.com/api/v4#operation/resizeLinodeInstance
     *
     * @return mixed
     */
    public function resize($optional = [])
    {
        return $this->apiCall('post', '/resize', ['json' => array_merge([
            'linode_id' => $linode_id,
        ], $optional)]);
    }

    /**
     * Shuts down a Linode you have permission to modify. If any actions are currently running or queued, those actions must be
     * completed first before you can initiate a shutdown.
     *
     * @param int $linode_id ID of the Linode to shutdown.
     *
     * @link https://developers.linode.com/api/v4#operation/shutdownLinodeInstance
     *
     * @return mixed
     */
    public function shutdown($optional = [])
    {
        return $this->apiCall('post', '/shutdown', ['json' => array_merge([
            'linode_id' => $linode_id,
        ], $optional)]);
    }

    /**
     * Deletes a Linode you have permission to `read_write`.
     *
     * Deleting a Linode is a destructive action and cannot be undone.
     *
     * Additionally, deleting a Linode:.
     *
     *   - Gives up any IP addresses the Linode was assigned.
     *   - Deletes all Disks, Backups, Configs, etc.
     *   - Stops billing for the Linode and its associated services. You will be billed for time used
     *     within the billing period the Linode was active.
     *
     * @param int $linode_id ID of the Linode to look up
     *
     * @link https://developers.linode.com/api/v4#operation/deleteLinodeInstance
     *
     * @return void
     */
    public function delete()
    {
        return $this->apiCall('delete', '');
    }
}
