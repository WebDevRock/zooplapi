<?php
use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;
use App\Lib\SlimDotEnv;


require '../vendor/autoload.php';

$app = new \Slim\App;
//DotEnv
$dotenv = new SlimDotEnv(__DIR__. '/..', '.env');
$dotenv->load();
$settings = require __DIR__ . '/../app/settings.php';
$app = new \Slim\App($settings);
require __DIR__ . '/../app/Dependencies.php';
require __DIR__ . '/../app/Middleware.php';
require __DIR__ . '/../app/Routes.php';

$container = $app->getContainer();
$app->run();