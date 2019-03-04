<?php namespace Maduser\Minimal\Routing;

use Maduser\Minimal\Routing\Contracts\RouteInterface;

/**
 * Class Route
 *
 * @package Maduser\Minimal\Core
 */
class Route implements RouteInterface
{
	/**
	 * @var
	 */
	private $requestMethod;

    private $name = '';

	/**
	 * @var null
	 */
	private $cache = null;

	/**
	 * @var null
	 */
	private $uriPrefix = null;

	/**
	 * @var null
	 */
	private $uriPattern = null;

	/**
	 * @var null
	 */
	private $middlewares = [];

	/**
	 * @var null
	 */
	private $namespace = null;

    /**
     * @var string
     */
    private $dispatcher;
	/**
	 * @var null
	 */
	private $controller = null;

	/**
	 * @var null
	 */
	private $action = null;

	/**
	 * @var null
	 */
	private $model = null;

	/**
	 * @var null
	 */
	private $method = null;

	/**
	 * @var null
	 */
	private $view = null;

	/**
	 * @var array
	 */
	private $params = [];

    private $arguments = [];

    private $options = [];

	/**
	 * @var array
	 */
	private $values = [];

    /**
     * @var bool
     */
    private $isClosure = false;

    /**
     * @var \Closure
     */
    private $closure = null;

    /**
	 * @return mixed
	 */
	public function getRequestMethod()
	{
		return $this->requestMethod;
	}

	/**
	 * @param mixed $requestMethod
	 */
	public function setRequestMethod($requestMethod)
	{
		$this->requestMethod = $requestMethod;
	}

    /**
     * @return mixed
     */
    public function getName()
    {
        if (! empty($this->name)) return $this->name;

        return ltrim($this->getUriPrefix() . $this->getUriPattern(), '/');
    }

    /**
     * @param mixed $name
     *
     * @return Route
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

	/**
	 * @return null
	 */
	public function getCache()
	{
		return $this->cache;
	}

    /**
     * @param $cache
     */
    public function setCache($cache)
	{
		$this->cache = $cache;
	}

	/**
	 * @return null
	 */
	public function getUriPrefix()
	{
		return $this->uriPrefix;
	}

    /**
     * @param $uriPrefix
     */
	public function setUriPrefix($uriPrefix)
	{
		$this->uriPrefix = $uriPrefix;
	}

	/**
	 * @return null
	 */
	public function getUriPattern()
	{
		return $this->uriPattern;
	}

	/**
	 * @param null $uriPattern
	 */
	public function setUriPattern($uriPattern)
	{
		$this->uriPattern = $uriPattern;
	}

	/**
	 * @return null
	 */
	public function getMiddlewares()
	{
		return $this->middlewares;
	}

    /**
     * @param null $middleware
     */
    public function setMiddlewares($middleware)
    {
        $this->middlewares = $middleware;
    }

    /**
     * @param null $middleware
     */
    public function addMiddleware($middleware)
    {
        $this->middlewares[] = $middleware;
    }

    /**
	 * @return null
	 */
	public function getNamespace()
	{
		return $this->namespace;
	}

    /**
     * @param null $namespace
     */
	public function setNamespace($namespace)
	{
		$namespace = !empty($namespace) ? rtrim($namespace, '\\') . '\\' : $namespace;
		$this->namespace = $namespace;
	}

    /**
     * @return string|null
     */
    public function getDispatcher()
    {
        return $this->dispatcher;
    }

    /**
     * @param string $dispatcher
     *
     * @return Route
     */
    public function setDispatcher(string $dispatcher): Route
    {
        $this->dispatcher = $dispatcher;

        return $this;
    }

	/**
	 * @param $controller
	 *
	 * @return $this
	 */
	public function setController($controller)
	{
		$this->controller = $controller;
		return $this;
	}

	/**
	 * @return null
	 */
	public function getController()
	{
		$controller = $this->namespace . $this->controller;

		return empty($controller) ? null : $controller;
	}

	/**
	 * @param $action
	 *
	 * @return $this
	 */
	public function setAction($action)
	{
		$this->action = $action;
		return $this;
	}

	/**
	 * @return null
	 */
	public function getAction()
	{
		return $this->action;
	}

	/**
	 * @param $method
	 *
	 * @return $this
	 */
	public function setMethod($method)
	{
		$this->method = $method;
		return $this;
	}

	/**
	 * @return null
	 */
	public function getMethod()
	{
		return $this->method;
	}

	/**
	 * @param $model
	 *
	 * @return $this
	 */
	public function setModel($model)
	{
		$this->model = $model;
		return $this;
	}

	/**
	 * @return null
	 */
	public function getModel()
	{
		return $this->model;
	}

	/**
	 * @param $params
	 *
	 * @return $this
	 */
	public function setParams($params)
	{
		$this->params = $params;
		return $this;
	}

	/**
	 * @return array
	 */
	public function getParams()
	{
		return $this->params;
	}

    /**
     * @return array
     */
    public function getArguments(): array
    {
        return $this->arguments;
    }

    /**
     * @param array $arguments
     */
    public function setArguments(array $arguments)
    {
        $this->arguments = $arguments;
    }

    /**
     * @return array
     */
    public function getOptions(): array
    {
        return $this->options;
    }

    /**
     * @param array $options
     */
    public function setOptions(array $options)
    {
        $this->options = $options;
    }

	/**
	 * @return array
	 */
	public function getValues(): array
	{
		return $this->values;
	}

	/**
	 * @param array $values
	 */
	public function setValues(array $values)
	{
		$this->values = $values;
	}

	/**
	 * @param $key
	 *
	 * @return array
	 */
	public function getValue($key)
	{
		return $this->values[$key];
	}

	/**
	 * @param $key
	 * @param $value
	 */
	public function addValue($key, $value)
	{
		$this->values[$key] = $value;
	}

	/**
	 * @param $view
	 *
	 * @return $this
	 */
	public function setView($view)
	{
		$this->view = $view;
		return $this;
	}

	/**
	 * @return null
	 */
	public function getView()
	{
		return $this->view;
	}

    /**
     * @param bool $isClosure
     *
     * @return Route
     */
    public function setIsClosure(bool $isClosure): Route
    {
        $this->isClosure = $isClosure;

        return $this;
    }

    /**
     * @param bool|null $bool
     *
     * @return bool
     */
    public function hasClosure(bool $bool = null): bool
    {
        if (is_callable($this->getClosure())) {
            return true;
        }

        return false;
    }

    /**
     * @return \Closure
     */
    public function getClosure()
    {
        return $this->closure;
    }

    /**
     * @param \Closure $closure
     *
     * @return Route
     */
    public function setClosure(\Closure $closure = null): Route
    {
        $this->closure = $closure;

        return $this;
    }

	/**
	 * Route constructor.
	 *
	 * @param array|null $values
	 */
	public function __construct(array $values = null)
	{
		if ($values) {
			foreach ($values as $key => $value)
			{
				if (method_exists($this, 'set' . ucfirst($key))) {
					$this->{'set' . ucfirst($key)}($value);
				} else {
					$this->addValue($key, $value);
				}
			}
		}

	}

	public function getUriParameters()
    {
        preg_match_all('(\([:a-zA-Z0-9]+\))', $this->getUriPattern(), $matches);
        return $matches[0];
    }


	public function uri($args = null)
    {
        $args = func_get_args();

        $uri = $this->getUriPrefix() . $this->getUriPattern();
        $params = $this->getUriParameters();

        for ($i = 0; $i < count($params); $i++) {
            $pos = strpos($uri, $params[$i]);
            if ($pos !== false) {
                $uri = substr_replace($uri, $args[$i], $pos,
                    strlen($params[$i]));
            }
        }

        return $uri;
    }

    public function pattern()
    {
        return $this->getUriPrefix() . $this->getUriPattern();
    }

    public function param(int $n)
    {
        if (! isset($this->params[$n-1])) return null;

        return $this->params[$n-1];
    }

    /**
     * @return array
     */
    public function toArray()
    {
       if (is_callable($this->closure)) {
           $this->closure = null;
       } else {
           $this->closure = null;
       }

        return get_object_vars($this);
    }

}