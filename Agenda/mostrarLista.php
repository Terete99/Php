<?php
include "Libreria.php";
//var_dump($aAgenda);
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
        table {border: 1px solid black;
               margin-left:auto;
               margin-right:auto;
               padding: 0.2em;}
        table tr:nth-child(even) {background-color: #f2f2f2;}
        td, img {height:50px;}
    </style>
    <script>
        function marcarTodo() {
            var checkboxes = document.getElementsByName('aListaBorrado[]');
            //alert ('Se van a seleccionar todos los contactos. ¡Cuidadín!');
            user_confirm = confirm("¿Está seguro que desea eliminar todo?");
            if (user_confirm) {
                for (var checkbox of checkboxes) {
               checkbox.checked = true;
               //alert ('Procesando ...');
               }
            }
        }
</script>
</head>
<body>
    <div>
        <h2>LISTA DE CONTACTOS</h2>
        <form action="guardado.php">
            <div style="witdh:100%; border:none; text-align:center; padding:25px;">
            <table>
            <tr>
                <th>NOMBRE</th>
                <th>TELÉFONO</th>
                <th>AVATAR</th>
                <th>EDITAR</th>
                <th><input type="button"
                    class="btn btn-danger"
                    onClick="marcarTodo();"
                    value="Marcar todo"></th>
            </tr>
            <?php
            $bEditar = '<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-pencil-square" viewBox="0 0 16 16">
            <path d="M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z"/>
            <path fill-rule="evenodd" d="M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5v11z"/>
          </svg>';
            $bPapelera = '<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-trash3-fill" viewBox="0 0 16 16">
            <path d="M11 1.5v1h3.5a.5.5 0 0 1 0 1h-.538l-.853 10.66A2 2 0 0 1 11.115 16h-6.23a2 2 0 0 1-1.994-1.84L2.038 3.5H1.5a.5.5 0 0 1 0-1H5v-1A1.5 1.5 0 0 1 6.5 0h3A1.5 1.5 0 0 1 11 1.5Zm-5 0v1h4v-1a.5.5 0 0 0-.5-.5h-3a.5.5 0 0 0-.5.5ZM4.5 5.029l.5 8.5a.5.5 0 1 0 .998-.06l-.5-8.5a.5.5 0 1 0-.998.06Zm6.53-.528a.5.5 0 0 0-.528.47l-.5 8.5a.5.5 0 0 0 .998.058l.5-8.5a.5.5 0 0 0-.47-.528ZM8 4.5a.5.5 0 0 0-.5.5v8.5a.5.5 0 0 0 1 0V5a.5.5 0 0 0-.5-.5Z"/>
          </svg>';
            foreach ($aAgenda as $aContacto){
                echo "<tr>";
                echo "<td>".$aContacto[0]."</td>";
                echo "<td>".$aContacto[1]."</td>";
                echo "<td><img src='".$aContacto[2]."'></td>";
                echo "<td><a href='".$sURL."Agenda.php?nombre=".$aContacto[0]."&telefono=".$aContacto[1]."' title='Editar'>$bEditar</a></td>";
                echo "<td><label>$bPapelera
                        <input type='checkbox'
                                 name='aListaBorrado[]'
                                 value='".htmlspecialchars($aContacto[0])."'></label></td>";
                echo "</tr>";
            }
            ?>
            </table>
            <div style="witdh:100%; border:none; text-align:center; padding:25px;">
            <input type="button"
                    class="btn btn-primary"
                    name="annadir"
                    onClick="location.href='Agenda.php'"
                    value="AÑADIR">
            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
            <input type="submit" 
                    class="btn btn-secondary"
                    name="borrar"
                    value="BORRAR">
            </div>
        </form>
    </div>
</body>
</html>