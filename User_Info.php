<?php
    //連結__SQL_CONNETCTION.php
    include './__SQL_CONNETCTION.php';

    $USER_UUID = $_COOKIE["UUID"]; 

    $SQL_COMMAND = "SELECT `帳戶餘額`.`餘額` AS 帳戶餘額,    (SELECT COUNT(*)FROM `帳戶資料`     where `帳戶資料`.`A_UUID`='".$USER_UUID."')AS 擁有帳戶數量,    (SELECT COUNT(*) FROM `交易資料`WHERE`交易號碼`='".$USER_UUID."'     OR `轉出號碼`='".$USER_UUID."') AS 交易次數,    `Frist_Name`,     `Last_Name`,    `Email`,    `Phone_Number`,     `Bank_Account_Info`.`SSN_Number`,     `User_ID`    FROM `帳戶餘額`    JOIN    `Bank_Account_Info` ON `帳戶餘額`.UUID = `Bank_Account_Info`.UUID     JOIN    `Bank_Person_Info` ON `帳戶餘額`.UUID = `Bank_Person_Info`.`UUID`    LEFT JOIN    `交易資料` ON `帳戶餘額`.`UUID`=`交易資料`.`交易號碼`    WHERE    `帳戶餘額`.`UUID` = '".$USER_UUID."'    GROUP BY    `帳戶餘額`.`餘額`,    `Frist_Name`,    `Last_Name`,    `Email`,    `Phone_Number`,    `Bank_Account_Info`.`SSN_Number`,     `User_ID`;";

    $result = SQL_EXECUTION($SQL_COMMAND);
    
    if ($result->num_rows <= 0 || $result->num_rows > 1){
        echo "error";
    }else{
        $fieldInfo = $result->fetch_fields();

        $field_array = array();

        echo "{";

        foreach($fieldInfo as $field){
            array_push($field_array, $field->name);
        }

        while($row = $result->fetch_assoc()) {
            for($i = 0; $i < count($field_array); $i++){
                echo '"' . $field_array[$i] . '":"' . $row[$field_array[$i]] . '"';

                echo ",";
            }
        }

        echo '"' . 'SQL_COMMAND" : "' . $SQL_COMMAND . '"';

        echo "}";
    }

    //$PRINT_DATA_DATABASE = array("USER_UUID", "LICENSE_STUTS");
?>
