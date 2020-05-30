<?php
require_once 'config.php';

//Mostrar errores en linux
ini_set("display_errors", "1");
error_reporting(E_ALL);


//MYSQL
function pdo_connect_mysql() {
    try {
    	return new PDO('mysql:host=' . DATABASE_HOST . ';dbname=' . DATABASE_NAME . ';charset=utf8', DATABASE_USER, DATABASE_PASS, [
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
            PDO::MYSQL_ATTR_INIT_COMMAND=>"SET NAMES utf8",
            
            PDO::ATTR_EMULATE_PREPARES => false
          ]);
    } catch (PDOException $exception) {
    	// If there is an error with the connection, stop the script and display the error.
    	die ('Failed to connect to database!');
    }
}

$pdo = pdo_connect_mysql();
if($pdo){
  //echo "Connected to the <strong>$db</strong> PGSQL database successfully!";
  }


//POSTGRESQL

 
$dsn = "pgsql:host=$host;port=5432;dbname=$db;user=$username;password=$password";
 
try{
 // create a PostgreSQL database connection
 $conn = new PDO($dsn);
 
 // display a message if connected to the PostgreSQL successfully
 if($conn){
 //echo "Connected to the <strong>$db</strong> MYSQL database successfully!";
 }
}catch (PDOException $e){
 // report error message
 echo $e->getMessage();
}


//MONGODB
// $client = new MongoDB\Driver\Manager(
//   'mongodb+srv://testing-admin:lestatme1@testing-zs41u.mongodb.net/');

//   if($client){
//     echo  nl2br ("Connection to MongoDBAtlas successfully\n");
//   }

//   $listdatabases = new MongoDB\Driver\Command(["listDatabases" => 1]);
//   if($listdatabases){
//     echo  nl2br ("listdatabases\n");
//   }

//   $res = $client->executeCommand("admin", $listdatabases);
//   if($res){
//     echo  nl2br ("res\n");
//   }

//   $databases = current($res->toArray());
//   foreach ($databases->databases as $el) {
    
//     echo nl2br ($el->name . "\n");
// }
?>