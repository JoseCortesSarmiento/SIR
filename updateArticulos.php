
<?php
include 'global/config.php';
include 'templates/head.php';
include 'global/conexion.php';
include 'global/sesion.php';


if (!empty($_GET['id_articulo'])) { 
    $id_articulo = $_REQUEST['id_articulo']; 
    //  echo $id_proveedor;
} 
 
if (!empty($_POST)) { 
   
    $nombre = $_POST['nombre']; 
    $precio= $_POST['precio']; 
    $unidad_medida= $_POST['unidad_medida']; 
    $stock_minimo = $_POST['stock_minimo']; 
    $stock_almacenado = $_POST['stock_almacenado']; 
    $stock_maximo = $_POST['stock_maximo']; 
    $descripcion = $_POST['descripcion']; 
    $estatus = $_POST['estatus']; 
    $id_articulo = $_POST['id_articulo']; 
    
        
        try{ 
            $pdo->beginTransaction(); 
            $sql2 = "UPDATE articulos set nombre = :nombre, precio=:precio, unidad_medida=:unidad_medida, stock_minimo=:stock_minimo, stock_maximo=:stock_maximo,stock_almacenado=:stock_almacenado, descripcion=:descripcion, estatus=:estatus WHERE id_articulo = :id_articulo"; 
            $stmt = $pdo->prepare($sql2); 
            $stmt->execute(['nombre'=>$nombre, 'precio'=>$precio, 'unidad_medida'=>$unidad_medida,'stock_minimo'=>$stock_minimo, 'stock_maximo'=>$stock_maximo, 'stock_almacenado'=>$stock_almacenado, 'descripcion'=>$descripcion, 'estatus'=>$estatus, 'id_articulo'=>$id_articulo ]); 
            // $stmt->debugDumpParams(); 
            echo '<script type="text/javascript">'; 
            echo 'setTimeout(function () { swal("¡ÉXITO!","Se ha actualizado el producto","success");'; 
            echo '}, 500);</script>'; 
            $pdo->commit(); 
        } 
        catch(Exception $e){ 
            $pdo->rollback(); 
            // $stmt->debugDumpParams(); 
            echo '<script type="text/javascript">'; 
            echo 'setTimeout(function () { swal("¡ERROR!","El producto no pudo ser actualizado","error");'; 
            echo '}, 500);</script>'; 
            throw $e;  
        } 
        // it takes me to the stock page, once I updated a product 
         header('location: articulos.php');
    
}  
 
else { 
     
    $sql = "SELECT * FROM articulos where id_articulo = ?"; 
    $q = $pdo->prepare($sql); 
    $q->execute(array($id_articulo)); 
    $data = $q->fetch(PDO::FETCH_ASSOC); 
    $id_articulo=$data['id_articulo'];
    $nombre = $data['nombre']; 
    $precio = $data['precio'];
    $unidad_medida = $data['unidad_medida'];
    $stock_minimo   = $data['stock_minimo'];
    $stock_almacenado   = $data['stock_almacenado'];
    $stock_maximo = $data['stock_maximo'];
    $descripcion = $data['descripcion'];
    $estatus = $data['estatus'];

 
} 
?> 
 

        

 <div class="card" style="width: 50rem;">
        <div class="card-body">
            <div class="md-form mb-5">

            <div class="text-center">
                <h4 class=" w-100 font-weight-bold">Editar articulo</h4>
            </div>

                <form action="updateArticulos.php" method="post">
                <div class="md-form mb-5">
          <input type="text"  class="form-control validate" name="nombre" value="<?php echo !empty($nombre)?$nombre:''; ?>" >
          <label data-error="wrong" data-success="right" >Nombre</label>
        </div>

        <div class="md-form mb-5">
          <input type="text"  class="form-control validate" name="precio" value="<?php echo !empty($precio)?$precio:''; ?>" >
          <label data-error="wrong" data-success="right" >Precio</label>
        </div>

        <div class="md-form mb-5">
          <input type="text"  class="form-control validate" name="unidad_medida" value="<?php echo !empty($unidad_medida)?$unidad_medida:''; ?>">
          <label data-error="wrong" data-success="right" >Unidad medida</label>
        </div>


        <div class="md-form mb-5">
          <input type="text"  class="form-control validate" name="stock_minimo" value="<?php echo !empty($stock_minimo)?$stock_minimo:''; ?>">
          <label data-error="wrong" data-success="right" >Stock minimo</label>
        </div>

        <div class="md-form mb-5">
          <input type="text"  class="form-control validate" name="stock_almacenado" value="<?php echo !empty($stock_almacenado)?$stock_almacenado:''; ?>">
          <label data-error="wrong" data-success="right">Stock almacenado</label>
        </div>

        <div class="md-form mb-5">
          <input type="text"  class="form-control validate" name="stock_maximo" value="<?php echo !empty($stock_maximo)?$stock_maximo:''; ?>" >
          <label data-error="wrong" data-success="right" for="defaultForm-email">Stock maximo</label>
        </div>

        <div class="md-form mb-5">
          <input type="text" class="form-control validate" name="descripcion" value="<?php echo !empty($descripcion)?$descripcion:''; ?>" >
          <label data-error="wrong" data-success="right" >Descripción</label>
        </div>


        <div class="md-form mb-5">
          <input type="text"  class="form-control validate" name="estatus" value="<?php echo !empty($estatus)?$estatus:''; ?>">
          <label data-error="wrong" data-success="right" >Estatus</label>
        </div> 

        
                <input type="hidden"  class="form-control validate" name="id_articulo" value="<?php echo !empty($id_articulo)?$id_articulo:''; ?>" >
               
    </div>

                
                <div class=" d-flex justify-content-center">
                    <button type="submit" class="btn btn-default">Editar</button>
                </div>
                </form>
            </div>
        </div>
 </div>

     
    




