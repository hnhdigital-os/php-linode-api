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
 * This is the Kernel class.
 *
 * This file is automatically generated.
 *
 * @link https://developers.linode.com/v4/reference/endpoints/kernels/$id
 *
 * @author Rocco Howard <rocco@hnh.digital>
 */
class Kernel extends Base
{
    /**
     * Endpoint.
     *
     * @var string
     */
    protected $endpoint = 'linode/kernels/%s';
    /**
     * Kernel Id.
     *
     * @var int
     */
    protected $kernel_id;

    /**
     * Constructor.
     *
     * @return void
     */
    public function __construct($kernel_id, $fill = [])
    {
        $this->kernel_id = $kernel_id;
        $this->fillable = true;
        parent::__construct($kernel_id, $fill);
    }

    /**
     * Returns information about this kernel.
     *
     * @link https://developers.linode.com/v4/reference/endpoints/kernels/$id#GET
     *
     * @return array
     */
    public function get()
    {
        return $this->apiCall('get', '');
    }
}
