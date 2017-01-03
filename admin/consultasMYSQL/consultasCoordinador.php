<?php
/* Solicita la clase que maneja todas las operaciones generales de la base de
 * datos. */
require_once( dirname(__FILE__) . '/class-servcomapp-crud-bdd.php' );

function insertar_Coordinador() {

  if(strtoupper($_SERVER['REQUEST_METHOD']) === 'POST' && !empty($_POST)) {

    $bdd = new servcomapp_crud_bdd();
    $nombre = $bdd -> citar_escapar($_POST['us_nom']);
    $apellido = $bdd -> citar_escapar($_POST['us_ape']);
    $correo = $bdd -> citar_escapar($_POST['us_corr']);
    $cedula = $bdd -> citar_escapar($_POST['us_ced']);
    $telefono = $bdd -> citar_escapar($_POST['us_tel']);
    $clave = $bdd -> citar_escapar($_POST['us_cla']);
    $facultad = $bdd -> citar_escapar($_POST['us_fac']);
    $oficina = $bdd -> citar_escapar($_POST['us_ofic']);

    $resultado = $bdd -> consultar("INSERT INTO" . " sc_usuarios ( us_apodo , us_clave ," .
      " us_tipo , us_nombre , us_fechaCreacion ) VALUES ( " . $nombre . " , " .
      $clave . " , 'coord' , " . $nombre . " , " . date("Y-m-d") . " )");
    $bdd -> cerrar_conexion();
  }
}

insertar_Coordinador();
