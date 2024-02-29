<?php

session_start();
require_once "autoloadAjax.php";



if (isset($_POST['Requerimiento'])) {


	    if ($_POST['Requerimiento'] == "GuardarResponsable") {

        $datos = array("nombre" => $_POST["Nombre"],
                       "usuario_registro"=>$_SESSION["id"],
                       "id_estado"             => 3);

        $dao = new Dao();
        $dao->GuardarAjax("responsable", $datos);
    }


  
}


