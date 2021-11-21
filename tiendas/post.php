<?php
include "config.php";
include "utils.php";

$dbConn =  connect($db);

//MOSTRAR CON POST
if ($_SERVER['REQUEST_METHOD'] == 'GET')
{
    if (isset($_GET['CORREOPROPIETARIO']) && isset($_GET['CONTRASENAPROPIETARIO']))
    {
      //Mostrar un post
      $sql = $dbConn->prepare("SELECT * FROM TBL_DATOSPROPIETARIO WHERE CORREOPROPIETARIO = :CORREOPROPIETARIO AND CONTRASENAPROPIETARIO = :CONTRASENAPROPIETARIO");
      $sql->bindValue(':CORREOPROPIETARIO', $_GET['CORREOPROPIETARIO']);
	  $sql->bindValue(':CONTRASENAPROPIETARIO', $_GET['CONTRASENAPROPIETARIO']);
      $sql->execute();
      header("HTTP/1.1 200 OK");
      echo json_encode(  $sql->fetch(PDO::FETCH_ASSOC)  );
      exit();
	  }
	  else if(isset($_GET['IDPROPIETARIO'])){
		$sql = $dbConn->prepare("select * from tbl_sucursales where IDPROPIETARIO = :IDPROPIETARIO");
      $sql->bindValue(':IDPROPIETARIO', $_GET['IDPROPIETARIO']);
	  $sql->setFetchMode(PDO::FETCH_ASSOC);
      $sql->execute();
      header("HTTP/1.1 200 OK");
      echo json_encode(  $sql->fetchAll()  );
      exit();
	  }
	  
	  else if(isset($_GET['IDSUCURSAL'])){
		$sql = $dbConn->prepare("select * from tbl_cliente where IDSUCURSAL = :IDSUCURSAL");
      $sql->bindValue(':IDSUCURSAL', $_GET['IDSUCURSAL']);
	  $sql->setFetchMode(PDO::FETCH_ASSOC);
      $sql->execute();
      header("HTTP/1.1 200 OK");
      echo json_encode(  $sql->fetchAll()  );
      exit();
	  }

	  else {
      //Mostrar lista de post
      $sql = $dbConn->prepare("SELECT * FROM TBL_DATOSPROPIETARIO");
      $sql->execute();
      $sql->setFetchMode(PDO::FETCH_ASSOC);
      header("HTTP/1.1 200 OK");
      echo json_encode( $sql->fetchAll()  );
      exit();
	}
}

//INSERTAR SE HACE CON POST
/*
if ($_SERVER['REQUEST_METHOD'] == 'POST')
{
    $input = $_POST;
    $sql = "INSERT INTO estudiante
          (codigo, nombre, apellido, edad)
          VALUES
          (:codigo, :nombre, :apellido, :edad)";
    $statement = $dbConn->prepare($sql);
    bindAllValues($statement, $input);
    $statement->execute();

    $postCodigo = $dbConn->lastInsertId();
    if($postCodigo)
    {
      $input['codigo'] = $postCodigo;
      header("HTTP/1.1 200 OK");
      echo json_encode($input);
      exit();
	 }
 }


if ($_SERVER['REQUEST_METHOD'] == 'DELETE')
{
	$codigo = $_GET['codigo'];
  $statement = $dbConn->prepare("DELETE FROM  estudiante where codigo=:codigo");
  $statement->bindValue(':codigo', $codigo);
  $statement->execute();
	header("HTTP/1.1 200 OK");
	exit();
}

//ACTUALIZAR CON PUT
if ($_SERVER['REQUEST_METHOD'] == 'PUT')
{
    $input = $_GET;
    $postCodigo = $input['codigo'];
    $fields = getParams($input);

    $sql = "
          UPDATE estudiante
          SET $fields
          WHERE codigo='$postCodigo'
           ";

    $statement = $dbConn->prepare($sql);
    bindAllValues($statement, $input);

    $statement->execute();
    header("HTTP/1.1 200 OK");
    exit();
}*/

?>