<?php 

$app->get('/hello/{name}', function ($request, $response, array $args) {
    $name = $args['name'];
    $response->getBody()->write("Hello, $name");

    return $response;
});

// Root
$app->get('/', function ($request, $response, array $args) {
    return $response->withStatus(403)->write('Forbidden.');
});

// Properties
$app->get("/properties", "App\Controllers\PropertyController:index");
$app->get("/properties/{id}", "App\Controllers\PropertyController:show");
$app->post("/properties/create", "App\Controllers\PropertyController:create");
$app->patch("/properties/{id}", "App\Controllers\PropertyController:update");
$app->delete("/properties/{id}", "App\Controllers\PropertyController:delete");

//Zoopla
$app->get("/zoopla/import", "App\Controllers\PropertyController:import");

