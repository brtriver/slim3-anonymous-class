slim3-anonymous-class -- sample anonymous class wit Slim3
==============================================

This application is sample to use anonymous class wit Slim3

Requirements
------------

DateRange works with PHP 7.0 or later.

Install
--------

```bash
$ git clone git@github.com:brtriver/slim3-anonymous-class.git
```

Try demo
--------

```bash
$ make setup
$ make install
$ php -S localhost:8888 -t ./web
```

Example
-------

see `web/index.php`:

```php
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

// render with MyController::render method without twig
$app->get('/plain/{name}', new class($app) extends MyController {

        public function __invoke(Request $request,  Response $response, $args)
        {
            $output = 'hello ' . $args['name'];

            return $this->render($response, $output);
        }
});

// render with MyController::render method with twig
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
```

License
-------

slim3-anonymous-class is licensed under the MIT license.


