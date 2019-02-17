<?php

namespace Maduser\Minimal\Routing\Tests;

use Maduser\Minimal\Routing\Route;
use PHPUnit\Framework\TestCase;

class RouteTest extends TestCase
{
    public function testCanAddAndGetValues()
    {
        $route = new Route();
        $route->addValue('key1', 'value1');
        $route->addValue('key2', 'value2');
        $result = $route->getValues();
        $expected = ['key1' => 'value1', 'key2' => 'value2'];

        $this->assertEquals($result, $expected);
    }

    public function testCanSetAndGetRequestMethod()
    {
        $route = new Route();
        $route->setRequestMethod('POST');
        $result = $route->getRequestMethod();

        $this->assertEquals($result, 'POST');
    }

    public function testCanSetAndGetCache()
    {
        $route = new Route();
        $route->setCache('dummy');
        $result = $route->getCache();

        $this->assertEquals($result, 'dummy');
    }

    public function testCanSetAndGetUriPrefix()
    {
        $route = new Route();
        $route->setUriPrefix('dummy');
        $result = $route->getUriPrefix();

        $this->assertEquals($result, 'dummy');
    }

    public function testCanSetAndGetUriPattern()
    {
        $route = new Route();
        $route->setUriPattern('dummy');
        $result = $route->getUriPattern();

        $this->assertEquals($result, 'dummy');
    }

    public function testCanSetAndGetMiddlewares()
    {
        $route = new Route();
        $route->setMiddlewares(['dummy1', 'dummy2']);
        $result = $route->getMiddlewares();
        $expected = ['dummy1', 'dummy2'];

        $this->assertEquals($result, $expected);
    }

    public function addMiddleware()
    {
        $route = new Route();
        $route->addMiddleware('dummy1');
        $route->addMiddleware('dummy2');
        $result = $route->getMiddlewares();
        $expected = ['dummy1', 'dummy2'];

        $this->assertEquals($result, $expected);
    }

    public function testCanSetAndGetNamespace()
    {
        $route = new Route();
        $route->setNamespace('dummy');
        $result = $route->getNamespace();
        $expected = 'dummy\\';

        $this->assertEquals($result, $expected);
    }

    public function testCanSetAndGetController()
    {
        $route = new Route();
        $route->setController('dummy');
        $result = $route->getController();
        $expected = 'dummy';

        $this->assertEquals($result, $expected);
    }

    public function testCanSetAndGetAction()
    {
        $route = new Route();
        $route->setAction('dummy');
        $result = $route->getAction();
        $expected = 'dummy';

        $this->assertEquals($result, $expected);
    }

    public function testCanSetAndGetMethod()
    {
        $route = new Route();
        $route->setMethod('dummy');
        $result = $route->getMethod();
        $expected = 'dummy';

        $this->assertEquals($result, $expected);
    }

    public function testCanSetAndGetModel()
    {
        $route = new Route();
        $route->setModel('dummy');
        $result = $route->getModel();
        $expected = 'dummy';

        $this->assertEquals($result, $expected);
    }

    public function testCanSetAndGetParams()
    {
        $route = new Route();
        $route->setParams(['dummy1', 'dummy2']);
        $result = $route->getParams();
        $expected = ['dummy1', 'dummy2'];

        $this->assertEquals($result, $expected);
    }


    public function testCanSetAndGetValues()
    {
        $route = new Route();
        $route->setValues(['dummy1', 'dummy2']);
        $result = $route->getValues();
        $expected = ['dummy1', 'dummy2'];

        $this->assertEquals($result, $expected);
    }

    public function testCanGetValue()
    {
        $route = new Route();
        $route->setValues(['key1' => 'dummy1', 'key2' => 'dummy2']);
        $result = $route->getValue('key2');
        $expected = 'dummy2';

        $this->assertEquals($result, $expected);
    }

    public function testCanSetAndGetView()
    {
        $route = new Route();
        $route->setView('dummy');
        $result = $route->getView();
        $expected = 'dummy';

        $this->assertEquals($result, $expected);
    }

    public function testCanSetIsClosure()
    {
        $route = new Route();
        $result = $route->setIsClosure(true);

        $this->assertEquals($result, $route);
    }

    public function testCanSetAndGetClosure()
    {
        $route = new Route();
        $route->setClosure(function () {
            return 'dummy';
        });
        $result = $route->getClosure();

        $this->assertTrue(is_callable($result));
    }

    public function testCanHasClosure()
    {
        $route = new Route();
        $route->setClosure(function () {
            return 'dummy';
        });
        $result = $route->hasClosure();

        $this->assertTrue($result);
    }

    public function testCanGetUriParameters()
    {
        $route = new Route();
        $route->setUriPattern('dummy/(:any)/dummy/(:num)/dummy');
        $result = $route->getUriParameters();
        $expected = ['(:any)', '(:num)'];

        $this->assertEquals($result, $expected);
    }

    public function testCanUri()
    {
        $route = new Route();
        $route->setUriPattern('dummy/(:any)/dummy/(:num)/dummy');
        $result = $route->uri('abc', 123);
        $expected = 'dummy/abc/dummy/123/dummy';

        $this->assertEquals($result, $expected);
    }
}