<?php
abstract class Type extends BasicEnum {
    //entre 0 et 19 , type = text et blob
    const char = 0;
    const varchar = 1;
    const binary = 2;
    const varbinary = 3;
    const tinyblob = 4;
    const blob = 5;
    const mediumblob = 6;
    const longblob = 7;
    const tinytext = 8;
    const text = 9;
    const mediumtext = 10;
    const longtext = 11;
    const enum = 12;
    const set = 13;
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
    //entre 40 et 59 , type = datetime
    const date = 40;
    const time = 41;
    const datetime = 42;
    const timestamp = 43;
    const year = 44;
    //entre 60 et 79 , type = formes
    const geometry = 60;
    const point = 61;
    const linestring = 62;
    const polygon = 63;
    const geometrycollection = 64;
    const multilinestring = 65;
    const multipoint = 66;
    const multipolygon = 67;

    //EXEMPLES D'UTILISATION
    //      DaysOfWeek::isValidName('Humpday');  
    //      DaysOfWeek::isValidValue(0);   
}



?>