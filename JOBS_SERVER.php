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
$trabajo_id = "";
$titulo_trabajo = "";
$min_salario = "";
$max_salario = "";





//actualizar registros
//3
$edit_state = false;


//conectar con la base de datos

$servername = "localhost";
$username = "username";
$password = "password";

// Create connection
$conn = new mysqli($servername, $username, $password);

$db = pg_connect("host=ec2-54-227-237-27.compute-1.amazonaws.com port=5432 dbname=desu9g234vo74 user=rvjttoxqgqdeek password=991a828e0f9c4b15953f2155174f0b0dbf2f2e76f8c75df7f47835b271194074");

// si se presiona el boton save de el formulario

if(isset($_POST['save'])){
    //2)empiezo a pasar los nombres de los atributos de mi formulario


    $trabajo_id = $_POST['trabajo_id'];
    $titulo_trabajo = $_POST['titulo_trabajo'];
    $min_salario = $_POST['min_salario'];
    $max_salario  = $_POST['max_salario'];



    //3) hacemos la query de insertar datos

    $query = "INSERT INTO jobs(trabajo_id,titulo_trabajo,min_salario,max_salario) VALUES('$trabajo_id', '$titulo_trabajo',
        '$min_salario','$max_salario')";
    pg_query($db, $query);
    //Mostrar notificaciones de mensajes
    //3
    $_SESSION['msg'] = "Imformacion Guardada";

    header('location: JOBS.php'); //redireccionamos a la pagina principal

}

//actualizar registros
//4)-->

if (isset($_POST['update'])){
    $trabajo_id = pg_escape_string($_POST['trabajo_id']);
    $titulo_trabajo  = pg_escape_string($_POST['titulo_trabajo']);
    $min_salario = pg_escape_string($_POST['min_salario']);
    $max_salario = pg_escape_string($_POST['max_salario']);



    pg_query($db, "UPDATE jobs SET trabajo_id='$trabajo_id', titulo_trabajo='$titulo_trabajo', min_salario='$min_salario', max_salario='$max_salario'   WHERE trabajo_id=$trabajo_id");
    $_SESSION['msg'] = "Imformacion Actualizada";

    header('location: JOBS.php'); //redireccionamos a la pagina principal
}

//<!-- BORRAR REGISTROS
//5)-->
if(isset($_GET['del'])){
    $trabajo_id = $_GET['del'];
    pg_query($db, "DELETE FROM jobs WHERE trabajo_id=$trabajo_id");
    $_SESSION['msg'] = "Imformacion Eliminada";

    header('location: JOBS.php'); //redireccionamos a la pagina principal

}

//recuperar registros##################
//6)
$results = pg_query($db, "SELECT * FROM jobs");


?>
