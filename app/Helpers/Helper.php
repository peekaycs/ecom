<?php 
namespace App\Helpers;

class Helper{

    public static function  constructSlug($slug){
        return str_replace(' ','-', $slug);
    }

    public static function destructSlug($slug){
        return str_replace('-', ' ', $slug);
    }

}


