<?php

use Illuminate\Database\Capsule\Manager as Capsule;
use Controllers\BaseController;

$container = $app->getContainer();

// Eloquent
$capsule = new Capsule;
$capsule->addConnection($container->get('settings')['database']);
$capsule->setAsGlobal();
$capsule->bootEloquent();

$container['Base'] = function ($c) {
    return new BaseController($c);
};