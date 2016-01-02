slim3-anonymous-class -- sample anonymous class wit Slim3
==============================================

This application is sample code to use anonymous class wit Slim3.
If you use this in your Slim3 application. [install brtriver/slim3-controller](https://github.com/brtriver/slim3-controller)


Requirements
------------

* PHP 7.0 or later.
* Slim3

Example
-------

a default Slim3 Hello example is below:

```php
$c = new \Slim\Container;
$c['greet'] = 'Hello ';

$app = new \Slim\App($c);

$app->get('/hello/{name}', function (Request $request, Response $response, $args) use ($app){
    $response->write($app->getContainer()['greet'] . $args['name']);

    return $response;
});
```

but slim3-anonymous-class is like:

```php
$app->get('/hello/{name}', new class($app) extends MyController {

        public function action($args)
        {
            return $this->render($this->container['greet'] . $args['name']);
        }
});
```

It is too easy to read because of you don't have to know about `$response` and how to access a container object.

And it is too easy to extend action with a trait class.
If you want use Twig as a template engine:

```php
$app->get('/hello/{name}', function ($request, $response, $args) {
    return $this->view->render($response, 'profile.html', [
        'name' => $args['name']
    ]);
});
```

This action should know about `$this->view` and `$response` but using trait like blow:

```php
$app->get('/hello/{name}', new class($app) extends MyController {
        use TwigTemplatable;

        public function action($args)
        {
            return $this->renderTwig('web.html', ['name' => $args['name']]);
        }
});
```

This sample uses `TwigTemplatable` trait class and too simple.

License
-------

slim3-anonymous-class is licensed under the MIT license.


