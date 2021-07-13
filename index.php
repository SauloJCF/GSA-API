<?php
namespace Gsi_api;

header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: Context-Type");

require_once './vendor/autoload.php';

use \Psr\Http\Message\ServerRequestInterface;
use \Psr\Http\Message\ResponseInterface;
use Slim\App;

$app = new App();

$app->any('/{module}/{action}[/{id}]', function(ServerRequestInterface $request, ResponseInterface $response, $args) {
    $module = 'Gsi_api\\Controller\\' . $args['module'] . 'Controller';
    $action = $args['action'];
    $params = null;
    if (isset($args['id'])) {
        $params = $args['id'];
    }
    $controller = new $module($params);
$controller->$action();
});

$app->run();