<?php
function conn(){
    $HOST_NAME = "localhost";	
    $DB_NAME = "datalist";		
    $CHAR_SET = "charset=utf8"; 
    $USERNAME = "root";     		
    $PASSWORD = "";  	    

    $conn = new PDO('mysql:host='.$HOST_NAME.';dbname='.$DB_NAME.';'.$CHAR_SET,$USERNAME,$PASSWORD);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    return $conn;
}

function insert_data($data, $StrQ){
    $stmt = conn()->prepare($StrQ);
    $stmt->execute($data);
    return $stmt;
}


function Show_data($StrQ){
    $stmt = conn()->prepare($StrQ);	       
    $stmt -> execute();				       
    $result = $stmt -> fetchAll();
    return $result;
}
?>

