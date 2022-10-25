<?php

namespace Prout;

class Route
{
    private string $route;
    private string $controller;
    private string $action;
    private string $hit;
    private string $uri;
    private array $params;

    public function __construct(string $route, string $controller, string $action)
    {
        $this->route = $route;
        $this->controller = $controller;
        $this->action = $action;
    }

    private function regex(): string
    {
        $regex = preg_replace('/\//', '\\/', $this->route);
        $regex = preg_replace('/:(\w+)/', '(?<${1}>\w+)', $regex);

        return '/^'.$regex.'$/';
    }

    public function analyse(string $uri): void
    {
        preg_match($this->regex(), $uri, $matches);

        if (empty($matches)) {
            $this->hit = false;

            return;
        }

        $this->hit = true;
        $this->uri = array_shift($matches);
        $this->params = array_filter($matches, 'is_string', ARRAY_FILTER_USE_KEY);
    }

    public function hit(): bool
    {
        return $this->hit;
    }

    public function execute()
    {
        $controller = $this->controller;
        $action = $this->action;

        return (new $controller())->$action($this->params);
    }
}
