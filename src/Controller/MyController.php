<?php
namespace Karen\Controller;

use \Psr\Http\Message\ResponseInterface as Response;

abstract class MyController
{
    protected $app;

    public function __construct($app)
    {
        $this->app = $app;
        $c = $this->app->getContainer()['errorHandler'] = $this->errorHandler();
    }

    public function errorHandler()
    {
        return function ($c) {
            return function ($request, $response, $exception) use ($c) {
                return $c['response']->withStatus(500)
                    ->withHeader('Content-Type', 'text/html')
                    ->write('Something went wrong!');
            };
        };
    }

    public function render(Response $response, $output)
    {
        return $response->write($output);
    }

    public function render404(Response $response, $output)
    {
        return $response->withStatus(404)->write($output);
    }

}
