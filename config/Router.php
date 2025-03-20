<?php
require_once 'controllers/HomeController.php';
/**
 * Router Class
 *
 * Handles routing for an MVC framework including:
 * - Route registration
 * - Parameter extraction
 * - Route dispatching
 * - URL generation
 */
class Router
{
    /**
     * Collection of registered routes
     * @var array
     */
    private $routes = [];

    /**
     * Base URL for the application
     * @var string
     */
    private $baseUrl;

    /**
     * Current URI
     * @var string
     */
    private $currentUri;

    /**
     * Default controller to use if no route matches
     * @var string
     */
    private $defaultController = 'HomeController';

    /**
     * Default action to use if no route matches
     * @var string
     */
    private $defaultAction = 'index';

    /**
     * Constructor
     *
     * @param string $baseUrl Base URL for the application
     */
    public function __construct($baseUrl = '')
    {
        $this->baseUrl = $baseUrl;
        $this->currentUri = $this->getRequestUri();
    }

    /**
     * Get the current request URI
     *
     * @return string
     */
    private function getRequestUri()
    {
        $uri = $_SERVER['REQUEST_URI'] ?? '/';

        // Remove query string
        if (($pos = strpos($uri, '?')) !== false) {
            $uri = substr($uri, 0, $pos);
        }

        // Remove base URL from URI if present
        if (!empty($this->baseUrl) && strpos($uri, $this->baseUrl) === 0) {
            $uri = substr($uri, strlen($this->baseUrl));
        }

        // Ensure leading slash
        if (empty($uri) || $uri[0] !== '/') {
            $uri = '/' . $uri;
        }

        return $uri;
    }

    /**
     * Register a new route
     *
     * @param string $method HTTP method (GET, POST, etc.)
     * @param string $pattern URL pattern with optional parameters like {id}
     * @param string|array $handler Controller and action to handle the route
     * @param string $name Optional name for the route
     * @return self
     */
    public function add($method, $pattern, $handler, $name = null)
    {
        // Convert to uppercase
        $method = strtoupper($method);

        // Parse handler
        if (is_string($handler)) {
            // Format: "ControllerName@actionName"
            list($controller, $action) = explode('@', $handler);
        } else if (is_array($handler) && count($handler) >= 2) {
            // Format: ['ControllerName', 'actionName']
            list($controller, $action) = $handler;
        } else {
            throw new \InvalidArgumentException('Invalid route handler specified');
        }

        // Extract parameter names from pattern
        $paramNames = [];
        if (strpos($pattern, '{') !== false) {
            preg_match_all('/{([^}]+)}/', $pattern, $matches);
            $paramNames = $matches[1];

            // Convert pattern to regex for matching
            $patternRegex = preg_replace('/{([^}]+)}/', '([^/]+)', $pattern);
            $patternRegex = '#^' . $patternRegex . '$#';
        } else {
            $patternRegex = '#^' . $pattern . '$#';
        }

        // Store route
        $route = [
            'method' => $method,
            'pattern' => $pattern,
            'regex' => $patternRegex,
            'controller' => $controller,
            'action' => $action,
            'paramNames' => $paramNames
        ];

        // Store with name if provided
        if ($name) {
            $this->routes[$name] = $route;
        } else {
            $this->routes[] = $route;
        }

        return $this;
    }

    /**
     * Add a GET route
     *
     * @param string $pattern URL pattern
     * @param string|array $handler Controller and action
     * @param string $name Optional route name
     * @return self
     */
    public function get($pattern, $handler, $name = null)
    {
        return $this->add('GET', $pattern, $handler, $name);
    }

    /**
     * Add a POST route
     *
     * @param string $pattern URL pattern
     * @param string|array $handler Controller and action
     * @param string $name Optional route name
     * @return self
     */
    public function post($pattern, $handler, $name = null)
    {
        return $this->add('POST', $pattern, $handler, $name);
    }

    /**
     * Add a PUT route
     *
     * @param string $pattern URL pattern
     * @param string|array $handler Controller and action
     * @param string $name Optional route name
     * @return self
     */
    public function put($pattern, $handler, $name = null)
    {
        return $this->add('PUT', $pattern, $handler, $name);
    }

    /**
     * Add a DELETE route
     *
     * @param string $pattern URL pattern
     * @param string|array $handler Controller and action
     * @param string $name Optional route name
     * @return self
     */
    public function delete($pattern, $handler, $name = null)
    {
        return $this->add('DELETE', $pattern, $handler, $name);
    }

    /**
     * Generate a URL for a named route
     *
     * @param string $name Route name
     * @param array $params Parameters to include in the URL
     * @return string The generated URL
     * @throws \Exception If route name not found
     */
    public function generateUrl($name, $params = [])
    {
        if (!isset($this->routes[$name])) {
            throw new \Exception("Route with name '{$name}' not found");
        }

        $route = $this->routes[$name];
        $url = $route['pattern'];

        // Replace parameters in URL
        foreach ($params as $key => $value) {
            $url = str_replace("{{$key}}", $value, $url);
        }

        // If any parameters weren't replaced, throw exception
        if (strpos($url, '{') !== false) {
            preg_match_all('/{([^}]+)}/', $url, $matches);
            throw new \Exception("Missing required parameters: " . implode(', ', $matches[1]));
        }

        return $this->baseUrl . $url;
    }

    /**
     * Dispatch the current request to the appropriate controller
     *
     * @return mixed The response from the controller action
     */
    public function dispatch()
    {
        $method = $_SERVER['REQUEST_METHOD'];

        // Check for method override via _method form field
        if ($method === 'POST' && isset($_POST['_method'])) {
            $method = strtoupper($_POST['_method']);
        }

        // Find matching route
        foreach ($this->routes as $route) {
            // Match HTTP method
            if ($route['method'] !== $method && $route['method'] !== 'ANY') {
                continue;
            }

            // Match URL pattern
            if (preg_match($route['regex'], $this->currentUri, $matches)) {
                // Extract parameters
                array_shift($matches); // Remove full match
                $params = [];

                // Associate parameter names with values
                foreach ($route['paramNames'] as $index => $name) {
                    $params[$name] = isset($matches[$index]) ? $matches[$index] : null;
                }

                // Create controller and call action
                $controllerName = $route['controller'];
                $actionName = $route['action'];

                return $this->executeController($controllerName, $actionName, $params);
            }
        }

        // No route found, use default controller/action
        return $this->executeController($this->defaultController, $this->defaultAction);
    }

    /**
     * Execute a controller action
     *
     * @param string $controllerName Controller class name
     * @param string $actionName Action method name
     * @param array $params Parameters to pass to the action
     * @return mixed The response from the controller action
     * @throws \Exception If controller or action not found
     */
    private function executeController($controllerName, $actionName, $params = [])
    {
        // Ensure controller class exists
        if (!class_exists($controllerName)) {
            throw new \Exception("Controller '{$controllerName}' not found");
        }

        // Create controller instance
        $controller = new $controllerName();

        // Ensure action method exists
        if (!method_exists($controller, $actionName)) {
            throw new \Exception("Action '{$actionName}' not found in controller '{$controllerName}'");
        }

        // Call the action with parameters
        return call_user_func_array([$controller, $actionName], $params);
    }

    /**
     * Set the default controller
     *
     * @param string $controller Controller class name
     * @return self
     */
    public function setDefaultController($controller)
    {
        $this->defaultController = $controller;
        return $this;
    }

    /**
     * Set the default action
     *
     * @param string $action Action method name
     * @return self
     */
    public function setDefaultAction($action)
    {
        $this->defaultAction = $action;
        return $this;
    }
}