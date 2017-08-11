<?php
/**
 * RouteInterface.php
 * 8/6/17 - 10:59 PM
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

use Maduser\Minimal\Routing\Route;


/**
 * Class Route
 *
 * @package Maduser\Minimal\Core
 */
interface RouteInterface
{
    /**
     * @return mixed
     */
    public function getRequestMethod();

    /**
     * @param mixed $requestMethod
     */
    public function setRequestMethod($requestMethod);

    /**
     * @return null
     */
    public function getCache();

    /**
     * @param $cache
     */
    public function setCache($cache);

    /**
     * @return null
     */
    public function getUriPrefix();

    /**
     * @param $uriPrefix
     */
    public function setUriPrefix($uriPrefix);

    /**
     * @return null
     */
    public function getUriPattern();

    /**
     * @param null $uriPattern
     */
    public function setUriPattern($uriPattern);

    /**
     * @return null
     */
    public function getMiddlewares();

    /**
     * @param null $middleware
     */
    public function setMiddlewares($middleware);

    /**
     * @param null $middleware
     */
    public function addMiddleware($middleware);

    /**
     * @return null
     */
    public function getNamespace();

    /**
     * @param null $namespace
     */
    public function setNamespace($namespace);

    /**
     * @param $controller
     *
     * @return $this
     */
    public function setController($controller);

    /**
     * @return null
     */
    public function getController();

    /**
     * @param $action
     *
     * @return $this
     */
    public function setAction($action);

    /**
     * @return null
     */
    public function getAction();

    /**
     * @param $method
     *
     * @return $this
     */
    public function setMethod($method);

    /**
     * @return null
     */
    public function getMethod();

    /**
     * @param $model
     *
     * @return $this
     */
    public function setModel($model);

    /**
     * @return null
     */
    public function getModel();

    /**
     * @param $params
     *
     * @return $this
     */
    public function setParams($params);

    /**
     * @return array
     */
    public function getParams();

    /**
     * @return array
     */
    public function getValues(): array;

    /**
     * @param array $values
     */
    public function setValues(array $values);

    /**
     * @param $key
     *
     * @return array
     */
    public function getValue($key);

    /**
     * @param $key
     * @param $value
     */
    public function addValue($key, $value);

    /**
     * @param $view
     *
     * @return $this
     */
    public function setView($view);

    /**
     * @return null
     */
    public function getView();

    /**
     * @param bool $isClosure
     *
     * @return Route
     */
    public function setIsClosure(bool $isClosure): Route;

    /**
     * @param bool|null $bool
     *
     * @return bool
     */
    public function hasClosure(bool $bool = null): bool;

    /**
     * @return \Closure
     */
    public function getClosure();

    /**
     * @param \Closure $closure
     *
     * @return Route
     */
    public function setClosure(\Closure $closure = null): Route;

    public function getUriParameters();

    public function uri($args = null);
}