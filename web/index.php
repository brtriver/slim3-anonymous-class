<?php
use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;

use Karen\Controller\MyController;
use Karen\Controller\TwigTemplatable;

require __DIR__ . '/../vendor/autoload.php';

$c = new \Slim\Container;
$c['greet'] = 'Hello ';

$app = new \Slim\App($c);

$app->get('/hello/{name}', function (Request $request, Response $response, $args) use ($app){
    $response->write($app->getContainer()['greet'] . $args['name']);

    return $response;
});

$app->get('/plain/{name}', new class($app) extends MyController {

        public function action($args)
        {
            return $this->render($this->container['greet'] . $args['name']);
        }
});

$app->get('/twig/{name}', new class($app) extends MyController {
        use TwigTemplatable;

        public function action($args)
        {
            return $this->renderTwig('web.html', ['name' => $args['name']]);
        }
});

$app->run();
