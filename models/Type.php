<?php
class Type extends BasicEnum {
    //entre 0 et 5 , type = boolean
    const boolean = 0;
    const binary = 1;
    const varbinary = 2;
    //entre 0 et 19 , type = text et blob
    const char = 6;
    const varchar = 7;
    const tinytext = 8;
    const text = 9;
    const mediumtext = 10;
    const longtext = 11;
    const enum = 12;
    const set = 13;
    const nchar = 14;
    const nvarchar = 15;
    const linestring = 16;
    const multilinestring = 17;

    //entre 20 et 39 , type = number
    const tinyint = 20;
    const smallint = 21;
    const mediumint = 22;
    const int = 23;
    const bigint = 24;
    const decimal = 25;
    const float = 26;
    const double = 27;
    const bit = 28;
    const number = 29; // pour l'affectation des formes display
    //entre 40 et 59 , type = datetime
    const date = 40;
    const time = 41;
    const datetime = 42;
    const timestamp = 43;
    const year = 44;
    //entre 60 et 79 , type = formes
    const geometry = 60;
    const point = 61;
    const polygon = 62;
    const geometrycollection = 63;
    const multipoint = 64;
    const multipolygon = 65;
    //entre 80 et 100, type = file
    const tinyblob = 80;
    const blob = 81;
    const mediumblob = 82;
    const longblob = 83;
    const json = 84;

    //EXEMPLES D'UTILISATION
    //      DaysOfWeek::isValidName('Humpday');  
    //      DaysOfWeek::isValidValue(0);   

    public static function getConstantName($number){
        $fooClass = new ReflectionClass ( 'Type' );
        $constants = $fooClass->getConstants();

        $constName = null;
        foreach ( $constants as $name => $value )
        {
            if ( $value == $number )
            {
                $constName = $name;
                break;
            }
        }
        return $constName;
    }
    public static function getConstantNumber($name){
        $fooClass = new ReflectionClass ( 'Type' );
        $constants = $fooClass->getConstants();

        $constNumber = null;
        foreach ( $constants as $_name => $value )
        {
            if ( $name == $_name )
            {
                $constNumber = $value;
                break;
            }
        }
        return $constNumber;
    }

    public static function getcustomType($type){
        if(Type::between(Type::getConstantNumber($type) , 0 , 5)){
            return "text";
        }elseif(Type::between(Type::getConstantNumber($type) , 5 , 20)){
            return "text";
        }elseif(Type::between(Type::getConstantNumber($type) , 20 , 40)){
            return "text";
        }elseif(Type::between(Type::getConstantNumber($type) , 40 , 60)){
            // return "date";
            return "text";
        }elseif(Type::between(Type::getConstantNumber($type) , 60 , 80)){
            return "N/A";
        }elseif(Type::between(Type::getConstantNumber($type) , 80 , 100)){
            return "file";
        }
    }

    private static function between($value , $minimalValue , $maximalValueEXC ){
        return (($value>=$minimalValue) && ($value<$maximalValueEXC));
    }
}



?>