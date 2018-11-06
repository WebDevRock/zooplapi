<?php

namespace App\Command;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use App\Lib\SlimDotEnv;
use App\Models;

class ImportZoopla extends Command
{
    protected function configure()
    {
        $this
            // the name of the command (the part after "bin/console")
            ->setName('app:import')

            // the short description shown while running "php bin/console list"
            ->setDescription('Import latest Zoopla dataset.')

            // the full command description shown when running the command with
            // the "--help" option
            ->setHelp('This command allows you import the Zoopla dataset with latest properties.')
        ;
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $dotenv = new SlimDotEnv(__DIR__. '/../../', '.env');
        $dotenv->load();

        $zoopla_url = getenv('zoopla_api_url', 'zooplapiurl');
        $zoopla_key = getenv('zoopla_api_key', 'zooplapikey');
        $zoopla_area = getenv('zoopla_area', 'Edinburgh');
        $url = $zoopla_url . '?area='. $zoopla_area . '&api_key=' . $zoopla_key;

        //todo: apply handling for rate limitation and (403 error)
        $zoopla = file_get_contents($url);
        $properties = json_decode($zoopla);
        $output->writeLn("Properties Found: " . count($properties->listing));
        $updated = 0;
        foreach ($properties->listing as $l)
        {
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
                "price" => $l->price,
                "propertyType" => $l->property_type,
                "thumbnailUrl" => $l->thumbnail_url,
                "town" => $l->post_town
            ];
            $exists = Models\Property::where("listing_id", "=", $l->listing_id)->first();
            if ($exists === null){
                $p = Models\Property::create($fields);
                $updated ++;
            }


        }
        $output->writeLn("Properties Updated: ". $updated);
    }
}