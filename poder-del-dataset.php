<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>dataset con JavaScript</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
</head>
<body>

    <div class="container">
        <h1 class="text-center mt-5 mb-5" style="font-weight:800; font-size:40px;">
            El PODER 💪 de dataset JAVASCRIPT
        </h1>

        <div class="row mt-5">
            <div class="col-md-12 text-center">

                <?php
                /**conexion a BD */
                $usuario  = "root";
                $password = "";
                $servidor = "localhost";
                $basededatos = "ejemplo_youtube";
                $con = mysqli_connect($servidor, $usuario, $password) or die("No se ha podido conectar al Servidor");
                mysqli_query($con, "SET SESSION collation_connection ='utf8_unicode_ci'");
                $db = mysqli_select_db($con, $basededatos) or die("Upps! Error en conectar a la Base de Datos");

                $sqlTrabajadores = ('SELECT * FROM trabajadores ORDER BY fecha_ingreso ASC');
                $query      = mysqli_query($con, $sqlTrabajadores);
                $total      = mysqli_num_rows($query);
                ?>

                <strong style="float: right; color:crimson;">
                    <?php echo ($total > 0) ? 'Total (' . $total . ')' : 'Total (0)'; ?>
                </strong>
                <div class="table-responsive resultadoFiltro">
                    <table class="table table-hover" id="tableEmpleados">
                        <thead>
                            <tr>
                                <th scope="col">NOMBRE Y APELLIDO</th>
                                <th scope="col">EMAIL</th>
                                <th scope="col">TELEFONO</th>
                                <th scope="col">SUELDO</th>
                                <th scope="col">ACCIÓN</th>
                            </tr>
                        </thead>
                        <tbody>
                        <?php
                        while ($dataRow = mysqli_fetch_array($query)) { ?>
                                <tr id="registro<?php echo $dataRow['id']; ?>"> 
                                    <td><?php echo $dataRow['nombre'] . ' ' . $dataRow['apellido']; ?></td>
                                    <td><?php echo $dataRow['email']; ?></td>
                                    <td><?php echo $dataRow['telefono']; ?></td>
                                    <td><?php echo '$ ' . number_format($dataRow['sueldo'], 0, '', '.'); ?></td>
                                    <td>
                                    <button onclick = "modificar(<?php echo $dataRow['id']; ?>)"> 
                                        Click here
                                    </button> 

                                    <p class="btn-delete" id="registro_<?php echo $dataRow['id']; ?>">
                                        <a href="#" class="btn btn-danger btn-sm" id="<?php echo $dataRow['id']; ?>" title="Borrar Registro <?php echo $dataRow['nombre']; ?>">
                                            Borrar
                                        </a>
                                    </p>
                                    
                                        <button data-id="<?php echo $dataRow['id']; ?>" type="button" class="modificar btn btn-info mb-1">Modificar</button>
                                        <button data-user='<?php echo $dataRow['nombre']; ?>' data-id='<?php echo $dataRow['id']; ?>' type="button" class="btn btn-danger mb-1 eliminar">Eliminar</button>
                                    </td>
                                </tr>
                        <?php } ?>
                        </tbody>
                    </table>
                </div>

            </div>
        </div>
    </div>

    <script>
        let idDelete = document.querySelector('.modificar');
        idDelete.addEventListener('click', function (item){
            console.log(item);
        });
        
        let btnBorrar = document.querySelector('.btn-delete');
            btnBorrar.addEventListener('click', ()=>{
                console.log(btnBorrar);
        })

         function modificar(id) {
            alert(id)
                //document.querySelector("row1").remove();
            }
    </script>
</body>
</html>