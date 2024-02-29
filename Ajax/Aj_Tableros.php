<?php

session_start();
require_once "autoloadAjax.php";

/*if (isset($_GET['Requerimiento'])) {


}*/

if (isset($_POST['Requerimiento'])) {


	    if ($_POST['Requerimiento'] == "GuardarTarea") {

        $datos = array("nombre_tarea" => $_POST["Nombre"],
                       "descripcion_tarea" => $_POST["Descripcion"],
                       "id_responsable" => $_POST["Responsable"],
                       "usuario_registro"=>$_SESSION["id"],
                       "id_sprint" => $_POST["Sprint"],
                       "fecha_desde" => $_POST["Fecha_Desde"],
                       "fecha_hasta" => $_POST["Fecha_Hasta"],
                       "cantidad_dias" => $_POST["Cantidad"],
                       "id_estado"             => 3);

        $dao = new Dao();
        $dao->GuardarAjax("tarea", $datos);
    }


     if ($_POST['Requerimiento'] == "ModificarTarea") {
        $datos = array("id_estado"=> 4);
        $dao = new Dao();
        $dao->ModificarAjax("tarea", $datos, "id = " . $_POST['Id'], $_POST['Id']);
    }

    if ($_POST['Requerimiento'] == "TerminarTarea") {
        $datos = array("id_estado"=> 5);
        $dao = new Dao();
        $dao->ModificarAjax("tarea", $datos, "id = " . $_POST['Id'], $_POST['Id']);
    }



    if ($_POST['Requerimiento'] == "consultartareaspendiente2") {
        $dao = new Dao();

        $dao->Campo("t.id","");
        $dao->Campo("t.nombre_tarea","");
        $dao->Campo("t.descripcion_tarea","");
        $dao->Campo("r.nombre","");
        $dao->Campo("t.fecha_desde","");
        $dao->Campo("t.fecha_hasta","");
        $dao->Campo("t.cantidad_dias","");

        $dao->TablasInnerAlias("tarea","t","responsable","r");
        $dao->Where("t.id_estado","3","and");
        $dao->Where("t.usuario_registro",$_SESSION['id'],"and");
        $dao->Where("t.id_sprint",$_POST['Sprint'],"");
        


        $dao->ConsultarAjax();
    }





    if ($_POST['Requerimiento'] == "consultartareasprocesadas2") {
        $dao = new Dao();

        $dao->Campo("t.id","");
        $dao->Campo("t.nombre_tarea","");
        $dao->Campo("t.descripcion_tarea","");
        $dao->Campo("r.nombre","");
        $dao->Campo("t.fecha_desde","");
        $dao->Campo("t.fecha_hasta","");
        $dao->Campo("t.cantidad_dias","");

        $dao->TablasInnerAlias("tarea","t","responsable","r");
        $dao->Where("t.id_estado","4","and");
        $dao->Where("t.usuario_registro",$_SESSION['id'],"and");
        $dao->Where("t.id_sprint",$_POST['Sprint'],"");
        
        


        $dao->ConsultarAjax();
    }


    if ($_POST['Requerimiento'] == "consultartareasterminadas2") {
        $dao = new Dao();

     $dao->Campo("t.id","");
        $dao->Campo("t.nombre_tarea","");
        $dao->Campo("t.descripcion_tarea","");
        $dao->Campo("r.nombre","");
        $dao->Campo("t.fecha_desde","");
        $dao->Campo("t.fecha_hasta","");
        $dao->Campo("t.cantidad_dias","");

        $dao->TablasInnerAlias("tarea","t","responsable","r");
        $dao->Where("t.id_estado","5","and");
        $dao->Where("t.usuario_registro",$_SESSION['id'],"and");
        $dao->Where("t.id_sprint",$_POST['Sprint'],"");
        
        


        $dao->ConsultarAjax();
    }


}



if (isset($_GET['Requerimiento'])) {

    

    if ($_GET['Requerimiento'] == "consultartareaspendiente") {
        $dao = new Dao();

        $dao->Campo("id","");
        $dao->Campo("nombre_tarea","");
        $dao->Campo("descripcion_tarea","");
        $dao->Campo("id_responsable","");
        $dao->Tabla("tarea","");
        $dao->Where("id_estado","3","");
        //$dao->Where("usuario_registro",$_SESSION['id'],"and");
        //$dao->Where("id_sprint",$_POST['Sprint'],"");

        


        $dao->ConsultarAjax();
    }

    if ($_GET['Requerimiento'] == "consultartareasprocesadas") {
        $dao = new Dao();

        $dao->Campo("id","");
        $dao->Campo("nombre_tarea","");
        $dao->Campo("descripcion_tarea","");
        $dao->Campo("responsable_tarea","");
        $dao->Tabla("tarea","");
        $dao->Where("id_estado","4","and");
        $dao->Where("usuario_registro",$_SESSION['id'],"");
        // $dao->Ordenar("id ");


        $dao->ConsultarAjax();
    }

    if ($_GET['Requerimiento'] == "consultartareasterminadas") {
        $dao = new Dao();

        $dao->Campo("id","");
        $dao->Campo("nombre_tarea","");
        $dao->Campo("descripcion_tarea","");
        $dao->Campo("responsable_tarea","");
        $dao->Tabla("tarea","");
        $dao->Where("id_estado","5","and");
        $dao->Where("usuario_registro",$_SESSION['id'],"");
        // $dao->Ordenar("id ");


        $dao->ConsultarAjax();
    }
}