<?php
class Database
{
    private $_name;
    private $_arrayTables;

    public function setName($name)
    {
        if(is_string($name))
        $this->_name = $name;
    }
    public function setArrayTables($arrayTables)
    {
        if(is_array($arrayTables))
        $this->_arrayTables = $arrayTables;
    }

    //GETTERS
    public function name()
    {
        return $this->_name;
    }
    public function arrayTables()
    {
        return $this->_arrayTables;
    }

}

?>