<?php

namespace HnhDigital\LinodeApi\Tests;

use HnhDigital\LinodeApi\Kernel;
use HnhDigital\LinodeApi\Kernels;

class LinodeKernelsEndpointTest extends BaseTest
{
    /**
     * Test GET /regions.
     *
     * @return void
     */
    public function testGetKernels()
    {
        // Kernels data.
        $data = [
            'pages'   => 1,
            'results' => 1,
            'data'    => [
                [
                    'id'           => 'linode/latest-64bit',
                    'xen'          => false,
                    'kvm'          => true,
                    'label'        => 'Latest 64 bit (4.9.50-x86_64-linode86)',
                    'version'      => '3.5.2',
                    'architecture' => 'x86_64',
                    'pvops'        => false,
                ],
            ],
            'page' => 1,
        ];

        // Setup test server at path and with response data.
        $this->mockRequest('GET', '/linode/kernels?page=1', $data);

        // Create a new regions endpoint.
        $result = (new Kernels())->search()->all();

        // Create the same object that it should return.
        $kernel = new Kernel('linode/latest-64bit', array_get($data, 'data.0'));

        // Compare.
        $this->assertEquals($kernel, array_get($result, 0));
    }

    /**
     * Test GET kernels/$kernel_id.
     *
     * @return void
     */
    public function testGetKernel()
    {
        // Kernel data.
        $data = [
            'id'           => 'linode/latest-64bit',
            'xen'          => false,
            'kvm'          => true,
            'label'        => 'Latest 64 bit (4.9.50-x86_64-linode86)',
            'version'      => '3.5.2',
            'architecture' => 'x86_64',
            'pvops'        => false,
        ];

        // Setup test server at path and with response data.
        $this->mockRequest('GET', '/linode/kernels/linode/latest-64bit', $data);
    }
}
