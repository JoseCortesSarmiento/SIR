<?php
include 'config.php';
include 'coneccion.php';
include 'header.php'
?>



<?php
            $sentencia = $pdo->prepare('SELECT * FROM proveedores');
            $sentencia->execute();
            $articulos = $sentencia->fetchAll(PDO::FETCH_ASSOC);
            //print_r($listaProductos);
?>

<table id="example" class="display" style="width:100%">
<thead>
            <tr>
                <th>Nombre</th>
                <th>Correo</th>
                <th>Teléfono</th>
                <th>Dirección</th>
            </tr>
        </thead>
<?php foreach ($articulos as $articulo): ?>
       
        <tbody>
            <tr>
            
            </tr>    
            <tr>
                <td> <?=$articulo['nombre']?></td>
                <td> <?=$articulo['correo']?></td>
                <td> <?=$articulo['telefono']?></td>
                <td> <?=$articulo['direccion']?></td>
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
    include "footer.php"
?>
</body>
</html>