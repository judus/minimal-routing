<?php
/**
 * RouterInterface.php
 * 7/15/17 - 12:51 AM
 *
 * PHP version 7
 *
 * @package    @package_name@
 * @author     Julien Duseyau <julien.duseyau@gmail.com>
 * @copyright  2017 Julien Duseyau
 * @license    https://opensource.org/licenses/MIT
 * @version    Release: @package_version@
 *
 * The MIT License (MIT)
 *
 * Copyright (c) Julien Duseyau <julien.duseyau@gmail.com>
 *
 * Permission is hereby granted, free of charge, to any person obtaining a copy
 * of this software and associated documentation files (the "Software"), to deal
 * in the Software without restriction, including without limitation the rights
 * to use, copy, modify, merge, publish, distribute, sublicense, and/or sell
 * copies of the Software, and to permit persons to whom the Software is
 * furnished to do so, subject to the following conditions:
 *
 * The above copyright notice and this permission notice shall be included in
 * all copies or substantial portions of the Software.
 *
 * THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
 * IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
 * FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
 * AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
 * LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,
 * OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN
 * THE SOFTWARE.
 */

namespace Maduser\Minimal\Routing\Contracts;

use Maduser\Minimal\Collections\Contracts\CollectionInterface;
use Maduser\Minimal\Config\Contracts\ConfigInterface;
use Maduser\Minimal\Http\Contracts\RequestInterface;
use Maduser\Minimal\Http\Contracts\ResponseInterface;
use Maduser\Minimal\Routing\Exceptions\RouteNotFoundException;

/**
 * Class Router
 *
 * @package Maduser\Minimal\Core
 */
interface RouterInterface
{
    /**
     * @return RequestInterface
     */
    public function getRequest(): RequestInterface;

    /**
     * @param RequestInterface $request
     */
    public function setRequest(RequestInterface $request);

    /**
     * @return CollectionInterface
     */
    public function getRoutes(): CollectionInterface;

    /**
     * @param $path
     */
    public function setGroupUriPrefix($path);

    /**
     * @param $path
     */
    public function setGroupNamespace($path);

    /**
     * @return mixed
     */
    public function getGroupUriPrefix();

    /**
     * @return mixed
     */
    public function getGroupNamespace();

    /**
     * @param array $values
     */
    public function setGroupValues(array $values);

    /**
     * @return array
     */
    public function getGroupValues();

    /**
     * @param $key
     * @param $value
     */
    public function addGroupValue($key, $value);

    /**
     * @param $key
     *
     * @return mixed
     */
    public function getGroupValue($key);

    /**
     * @return mixed
     */
    public function getGroupMiddlewares();

    /**
     * @param mixed $groupMiddlewares
     */
    public function setGroupMiddlewares($groupMiddlewares);

    /**
     * @param bool|null $bool
     *
     * @return bool
     */
    public function hasClosure(bool $bool = null): bool;

    /**
     * Routes constructor.
     *
     * @param ConfigInterface            $config
     * @param RequestInterface           $request
     * @param RouteInterface             $route
     * @param ResponseInterface          $response
     */
    public function __construct(
        ConfigInterface $config,
        RequestInterface $request,
        RouteInterface $route,
        ResponseInterface $response
    );

    /**
     * @param                $options
     * @param \Closure       $callback
     */
    public function group($options, \Closure $callback);

    /**
     * @param                $pattern
     * @param array|\Closure $options
     * @param \Closure       $callback
     */
    public function post($pattern, $options, $callback = null);

    /**
     * @param                $pattern
     * @param array|\Closure $options
     * @param \Closure       $callback
     */
    public function get($pattern, $options, $callback = null);

    /**
     * @param                $pattern
     * @param array|\Closure $options
     * @param \Closure       $callback
     */
    public function put($pattern, $options, $callback = null);

    /**
     * @param                $pattern
     * @param array|\Closure $options
     * @param \Closure       $callback
     */
    public function patch($pattern, $options, $callback = null);

    /**
     * @param                $pattern
     * @param array|\Closure $options
     * @param \Closure       $callback
     *
     * @return
     */
    public function delete($pattern, $options, $callback = null);

    /**
     * @param String         $requestMethod
     * @param String         $uriPattern
     * @param array|\Closure $callback
     */
    public function register(
        String $requestMethod,
        String $uriPattern,
        $callback
    );

    /**
     * @param $strOrArray
     *
     * @return array
     */
    public function fetchControllerAndAction($strOrArray);

    /**
     * @param string $requestMethod
     *
     * @return CollectionInterface
     */
    public function all($requestMethod = 'ALL'): CollectionInterface;

    /**
     * @param null $uriString
     *
     * @return RouteInterface
     * @throws RouteNotFoundException
     */
    public function fetchRoute($uriString = null): RouteInterface;

    /**
     * @param $uriPattern
     *
     * @return bool
     */
    public function matchLiteral($uriPattern);

    /**
     * @param $uriPattern
     *
     * @return null
     */
    public function matchWildcard($uriPattern);

    /**
     * @param null $uriString
     *
     * @return RouteInterface
     */
    public function getRoute($uriString = null): RouteInterface;
}