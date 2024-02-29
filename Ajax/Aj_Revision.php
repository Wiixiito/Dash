<?php

session_start();
require_once "autoloadAjax.php";


if (isset($_POST['Requerimiento'])) {

if ($_POST['Requerimiento'] == "ConsultarRevisiones") {

        $dao = new Dao();

        $dao->Campo("id", "");
        $dao->Campo("Modulo", "");
        $dao->Campo("Funcionabilidad", "");
        $dao->Campo("verificado", "");
        $dao->Campo("observaciones", "");
        $dao->Campo("imagen", "");
        $dao->Campo("verificado", "");

        
        $dao->Tabla("revi","");
       
        $respuesta =$dao->Consultar();

        $data = array();
        $total=0;
        $no = 1;
        foreach ($respuesta as $row => $item){
             $botonChequeado = '';
             $botonDesc = '';
             $botonImagenes = '';
             $verificado = '';
             $botonDesc = '<button type="button" data-toggle="modal" data-target="#myModal" id="ModificarDesc" idObservaciones=' . $item[0] . '  class="btn btn-info waves-effect"><i class="material-icons">edit</i><span>Observaciones del modulo</span></button>';
             

              if($item[3]==1){
                   $botonChequeado = '<div  id="chequeado" class="checkbox checkbox-info checkbox-circle"><input  class="checkProductoInventario"  type="checkbox" class="chk-col-pink" checked><label ></label> </div>';

              }else{
                   $botonChequeado = '<div  id="nochequeado" class="checkbox checkbox-info checkbox-circle"><input  class="checkProductoInventario"  type="checkbox"><label checkbox-circle></label> </div>';

              }

              if($item[4]==NULL){
                    $botonDesc = '<button type="button" data-toggle="modal" data-target="#myModal" id="ModificarDesc" idObservaciones=' . $item[0] . '  class="btn btn-info waves-effect"><i class="material-icons">edit</i><span>Agregar Observacion</span></button>'; 
              }else {
                 $botonDesc = '<button type="button" data-toggle="modal" data-target="#myModal" id="ModificarDesc" idObservaciones=' . $item[0] . '  class="btn btn-info waves-effect"><i class="material-icons">edit</i><span>Verificar Observaciones</span></button>';
              }

              if($item[6]==1){
                    $verificado = '<label> Si </label>'; 
              }else {
                 $verificado = '<label> No </label>'; 
              }


            $botonImagenes = '<button type="button" data-toggle="modal" data-target="#myModalFotos" id="fotos" idImagen=' . $item[0] . '  class="btn btn-info waves-effect"><i class="material-icons">edit</i><span>Carga de Imagenes</span></button>';



          

           
            $sub_array = array();
            $sub_array[] =$no;
            $sub_array[] =$item[1];
            $sub_array[] =$item[2];
            $sub_array[] =$botonDesc;
            $sub_array[] =$botonImagenes;
            $sub_array[] =$botonChequeado;
            $sub_array[] =$item[4];
            $sub_array[] =$verificado;

           
            $data[] = $sub_array;
            $total++;
            $no++;
        }

        $output = array(
                "draw"           => intval($_POST["draw"]),
                "recordsTotal"   => $total,
                "recordsFiltered"=> $total,
                "data"           => $data
        );
        echo json_encode($output);
    }


    if ($_POST['Requerimiento'] == "ConsultarPorcentajes") {

        $dao = new Dao();

        $dao->Campo("id", "");
        $dao->Campo("nombre_tarea", "");
        $dao->Campo("id_estado", "");
        $dao->Campo("responsable_tarea", "");
        $dao->Campo("porcentaje", "");
        
        

        
        $dao->Tabla("tarea","");
         $dao->Where("usuario_registro",$_SESSION['id'],"");
       
        $respuesta =$dao->Consultar();
        //echo json_encode($dao->Consultar2());

        $data = array();
        $total=0;
        $no = 1;
        foreach ($respuesta as $row => $item){
              $verificado = '';
              $progreso = '';

              if($item[2]==3){
                    $verificado = '<span class="label bg-red">Pendiente</span>'; 
              }else if ($item[2]==4){
                    $verificado = '<span class="label bg-blue">En Proceso</span>'; 
              }else if ($item[2]==5){
                    $verificado = '<span class="label bg-green">Completado</span>'; 
              }


            if ($item[4] <= 40) {
                    $progreso = '<div class="progress"> <div class="progress-bar bg-red" role="progressbar" aria-valuenow="' . $item[4] . '" aria-valuemin="0" aria-valuemax="100" style="width: ' . $item[4] . '%"></div></div>';
                    } else if ($item[4] != 40 && $item[4] < 90) {
                        $progreso = '<div class="progress"> <div class="progress-bar bg-blue" role="progressbar" aria-valuenow="' . $item[4] . '" aria-valuemin="0" aria-valuemax="100" style="width: ' . $item[4] . '%"></div></div>';
                    } else if ($item[4] == 100) {
                    $progreso = '<div class="progress"> <div class="progress-bar bg-green" role="progressbar" aria-valuenow="' . $item[4] . '" aria-valuemin="0" aria-valuemax="100" style="width: ' . $item[4] . '%"></div></div>';
                    }


              


             
            
             
 
            $sub_array = array();
            $sub_array[] =$no;
            $sub_array[] =$item[1];
            $sub_array[] =$verificado;
            $sub_array[] =$item[3];
            $sub_array[] =$progreso;
          

           
            $data[] = $sub_array;
            $total++;
            $no++;
        }

        $output = array(
                "draw"           => intval($_POST["draw"]),
                "recordsTotal"   => $total,
                "recordsFiltered"=> $total,
                "data"           => $data
        );
        echo json_encode($output);
    }



        if ($_POST['Requerimiento'] == "ModificarTarea") {
        $datos = array("verificado"=> "1");
        $dao = new Dao();
        $dao->ModificarAjax("revi", $datos, "id = " . $_POST['Id'], $_POST['Id']);
     }

        if ($_POST['Requerimiento'] == "EliminarTarea") {
        $datos = array("verificado"=> "0");
        $dao = new Dao();
        $dao->ModificarAjax("revi", $datos, "id = " . $_POST['Id'], $_POST['Id']);
     }

     if ($_POST['Requerimiento'] == "ModificarObserva") {
        $datos = array("observaciones" => $_POST["Observaciones"]);
        $dao = new Dao();
        $dao->ModificarAjax("revi", $datos, "id = " . $_POST['Id'], $_POST['Id']);
     }


   
     
      if ($_POST['Requerimiento'] == "ConsultarRutasIdInv") {

        $dao = new Dao();

        $dao->Campo("ruta", "");
        $dao->Campo("id", "");
        $dao->Tabla("inventario_fotos","");
        $dao->Where("id_inventario", $_POST['IdInv'], "");

        $respuesta = $dao->ConsultarAjax();
    }



    }
