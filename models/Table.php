<?php
class Table
{
    private $_name;
    private $_arrayType;
    private $_arrayRows;

    public function setName($name)
    {
        if(is_string($name))
        $this->_name = $name;
    }
    public function setArrayType($arrayType)
    {
        if(is_array($arrayType))
        $this->_arrayType = $arrayType;
    }
    public function setArrayRows($arrayRows)
    {
        if(is_array($arrayRows))
        $this->_arrayRows = $arrayRows;
    }

    //GETTERS
    public function name()
    {
        return $this->_name;
    }
    public function arrayType()
    {
        return $this->_arrayType;
    }
    public function arrayRow()
    {
        return $this->_arrayRow;
    }

}

?>