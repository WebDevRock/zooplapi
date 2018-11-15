<?php
namespace App\Controllers;

use App\Models;
use \Psr\Http\Message\ResponseInterface as Response;
use \Psr\Http\Message\ServerRequestInterface as Request;

class PropertyController extends BaseController
{
    public function index()
    {
        $properties = Models\Property::get();

        if ($properties) {
            echo self::encode($properties);
        }
    }

    public function show($id)
    {
        echo "show";
    }

    public function create(Request $request, Response $response)
    {
        $data = $request->getParsedBody();
        $fields = [
            "country" => filter_var($data['country_code'], FILTER_SANITIZE_STRING),
            "county" => filter_var($data['county'], FILTER_SANITIZE_STRING),
            "description" => filter_var($data['description'], FILTER_SANITIZE_STRING),
            "displayable_address" => filter_var($data['displayable_address'], FILTER_SANITIZE_STRING),
            "full_details_url" => filter_var($data['details_url'], FILTER_SANITIZE_URL),
            //"imageUrl" => $l->image_645_430_url,
            //"latitude" => $l->latitude,
            //"longitude" => $l->longitude,
            "bathrooms" => filter_var($data['num_bathrooms'], FILTER_SANITIZE_NUMBER_INT),
            "bedrooms" => filter_var($data['num_bedrooms'], FILTER_SANITIZE_NUMBER_INT),
            "price" => $l->price,
            "type" => $l->property_type,
            "thumbnail_url" => $l->thumbnail_url,
            "town" => $l->post_town,
        ];
        $exists = Models\Property::where("listing_id", "=", $l->listing_id)->first();
        if ($exists === null) {
            $p = Models\Property::create($fields);
            $updated++;
        }
    }

    public function update($request, $response, $args)
    {
        echo "update";
    }

    public function delete($request, $response, $args)
    {
        echo "delete";
    }

    /**
     * @param $request
     * @param $response
     * @param $args
     *  todo: Extract out into command line only
     */
    public function import($request, $response, $args)
    {

        $zoopla_url = getenv('zoopla_api_url', 'zooplapiurl');
        $zoopla_key = getenv('zoopla_api_key', 'zooplapikey');
        $zoopla_area = getenv('zoopla_api_area', 'Edinburgh');

        $zoopla = file_get_contents($zoopla_url . '?area=oxford&api_key=' . $zoopla_key);
        $properties = json_decode($zoopla);
        echo "<pre>Properties Found: " . count($properties->listing) . "</pre>" . PHP_EOL;
        $updated = 0;
        foreach ($properties->listing as $l) {
            $fields = [
                "country" => $l->country_code,
                "county" => $l->county,
                "description" => $l->description,
                "displayable_address" => $l->displayable_address,
                "full_details_url" => $l->details_url,
                "image_url" => $l->image_645_430_url,
                "latitude" => $l->latitude,
                "listing_id" => $l->listing_id,
                "longitude" => $l->longitude,
                "bathrooms" => $l->num_bathrooms,
                "bedrooms" => $l->num_bedrooms,
                "price" => $l->price,
                "type" => $l->property_type,
                "thumbnail_url" => $l->thumbnail_url,
                "town" => $l->post_town,
            ];
            $exists = Models\Property::where("listing_id", "=", $l->listing_id)->first();
            if ($exists === null) {
                $p = Models\Property::create($fields);
                $updated++;
            }

        }
        echo "<pre>Properties Updated: " . $updated . "</pre>" . PHP_EOL;
    }
}
