<?php namespace Maduser\Minimal\Routing\Contracts;

/**
 * Interface RouteInterface
 *
 * @package Maduser\Minimal\Routing\Contracts
 */
interface RouteInterface
{
	/**
	 * @param $uriPrefix
	 */
	public function setUriPrefix($uriPrefix);

	/**
	 * @return mixed
	 */
	public function getUriPrefix();

	/**
	 * @param $cache
	 */
	public function setCache($cache);

	/**
	 * @param $name
	 */
	public function setModel($name);

	/**
	 * @return mixed
	 */
	public function getModel();

	/**
	 * @param $namespace
	 */
	public function setNamespace($namespace);

	/**
	 * @param $name
	 */
	public function setController($name);

	/**
	 * @return mixed
	 */
	public function getController();

	/**
	 * @param $name
	 */
	public function setView($name);

	/**
	 * @return mixed
	 */
	public function getView();

	/**
	 * @param $name
	 */
	public function setMethod($name);

	/**
	 * @return mixed
	 */
	public function getMethod();

	/**
	 * @param $name
	 */
	public function setAction($name);

	/**
	 * @return mixed
	 */
	public function getAction();

	/**
	 * @param $name
	 */
	public function setParams($name);

	/**
	 * @return mixed
	 */
	public function getParams();

    /**
     * @return mixed
     */
    public function getMiddlewares();

    /**
     * @return bool
     */
    public function hasClosure();

    /**
     * @return \Closure
     */
    public function getClosure();
}