<?php
class DatabaseConfig {
    
    protected $serverName;
    protected $userName;
    protected $passCode;
    protected $databaseName;
    
    private $sqlQuery;
    
    public $connectionString;
    public $dataSet;
    
    public function Dbsettings($server_name, $user_name, $password, $database) {
        $this->serverName = $server_name;
        $this->userName = $user_name;
        $this->passCode = $password;
        $this->databaseName = $database;
    }
    
    public function Mysql() {   
        $this->connectionString = null;
        $this->sqlQuery = null;
        $this->dataSet = null;
    }
    
    public function Dbconnect() {
        $this->Mysql();        
        $this -> connectionString = mysql_connect($this -> serverName,$this -> userName,$this -> passCode);
        mysql_select_db($this -> databaseName,$this -> connectionString);
        
        return $this -> connectionString;
    }
}
?>
