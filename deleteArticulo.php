<?php 

include 'global/config.php';
include 'global/conexion.php';
include 'global/header.php';
include 'addArticulo.php';


     if (isset($_GET["id_articulo"])) {
        try {
      
          $id = $_GET["id_articulo"];
      
          $sql = "DELETE FROM articulos WHERE id_articulo = :id";
      
          $statement = $pdo->prepare($sql);
          $statement->bindValue(':id', $id);
          $statement->execute();
      
          echo '<script type="text/javascript">'; 
            echo 'setTimeout(function () { swal("¡ÉXITO!","Se ha borrado el articulo","success");'; 
            echo '}, 500);</script>'; 

           
        } 
        catch(PDOException $error) {
          echo $sql . "<br>" . $error->getMessage();
        }
      }
      
      

?>



	<br /><br />  
	<div class="container">  
		<h3 align="center">Artículos</h3>  
		<br />  
		<div class="table-responsive">  
			<table id="articulos" class="table table-striped table-bordered">  
				<thead>  
					<tr>  
						<th>Nombre</th>
						<th>Precio</th>
						<th>Unidad medida</th>
						<th>Stock minimo</th>
						<th>Stock almacenado</th>
						<th>Stock máximo</th>
						<th>Descripción</th>
						<th>Estatus</th>
                        <th>Proveedor</th>
                        <th>Acciones</th>
					</tr>  
				</thead>  
				<?php foreach ($articulos as $articulo): ?>
					
					<tr>
						<td> <?=$articulo['nombre']?></td>
						<td> <?=$articulo['precio']?></td>
						<td> <?=$articulo['unidad_medida']?></td>
						<td> <?=$articulo['stock_minimo']?></td>
						<td> <?=$articulo['stock_almacenado']?></td>
						<td> <?=$articulo['stock_maximo']?></td>
						<td> <?=$articulo['descripcion']?></td>
						<td> <?=$articulo['estatus']?></td> 
                        <td> <?=$articulo['proveedor']?></td>  
                        
                        <td>

                        <span style="font-size: 32px; color: darkturquoise;">
                            <a href="updateArticulo.php?id_articulo=<?=$articulo['id_articulo']?>"class="btn btn-default btn-rounded mb-4"  data-toggle="modal" data-target="#modalEditArticulo"> <i class="fas fa-edit"></i></a>
                        </span>

                        <span style="font-size: 32px; color: tomato;">
                            <a href="deleteArticulo.php?id_articulo=<?=$articulo['id_articulo']?>" class="btn btn-red btn-rounded mb-4" > <i class="fas fa-trash-alt"></i></a>
                        </span>  
                       
                        
                        </td>   
					</tr>

				<?php endforeach; ?>
			</table>  
		</div>  
	</div>  
</body>  
</html>  
<script>  
	$(document).ready(function(){  
		$('#articulos').DataTable();  
	}); 
</script>  