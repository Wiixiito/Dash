

<?php


class Conexion{



  var $link =null;



	public function conectar(){


		$servername = "localhost";
		$username = "root";
		$password = "";
		$database = "george";
	
		

		try{



			// $link = new PDO("mysql:host=localhost;dbname=perla_negra;charset=utf8","root","",array(PDO::ATTR_PERSISTENT => true));

			$link = new PDO("mysql:host=$servername;dbname=$database", $username, $password);

			return $link;



		}catch(PDOException $e){

			echo "Error de Conexion ".$e->getMessage();

		}

				



	}



}?>