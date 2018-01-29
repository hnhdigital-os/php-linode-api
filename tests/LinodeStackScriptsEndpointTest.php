<?php

namespace HnhDigital\LinodeApi\Tests;

use HnhDigital\LinodeApi\StackScript;
use HnhDigital\LinodeApi\StackScripts;

class LinodeStackScriptsEndpointTest extends BaseTest
{
    /**
     * Test GET /stackscripts.
     *
     * @return void
     */
    public function testGetStackScripts()
    {
        // StackScripts data.
        $data = [
            'pages'   => 1,
            'results' => 1,
            'data'    => [
                [
                    'id'           => 'linode/latest-64bit',
                    'xen'          => false,
                    'kvm'          => true,
                    'label'        => 'Latest 64 bit (4.9.50-x86_64-linode86)',
                    'version'      => '3.5.2',
                    'architecture' => 'x86_64',
                    'pvops'        => false,
                ],
            ],
            'page' => 1,
        ];

        // Setup test server at path and with response data.
        $this->mockRequest('GET', '/linode/stackscripts?page=1', $data);

        // Create a new stackscripts endpoint.
        $result = (new StackScripts())->search()->all();

        // Create the same object that it should return.
        $stack_script = new StackScript('linode/latest-64bit', array_get($data, 'data.0'));

        // Compare.
        $this->assertEquals($stack_script, array_get($result, 0));
    }

    /**
     * Test GET stackscripts/$stack_script_id.
     *
     * @return void
     */
    public function testGetStackScript()
    {
        // StackScript data.
        $data = [
            'id'           => 'linode/latest-64bit',
            'xen'          => false,
            'kvm'          => true,
            'label'        => 'Latest 64 bit (4.9.50-x86_64-linode86)',
            'version'      => '3.5.2',
            'architecture' => 'x86_64',
            'pvops'        => false,
        ];

        // Setup test server at path and with response data.
        $this->mockRequest('GET', '/linode/stackscripts/linode/latest-64bit', $data);

        // Create the same object that it should return.
        $stack_script = new StackScript('linode/latest-64bit');

        // Data.
        $result = $stack_script->get();

        // Create the same object that it should return.
        $populated_stack_script = new StackScript('linode/latest-64bit', $data);

        // Compare.
        $this->assertEquals($data, $result);

        // Compare the populated attributes.
        $this->assertEquals($populated_stack_script->getAttributes(), $stack_script->getAttributes());
    }
}
