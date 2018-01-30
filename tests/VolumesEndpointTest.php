<?php

namespace HnhDigital\LinodeApi\Tests;

use HnhDigital\LinodeApi\Volume;
use HnhDigital\LinodeApi\Volumes;

class VolumesEndpointTest extends BaseTest
{
    private $data = [
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

    /**
     * Test GET /volumes.
     *
     * @return void
     */
    public function testGetVolumes()
    {
        // Setup test server at path and with response data.
        $this->mockGetRequest('/volumes?page=1', $this->data);

        // Create a new volumes endpoint.
        $result = (new Volumes())->search()->all();

        // Create the same object that it should return.
        $volume = new Volume(123, array_get($this->data, 'data.0'));

        // Compare.
        $this->assertEquals($volume, array_get($result, 0));
    }

    /**
     * Test GET /volumes/$volume_id.
     *
     * @return void
     */
    public function testGetVolume()
    {
        // Setup test server at path and with response data.
        $this->mockGetRequest('/volumes/123', array_get($this->data, 'data.0'));

        // Create the same object that it should return.
        $volume = new Volume(123, true);

        // Create the same object that it should return.
        $populated_volume = new Volume(123, array_get($this->data, 'data.0'));

        // Compare the populated attributes.
        $this->assertEquals($populated_volume->getAttributes(), $volume->getAttributes());

        // Get the data directly.
        $result = $volume->get();

        // Compare.
        $this->assertEquals(array_get($this->data, 'data.0'), $result);
    }

    /**
     * Test POST /volumes.
     *
     * @return void
     */
    public function testCreateVolume()
    {
        // Setup test server at path and with response data.
        $this->mockPostRequest('/volumes', array_get($this->data, 'data.0'));

        $volumes = new Volumes();
        $response = $volumes->create('us-east-1a', 'my-volume');

        $request_body = $this->getRequestBody();

        $this->assertEquals($request_body, [
            'label'  => 'my-volume',
            'region' => 'us-east-1a',
        ]);

        $this->assertEquals(array_get($this->data, 'data.0'), $response);
    }
}
