<?php
    class Column
    {
        private $_name;
        private $_type;
        private $_canBeNull;
        private $_key;
        private $_isAutoIncrement;

        public function __construct($fromDB)
        {
            // $this->_name = $fromDB;
            $this->_name = $fromDB["Field"];
            $this->setType($fromDB["Type"]);
            $this->setCanBeNull($fromDB["Null"] === 'YES'?TRUE:FALSE);
            $this->setKey($fromDB['Key']);
            $this->setIsAutoIncrement($fromDB['Key'] === 'auto_increment'?TRUE:FALSE);
        }

        public function setName($name)
        {
            if(is_string($name))
                $this->_name = $name;
        }
        public function setType($type)  //à tester
        {
            if(is_string($type))
            {
                // if( strpos($type,'('))
                //     $type = preg_split('(' , $type)[0];
                if( strpos($type,'('))
                    $type = substr($type, 0, strrpos($type, '('));
                    
                    if(Type::isValidName($type))
                        $this->_type = $type;
            }
        }
        public function setCanBeNull(bool $canBeNull)
        {
            $this->_canBeNull = $canBeNull;
        }
        public function setKey($key)
        {
            if(is_string($key))
            $this->_key = $key;
        }
        public function setIsAutoIncrement(bool $autoIncrement)
        {
            $this->_isAutoIncrement = $autoIncrement;
        }
    
        //GETTERS
        public function name()
        {
            return $this->_name;
        }
        public function type()
        {
            return $this->_type;
        }
        public function canBeNull()
        {
            return $this->_canBeNull;
        }
        public function key()
        {
            return $this->_key;
        }
        public function isAutoIncrement()
        {
            return $this->_isAutoIncrement;
        }

        function endsWith($haystack, $needle) {
            return substr_compare($haystack, $needle, -strlen($needle)) === 0;
        }

    }
?>