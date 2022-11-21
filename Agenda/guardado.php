<?php
include "Libreria.php";
if (isset($_POST['nombre'])&&($_POST['nombre']!="")){
    $sNombre=$_POST['nombre'];
    }else{ $sNombre="El nombre es obligatorio.";}
if (isset($_POST['telefono'])&&($_POST['telefono']!="")){
    $sTelefono=$_POST['telefono'];
    }else{ $sTelefono="El número de teléfono es obligatorio.";}
if (isset($_POST['modificar'])) {
    $bModificar = true;
}else{
    $bModificar = false;
};
if (isset($_FILES['fileToUpload'])){
    //echo "se va a subir el fichero<br>";
    $sRutaImagen = subirFichero(); 
    //echo "Fin subir el fichero<br>";
} else {$sRutaImagen = '';}
if (isset($_GET['aListaBorrado'])){
    $bBorrar = true;
    $sMensaje ="";
    $aListaBorrado = $_GET['aListaBorrado'];
    foreach($aListaBorrado as $sCandidatoBorrado) {
        echo "Se va a borrar $sCandidatoBorrado<br>";
        foreach ($aAgenda as $iAgenda => $aContacto){
            if (in_array($sCandidatoBorrado,$aContacto)) {
                unset($aAgenda[$iAgenda]);
                echo "Borrando<br>";
                $sMensaje .= 'Se ha borrado a :'.$aContacto[0].'<br>';
                break;
            }
        }
    }
    $sH2 = '¡Borrado de los registros!';
        //Reescribir fichero (en esta funcion esta llamando a la libreria)
    reescribirFichero($hFichero, $aAgenda);
} else {
    $bBorrar = false;
}
if (!$bModificar && !$bBorrar) {
    $bInsertar=true;
    foreach ($aAgenda as $aContacto){
        if (in_array($sNombre,$aContacto)) {
            $bInsertar  = false;
            $sH2        = "¡El contacto ya existe!";
            $iTelefonoActual=$aContacto[array_search($sNombre,$aContacto)+1];
            $sEditar  = "<a 
            href='".$sURL."Agenda.php?nombre=".$sNombre."&telefono=".$sTelefono."'>
                        Editar</a>";
            break;
        } else {
            $sH2 = "¡Contacto guardado exitosamente!";
        }
    }
    if ($bInsertar) {
        //insertarás si no existe
        $hFichero = fopen("C:\\Agenda.csv","a");
        fwrite($hFichero, $sNombre.",".$sTelefono.",".$sRutaImagen.",\n");
    }
    $sMensaje   = !$bInsertar?"El telefono actual es:$iTelefonoActual. Pulse en el siguiente enlace para ":'';
    $sMensaje  .= !$bInsertar?$sEditar:'';
} else if (!$bBorrar) {
    foreach ($aAgenda as $iAgenda => $aContacto){
        if (in_array($sNombre,$aContacto)) {
            $aContacto[1]       =$sTelefono;
            $aAgenda[$iAgenda]  = $aContacto;
            break;
        }
    }
    //reescribir el fichero
    reescribirFichero($hFichero, $aAgenda);
    $sH2 = "¡Contacto modificado exitosamente!";
    $sMensaje = "";
}

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
        <h2><?= $sH2; ?></h2>
        <p><?php if (!$bBorrar) {echo $sNombre." ".$sTelefono." ";};
                echo $sMensaje;
                echo "<img src='$sRutaImagen'>";?></p>
       <div style="witdh:100%; border:none; text-align:center; padding:25px;">
                <input type="button" 
                        name="annadir"
                        class="btn btn-primary"
                        onClick="location.href='Agenda.php'"
                        value="AÑADIR">
                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                <input type="button" 
                        class="btn btn-secondary
                        name="mostar_lista"
                        onClick="location.href='mostrarLista.php'"
                        value="MOSTRAR LISTA">
            </div>
        </form>
    </div>
</body>
</html>