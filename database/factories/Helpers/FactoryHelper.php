<?php

namespace Database\Factories\Helpers;

use Illuminate\Database\Eloquent\Factories\HasFactory;

class FactoryHelper
{

    /**
     * This function will get random model id from the database.
     * @param string | HasFactory $model
     */
    public static function getRandomModelId(string $model)
    {
        //get model count
        $count = $model::query()->count();
        if($count === 0 ){
            // if model count is 0
            // create a new record and retrieve the record id
            return $model::factory()->create()->id;
        }else{
            // Generate Number between 1 and model count.
            return  rand(1, $count);
        }
    }
}
