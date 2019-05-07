<?php
    class Item
    {
        private $_value;
        private $_type;

        public function __construct($itemFromBd)
        {
            $this->_value = $itemFromBd;
        }

        public function setValue($value)
        {
            $this->_value = $value;
        }
        public function setType($type)
        {
            if(is_string($type))
            {
                if(endsWith($type , ')')){
                    $type = split('(' , $type)[0];
                }
                    if(Type::isValidName($type))
                        $this->_type = $type;
            }
        }

        //GETTERS
        public function value()
        {
            return $this->_value;
        }
        public function type()
        {
            return $this->_type;
        }




    }
