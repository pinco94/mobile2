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
      <h1 class="title">Productos disponibles</h1>
    </header>

    <!-- Wrap all non-bar HTML in the .content div (this is actually what scrolls) -->
    <div class="content">
    
        <?php 
        $cliente = new nusoap_client("http://pymesv.com/datos08new/soap_server.php");
        $resultado_producto = $cliente->call("get");
        ?>    
        
        
        <div class="row text-center">
           <?php foreach($resultado_producto as $producto):?>
               <div class="col-sm-2">
                   <div class="thumbnail">
                     <img src="./productos/<?php echo $producto['imagen']?>" alt="<?php echo $producto['nombre']?>">
                     <p><strong><?php echo $producto['nombre']?></strong></p>
                     <p><?php echo $producto['descripcion']?></p>
                   </div>
               </div>
           <?php endforeach;?>
        </div>
    
        <nav class="bar bar-tab">
          <a class="tab-item active" href="index.php">
            <span class="icon icon-home"></span>
            <span class="tab-label">Home</span>
          </a>
          <a class="tab-item" href="agregar.php">
            <span class="icon icon-plus"></span>
            <span class="tab-label">Agregar producto</span>
          </a>
          <a class="tab-item" href="carrito.php">
            <span class="icon icon-compose"></span>
            <span class="tab-label">Comprar</span>
          </a>
          
        </nav>
    </div>

  </body>
</html>