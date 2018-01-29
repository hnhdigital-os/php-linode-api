<?php

namespace HnhDigital\LinodeApi\Tests;

use HnhDigital\LinodeApi\Regions;
use HnhDigital\LinodeApi\Region;
use HnhDigital\LinodeApi\Foundation\Auth;

class RegionsTest extends BaseTest
{
    public function testSimpleRequest()
    {
        // Regions data.
        $regions_data = [
            'pages' => 1,
            'results' => 1,
            'data' => [
                [
                    "id"      => "us-east-1a",
                    "country" => "US"
                ]
            ],
            'page' => 1,
        ];

        // Mock the API endpoint and result.
        $this->http->mock
            ->when()
                ->methodIs('GET')
                ->pathIs('/regions?page=1')
            ->then()
                ->body(json_encode($regions_data))
            ->end();

        $this->http->setUp();

        // Ensure the mock server responds with the same data.
        $this->assertSame(json_encode($regions_data), file_get_contents('http://localhost:8082/regions?page=1'));

        // Set the Linode API to this local server.
        Auth::setBaseEndpoint('http://localhost:8082/');

        // Create a new regions endpoint.
        $result = (new Regions())->search()->all();

        // Create the same object that it should return.
        $region = new Region('us-east-1a', array_get($regions_data, 'data.0'));

        // Compare.
        $this->assertEquals($region, array_get($result, 0));
    }
}
