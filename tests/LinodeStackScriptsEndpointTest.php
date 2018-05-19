<?php

namespace HnhDigital\LinodeApi\Tests;

use HnhDigital\LinodeApi\StackScript;
use HnhDigital\LinodeApi\StackScripts;

class LinodeStackScriptsEndpointTest extends BaseTest
{
    // StackScripts data.
    protected $data = [
        'pages'   => 1,
        'results' => 1,
        'data'    => [
            [
                'id'               => 37,
                'username'         => 'linode',
                'user_gravatar_id' => '08e2a99f31420a3f38753b07e23af7d6',
                'label'            => 'Example StackScript',
                'description'      => 'Installs the Linode API bindings',
                'images'           => [
                    'linode/debian8',
                    'linode/debian9',
                ],
                'deployments_total'   => 150,
                'deployments_active'  => 42,
                'is_public'           => true,
                'created'             => '2015-09-29T11:21:01',
                'updated'             => '2015-10-15T10:02:01',
                'rev_note'            => 'Initial import',
                'script'              => '#!/bin/bash',
                'user_defined_fields' => [
                    [
                        'label'   => 'A question',
                        'example' => 'An example value',
                        'default' => 'Default value',
                        'oneof'   => 'possible,enum,values',
                    ]
                ],
            ],
        ],
        'page' => 1,
    ];

    /**
     * Test GET /stackscripts.
     *
     * @return void
     */
    public function testGetStackScripts()
    {

        // Setup test server at path and with response data.
        $this->mockGetRequest('/linode/stackscripts?page=1', $this->data);

        // Create a new stackscripts endpoint.
        $result = (new StackScripts())->search()->all();

        // Create the same object that it should return.
        $stack_script = new StackScript('37', array_get($this->data, 'data.0'));

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
        // Setup test server at path and with response data.
        $this->mockGetRequest('/linode/stackscripts/37', $this->data['data']);

        // Create the same object that it should return.
        $stack_script = new StackScript('37');

        // Data.
        $result = $stack_script->get();

        // Create the same object that it should return.
        $populated_stack_script = new StackScript('37', $this->data['data']);

        // Compare.
        $this->assertEquals($this->data['data'], $result);

        // Compare the populated attributes.
        $this->assertEquals($populated_stack_script->getAttributes(), $stack_script->getAttributes());
    }

    /**
     * Test updating a stackscript.
     *
     * @return void
     */
    public function testUpdate()
    {
        // Setup test server at path and with response data.
        $this->mockPutRequest('/linode/stackscripts/37', $this->data['data']);

        $put_data = [
            'label' => 'Example StackScript - test',
        ];

        // Get the profile data from the endpoint.
        $stack_script = new StackScript('37');

        // Put the changes, get the latest model back.
        $stack_script->update($put_data);

        $request_body = $this->getRequestBody();

        $this->assertEquals($put_data, $request_body);
    }

    /**
     * Test updating a stackscript.
     *
     * @return void
     */
    public function testDelete()
    {
        // Setup test server at path and with response data.
        $this->mockDeleteRequest('/linode/stackscripts/37');

        // Get the profile data from the endpoint.
        $stack_script = new StackScript('37');

        $stack_script->delete();
    }
}
