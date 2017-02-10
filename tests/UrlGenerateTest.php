<?php

require_once dirname(dirname(__FILE__)) . '/vendor/autoload.php';

class UrlGenerateTest extends PHPUnit_Framework_TestCase
{

    public function testUm() {
        /*$url = new Webme\Url\Generator('/media/www/site');
        $this->assertEquals('http://localhost/site',$url->getURI());*/
    }


    public function testPushAndPop()
    {
        /*$stack = array();
        $this->assertEquals(0, count($stack));

        array_push($stack, 'foo');
        $this->assertEquals('foo', $stack[count($stack)-1]);
        $this->assertEquals(1, count($stack));

        $this->assertEquals('foo', array_pop($stack));
        $this->assertEquals(0, count($stack));*/
    }

}
