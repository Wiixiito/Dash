<?php

session_start();
require_once "autoloadAjax.php";



if (isset($_POST['Requerimiento'])) {


	    if ($_POST['Requerimiento'] == "GuardarSprint") {

        $datos = array("nombre" => $_POST["Nombre"],
                       "usuario_registro"=>$_SESSION["id"],
                       "id_estado"             => 3);

        $dao = new Dao();
        $dao->GuardarAjax("sprint", $datos);
    }


  
}



if (isset($_GET['Requerimiento'])) {

    

    if ($_GET['Requerimiento'] == "consultartareaspendiente") {
        $dao = new Dao();

        $dao->Campo("id","");
        $dao->Campo("nombre_tarea","");
        $dao->Campo("descripcion_tarea","");
        $dao->Campo("responsable_tarea","");
        $dao->Tabla("tarea","");
       // $dao->Where("id_estado","3","and");
       // $dao->Where("usuario_registro",$_SESSION['id'],"");
        // $dao->Ordenar("id ");


        $dao->ConsultarAjax();
    }

    
}