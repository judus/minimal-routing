<?php

namespace Maduser\Minimal\Routing\Tests;

use Maduser\Minimal\Collections\Collection;
use Maduser\Minimal\Collections\Contracts\CollectionInterface;
use Maduser\Minimal\Config\Config;
use Maduser\Minimal\Http\Contracts\RequestInterface;
use Maduser\Minimal\Http\Request;
use Maduser\Minimal\Http\Response;
use Maduser\Minimal\Routing\Route;
use Maduser\Minimal\Routing\Router;

class RouterTest extends \PHPUnit_Framework_TestCase
{
    public function testCanSetAndGetRequest()
    {
        $router = new Router(
            new Config(),
            new Request(),
            new Route(),
            new Response()
        );

        $request = new Request();
        $router->setRequest($request);
        $result = $router->getRequest();

        $this->assertEquals($result, $request);
    }

    public function testCanGetRoutes()
    {
        $router = new Router(
            new Config(),
            new Request(),
            new Route(),
            new Response()
        );

        $result = $router->getRoutes();

        $expected = new Collection();

        $expected->add(new Collection(), 'ALL')
                 ->add(new Collection(), 'POST')
                 ->add(new Collection(), 'GET')
                 ->add(new Collection(), 'PUT')
                 ->add(new Collection(), 'PATCH')
                 ->add(new Collection(), 'DELETE')
                 ->add(new Collection(), 'CLI');

        $this->assertEquals($result, $expected);
    }

    public function testCanSetAndGetGroupUriPrefix()
    {
        $router = new Router(
            new Config(),
            new Request(),
            new Route(),
            new Response()
        );

        $router->setGroupUriPrefix('dummy/test/');
        $result = $router->getGroupUriPrefix();
        $expected = 'dummy/test';

        $this->assertEquals($result, $expected);
    }

    public function testCanSetAndGetGroupNamespace()
    {
        $router = new Router(
            new Config(),
            new Request(),
            new Route(),
            new Response()
        );

        $router->setGroupNamespace('dummy\\test');
        $result = $router->getGroupNamespace();
        $expected = 'dummy\\test\\';

        $this->assertEquals($result, $expected);
    }

    public function testCanSetAndGetGroupValues()
    {
        $router = new Router(
            new Config(),
            new Request(),
            new Route(),
            new Response()
        );

        $router->setGroupValues(['key1' => 'value1', 'key2' => 'value2']);
        $result = $router->getGroupValues();
        $expected = ['key1' => 'value1', 'key2' => 'value2'];

        $this->assertEquals($result, $expected);
    }

    public function testCanSetAndGetGroupMiddlewaresFromString()
    {
        $router = new Router(
            new Config(),
            new Request(),
            new Route(),
            new Response()
        );

        $router->setGroupMiddlewares('dummy/test');
        $result = $router->getGroupMiddlewares();
        $expected = ['dummy/test'];

        $this->assertEquals($result, $expected);
    }

    public function testCanSetAndGetGroupMiddlewaresFromArray()
    {
        $router = new Router(
            new Config(),
            new Request(),
            new Route(),
            new Response()
        );

        $router->setGroupMiddlewares(['dummy/test']);
        $result = $router->getGroupMiddlewares();
        $expected = ['dummy/test'];

        $this->assertEquals($result, $expected);
    }

    public function testCanSetAndGetClosure()
    {
        $router = new Router(
            new Config(),
            new Request(),
            new Route(),
            new Response()
        );

        $router->setClosure(function () { return 'dummy'; });
        $result = $router->getClosure();

        $this->assertTrue(is_callable($result));
    }

    public function testHasClosureIsTrue()
    {
        $router = new Router(
            new Config(),
            new Request(),
            new Route(),
            new Response()
        );

        $router->setClosure(function () {
            return 'dummy';
        });
        $result = $router->hasClosure();

        $this->assertTrue($result);
    }

    public function testHasClosureIsFalse()
    {
        $router = new Router(
            new Config(),
            new Request(),
            new Route(),
            new Response()
        );

        $result = $router->hasClosure();

        $this->assertNotTrue($result);
    }

    public function testCanSetAndShouldOverwriteExistingRouteIsTrue()
    {
        $router = new Router(
            new Config(),
            new Request(),
            new Route(),
            new Response()
        );

        $router->setOverwriteExistingRoute(true);
        $result = $router->shouldOverwriteExistingRoute();

        $this->assertTrue($result);

    }

    public function testCanSetAndShouldOverwriteExistingRouteIsFalse()
    {
        $router = new Router(
            new Config(),
            new Request(),
            new Route(),
            new Response()
        );

        $router->setOverwriteExistingRoute(false);
        $result = $router->shouldOverwriteExistingRoute();

        $this->assertFalse($result);
    }

    public function testCanGroup()
    {
        $router = new Router(
            new Config(),
            new Request(),
            new Route(),
            new Response()
        );

        $router->group([
            'uriPrefix' => 'dummy/test',
            'middlewares' => ['dummyMiddleware1'],
            'namespace' => 'dummy\\namespace'
        ], function() use ($router) {
           $result = [
               'uriPrefix' => $router->getGroupUriPrefix(),
               'middlewares' => $router->getGroupMiddlewares(),
               'namespace' => $router->getGroupNamespace()
           ];

           $expected = [
               'uriPrefix' => 'dummy/test',
               'middlewares' => ['dummyMiddleware1'],
               'namespace' => 'dummy\\namespace\\'
           ];

            $this->assertEquals($result, $expected);
        });

        $result = [
            'uriPrefix' => $router->getGroupUriPrefix(),
            'middlewares' => $router->getGroupMiddlewares(),
            'namespace' => $router->getGroupNamespace()
        ];

        $expected = [
            'uriPrefix' => '',
            'middlewares' => [],
            'namespace' => ''
        ];

        $this->assertEquals($result, $expected);
    }

    public function testCanRegister($requestMethod = 'GET')
    {
        $router = new Router(
            new Config(),
            new Request(),
            new Route(),
            new Response()
        );

        $router->register($requestMethod, 'dummy/(:any)/test', [
            'controller' => 'dummyController',
            'action' => 'dummyAction'
        ]);

        $result = $router->getRoutes();

        $route = new Route([
            'requestMethod' => $requestMethod,
            'middlewares' => [null],
            'uriPattern' => 'dummy/(:any)/test',
            'controller' => 'dummyController',
            'action' => 'dummyAction'
        ]);

        $expected = new Collection();

        $expected->add(new Collection(), 'ALL')
                 ->add(new Collection(), 'POST')
                 ->add(new Collection(), 'GET')
                 ->add(new Collection(), 'PUT')
                 ->add(new Collection(), 'PATCH')
                 ->add(new Collection(), 'DELETE')
                 ->add(new Collection(), 'CLI');

        $all = $expected->get('ALL');
        $post = $expected->get($requestMethod);

        $all->add($route, $requestMethod . '::dummy/(:any)/test');
        $post->add($route, 'dummy/(:any)/test');

        $this->assertEquals($result, $expected);
    }

    public function testCanPost()
    {
        // Alias method
        $this->testCanRegister('POST');
    }

    public function testCanGet()
    {
        // Alias method
        $this->testCanRegister('GET');
    }

    public function testCanPut()
    {
        // Alias method
        $this->testCanRegister('PUT');
    }

    public function testCanPatch()
    {
        // Alias method
        $this->testCanRegister('PATCH');
    }

    public function testCanDelete()
    {
        // Alias method
        $this->testCanRegister('DELETE');
    }

    public function testCanFetchControllerAndActionFromString()
    {
        $router = new Router(
            new Config(),
            new Request(),
            new Route(),
            new Response()
        );

        $result = $router->fetchControllerAndAction('dummy\\test@action');
        $expected = ['controller' => 'dummy\\test', 'action' => 'action'];

        $this->assertEquals($result, $expected);
    }

    public function testCanFetchControllerAndActionFromArry()
    {
        $router = new Router(
            new Config(),
            new Request(),
            new Route(),
            new Response()
        );

        $result = $router->fetchControllerAndAction([
            'controller' => 'dummy\\test',
            'action' => 'action'
        ]);
        $expected = ['controller' => 'dummy\\test', 'action' => 'action'];

        $this->assertEquals($result, $expected);
    }

    public function testCanAll()
    {
        $router = new Router(
            new Config(),
            new Request(),
            new Route(),
            new Response()
        );

        $router->register('GET', 'dummy/(:any)/test', [
            'controller' => 'dummyController',
            'action' => 'dummyAction'
        ]);

        $result = $router->all();

        $route = new Route([
            'requestMethod' => 'GET',
            'middlewares' => [null],
            'uriPattern' => 'dummy/(:any)/test',
            'controller' => 'dummyController',
            'action' => 'dummyAction'
        ]);

        $expected = new Collection();
        $expected->add($route, 'GET::dummy/(:any)/test');

        $this->assertEquals($result, $expected);
    }

    public function testCanFetchRoute($uriString = 'dummy/123/test')
    {
        $router = new Router(
            new Config(),
            new Request(),
            new Route(),
            new Response()
        );

        $router->register('GET', 'dummy/(:any)/test', [
            'controller' => 'dummyController',
            'action' => 'dummyAction'
        ]);

        $router->register('POST', 'dummy/(:any)/test', [
            'controller' => 'dummyController',
            'action' => 'dummyAction'
        ]);

        $router->register('CLI', 'dummy/(:num)/test', [
            'controller' => 'dummyController',
            'action' => 'dummyAction'
        ]);

        $result = $router->fetchRoute($uriString);

        $expected = new Route([
            'requestMethod' => 'CLI',
            'middlewares' => [null],
            'uriPattern' => 'dummy/(:num)/test',
            'controller' => 'dummyController',
            'action' => 'dummyAction',
            'params' => [123]
        ]);

        $this->assertEquals($result, $expected);
    }

    public function testCanMatchLiteralIsTrue()
    {
        $request = new Request();
        $request->setUriString('dummy\test');

        $router = new Router(
            new Config(),
            $request,
            new Route(),
            new Response()
        );

        $result = $router->matchLiteral('dummy\test');

        $this->assertTrue($result);
    }

    public function testCanMatchLiteralIsFalse()
    {
        $request = new Request();
        $request->setUriString('test\dummy');

        $router = new Router(
            new Config(),
            $request,
            new Route(),
            new Response()
        );

        $result = $router->matchLiteral('dummy\test');

        $this->assertFalse($result);
    }

    public function testCanMatchWildcardIsTrue()
    {
        $request = new Request();
        $request->setUriString('dummy/123/test/abc');

        $router = new Router(
            new Config(),
            $request,
            new Route(),
            new Response()
        );

        $result = $router->matchWildcard('dummy/(:num)/test/(:any)');

        var_dump($result);

        $expected = [123, 'abc'];

        $this->assertEquals($result, $expected);
    }

    public function testCanMatchWildcardIsNull()
    {
        $request = new Request();
        $request->setUriString('dummy/123/test/abc');

        $router = new Router(
            new Config(),
            $request,
            new Route(),
            new Response()
        );

        $result = $router->matchWildcard('dummy/(:num)/test/(:num)');

        $this->assertNull($result);
    }

    public function testCanGetRoute()
    {
        // Alias method getRoute
        $this->testCanFetchRoute('dummy/123/test');
    }

    public function testExistsIsTrue()
    {
        $router = new Router(
            new Config(),
            new Request(),
            new Route(),
            new Response()
        );

        $router->register('GET', 'dummy/(:any)/test', [
            'controller' => 'dummyController',
            'action' => 'dummyAction'
        ]);

        $router->register('POST', 'dummy/(:any)/test', [
            'controller' => 'dummyController',
            'action' => 'dummyAction'
        ]);

        $router->register('CLI', 'dummy/(:num)/test', [
            'controller' => 'dummyController',
            'action' => 'dummyAction'
        ]);

        $result = $router->exists('dummy/(:any)/test', 'POST');

        $this->assertTrue($result);
    }

    public function testExistsIsFalse()
    {
        $router = new Router(
            new Config(),
            new Request(),
            new Route(),
            new Response()
        );

        $router->register('GET', 'dummy/(:any)/test', [
            'controller' => 'dummyController',
            'action' => 'dummyAction'
        ]);

        $router->register('POST', 'dummy/(:any)/test', [
            'controller' => 'dummyController',
            'action' => 'dummyAction'
        ]);

        $router->register('CLI', 'dummy/(:num)/test', [
            'controller' => 'dummyController',
            'action' => 'dummyAction'
        ]);

        $result = $router->exists('dummy/(:any)/test', 'DELETE');

        $this->assertFalse($result);
    }

    public function testExistsIsFalseWithoutSpecificRequestMethod()
    {
        $router = new Router(
            new Config(),
            new Request(),
            new Route(),
            new Response()
        );

        $router->register('GET', 'dummy/(:any)/test', [
            'controller' => 'dummyController',
            'action' => 'dummyAction'
        ]);

        $router->register('POST', 'dummy/(:any)/test', [
            'controller' => 'dummyController',
            'action' => 'dummyAction'
        ]);

        $router->register('CLI', 'dummy/(:num)/test', [
            'controller' => 'dummyController',
            'action' => 'dummyAction'
        ]);

        $result = $router->exists('dummy/(:any)/test');

        $this->assertTrue($result);
    }
}
