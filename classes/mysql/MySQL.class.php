<?php

// pkrawczak@gmail.com, 2008-03-07
// ...
// pkrawczak@gmail.com, 2009-11-17
	





// requires ErrorManager class



/*
interface:

public function __construct()

public function connect($host, $base, $user, $password, $enconding = "utf8")
public function query($string)
public function fetchAll($result)
public function queryFetchAll($query)

public function getHost()
public function getBaseName()
public function getUser()

public function getLastId()
public function getQueries()

public function __destruct()

*/

class MySQLException extends Exception { }



class MySQL {





	private $host = null, 
			$baseName = null, 
			$user = null, 
			$id = null;

	private $errorManager = null;	
	
	private $queries = array();



	public function __construct() {

		$this->errorManager = ErrorManager::getInstance();

	} // public function __construct()



	public function getHost() { return $this->host; }
	public function getBaseName() { return $this->baseName; }
	public function getUser() { return $this->user; }
	

	public function connect($host, $base, $user, $password, $enconding = "utf8") {

		if (!($this->id = mysql_connect($host, $user, $password))) {

			$this->host = null;
			$this->base = null;
			$this->user = null;
			$this->id = null;

			$this->errorManager->reportFatalError($this, new MySQLException("database connection failed!"));

		}
		else {
			$this->host = $host;
			$this->user = $user;
			if (mysql_select_db($base, $this->id)) {
				$this->baseName = $base;
			}
			mysql_set_charset($enconding, $this->id);
			return true;
		}

	} // public function connect($host, $base, $user, $password)
	




	public function getLastId() {
		
		if (is_resource($this->id)) {

			$lastId = mysql_insert_id($this->id);
			return $lastId;

		}
		else {

			$this->errorManager->reportFatalError($this, new MySQLException("database is not connected, can't get last id"));

		}

	} // public function getLastId()







	public function fetchAll($result) {
	
		if (mysql_num_rows($result)) {

			$rows = array();
			while ($row = mysql_fetch_assoc($result)) {
				$rows[] = $row;
			}
			return $rows;

		}
		else {

			$this->errorManager->reportFatalError($this, new MySQLException("invalid mysql query result supplied to fetchAll()"));

		}

	} // public function fetchAll($result)





	
	public function query($string) {

	 	if (is_resource($this->id)) {
			
			if ($result = mysql_query($string, $this->id)) {
				
				$this->queries[] = $string;
				return $result;

			}
			else {
				$this->errorManager->reportFatalError($this, new MySQLException("error in query: '$string':".mysql_error($this->id)));
			}

		}
		else {

			$this->errorManager->reportFatalError($this, new MySQLException("database is not connected, can't make query"));

		}

	} // public function query($string)



	public function queryFetchAll($query) {

		$result = $this->query($query);
		$entries = $this->fetchAll($result);
		return $entries;

	} // public function queryFetchAll($query)





	public function getQueries() {
	
		return $this->queries;

	} // public function getQueries()



	
	public function __destruct() {

		if (is_resource($this->id)) {

			mysql_close($this->id);
		
		}

	} // public function __destruct()



} // class Mysql

?>
