<?php

namespace HnhDigital\LinodeApi\Tests;

use HnhDigital\LinodeApi\Linode\Stackscript;
use HnhDigital\LinodeApi\Profile;

class OverallTest extends BaseTest
{
    /**
     * Test setting, getting attributes.
     *
     * @return void
     */
    public function testAttributes()
    {
        $data = [
            'label' => 'test',
        ];

        $stack_script = new Stackscript(false, $data);

        // Test setting something not in the model.
        $stack_script->test = 1;
        $this->assertEquals([], $stack_script->getDirty());

        // Test getting something not in the model.
        $region = $stack_script->region;
        $this->assertEquals($region, null);

        // Get the attributes.
        $this->assertEquals($data, $stack_script->getAttributes());

        // Get the original attributes.
        $this->assertEquals($data, $stack_script->getOriginalAttributes());
    }

    /**
     * Test setting the token, and checking that it is sent with the request.
     *
     * @return void
     */
    public function testToken()
    {
        // Setup test server at path and with response data.
        $this->mockGetRequest('/profile', []);

        Profile::token('123456789');

        // Get the profile data from the endpoint.
        $profile = new Profile(true);

        $request = $this->http->requests->last();

        $this->assertTrue($request->getHeaders()->get('authorization')->hasValue('Bearer 123456789'));
    }

    /**
     * Test that an exception occurs when the body is not json encoded.
     *
     * @expectedException HnhDigital\LinodeApi\Foundation\LinodeApiException
     *
     * @return void
     */
    public function testBodyNotJsonEncoded()
    {
        // Mock the API endpoint and result.
        $this->http->mock
            ->when()
                ->methodIs('GET')
                ->pathIs('/profile')
            ->then()
                ->body('This is not encoded')
            ->end();

        $this->http->setUp();

        // Set the Linode API to this local server.
        Profile::endpoint('http://localhost:8082/');

        // Get the profile data from the endpoint.
        $profile = new Profile(true);

        $this->expectExceptionMessage('Could not decode response.');
    }
}
