<?php

namespace HnhDigital\LinodeApi\Tests;

use HnhDigital\LinodeApi\Foundation\Auth;
use InterNations\Component\HttpMock\PHPUnit\HttpMockTrait;
use PHPUnit\Framework\TestCase;

abstract class BaseTest extends TestCase
{
    use HttpMockTrait;

    /**
     * Setup the http mock.
     *
     * @return void
     */
    public static function setUpBeforeClass()
    {
        static::setUpHttpMockBeforeClass('8082', 'localhost');
    }

    /**
     * Tear down the http mock.
     *
     * @return void
     */
    public static function tearDownAfterClass()
    {
        static::tearDownHttpMockAfterClass();
    }

    /**
     * Setup the http mock.
     *
     * @return void
     */
    public function setUp()
    {
        $this->setUpHttpMock();
    }

    /**
     * Tear down the http mock.
     *
     * @return void
     */
    public function tearDown()
    {
        $this->tearDownHttpMock();
    }

    /**
     * Mock a GET request.
     *
     * @param string $method
     * @param string $path
     * @param array  $data
     *
     * @return void
     */
    protected function mockGetRequest($path, $data)
    {
        // Encode response.
        $encoded_data = json_encode($data);

        // Mock the API endpoint and result.
        $this->http->mock
            ->when()
                ->methodIs('GET')
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

    /**
     * Mock a PUT request.
     *
     * @param string $method
     * @param string $path
     * @param array  $data
     *
     * @return void
     */
    protected function mockPutRequest($path, $data)
    {
        // Encode response.
        $encoded_data = json_encode($data);

        // Mock the API endpoint and result.
        $this->http->mock
            ->when()
                ->methodIs('PUT')
                ->pathIs($path)
            ->then()
                ->body($encoded_data)
            ->end();

        $this->http->setUp();

        // Set the Linode API to this local server.
        Auth::setBaseEndpoint('http://localhost:8082/');
    }

    /**
     * Get the request body that our test server received.
     *
     * @return array|string
     */
    protected function getRequestBody()
    {
        $request = $this->http->requests->last();

        $contents = (string) $request->getBody();

        $decoded_contents = json_decode($contents, true);

        if (json_last_error() === JSON_ERROR_NONE) {
            return $decoded_contents;
        }

        return $contents;
    }
}
