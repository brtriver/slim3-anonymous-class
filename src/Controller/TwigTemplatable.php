<?php
namespace Karen\Controller;

use \Psr\Http\Message\ResponseInterface as Response;

trait  TwigTemplatable
{
    private $templatePath;
    private $cachePath;
    private $view;

    public function useTwig()
    {
        $this->templatePath = __DIR__ . '/../../templates/';
        $this->cachePath = '/tmp/';

        // Get container
        $container = $this->app->getContainer();

        // Register component on container
        $this->view = new \Slim\Views\Twig($this->templatePath, [
            'cache' => $this->cachePath
        ]);
        $this->view->addExtension(new \Slim\Views\TwigExtension(
            $container['router'],
            $container['request']->getUri()
        ));
    }
}
