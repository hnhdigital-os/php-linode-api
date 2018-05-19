<?php

namespace HnhDigital\LinodeApi\Tests;

use HnhDigital\LinodeApi\Linode\Type;
use HnhDigital\LinodeApi\Linode\Types;

class TypesEndpointTest extends BaseTest
{
    /**
     * Test GET /linode/types.
     *
     * @return void
     */
    public function testGetTypes()
    {
        // Types data.
        $data = [
            'pages'   => 1,
            'results' => 1,
            'data'    => [
                [
                    'id'    => 'linode2048.5',
                    'disk'  => 24576,
                    'class' => [],
                    'price' => [
                        'hourly'  => 1.44,
                        'monthly' => 1000,
                    ],
                    'label'  => 'Linode 2048',
                    'addons' => [
                        'backups' => [
                        'price' => [
                                'hourly'  => 0.004,
                                'monthly' => 2.5,
                            ],
                        ],
                    ],
                    'network_out' => 125,
                    'memory'      => 2048,
                    'transfer'    => 2000,
                    'vcpus'       => 2,
                ],
            ],
            'page' => 1,
        ];

        // Setup test server at path and with response data.
        $this->mockGetRequest('/linode/types?page=1', $data);

        // Create a new types endpoint.
        $result = (new Types())->get()->all();

        // Create the same object that it should return.
        $type = new Type('linode2048.5', array_get($data, 'data.0'));

        // Compare.
        $this->assertEquals($type, array_get($result, 0));
    }

    /**
     * Test GET linode/types/$type_id.
     *
     * @return void
     */
    public function testGetType()
    {
        // Type data.
        $data = [
            'id'    => 'linode2048.5',
            'disk'  => 24576,
            'class' => [],
            'price' => [
                'hourly'  => 1.44,
                'monthly' => 1000,
            ],
            'label'  => 'Linode 2048',
            'addons' => [
                'backups' => [
                'price' => [
                        'hourly'  => 0.004,
                        'monthly' => 2.5,
                    ],
                ],
            ],
            'network_out' => 125,
            'memory'      => 2048,
            'transfer'    => 2000,
            'vcpus'       => 2,
        ];

        // Setup test server at path and with response data.
        $this->mockGetRequest('/linode/types/linode2048.5', $data);

        // Create the same object that it should return.
        $type = new Type('linode2048.5');

        // Data.
        $result = $type->get();

        // Create the same object that it should return.
        $populated_type = new Type('linode2048.5', $data);

        // Compare.
        $this->assertEquals($data, $result);

        // Compare the populated attributes.
        $this->assertEquals($populated_type->getAttributes(), $type->getAttributes());
    }
}
