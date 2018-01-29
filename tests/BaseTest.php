<?php

namespace HnhDigital\LinodeApi\Tests;

use HnhDigital\LinodeApi\Foundation\Auth;
use InterNations\Component\HttpMock\PHPUnit\HttpMockTrait;
use PHPUnit\Framework\TestCase;

abstract class BaseTest extends TestCase
{
    use HttpMockTrait;

    public static function setUpBeforeClass()
    {
        static::setUpHttpMockBeforeClass('8082', 'localhost');
    }

    public static function tearDownAfterClass()
    {
        static::tearDownHttpMockAfterClass();
    }

    public function setUp()
    {
        $this->setUpHttpMock();
    }

    public function tearDown()
    {
        $this->tearDownHttpMock();
    }

    /**
     * Mock a GET request.
     */
    protected function mockRequest($method, $path, $data)
    {
        // Encode response.
        $encoded_data = json_encode($data);

        // Mock the API endpoint and result.
        $this->http->mock
            ->when()
                ->methodIs($method)
                ->pathIs($path)
            ->then()
                ->body($encoded_data)
            ->end();

        $this->http->setUp();        

        // Set the Linode API to this local server.
        Auth::setBaseEndpoint('http://localhost:8082/');

        // Ensure the mock server responds with the same data.
        $this->assertSame($encoded_data, file_get_contents('http://localhost:8082'.$path));
    }
}
