<?php
session_start();

require_once "autoloadAjax.php";

if (isset($_POST['Requerimiento'])) {

  if ($_POST['Requerimiento'] == "IniciarSesion") {

      $dao = new Dao();

      $dao->Campo("id", "");
      $dao->Campo("usuario", "");
      $dao->Campo("psd", "");
      $dao->Campo("rol", "");

      $dao->Tabla("usuario", "");
      $dao->Where("usuario", "'" . $_POST["Usuario"] . "'", "");

      $respuesta   = $dao->Consultar();
      
      $jsondata    = array();
      $jsondata[0] = "UsuarioIncorrecto";
     

      foreach ($respuesta as $row => $item) {

          if (password_verify(1234, $item['psd']) && $_POST["Pass"] == 1234) {
              $jsondata[0] = "NuevoUsuario";
              $jsondata[1] = $item[0];
          } else {
              if (password_verify($_POST["Pass"], $item['psd']) && $_POST["Pass"] != 1234) {
                  $_SESSION["validar"] = true;
                  $_SESSION["usuario"] = $item["usuario"];
                  $_SESSION["rol"] = $item["rol"];
                  $_SESSION["id"] = $item["id"];
                  $_SESSION["id"] = $item[0];
                  $jsondata[0]="UsuarioNormal";
                  $jsondata[1] = $item[0];

                  //Se coloca este jsondata ID para obtenerlo en flutter
                  //$jsondata["id"] = $item["id"];
              } else {
                  $jsondata[0] = "PsdIncorrecta";
              }
          }
      }
      echo json_encode($jsondata);

  }


  if ($_POST['Requerimiento'] == "GuardarUsuario") {
 $dao = new Dao();
        //$passHash3 = password_hash($_POST["Pass"], PASSWORD_BCRYPT);
        // Verificar si el usuario ya está registrado
    if ($dao->UsuarioRegistrado($_POST["Usuario"])) {
        // El usuario ya está registrado, devolver un mensaje de error
        $jsondata = array("UsuarioYaRegistrado");
    } else {
         $passHash3 = password_hash($_POST["Pass"], PASSWORD_BCRYPT);
        $datos = array("usuario" => $_POST["Usuario"],
                        "psd" =>  $passHash3,
                        "rol"             => 1);

       
          $resultado = $dao->Guardar("usuario", $datos, false);
        if ($resultado[0]) {
            // Guardado exitoso
            $jsondata = array("GuardadoExitoso");
        } else {
            // Error al guardar
            $jsondata = array("ErrorAlGuardar");
        }
    }
    echo json_encode($jsondata);
   
    }

    if ($_POST['Requerimiento'] == "GuardarCalificacion") {

        $datos = array(
                       "descripcion" => $_POST["Descripcion"]);

        $dao = new Dao();
        $dao->GuardarAjax("calificaciones", $datos);
    }





/*if ($_POST['Requerimiento'] == "GuardarUsuario") {
    $dao = new Dao();

    // Verificar si el usuario ya está registrado
    if ($dao->UsuarioRegistrado($_POST["Usuario"])) {
        // El usuario ya está registrado, devolver un mensaje de error
        $jsondata = array("UsuarioYaRegistrado");
    } else {
        // El usuario no está registrado, proceder con guardar el nuevo usuario
        $passHash3 = password_hash($_POST["Pass"], PASSWORD_BCRYPT);

        $datos = array("nombre" => $_POST["Usuario"],
                         "psd" => $passHash3);

        $resultado = $dao->Guardar("usuario", $datos, false);

        if ($resultado[0]) {
            // Guardado exitoso
            $jsondata = array("GuardadoExitoso");
        } else {
            // Error al guardar
            $jsondata = array("ErrorAlGuardar");
        }
    }

    echo json_encode($jsondata);
}*/

    if ($_POST['Requerimiento'] == "CerrarSesion") {

        if (isset($_SESSION['usuario'])) {
            if ($_SESSION['usuario'] == $_POST['Usuario']) {

            }

        }
        $jsondata    = array();
        $jsondata[0] = true;
        echo json_encode($jsondata);

    }

    if ($_POST['Requerimiento'] == "ModificaContra") {

        $passHash1 = password_hash($_POST["Segundo"], PASSWORD_BCRYPT);

        $datos = array("psd" => $passHash1);

        $dao = new Dao();
        $dao->ModificarAjax("usuario", $datos, "id=" . $_POST['Id'], $_POST['Id']);
    }

    if ($_POST['Requerimiento'] == "Resetear") {

        $passHash2 = password_hash(1234, PASSWORD_BCRYPT);

        $datos = array("psd" => $passHash2);

        $dao = new Dao();
        $dao->ModificarAjax("cliente", $datos, "id=" . $_POST['Id'], $_POST['Id']);
    }
    if($_POST['Requerimiento'] == "ActualizarImagen"){

        $ruta = "../imagenes/PERFIL/USER".$_POST['Cedula'].'.jpg';
    
            $base=$_POST['Imagen']; 
            $binary=base64_decode($base);
            header('Content-Type: bitmap; charset=utf-8');
            $file = fopen($ruta, 'wb');
            fwrite($file, $binary);
            fclose($file);
        
        $datos = array("logo"=>substr($ruta,3));


        $dao= new Dao();
        $dao->Modificar("cliente",$datos,"cedula=".$_POST['Cedula'],0);
        $jsondata = array();
        $jsondata[0]=true;
        $jsondata[1]=substr($ruta,3);
        echo json_encode($jsondata, JSON_FORCE_OBJECT);
    }
    if($_POST['Requerimiento'] == "ActualizarImagenAdmin"){

        $ruta = "../imagenes/PERFIL/USER_".$_POST['Usuario'].'.jpg';
    
        $base=$_POST['Imagen']; 
        $binary=base64_decode($base);
        header('Content-Type: bitmap; charset=utf-8');
        $file = fopen($ruta, 'wb');
        fwrite($file, $binary);
        fclose($file);
        
        $datos = array("foto"=>substr($ruta,3));


        $dao= new Dao();
        $dao->Modificar("usuario",$datos,"usuario= '".$_POST['Usuario']."'",0);
        $jsondata = array();
        $jsondata[0]=true;
        $jsondata[1]=substr($ruta,3);
        echo json_encode($jsondata, JSON_FORCE_OBJECT);
    }

    if ($_POST['Requerimiento'] == "ModificarUsuarioDatos") {

        $datos = array("nombres"  => $_POST["Nombre"]);

        $dao = new Dao();
        $dao->ModificarAjax("usuario", $datos, "usuario='" . $_POST["Usuario"]."'",0);
    }

    if ($_POST['Requerimiento'] == "CargarDatosUsuario") {

        $dao = new Dao();

        $dao->Campo("nombres", "");
        $dao->Campo("foto", "");

        $dao->Tabla("usuario", "");
        $dao->Where("usuario", "'" . $_POST["Usuario"] . "'", "");

        $dao->ConsultarAjax();

    }
}
