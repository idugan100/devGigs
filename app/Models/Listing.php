<?php
namespace App\Models;
class Listing{
    public static function all(){
        return[
            ["id"=>1,
            "title"=>"entry django dev",
            "description"=>"Eager to learn and familiar with python, django and SQLite"
            ],
            ["id"=>2,
            "title"=>"Senior Node dev",
            "description"=>"Skills with Node.js MongoDb and strong leadership skills"
            ]
            
        ];
    }

    public static function find($id){
        $listings=self::all();
        foreach($listings as $listing){
            if($listing['id']==$id){
                return $listing;
            }
        }
    }
}


?>