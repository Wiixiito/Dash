<?php

session_start();
require_once "autoloadAjax.php";




if (isset($_GET['Requerimiento'])) {

    

    if ($_GET['Requerimiento'] == "ConsultarSlide") {
        $dao = new Dao();

        $dao->Campo("id","");
        $dao->Campo("nombre","");
        $dao->Campo("descripcion","");
        $dao->Campo("ruta","");
        $dao->Tabla("foto_slide","");
       


        $dao->ConsultarAjax();
    }

    if ($_GET['Requerimiento'] == "ConsultarSlide2") {
        $dao = new Dao();

        $dao->Campo("id","");
        $dao->Campo("nombre","");
        $dao->Campo("descripcion","");
        $dao->Campo("ruta","");
        $dao->Tabla("foto_slide2","");
       


        $dao->ConsultarAjax();
    }



    if ($_GET['Requerimiento'] == "ConsultarPregunta") {
        $dao = new Dao();

        $dao->Campo("id","");
        $dao->Campo("pregunta","");
        $dao->Campo("r1","");
        $dao->Campo("r2","");
        $dao->Campo("r3","");
        $dao->Campo("r4","");
        $dao->Campo("rf","");
        $dao->Tabla("quiz","");
       


        $dao->ConsultarAjax();
    }

    
}