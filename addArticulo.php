<?php 

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
    $proveedor   = $_POST['proveedor'];
		
			$sql = "INSERT INTO proveedores ( nombre, precio, unidad_medida, stock_minimo, stock_almacenado, stock_maximo,descripcion, estatus, proveedor) values(?, ?, ?, ? ,?, ?, ?, ?,?)";			
			$stmt = $pdo->prepare($sql);
            $stmt->execute([$nombre, $precio, $unidad_medida, $stock_minimo, $stock_almacenado,$stock_maximo, $descripcion, $estatus, $proveedor]);	
            
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
          <input type="text" id="defaultForm-email" class="form-control validate" name="nombre" >
          <label data-error="wrong" data-success="right" >Nombre</label>
        </div>

        <div class="md-form mb-5">
          <input type="text" id="defaultForm-email" class="form-control validate" name="precio" >
          <label data-error="wrong" data-success="right" >Precio</label>
        </div>

        <div class="md-form mb-5">
          <input type="text" id="defaultForm-email" class="form-control validate" name="unidad_medida" >
          <label data-error="wrong" data-success="right" >Unidad medida</label>
        </div>


        <div class="md-form mb-5">
          <input type="text" id="defaultForm-email" class="form-control validate" name="stock_minimo" >
          <label data-error="wrong" data-success="right" >Stock minimo</label>
        </div>

        <div class="md-form mb-5">
          <input type="text" id="defaultForm-email" class="form-control validate" name="stock_almacenado" >
          <label data-error="wrong" data-success="right">Stock almacenado</label>
        </div>

        <div class="md-form mb-5">
          <input type="text" id="defaultForm-email" class="form-control validate" name="stock_maximo" >
          <label data-error="wrong" data-success="right" for="defaultForm-email">Stock maximo</label>
        </div>

        <div class="md-form mb-5">
          <input type="text" id="defaultForm-email" class="form-control validate" name="descripcion" >
          <label data-error="wrong" data-success="right" >Descripción</label>
        </div>


        <div class="md-form mb-5">
          <input type="text" id="defaultForm-email" class="form-control validate" name="estatus" >
          <label data-error="wrong" data-success="right" >Estatus</label>
        </div>

        <div class="md-form mb-5">
        <select class="mdb-select colorful-select dropdown-primary">
                <option value="1">Option 1</option>
                <option value="2">Option 2</option>
                <option value="3">Option 3</option>
                <option value="4">Option 4</option>
                <option value="5">Option 5</option>
            </select>
            <label>Blue select</label>
          <label data-error="wrong" data-success="right" >Estatus</label>
        </div>
       
      </div>
      <div class="modal-footer d-flex justify-content-center">
        <button type="submit"  class="btn btn-default">Agregar</button>
      </div>

      </form>
    </div>
  </div>
</div>