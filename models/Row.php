<?php
class Row
{
    private $_arrayType;
    private $_arrayItems = array();
    private $_myId;

    public function __construct($data, int $id)
    {
        $this->_myId = $id;
        if($data != null){
            foreach ($data as $key => $value) {
                $item = new Item($value);
                array_push($this->_arrayItems, $item);
            }
        }
    }

    public function setMyId($myId)
    {
        if (is_int($myId))
            $this->_myId = $myId;
    }
    public function setArrayType($arrayType)
    {
        if (is_array($arrayType))
            $this->_arrayType = $arrayType;
    }
    public function setArrayItems($arrayItems)
    {
        if (is_array($arrayItems))
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
        if($this->_arrayType != null){
            $i=0;
            foreach($this->_arrayItems as $_tempItem){

                if($this->_arrayType[$i]->type() != null && $this->_arrayType[$i]->type() != ''){
                    $_tempItem->setType($this->arrayType[$i]);
                }else{
                    $_tempItem->setType('');
                }
                
                $i++;
            }
        }
        return $this->_arrayItems;
    }
}
