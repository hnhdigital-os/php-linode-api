<?php

namespace HnhDigital\LinodeApi\Tests;

use HnhDigital\LinodeApi\StackScript;
use HnhDigital\LinodeApi\Foundation\Auth;

class OverallTest extends BaseTest
{

    public function testAttributes()
    {
        $data = [
            'label' => 'test',
        ];

        $stack_script = new StackScript(false, $data);

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
}