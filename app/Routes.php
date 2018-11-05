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
$app->get("/properties", "Controllers\PropertyController:index");
$app->get("/properties/{id}", "Controllers\PropertyController:getById");
$app->post("/properties", "Controllers\PropertyController:create");
$app->patch("/properties/{id}", "Controllers\PropertyController:update");
$app->delete("/properties/{id}", "Controllers\PropertyController:delete");

//Zoopla
$app->get("/zoopla/import/{area}/{api}", "Controllers\PropertyController:import");

