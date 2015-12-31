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

        // Register component on container
        $this->view = new \Slim\Views\Twig($this->templatePath, [
            'cache' => $this->cachePath
        ]);
        $this->view->addExtension(new \Slim\Views\TwigExtension(
            $this->container['router'],
            $this->container['request']->getUri()
        ));
    }

    public function renderTwig($path, $args)
    {
        $this->useTwig();
        $this->view->render($this->response, $path, $args);
    }
}
