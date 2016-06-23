<?php



class ErrorManager {



	private static $instance = null;

	private $errors = array();





	private function __construct() { }




	public static function getInstance() {
	
		if (self::$instance == null) {
			
			self::$instance = new ErrorManager();

		}

		return self::$instance;

	} // public function getInstance()





	public function getErrors() {
		
		return $this->errors;

	} // public function getErrors()




	public function reportError(&$sourceObject, $msg = "") {

		$class = get_class($sourceObject);
		$this->errors[] = array("source" => $sourceObject, "message" => "$class: \"$msg\"");

	} // public function reportError($sourceObject, $msg = "")




	public function reportFatalError(&$sourceObject, $exception = null) {

		if (!($exception instanceof Exception)) {
			
			$exception = new Exception();	
	
		}
		$msg = $exception->getMessage();
		$class = get_class($sourceObject);
		$this->reportError($sourceObject, "fatal error: $msg");
	
		throw $exception;

	} // public function reportFatalError($sourceObject, $exception)


} // class ErrorManager







?>