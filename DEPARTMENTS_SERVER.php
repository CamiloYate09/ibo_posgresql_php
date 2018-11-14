<?php
/**
 * Created by PhpStorm.
 * User: Kernel-2018
 * Date: 29/03/2018
 * Time: 16:01
 */
//Mostrar notificaciones de mensajes
//3
session_start();

//INICIALIZAR VARIABLES

//1)variables para conectar con employees
$departamento_id = "";//1
$nombre_departamento = "";//2
$jefe_id = "";//3
$localizacion_id = "";//4





//actualizar registros
//3
$edit_state = false;


//conectar con la base de datos

$db = pg_connect("host=ec2-54-227-237-27.compute-1.amazonaws.com port=5432 dbname=desu9g234vo74 user=rvjttoxqgqdeek password=991a828e0f9c4b15953f2155174f0b0dbf2f2e76f8c75df7f47835b271194074");

// si se presiona el boton save de el formulario

if(isset($_POST['save'])){
    //2)empiezo a pasar los nombres de los atributos de mi formulario

    //$name = $_POST['name'];
    //$address = $_POST['address'];
    $departamento_id = $_POST['departamento_id'];
    $nombre_departamento = $_POST['nombre_departamento'];
    $jefe_id = $_POST['jefe_id'];
    $localizacion_id  = $_POST['localizacion_id'];



    //3) hacemos la query de insertar datos

    $query = "INSERT INTO employees(departamento_id,nombre_departamento,jefe_id,localizacion_id) VALUES('$departamento_id', '$nombre_departamento',
        '$jefe_id','$localizacion_id')";
    pg_query($db, $query);
    //Mostrar notificaciones de mensajes
    //3
    $_SESSION['msg'] = "Imformacion Guardada";

    header('location: DEPARTMENTS.php'); //redireccionamos a la pagina principal

}

//actualizar registros
//4)-->

if (isset($_POST['update'])){
    $departamento_id = pg_escape_string($_POST['departamento_id']);
    $nombre_departamento  = pg_escape_string($_POST['nombre_departamento']);
    $jefe_id = pg_escape_string($_POST['jefe_id']);
    $localizacion_id = pg_escape_string($_POST['localizacion_id']);



    pg_query($db, "UPDATE departments SET departamento_id='$departamento_id', nombre_departamento='$nombre_departamento', jefe_id='$jefe_id', localizacion_id='$localizacion_id'   WHERE departamento_id=$departamento_id");
    $_SESSION['msg'] = "Imformacion Actualizada";

    header('location: DEPARTMENTS.php'); //redireccionamos a la pagina principal
}

//<!-- BORRAR REGISTROS
//5)-->
if(isset($_GET['del'])){
    $departamento_id = $_GET['del'];
    pg_query($db, "DELETE FROM departments WHERE departamento_id=$departamento_id");
    $_SESSION['msg'] = "Imformacion Eliminada";

    header('location: DEPARTMENTS.php'); //redireccionamos a la pagina principal

}

//recuperar registros##################
//6)
$results = pg_query($db, "SELECT * FROM departments");


?>
