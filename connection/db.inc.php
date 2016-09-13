<?php
//error_reporting(0);
class DatabaseConnect{
	
	private $host      = 'localhost';
    private $user      = 'root';
    private $pass      = '';
    private $dbname    = 'depeddoctracking';
    private $port      = '3306';
    private $db;
    private $error;
  	private $stmt;
	private $data = array();
    private $result;
    
	function __construct()
	{
		$this->db = mysqli_connect($this->host, $this->user, $this->pass, $this->dbname);
		if (mysqli_connect_errno($this->db)) {
			echo "Failed to connect to MySQL: " . mysqli_connect_error();
		}
	}
	
	function query($MySQLquery){
		$this->stmt = $this->db->prepare(mysqli_real_escape_string($this->db,$MySQLquery));
	}
    
    function bind($bind=array()){
        if ( $type = array_shift( $bind ) )
        call_user_func_array( 
            array( $this->stmt, 'bind_param' ), 
            array_merge( array( $type ), array_map( function( &$item ) { return $item; }, $bind ) ) 
        );

    }
	
    function execute(){
        $this->stmt->execute();
    }
	function rowCount(){
		return mysqli_num_rows($this->result);	
	}
	
	function resultset(){
        $this->stmt->execute();
        $this->result = $this->stmt->get_result();
        while($row = mysqli_fetch_assoc($this->result)) {
          array_push($this->data, $row);
        }
        return $this->data;
        $this->free();
        $this->close();
	}
	
    function single(){
        $this->stmt->execute();
        $this->result = $this->stmt->get_result();
        while ($row = $this->stmt->fetch_row()) {
            printf ("%s (%s)\n", $row[0], $row[1]);
        }
        //return $this->stmt->fetch_row()[0];
        
        $this->free();
        $this->close();
    }
    
	function close()
	{
		$this->db->close();	
	}
	
	function free(){
		$this->result->free();
	}
}