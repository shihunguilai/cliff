<?php

namespace shihunguilai\phpapi\Cache;

use PHPUnit_Framework_TestCase;

class CacheRedisTest extends PHPUnit_Framework_TestCase
{
    public function setUp()
    {
        parent::setUp(); // TODO: Change the autogenerated stub
        if (!extension_loaded('redis')) {
            $this->markTestSkipped('no redis extension');
        }
    }

    public function tearDown()
    {
        CacheRedis::getInstance()->clear();
    }

    public function testRedisExt()
    {
        $this->assertTrue(extension_loaded('redis'));
    }
    public function testGetInstance()
    {
        $a = CacheRedis::getInstance();
        $b = CacheRedis::getInstance();
        $this->assertEquals($a, $b);
    }

    public function testSetAndGet()
    {
        $k = 'nnn';
        $v = 'aaaa';
        CacheRedis::getInstance()->set($k, $v);
        $this->assertEquals($v, CacheRedis::getInstance()->get($k));
    }

    public function testMSetAndMGet()
    {
        $kvs = array(
            'b' => [1, 23, 5],
            'c' => 'jfkdfjdkfjdkfd',
        );
        CacheRedis::getInstance()->mSet($kvs);
        $this->assertEquals($kvs, CacheRedis::getInstance()->mGet(array_keys($kvs)));
    }

    public function testRm()
    {
        CacheRedis::getInstance()->set('aa', 'jfkdjfkd');
        CacheRedis::getInstance()->rm('aa');
        $this->assertNull(CacheRedis::getInstance()->get('aa'));

        $kvs = array(
            'b' => [1, 23, 5],
            'c' => 'jfkdfjdkfjdkfd',
        );
        CacheRedis::getInstance()->mSet($kvs);
        CacheRedis::getInstance()->rm(array_keys($kvs));
        $this->assertEquals(
            array_combine(array_keys($kvs), array(false, false)), CacheRedis::getInstance()->mGet(array_keys($kvs)));
    }
}
