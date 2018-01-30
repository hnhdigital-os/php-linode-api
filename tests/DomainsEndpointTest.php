<?php

namespace HnhDigital\LinodeApi\Tests;

use HnhDigital\LinodeApi\Domain;
use HnhDigital\LinodeApi\Domains;

class DomainsEndpointTest extends BaseTest
{
    /**
     * Test GET /domains.
     *
     * @return void
     */
    public function testGetDomains()
    {
        // Domains data.
        $data = [
            'pages'   => 1,
            'results' => 1,
            'data'    => [
                [
                    'id'          => 357,
                    'domain'      => 'example.com',
                    'soa_email'   => 'admin@example.com',
                    'description' => 'Example Description',
                    'refresh_sec' => 14400,
                    'retry_sec'   => 3600,
                    'expire_sec'  => 604800,
                    'ttl_sec'     => 3600,
                    'status'      => 'active',
                    'master_ips' => [
                        '127.0.0.1',
                        '255.255.255.1',
                        '123.123.123.7',
                    ],
                    'axfr_ips' => [
                        '44.55.66.77'
                    ],
                    'group' => 'Example Display Group',
                    'type'  => 'master',
                    'zonefile' => [
                        'rendered' => '',
                        'status'   => 'setting_up',
                    ]
                ],
            ],
            'page' => 1,
        ];

        // Setup test server at path and with response data.
        $this->mockGetRequest('/domains?page=1', $data);

        // Create a new domains endpoint.
        $result = (new Domains())->search()->all();

        // Create the same object that it should return.
        $domain = new Domain(357, array_get($data, 'data.0'));

        // Compare.
        $this->assertEquals($domain, array_get($result, 0));
    }

    /**
     * Test GET domains/$domain_id.
     *
     * @return void
     */
    public function testGetDomain()
    {
        // Domain data.
        $data = [
            'id'          => 357,
            'domain'      => 'example.com',
            'soa_email'   => 'admin@example.com',
            'description' => 'Example Description',
            'refresh_sec' => 14400,
            'retry_sec'   => 3600,
            'expire_sec'  => 604800,
            'ttl_sec'     => 3600,
            'status'      => 'active',
            'master_ips' => [
                '127.0.0.1',
                '255.255.255.1',
                '123.123.123.7',
            ],
            'axfr_ips' => [
                '44.55.66.77'
            ],
            'group' => 'Example Display Group',
            'type'  => 'master',
            'zonefile' => [
                'rendered' => '',
                'status'   => 'setting_up',
            ]
        ];

        // Setup test server at path and with response data.
        $this->mockGetRequest('/domains/357', $data);

        // Create the same object that it should return.
        $domain = new Domain(357);

        // Data.
        $result = $domain->get();

        // Create the same object that it should return.
        $populated_domain = new Domain(357, $data);

        // Compare.
        $this->assertEquals($data, $result);

        // Compare the populated attributes.
        $this->assertEquals($populated_domain->getAttributes(), $domain->getAttributes());
    }
}
