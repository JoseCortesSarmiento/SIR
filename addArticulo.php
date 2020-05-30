<?php 
// include 'articuloExistente.php';

	if ( !empty($_POST)) {
		
		// keep track post values		
		$nombre = $_POST['nombre'];
		$precio = $_POST['precio'];
		$unidad_medida = $_POST['unidad_medida'];
		$stock_minimo   = $_POST['stock_minimo'];
    $stock_almacenado   = $_POST['stock_almacenado'];
    $stock_maximo = $_POST['stock_maximo'];
    $descripcion = $_POST['descripcion'];
    $estatus = $_POST['estatus'];
    $id_proveedor   = $_POST['proveedor'];
		
      $sql = "INSERT INTO articulos ( nombre, unidad_medida, stock_minimo, stock_almacenado, stock_maximo,descripcion, estatus) values( ?, ?, ? ,?, ?, ?, ?)";	
      $stmt = $pdo->prepare($sql);

      $sql2 = "INSERT INTO articulos_proveedores (id_articulo, id_proveedor, precio) VALUES(?,?,?)";
      $stmt2 = $pdo->prepare($sql2);


      $stmt->execute([$nombre, $unidad_medida, $stock_minimo, $stock_almacenado,$stock_maximo, $descripcion, $estatus]);	
      $articuloId=$pdo->lastInsertId();
      echo $id_proveedor;
      $stmt2->execute([$articuloId, $id_proveedor, $precio]);
            echo '<script type="text/javascript">'; 
            echo 'setTimeout(function () { swal("¡ÉXITO!","Se ha agregado un nuevo articulo","success");'; 
            echo '}, 500);</script>'; 
	}
?>


<div class="modal fade" id="modalAddArticulo" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
  aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header text-center">
        <h4 class="modal-title w-100 font-weight-bold">Agregar artículo</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>


      <div class="modal-body mx-3">

       <form action="articulos.php" method="post">

      
       <div class="md-form mb-5">
          <input type="text"  class="form-control validate" name="nombre" >
          <label data-error="wrong" data-success="right" >Nombre</label>
        </div>

        <div class="md-form mb-5">
          <input type="text"  class="form-control validate" name="precio" >
          <label data-error="wrong" data-success="right" >Precio</label>
        </div>

        
        <div class="md-form mb-5">
            <select class="browser-default custom-select" name="unidad_medida">
                <option selected value="kilo">Kilo</option>
                <option value="litro">Litro</option>
            </select>
          </div>
        


        <div class="md-form mb-5">
          <input type="text"  class="form-control validate" name="stock_minimo" >
          <label data-error="wrong" data-success="right" >Stock minimo</label>
        </div>

        <div class="md-form mb-5">
          <input type="text"  class="form-control validate" name="stock_almacenado" >
          <label data-error="wrong" data-success="right">Stock almacenado</label>
        </div>

        <div class="md-form mb-5">
          <input type="text"  class="form-control validate" name="stock_maximo" >
          <label data-error="wrong" data-success="right" for="defaultForm-email">Stock maximo</label>
        </div>

        <div class="md-form mb-5">
          <input type="text" class="form-control validate" name="descripcion" >
          <label data-error="wrong" data-success="right" >Descripción</label>
        </div>


        <div class="md-form mb-5">
          <input type="text"  class="form-control validate" name="estatus" >
          <label data-error="wrong" data-success="right" >Estatus</label>
        </div> 

         <div class="md-form mb-5">
        <select class="browser-default custom-select" name="proveedor">
            <option selected>Elija un proveedor</option>
            <?php 
					   						 
					   						$query = 'SELECT * FROM proveedores'; 
	 				   						foreach ($pdo->query($query) as $row) { 
	 	
                        	   						echo "<option selected value='" . $row['id_proveedor'] . "'>" . $row['nombre'] . "</option>"; 
                        	   				
					   						} 
					   						 
					  ?> 
      </select>
      </div>
        
      </div>

      <div class="modal-footer d-flex justify-content-center">
        <button type="submit"  class="btn btn-default">Agregar</button>
      </div>

      </form>
    </div>
  </div>
</div>
</div>