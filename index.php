<?php

include "database.php";
header('Access-Control-Allow-Origin: *');
header("Access-Control-Allow-Methods: HEAD, GET, POST, PUT, PATCH, DELETE, OPTIONS");
header("Access-Control-Allow-Headers: X-API-KEY, Origin, X-Requested-With, Content-Type, Accept, Access-Control-Request-Method,Access-Control-Request-Headers, Authorization");
header('Content-Type: application/json');
$method = $_SERVER['REQUEST_METHOD'];
if ($method == "OPTIONS") {
header('Access-Control-Allow-Origin: *');
header("Access-Control-Allow-Headers: X-API-KEY, Origin, X-Requested-With, Content-Type, Accept, Access-Control-Request-Method,Access-Control-Request-Headers, Authorization");
header("HTTP/1.1 200 OK");
die();
}

$data = json_decode(file_get_contents('php://input'), true);

switch ($_SERVER["REQUEST_METHOD"]) {
    case 'GET':
        if(isset($_GET['id'])) {
        $query="SELECT * FROM bundles WHERE id=".$_GET['id'].";";
        $result=getMethod($query);
        echo json_encode($result->fetch(PDO::FETCH_ASSOC)); 
        }else{
            $query="SELECT * FROM bundles";
            $result=getMethod($query);
            echo json_encode($result->fetchAll());
        }
        header("HTTP/1.1 200 OK");
        exit();
        break;
    case 'POST':
        $username=$data['username'];
        echo json_encode($username);
        echo "\n\n";
        $bundle=$data['bundle'];
        $company=$data['company'];
        $email=$data['email'];
        $active=$data['active'];
        $category=$data['category'];
        $query="INSERT INTO bundles(username,bundle,company,email,active,category) VALUES ('$username','$bundle','$company','$email','$active','$category')";
        $queryAutoIncrement="SELECT max(id) AS id FROM bundles";
        $result=postMethod($query,$queryAutoIncrement);
        echo json_encode($result);
        header("HTTP/1.1 200 OK");
        exit();
        break;
    case 'PUT':
        $id=$data['id'];
        $username=$data['username'];
        $bundle=$data['bundle'];
        $company=$data['company'];
        $email=$data['email'];
        $active=$data['active'];
        $category=$data['category'];
        $query="UPDATE bundles SET username='$username', bundle='$bundle', company='$company', email='$email', active='$active', category='$category' WHERE id=$id";
        $result=putMethod($query,$queryAutoIncrement);
        echo json_encode($result);
        header("HTTP/1.1 200 OK");
        exit();
        break;
    case 'DELETE':
        $id=$data['id'];
        $query="DELETE FROM bundles WHERE id='$id'";
        $result=deleteMethod($query);
        echo json_encode($result);
        header("HTTP/1.1 200 OK");
        exit();
        break;
    default:
        header("HTTP/1.1 400 BAD REQUEST");
        break;
}


?>