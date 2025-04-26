<?php
    //連結__SQL_CONNETCTION.php
    include './__SQL_CONNETCTION.php';

    $USER_UUID = $_COOKIE["UUID"]; 

    $SQL_COMMAND = "SELECT DISTINCT    (SELECT COUNT(*) FROM `帳戶資料` AS I     WHERE `I`.`Principal_ID` =    (SELECT `User_ID` FROM `Bank_Account_Info` AS I    where `UUID`='".$USER_UUID."' and `I`.`Role`='User'    ORDER BY `User_ID`     DESC LIMIT 1)) AS 旗下帳戶數量,    (SELECT  COUNT(*) From `交易資料` WHERE`交易資料`.`交易行員_ID`=(    SELECT `User_ID` FROM `Bank_Account_Info`     WHERE `UUID`='".$USER_UUID."'    AND `Bank_Account_Info`.`Role`='User'    ORDER BY `User_ID` DESC LIMIT 1)) AS 處理交易次數,    `Bank_Person_Info`.Frist_Name,    `Bank_Person_Info`.Last_Name,    `Bank_Person_Info`.Email,    `Bank_Person_Info`.`Phone_Number`,    `Bank_Person_Info`.SSN_Number,    `U`.`User_ID`    From `Bank_Account_Info` AS U    join `Bank_Person_Info` ON`U`.UUID = `Bank_Person_Info`.`UUID`    join `交易資料` ON  `U`.User_ID = `交易資料`.`交易行員_ID`    where `U`.UUID='".$USER_UUID."'";

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
