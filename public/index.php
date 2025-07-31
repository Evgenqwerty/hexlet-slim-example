<?php
require __DIR__ . '/../vendor/autoload.php'; // Важно: правильный путь к автозагрузчику

use Slim\Factory\AppFactory;
use DI\Container;

// Создаем контейнер
$container = new Container();
$container->set('renderer', function () {
    return new \Slim\Views\PhpRenderer(__DIR__ . '/../templates');
});

// Создаем приложение из контейнера
$app = AppFactory::createFromContainer($container);
$app->addErrorMiddleware(true, true, true);

$app->get('/users/{id}', function ($request, $response, $args) {
    $params = ['id' => $args['id'], 'nickname' => 'user-' . $args['id']];
    return $this->get('renderer')->render($response, 'users/show.phtml', $params);
});

$app->run();
