<?php
$bModificar = false;
if (isset($_GET['nombre'])&&($_GET['nombre']!="")){
    $sNombre=$_GET['nombre'];
    $bModificar = true;
    }else{ $sNombre="";}
if (isset($_GET['telefono'])&&($_GET['telefono']!="")){
    $sTelefono=$_GET['telefono'];
    }else{ $sTelefono="";}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Agenda de contactos</title>
    <link   href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" 
            rel="stylesheet" 
            integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" 
            crossorigin="anonymous">
    <style>
        div {width:100%; text-align:center; border:1px solid black;}
        table {margin-left:auto;
               margin-right:auto;}
    </style>
</head>
<body>
    <div>
        <h2>AGENDA DE CONTACTOS</h2>
        <form action="guardado.php" method="POST" enctype="multipart/form-data">
            <table>
                <tr>
                    <td style="text-align:right;">
                        <label for="nombre">NOMBRE:</label>
                    </td>
                    <td style="text-align:left;">
                        <input  id="nombre"
                                type="text" 
                                name="nombre"
                                value="<?= $sNombre; ?>"
                                placeholder="Nombre y Apellido"
                                onkeyup="this.value = this.value.toUpperCase();"
                                required>
                    </td>
                </tr>
                <tr>
                    <td style="text-align:right;">
                        <label for="nombre">TELEFONO:</label>
                    </td>
                    <td style="text-align:left;">
                        <input type="number" 
                                name="telefono"
                                value="<?= $sTelefono; ?>"
                                placeholder="telefono"
                                required>
                    </td>
                    </tr>
                    <tr>
                    <td style="text-align:right;">
                        <label for="nombre">IMAGEN A SUBIR:</label>
                    </td>
                    
                    <td style="text-align:left;">
                    <input type="file" name="fileToUpload" id="fileToUpload">
                    </td>               
                </tr>
            </table>  
            <div style="witdh:100%; border:none; text-align:center; padding:25px;">
                <input type="submit"
                        class="btn btn-primary" 
                        name="<?php echo $bModificar?'modificar':'guardar' ?>"
                        value="<?php echo $bModificar?'MODIFICAR':'GUARDAR' ?>">
                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                <?php
                if ($bModificar) {
                    echo '
                    <input type="button"
                            class="btn btn-secondary" 
                            name="mostar_lista"
                            onClick="location.href=\'mostrarLista.php\'"
                            value="MOSTRAR LISTA">     ';           
                    } else  {
                        echo '
                        <input type="button"
                                class="btn btn-secondary"
                                name="buscar"
                                value="BUSCAR">';
                    } 
                ?>         
            </div>
        </form>
    </div>
</body>
</html>
