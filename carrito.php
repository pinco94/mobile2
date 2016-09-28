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
      <h1 class="title">Carrito</h1>
    </header>

    <!-- Wrap all non-bar HTML in the .content div (this is actually what scrolls) -->
    <div class="content">
    
        <?php 
        $cliente = new nusoap_client("http://pymesv.com/datos08new/soap_server.php");
        $resultado_producto = $cliente->call("get");
        ?>    
        
        <div class="row">
    			<div class="col-md-2">
                
    				<div>Producto:
        				<select name="cbo_producto" id="cbo_producto" class="col-md-2 form-control" >
        					<option value="0">Seleccione un producto</option>
        					<?php foreach($resultado_producto as $producto):?>
        						<option value="<?php echo $producto['id']?>"><?php echo $producto['nombre']?></option>
        					<?php endforeach;?>
        				</select>
    				</div>
    			</div> 
    			<div class="col-md-2">
    				<div>Cantidad:
    				  <input id="txt_cantidad" name="txt_cantidad" type="text" class="col-md-2 form-control" placeholder="Ingrese cantidad" autocomplete="off" />
    				</div>
    			</div>
    			<div class="col-md-2">
    				<div style="margin-top: 19px;">
    				<button type="button" class="btn btn-success btn-agregar-producto">Agregar</button>
    				</div>
    			</div>
       </div>
       
       <br />
            <div class="panel panel-info">
			 <div class="panel-heading">
		        <h3 class="panel-title">Productos</h3>
		      </div>
			<div class="panel-body detalle-producto">
				<?php if(count($_SESSION['detalle'])>0){?>
					<table class="table">
					    <thead>
					        <tr>
					            <th>Descripci&oacute;n</th>
					            <th>Cantidad</th>
					            <th>Precio</th>
					            <th>Subtotal</th>
					            <th></th>
					        </tr>
					    </thead>
					    <tbody>
					    	<?php
					    	foreach($_SESSION['detalle'] as $k => $detalle){
					    	?>
					        <tr>
					        	<td><?php echo $detalle['producto'];?></td>
					            <td><?php echo $detalle['cantidad'];?></td>
					            <td><?php echo $detalle['precio'];?></td>
					            <td><?php echo $detalle['subtotal'];?></td>
					            <td><button type="button" class="btn btn-sm btn-danger eliminar-producto" id="<?php echo $detalle['id'];?>">Eliminar</button></td>
					        </tr>
					        <?php }?>
					    </tbody>
					</table>
				<?php }else{?>
				<div class="panel-body"> No hay productos agregados</div>
				<?php }?>
			</div>
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