<?php
    //連結__SQL_CONNETCTION.php
    include './__SQL_CONNETCTION.php';

    $USER_UUID = $_GET["UUID"]; 
    
    $SQL_COMMAND = "SELECT COUNT(*) AS 持有帳戶數量,P.Frist_Name,P.Last_Name,P.Phone_Number     FROM `帳戶資料`     join `Bank_Person_Info` AS P    on`帳戶資料`.`Frist_Name`=`P`.`Frist_Name`    WHERE  `帳戶資料`.`Frist_Name`=(SELECT Frist_Name FROM `Bank_Person_Info` where `Bank_Person_Info`.`UUID`='".$USER_UUID."')    group by P.Frist_Name,P.Last_Name,P.Phone_Number";

    //$SQL_COMMAND = "SELECT COUNT(*) AS 持有帳戶數量,P.Frist_Name,P.Last_Name,P.Phone_Number FROM `帳戶資料` join `Bank_Person_Info` AS Pon`帳戶資料`.`A_UUID`=`P`.`UUID`WHERE  `帳戶資料`.`A_UUID`='.".$USER_UUID.".')group by P.Frist_Name,P.Last_Name,P.Phone_Number";

    $result = SQL_EXECUTION($SQL_COMMAND);
    
    if ($result->num_rows <= 0){
        echo "error";
    }else{
        $fieldInfo = $result->fetch_fields();

        $output_text = "";

        $field_array = array();

        $output_text .= '{"Data":[';

        foreach($fieldInfo as $field){
            array_push($field_array, $field->name);
        }

        while($row = $result->fetch_assoc()) {
            $output_text .= '{';
            for($i = 0; $i < count($field_array); $i++){
                $output_text .= '"' . $field_array[$i] . '":"' . $row[$field_array[$i]] . '"';

                $output_text .= ($i == count($field_array) - 1) ? "" : ",";
            }

            $output_text .= '},';
        }

        $output_text = substr($output_text, 0, -1);

        $output_text .=  '],';

        $output_text .=  '"' . 'SQL_COMMAND" : "' . $SQL_COMMAND . '"';

        $output_text .=  "}";

        echo $output_text;
    }

    //$PRINT_DATA_DATABASE = array("USER_UUID", "LICENSE_STUTS");
?>
