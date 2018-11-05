<?php
namespace Controllers;

use Models;

class PropertyController extends BaseController
{
    public function index()
    {
        $properties = Models\Property::get();

        if ($properties) {
            echo self::encode($properties);
        }
    }

    public function create() 
    {
        echo "create";
    }

    public function update() 
    {
        echo "update";
    }

    public function delete() 
    {
        echo "delete";
    }


    public function import($request, $response, $args) 
    {
        $zoopla = file_get_contents('http://api.zoopla.co.uk/api/v1/property_listings.js?postcode=CF64&api_key=raqjr53tyfbdytqt8bc7r3h8');
        $properties = json_decode($zoopla);
        foreach ($properties->listing as $l)
        {
            var_dump($l->country_code);
            $fields = [
                "country" => $l->country_code,
                "county" => $l->county,
                "description" => $l->description,
                "displayableAddress" => $l->displayable_address,
                "fullDetailsUrl" => $l->details_url,
                "imageUrl" => $l->image_645_430_url,
                "latitude" => $l->latitude,
                "listing_id" => $l->listing_id,
                "longitude" => $l->longitude,
                "numBathrooms" => $l->num_bathrooms,
                "numBedrooms" => $l->num_bedrooms,
               // "postcode" => $l->postcode,
                "price" => $l->price,
                "propertyType" => $l->property_type,
                "thumbnailUrl" => $l->thumbnail_url,
                "town" => $l->post_town
            ];
            $p = Models\Property::create($fields);
            //$p->save($fields);
//            $p->country = $l->country_code
//                ->county = $l->county
//                ->description = $l->description
//                ->displayableAddress = $l->displayable_address
//                ->fullDetailsUrl = $l->details_url
//                ->imageUrl = $l->image_645_430_url
//                ->latitude = $l->latitude
//                ->listing_id = $l->listing_id
//                ->longitude = $l->longitude
//                ->numBathrooms = $l->num_bathrooms
//                ->numBedrooms = $l->num_bedrooms
//                ->postcode = $l->postcode
//                ->price = $l->price
//                ->propertyType = $l->property_type
//                ->thumbnailUrl = $l->thumbnail_url
//                ->town = $l->post_town;
//            $p->save();
//            ;



        }
            
        // foreach ($args as $a){
        //     echo $a.PHP_EOL;
        // }
        echo "done";
    }


     /**
     * Pega clube pelo id
     * $request e $response usam interface psr7
     * $args contém os argumentos informados na rota
     *
     * @param Slim\Http\Request $request
     * @param Slim\Http\Response $response
     * @param array $args
     * @return boolean|Slim\Http\Response
     */
    public function getById($request, $response, $args)
    {
        $id = $args['id'];
        
        $property = Models\Property::find($id);

		if ($property) {
			echo self::encode($clube);
			return true;
		}
		
		echo $this->error(
			'get#property{id}',
			$request->getUri()->getPath(),
			$status
		);
		
		return $response->withStatus($status);
    }
}