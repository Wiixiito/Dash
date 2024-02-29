<?php

session_start();
require_once "autoloadAjax.php";




if (isset($_GET['Requerimiento'])) {

    

    if ($_GET['Requerimiento'] == "ConsultarLibros") {
        $dao = new Dao();

        $dao->Campo("id","");
        $dao->Campo("nombre","");
        $dao->Campo("descripcion","");
        $dao->Campo("detalle","");
        $dao->Tabla("libros","");
       


        $dao->ConsultarAjax();
    }

    
}