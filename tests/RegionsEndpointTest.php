<?php

namespace HnhDigital\LinodeApi\Tests;

use HnhDigital\LinodeApi\Region;
use HnhDigital\LinodeApi\Regions;

class RegionsEndpointTest extends BaseTest
{
    /**
     * Test GET /regions.
     *
     * @return void
     */
    public function testGetRegions()
    {
        // Regions data.
        $data = [
            'pages'   => 1,
            'results' => 1,
            'data'    => [
                [
                    'id'      => 'us-east-1a',
                    'country' => 'US',
                ],
            ],
            'page' => 1,
        ];

        // Setup test server at path and with response data.
        $this->mockRequest('GET', '/regions?page=1', $data);

        // Create a new regions endpoint.
        $result = (new Regions())->search()->all();

        // Create the same object that it should return.
        $region = new Region('us-east-1a', array_get($data, 'data.0'));

        // Compare.
        $this->assertEquals($region, array_get($result, 0));
    }

    /**
     * Test GET regions/$region_id.
     *
     * @return void
     */
    public function testGetRegion()
    {
        // Region data.
        $data = [
            'id'      => 'us-east-1a',
            'country' => 'US',
        ];

        // Setup test server at path and with response data.
        $this->mockRequest('GET', '/regions/us-east-1a', $data);

        // Create the same object that it should return.
        $region = new Region('us-east-1a', true);

        // Create the same object that it should return.
        $populated_region = new Region('us-east-1a', $data);

        // Compare the populated attributes.
        $this->assertEquals($populated_region->getAttributes(), $region->getAttributes());

        // Get the data directly.
        $result = $region->get();

        // Compare.
        $this->assertEquals($data, $result);
    }
}
