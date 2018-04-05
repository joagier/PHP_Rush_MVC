<?php 

Class DB {

	private static $DB = null;

	private function __construct(){

	}

	public static function getInstance(){
		if (self::$DB == null) {
			self::$DB = new DB();
			return self::$DB;
		} else {
			return self::$DB;
		}
	}

	public function connectDB()
	{
	    try {
	        $pdo = new PDO('mysql:dbname=MVC;host=localhost', 'root', 'Echarcon91!');
	        return $pdo;
	    } catch (PDOException $e) {
	        echo "PDO ERROR: " . $e->getMessage() . "\n";
	    }
	}
}



?>