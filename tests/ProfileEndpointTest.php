<?php

namespace HnhDigital\LinodeApi\Tests;

use HnhDigital\LinodeApi\Profile;
use HnhDigital\LinodeApi\Profiles;

class ProfileEndpointTest extends BaseTest
{
    private $data = [
        'uuid'                => 123,
        'username'            => 'example_user',
        'email'               => 'person@place.com',
        'timezone'            => 'US/Eastern',
        'email_notifications' => true,
        'referrals' => [
            'code'      => 'rcg3340777c21fa49a5beb971ca1aec44bc584333',
            'url'       => 'https://www.linode.com/?r=rcg3340777c21fa49a5beb971ca1aec44bc584333',
            'total'     => 10,
            'completed' => 8,
            'pending'   => 2,
            'credit'    => 160,
        ],
        'ip_whitelist_enabled' => true,
        'lish_auth_method'     => 'password_keys',
        'authorized_keys'      => 'ssh-rsa AADDDDB3NzaC1yc2EAAAADAQABAAACAQDzP5sZlvUR9nZPy0WrklktNXffq+nQoEYUdVJ0hpIzZs+KqjZ3CDbsJZF0g0pn1/gpY9oSEeXzFpWasdkjlfasdf09asldf+O+y8w6rbPe8IyP1mext4cmBe6g/nHAjw/k0rS6cuUFZu++snG0qubymE9gMZ3X0ac92TP7tk0dEwq1fbjumhqNmNyqSbt5j8pLuLRhYHhVszmwnuKjeGjm9mJLJGnd5V6IdZWEIhCjrNgNr1H+fVNI87ryFE31i/i/bnHcbnkNdAmDc2EQ2gJ33vXg8D8Nf2aI+K+e3t9MiFVTJmzAILQpvZQj2YV4mfOt+GSTUJ4VdgH9dNC/3lA0yoP6YoFYw0cdTKhJ0MotmR9iZepbJfbuXxAFOECJuC1bxFtUam3fIsGqj3vXi1R6CzRzxNERqPGLiFcXH8z0VTwXA1v+iflVd4KqihnwNtU+45TXTtFY0twLQRauB9qo9slvnhYlHqQZb8SBYw5WltX3MBQpyLTSZLQLqIKZVgQRKKF413fT52vMF54zk5SpImm5qY5Q1E4od00UJ1x4kFe0fTUQWVgeYvL8AgFx/idUsVs9r3jRPVTUnQZNB2D+7Cyf9dUFjjpiuH3AMMZyRYfJbh/Chg8J6QXYZyEQCxMRa9/lm2rRCVfGbcfb5zgKsV/HRHI/O1F9cZ9JvykwQ== someguy@someplace.com',
        'two_factor_auth'      => true,
        'restricted'           => false,
    ];

    /**
     * Test GET profile.
     *
     * @return void
     */
    public function testGetProfile()
    {
        // Setup test server at path and with response data.
        $this->mockGetRequest('/profile', $this->data);

        // Get the profile data from the endpoint.
        $profile = new Profile(true);

        // Create the same object that it should return.
        $populated_profile = new Profile($this->data);

        // Compare the populated attributes.
        $this->assertEquals($populated_profile->getAttributes(), $profile->getAttributes());

        // Get the data directly.
        $result = $profile->get();

        // Compare.
        $this->assertEquals($this->data, $result);
    }

    /**
     * Test Update profile.
     *
     * @return void
     */
    public function testUpdateProfile()
    {
        // Create an existing profile.
        $profile = new Profile($this->data);

        // Setup test server at path and with response data.
        //$this->mockRequest('PUT', '/profile', $this->data);

        $profile->username = 'jsmith';

        $dirty = [
            'username' => 'jsmith',
        ];

        // Compare.
        $this->assertEquals($dirty, $profile->getDirty());

        //$profile->update();
    }
}
