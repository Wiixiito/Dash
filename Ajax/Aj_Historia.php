





<?php

session_start();
require_once "autoloadAjax.php";




if (isset($_GET['Requerimiento'])) {

    

    if ($_GET['Requerimiento'] == "ConsultarTemasHistoria") {
        $dao = new Dao();

        $dao->Campo("id","");
        $dao->Campo("nombre","");
        $dao->Campo("ruta","");
        $dao->Tabla("historia_usuario","");
       


        $dao->ConsultarAjax();
    }


     if ($_GET['Requerimiento'] == "ConsultarDetallehistorias") {

        $dao = new Dao();

        $dao->Campo("hd.nombre", "");
        $dao->Campo("hd.descripcion", "");
       
      

        $dao->TablasInnerAlias("historia_usuario_detalle", "hd","historia_usuario","h");
        $dao->Where("h.id", $_POST["Categoria"], "");

        

        $dao->ConsultarAjax();
    }

    
}



