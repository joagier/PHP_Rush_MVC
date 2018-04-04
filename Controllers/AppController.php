<?php

include_once (dirname(__FILE__) . '/../dispatcher.php');

class AppController {

    protected function redirect($param) {

    }

	public function loadModel($model){
		if ($model == 'DB') {
			include_once (dirname(__FILE__) . '/../Config/db.php');

		} else {
			$modelPath = (dirname(__FILE__) . '/../Models/' . $model . '.php');
			if (is_readable($modelPath)) {
				echo 'path exists';
				include_once($modelPath);
				if (class_exists($model)) {
					echo 'class exists';
					return new $model;
				} else {
					return false;
				}
			}else {
				return false;
			}
			
		}
		

	}
}

?>

