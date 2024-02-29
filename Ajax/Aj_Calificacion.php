<?php

session_start();
require_once "autoloadAjax.php";



if (isset($_POST['Requerimiento'])) {




    if ($_POST['Requerimiento'] == "GuardarCalificacion") {

        $datos = array(
                       "descripcion" => $_POST["Descripcion"],
                       "calificacion" => $_POST["Calificacion"],
                       "id_usuario"=>$_POST["id"]);

        $dao = new Dao();
        $dao->GuardarAjax("calificaciones", $datos);
    }


  
}
