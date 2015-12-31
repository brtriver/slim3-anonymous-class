<?php
use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;

use Karen\Controller\MyController;
use Karen\Controller\TwigTemplatable;

require __DIR__ . '/../vendor/autoload.php';

$app = new \Slim\App;
$app->get('/hello/{name}', function (Request $request, Response $response) {
    $name = $request->getAttribute('name');
    $response->getBody()->write("Hello, $name");

    return $response;
});

$app->get('/plain/{name}', new class($app) extends MyController {

        public function __invoke(Request $request,  Response $response, $args)
        {
            $output = 'hello ' . $args['name'];

            return $this->render($response, $output);
        }
});

$app->get('/twig/{name}', new class($app) extends MyController {
        use TwigTemplatable;

        public function __invoke(Request $request,  Response $response, $args)
        {
            // render by twig
            $this->useTwig();
            $output = $this->view->fetch('web.html', [
                'name' => $args['name']
            ]);

            return $this->render($response, $output);

            // if render with 404 status, call `$this->render404` in MyController
        }
});

$app->run();
