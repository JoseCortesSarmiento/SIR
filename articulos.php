<?php
include 'global/config.php';
include 'global/conexion.php';
include 'global/header.php'
?>




<?php
            $sentencia = $pdo->prepare('SELECT * FROM articulos');
            $sentencia->execute();
            $articulos = $sentencia->fetchAll(PDO::FETCH_ASSOC);
            //print_r($listaProductos);
?>

<table id="example" class="display" style="width:100%">
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
            </tr>
        </thead>
<?php foreach ($articulos as $articulo): ?>
       
        <tbody>
            <tr>
            
            </tr>    
            <tr>
                <td> <?=$articulo['nombre']?></td>
                <td> <?=$articulo['precio']?></td>
                <td> <?=$articulo['unidad_medida']?></td>
                <td> <?=$articulo['stock_minimo']?></td>
                <td> <?=$articulo['stock_almacenado']?></td>
                <td> <?=$articulo['stock_maximo']?></td>
                <td> <?=$articulo['descripcion']?></td>
                <td> <?=$articulo['estatus']?></td>
                
            </tr>
        </tbody>
<?php endforeach; ?>
        <!-- <tfoot>
            <tr>
                <th>Name</th>
                <th>Position</th>
                <th>Office</th>
                <th>Age</th>
                <th>Start date</th>
                <th>Salary</th>
            </tr>
        </tfoot> -->
    </table>
<?php 
    include "global/footer.php"
?>
</body>
</html>