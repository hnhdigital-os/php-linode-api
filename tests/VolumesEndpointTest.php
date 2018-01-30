<?php

namespace HnhDigital\LinodeApi\Tests;

use HnhDigital\LinodeApi\Volume;
use HnhDigital\LinodeApi\Volumes;

class VolumesEndpointTest extends BaseTest
{
    /**
     * Test GET /volumes.
     *
     * @return void
     */
    public function testGetVolumes()
    {
        // Volumes data.
        $data = [
            'pages'   => 1,
            'results' => 1,
            'data'    => [
                [
                    'id'        => 123,
                    'label'     => 'my-volume',
                    'status'    => 'active',
                    'size'      => 102400,
                    'region'    => 'us-east-1a',
                    'created'   => '2017-06-20T11:21:01',
                    'updated'   => '2017-06-20T11:21:01',
                    'linode_id' => 456,
                ],
            ],
            'page' => 1,
        ];

        // Setup test server at path and with response data.
        $this->mockGetRequest('/volumes?page=1', $data);

        // Create a new volumes endpoint.
        $result = (new Volumes())->search()->all();

        // Create the same object that it should return.
        $volume = new Volume(123, array_get($data, 'data.0'));

        // Compare.
        $this->assertEquals($volume, array_get($result, 0));
    }

    /**
     * Test GET volumes/$volume_id.
     *
     * @return void
     */
    public function testGetVolume()
    {
        // Volume data.
        $data = [
            'id'        => 123,
            'label'     => 'my-volume',
            'status'    => 'active',
            'size'      => 102400,
            'region'    => 'us-east-1a',
            'created'   => '2017-06-20T11:21:01',
            'updated'   => '2017-06-20T11:21:01',
            'linode_id' => 456,
        ];

        // Setup test server at path and with response data.
        $this->mockGetRequest('/volumes/123', $data);

        // Create the same object that it should return.
        $volume = new Volume(123, true);

        // Create the same object that it should return.
        $populated_volume = new Volume(123, $data);

        // Compare the populated attributes.
        $this->assertEquals($populated_volume->getAttributes(), $volume->getAttributes());

        // Get the data directly.
        $result = $volume->get();

        // Compare.
        $this->assertEquals($data, $result);
    }
}
