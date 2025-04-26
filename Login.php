<?php
    //連結__SQL_CONNETCTION.php
    include './__SQL_CONNETCTION.php';

    $USER_SSN = $_GET["SSN"];
    $USER_ID = $_GET["ID"];
    $USER_PASSWORD = $_GET["PASSWORD"];  
    $LOGIN_TYPE = $_GET["TYPE"]; 

    $result = SQL_EXECUTION(
        "SELECT * FROM `Bank_Account_Info` WHERE `SSN_NUMBER` = '" . $USER_SSN . "' AND " . " `USER_ID` = '" . $USER_ID . "' AND " . " `Password` = '" . $USER_PASSWORD . "' AND " . " `Role` = '" . $LOGIN_TYPE . "'"
    );
    
    if ($result->num_rows <= 0 || $result->num_rows > 1){
        echo "error";
    }else{
        while($row = $result->fetch_assoc()) {
            echo $row["UUID"];
        }
    }

    //$PRINT_DATA_DATABASE = array("USER_UUID", "LICENSE_STUTS");
?>
