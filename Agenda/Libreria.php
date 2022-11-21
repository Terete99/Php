<?php
$sURL = "http://localhost/Poo/Agenda/";
$sRutaFichero = "C:\\Agenda.csv";
//libreria de funciones//
//convertir csv a array
// AL principio cuando cargamos la libreria necesitamos llamar a un archivo existente (o crearlo en su defecto)
// $hFichero = fopen("C:\\xampp\\htdocs\\Agenda.csv","a");
$hFichero = fopen($sRutaFichero,"r");
$aAgenda = array();
while (!feof($hFichero)){//Comprueba si el puntero a un archivo está al final 
    $linea  = fgets($hFichero);//Obtiene una línea desde el puntero a un fichero
    if ($linea!="") {
            $aLinea = explode(',',$linea);//Divide un string en varios string
            //print_r($aLinea);
            if (isset ($aLinea[2]) && $aLinea[2]!="") {
                //echo "URL =>".$aLinea[2];
                $sRutaImagen = $aLinea[2];
            } else {$sRutaImagen='';}
            //echo "<br>";
            $aContacto = [$aLinea[0],$aLinea[1],$sRutaImagen];//Creamos el array con los datos
            array_push($aAgenda,$aContacto);//creamos el array de los contactos
            //echo "Nombre:".$aLinea[0]." Teléfono:".$aLinea[1]."<br>";
        }
}
sort($aAgenda);
    fclose($hFichero);
function reescribirFichero($sRutaFichero, $aAgenda) {
    $hFichero = fopen("C:\\Agenda.csv","w");
    foreach($aAgenda as $aContacto){
        $sImagen = (isset($aContacto[2]))?$aContacto[2]:'';
        fwrite($hFichero, $aContacto[0].",".$aContacto[1].",$sImagen,\n");
    }
    fclose($hFichero);
}

function subirfichero() {
    $target_dir = "uploads/";
    $target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
    //echo "Starget_file<br>";
    $uploadOk = 1;
    $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));

// Check if image file is a actual image or fake image
if(isset($_POST["submit"])) {
$check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
if($check !== false) {
    echo "File is an image - " . $check["mime"] . ".";
    $uploadOk = 1;
  } else {
    echo "File is not an image.";
    $uploadOk = 0;
  }
}

// Check if file already exists
if (file_exists($target_file)) {
  echo "Sorry, file already exists.";
  $uploadOk = 0;
}

// Check file size
if ($_FILES["fileToUpload"]["size"] > 500000) {
  echo "Sorry, your file is too large.";
  $uploadOk = 0;
}

// Allow certain file formats
if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
&& $imageFileType != "gif" ) {
  echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
  $uploadOk = 0;
}

// Check if $uploadOk is set to 0 by an error
if ($uploadOk == 0) {
  echo "Sorry, your file was not uploaded.";
// if everything is ok, try to upload file
} else {
  if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
    echo "The file ". htmlspecialchars( basename( $_FILES["fileToUpload"]["name"])). " has been uploaded.";
  } else {
    echo "Sorry, there was an error uploading your file.";
  }
}
return $target_file;
}

?>
