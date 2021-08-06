<?php
$pdo=null;
$host="localhost";
$user="root";
$password="toor";
$db="tappx";


function connect(){
    try{
        $connection="mysql:host=".$GLOBALS["host"].";dbname=".$GLOBALS["db"]."";
        $GLOBALS['pdo'] = new PDO($connection, $GLOBALS["user"], $GLOBALS["password"]);
        $GLOBALS['pdo'] -> setAttribute(PDO:: ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    } catch (PDOException $e){
        echo "Error. Database ".$GLOBALS["db"]." not found<br/>";
        echo "\nError:".$e."<br/>";
    }
}

function disconnect(){
    $GLOBALS['pdo'] = null;
}

function getMethod($query){
    try{
        connect();
        $stmt=$GLOBALS['pdo']->prepare($query);
        $stmt->setFetchMode(PDO::FETCH_ASSOC); # resultado de query -> array asociativo (ejecutamos el query)  
        $stmt->execute();
        disconnect();
        return $stmt;
    } catch(Exception $e) {
        die("Error: ".$e);
    }
}

function postMethod($query, $queryAutoIncrement){
    try{
        connect();
        $stmt=$GLOBALS['pdo']->prepare($query);
        $stmt->execute();
        $idAutoIncrement=getMethod($queryAutoIncrement)->fetch(PDO::FETCH_ASSOC);
        $stmt->closeCursor(); 
        $result=array_merge($idAutoIncrement, $_POST);
        disconnect();
        return $result;
    } catch(Exception $e) {
        die("Error: ".$e);
    }
}

function putMethod($query,$queryAutoIncrement){
    try{
        echo json_encode($query);
        echo "\n\n";
        $queryAutoIncrement="select max(id) as id from bundles";
        echo json_encode($queryAutoIncrement);
        echo "\n\n";
        connect();
        $stmt=$GLOBALS['pdo']->prepare($query);
        $stmt->execute();
        $idAutoIncrement=getMethod($queryAutoIncrement)->fetch(PDO::FETCH_ASSOC);
        $stmt->closeCursor(); 
        $result=array_merge($_GET, $_POST);
        disconnect();
        return $result;
    } catch(Exception $e) {
        die("Error: ".$e);
    }
}

function deleteMethod($query){
    try{
        connect();
        $stmt=$GLOBALS['pdo']->prepare($query);
        $stmt->execute();
        $stmt->closeCursor(); 
        disconnect();
        return $_GET['id'];
    } catch(Exception $e) {
        die("Error: ".$e);
    }
}
?>