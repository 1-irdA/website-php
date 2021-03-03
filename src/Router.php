<?php

namespace App;

use AltoRouter;
use App\Security\ForbiddenException;

class Router
{
    private string $view_path;

    public string $layout = 'layout/default';

    /**
     * @var AltoRouter
     */
    private $router;

    /**
     * __construct
     *
     * @param  string $view_path path the the view folder
     * @return void
     */
    public function __construct(string $view_path)
    {
        $this->view_path = $view_path;
        $this->router = new AltoRouter();
    }

    /**
     * Url with get method
     *
     * @param  string $url in web page
     * @param  string $view path to the view folder
     * @param  string $name name of path
     * @return self fluent method
     */
    public function get(string $url, string $view, ?string $name = null): self
    {
        $this->router->map('GET', $url, $view, $name);
        return $this;
    }
    
    /**
     * Url with post method
     * 
     * @param  string $url in web page
     * @param  string $view path to the view folder
     * @param  string $name of path
     * @return self fluent method
     */
    public function post(string $url, string $view, ?string $name = null): self
    {
        $this->router->map('POST', $url, $view, $name);
        return $this;
    }
    
    /**
     * Url with get or post method
     *
     * @param  string $url in web page
     * @param  string $view path to view folder
     * @param  string $name url name
     * @return self fluent method
     */
    public function match(string $url, string $view, ?string $name = null): self
    {
        $this->router->map('POST|GET', $url, $view, $name);
        return $this;
    }
    
    /**
     * Run router
     *
     * @return void
     */
    public function run()
    {
        $match = $this->router->match();

        if ($match === false) {
            require $this->view_path . '/404.php';
            exit();
        }

        $view = $match['target'];

        // global
        $params = $match['params'];
        $router = $this;

        $this->layout = strpos($view, 'admin/') !== false ? 'admin/layout/default' : 'layout/default';
        
        try {
            ob_start();
            require $this->view_path . $view . '.php';
            $content = ob_get_clean();
            require $this->view_path . DIRECTORY_SEPARATOR . $this->layout . '.php';
        } catch (ForbiddenException $e) {
            http_response_code(301);
            header('Location: ' . $this->url('login') . '?forbidden=1');
            exit();
        }
        return $this;
    }
    
    /**
     * url
     *
     * @param  string $name name of url
     * @param  string $params share params
     * @return string url
     */
    public function url(string $name, array $params = []): string
    {
        return $this->router->generate($name,$params);
    }
}
