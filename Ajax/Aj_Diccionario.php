<?php

session_start();
require_once "autoloadAjax.php";



if (isset($_POST['Requerimiento'])) {


	    if ($_POST['Requerimiento'] == "GuardarDiccionario") {

        $datos = array("nombre" => $_POST["Nombre"],
                       "descripcion" => $_POST["Descripcion"],
                       "usuario_registro"=>$_SESSION["id"],
                       "id_estado"             => 3);

        $dao = new Dao();
        $dao->GuardarAjax("diccionario", $datos);
    }


  
}


if (isset($_GET['Requerimiento'])) {

    

    if ($_GET['Requerimiento'] == "consultardiccionario") {
        $dao = new Dao();

        $dao->Campo("id","");
        $dao->Campo("nombre","");
        $dao->Campo("descripcion","");
        $dao->Tabla("diccionario","");
        $dao->Where("id_estado","3","");
        
        


        $dao->ConsultarAjax();
    }

    
}