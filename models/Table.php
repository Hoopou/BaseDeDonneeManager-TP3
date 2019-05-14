<?php
class Table
{
    private $_name;
    private $_arrayColumns;
    private $_arrayRows;

    public function __construct($fromDB)
    {
        $fromDB = (String)$fromDB;
        $this->_name = $fromDB;
    }

    public function setName($name)
    {
        if(is_string($name))
        $this->_name = $name;
    }
    public function setArrayColumns($arrayColumns)
    {
        if(is_array($arrayColumns))
        $this->_arrayColumns = $arrayColumns;
    }
    public function setArrayRows(Array $arrayRows)
    {
        if(is_array($arrayRows))
        $this->_arrayRows = $arrayRows;
    }

    //GETTERS
    public function name()
    {
        return $this->_name;
    }
    public function arrayColumns()
    {
        return $this->_arrayColumns;
    }
    public function arrayRow()
    {
        return $this->_arrayRows;
    }

}

?>