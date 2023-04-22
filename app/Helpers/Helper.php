<?php 
namespace App\Helpers;

class Helper{

    public static function  constructSlug($slug){
        return str_replace(' ','-', $slug);
    }

    public static function destructSlug($slug){
        return str_replace('-', ' ', $slug);
    }


    public static function randomString($length = 10, $prefix = null, $type = 'alphanumeric'){ 
        switch($type){
            case 'numeric':
               $input =  range(48,57);
            break;
            case 'alphbtes':
                $input = range(65,90);
            break;  
            default:  
            $input = array_merge(
                range(65,90),
                range(48,57)
            );
            break;
        }
        $alpabet_numerics = array_map(function($i) use ($type) {
            return chr($i);
        }, $input );
        shuffle($alpabet_numerics);
        $alpabet_numerics = implode('', $alpabet_numerics);
        $string = ($prefix) ?  $prefix.substr($alpabet_numerics, 0, $length) : substr($alpabet_numerics, 0, $length);
        return $string;
    
}

}


