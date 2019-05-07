<?php
class Connection
{
    private $_host;
    private $_user;
    private $_password;
    private $_database;

    public function setUser($user)
    {
        if(is_string($user))
        $this->_user = $user;
    }
    public function setHost($host)
    {
        if(is_string($host))
        $this->_host = $host;
    }
    public function setPassword($pwd)
    {
        if(is_string($pwd))
        $this->_password = $pwd;
    }
    public function setDatabases($database){
        if(is_array($database))
        $this->_database = $database;
    }

    //GETTERS
    public function user()
    {
        return $this->_user;
    }
    public function host()
    {
        return $this->_host;
    }
    public function password()
    {
        return $this->_password;
    }
    public function database(){
        return $this->_database;
    }

}

?>