<?php
use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;

use Karen\Controller\TwigTemplatable;

require __DIR__ . '/../vendor/autoload.php';

$app = new \Slim\App;
$app->get('/hello/{name}', function (Request $request, Response $response) {
    $name = $request->getAttribute('name');
    $response->getBody()->write("Hello, $name");

    return $response;
});

$app->get('/twig/{name}', new class ($app) {
        use TwigTemplatable;
        public function __construct($app)
        {
            $this->app = $app;
            $this->useTwig();
        }
        public function __invoke(Request $request,  Response $response, $args)
        {
            return $this->view->render($response, 'web.html', [
                'name' => $args['name']
            ]);

        }
});

$app->run();
