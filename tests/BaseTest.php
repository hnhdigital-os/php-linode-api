<?php

namespace HnhDigital\LinodeApi\Tests;

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
}
