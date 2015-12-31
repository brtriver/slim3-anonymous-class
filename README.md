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

```

License
-------

DateRange is licensed under the MIT license.


