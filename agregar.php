<?php
session_start();
$_SESSION['detalle'] = array();

require_once "lib/nusoap.php";

?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>Ratchet template page</title>

    <!-- Sets initial viewport load and disables zooming  -->
    <meta name="viewport" content="initial-scale=1, maximum-scale=1">

    <!-- Makes your prototype chrome-less once bookmarked to your phone's home screen -->
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="apple-mobile-web-app-status-bar-style" content="black">

    <!-- Include the compiled Ratchet CSS -->
    <link href="ratchet/dist/css/ratchet.css" rel="stylesheet">

    <!-- Include the compiled Ratchet JS -->
    <script src="ratchet/dist/js/ratchet.js"></script>
    
    <link rel="stylesheet" href="libs/js/alertify/themes/alertify.core.css" />
    <link rel="stylesheet" href="libs/js/alertify/themes/alertify.bootstrap.css" id="toggleCSS" />
    <link href="libs/css/bootstrap.css" rel="stylesheet">
    <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    
    <script src="libs/js/jquery.js"></script>
    <script src="libs/js/jquery-1.8.3.min.js"></script>
    <script src="libs/js/bootstrap.min.js"></script>
    <script type="text/javascript" src="libs/ajax.js"></script>	     
    <script src="libs/js/alertify/lib/alertify.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <script src="http://code.jquery.com/jquery-1.11.1.min.js"></script>
    <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
  </head>
  <body>

    <!-- Make sure all your bars are the first things in your <body> -->
    <header class="bar bar-nav">
    
      <h1 class="title">Agregar productos</h1>
    </header>

    <!-- Wrap all non-bar HTML in the .content div (this is actually what scrolls) -->
    <div class="content">
    
    <?php
    $cliente = new nusoap_client("http://pymesv.com/datos08new/soap_server_insert.php");
    ?>
        <nav class="bar bar-tab">
          <a class="tab-item" href="index.php">
            <span class="icon icon-home"></span>
            <span class="tab-label">Home</span>
          </a>
          <a class="tab-item active" href="agregar.php">
            <span class="icon icon-plus"></span>
            <span class="tab-label">Agregar producto</span>
          </a>
          <a class="tab-item" href="carrito.php">
            <span class="icon icon-compose"></span>
            <span class="tab-label">Comprar</span>
          </a>
          
        </nav>
        
        <form name="frm1" action="?" method="post" enctype="multipart/form-data">
                <div class="col-xs-12">
                  <div class="form-group">
                    <label for="nombre">Nombre de producto</label>
                    <input type="text" name="txtnombre" class="form-control" id="nombre" aria-describedby="name" placeholder="Ingrese el nombre del producto">
                    <!--small id="name" class="form-text text-muted">Elija un nombre descriptivo para el producto nuevo.</small-->
                  </div>  
                 
                  
                    <div class="form-group">
                    <label for="descripcion">Descripcion del producto</label>
                    <input type="text" name="txtdescripcion" class="form-control" id="descripcion" placeholder="Ingrese la descripcion del producto">
                    <!--small id="descripcion" class="form-text text-muted">Ingrese las características del producto aquí separelas por ",".</small-->
                  
                  </div>
                  
                  <div class="form-group">
                    <label for="imagen">Seleccionar archivo</label>
                    <input type="file" name="txtimagen" class="form-control-file" id="exampleInputFile" aria-describedby="fileHelp">
                    <!--small id="fileHelp" class="form-text text-muted">Seleccione una imagen para mostrar su producto...</small-->    
                    </div>
                    
                    
                    <div class="form-group">
                    <label for="descripcion">Precio del producto</label>
                    <input type="double" name="txtprecio" class="form-control" id="descripcion" placeholder="Precio del producto">
                    <!--small id="descripcion" class="form-text text-muted">Ingrese el precio del producto</small--> 
                  </div>
                  
                  <div class="form-group">
                    <label for="cantidad">Cantidad del producto</label>
                    <input type="double" name="txtcantidad" class="form-control" id="cantidad" placeholder="Cantidad producto">
                    <!--small id="descripcion" class="form-text text-muted">Ingrese la cantidad inicial del producto en unidades</small--> 
                  </div>
                  <input type="submit" name="btnagregar" value="Agregar producto" Class="btn btn-positive btn-block"/>
                   
              </div>
            </form>
    </div>
<?php

if (isset($_POST['btnagregar']))
{
    
    
//$resultado = $cliente->call('ingresar_producto');    
    
    $producto = array();
    $producto[1] =  array('nombre' => $_POST['txtnombre'], 'descripcion' => $_POST['txtdescripcion'], 'archivo'   => $_FILES["txtimagen"]["name"], 'precio'   => $_POST['txtprecio'], 'cantidad'   => $_POST['txtcantidad']);   
     
     
    $datos_producto_entrada = array( "datos_producto_entrada" => $producto);
 
    //$cliente = new nusoap_client("http://pymesv.com/datos08new/soap_server_insert.php");
    try {
    $resultado = $cliente->call('ingresar_producto',$datos_producto_entrada);
    
    $foto = $_FILES["txtimagen"]["tmp_name"];
    $destino = "productos/".$_FILES["txtimagen"]["name"];
    move_uploaded_file($foto,$destino);
    //echo $resultado;
    //$dbhandle = mysqli_connect("basews08.db.8917278.hostedresource.com","basews08","XZ7rADss89@gvc5","basews08");
    //mysqli_query($dbhandle,"INSERT INTO productos(nombre,descripcion,imagen,precio,cantidad) VALUES('".$value['nombre']."','".$value['descripcion']."','".$value['archivo']."',".$value['precio'].",".$value['cantidad'].")");
    echo '<div class="panel panel-success">
          <div class="panel-heading">Registro completado con exito</div>         
          </div>';
  }
  catch (Exception $e) {
    echo $e;

    echo '<div class="panel panel-danger">
          <div class="panel-heading">Ha ocurrido un error</div>
          </div>';
  }
}
?>
  </body>
</html>