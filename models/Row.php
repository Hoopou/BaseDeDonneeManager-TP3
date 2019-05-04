<?php
class Row
{
    private $_arrayType;
    private $_arrayItems;
    private $_myId;

    public function __construct()
    {
        // $this->setMyId($myid);
        // $this->setArrayType($arrayType);
        // $this->setArrayItems($arrayItems);
    }

    public function setMyId($myId)
    {
        if(is_int($myId))
        $this->_myId = $myId;
    }
    public function setArrayType($arrayType)
    {
        if(is_array($arrayType))
        $this->_arrayType = $arrayType;
    }
    public function setArrayItems($arrayItems)
    {
        if(is_array($arrayItems))
        $this->_arrayItems = $arrayItems;
    }

    //GETTERS
    public function myid()
    {
        return $this->_myId;
    }
    public function arrayType()
    {
        return $this->_arrayType;
    }
    public function arrayItems()
    {
        return $this->_arrayItems;
    }




}
