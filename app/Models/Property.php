<?php
namespace Models;

use Illuminate\Database\Eloquent\Model as Eloquent;

class Property extends Eloquent
{
    /**
     * @var string
     */
    protected $table = "properties";
    protected $guarded = [];


    public static function create(array $attributes = [])
    {
        $model = new static($attributes);
        $model->save();
        return $model;
    }

    
}