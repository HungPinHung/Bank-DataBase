

<?php

    //連結__SQL_CONNETCTION.php
    include './__SQL_CONNETCTION.php';
    
    $USER_UUID = $_COOKIE["UUID"]; 

    $SQL_COMMAND = "SELECT DISTINCT `Bank_Person_Info`.`Frist_Name`,    `Bank_Person_Info`.`Last_Name`,`交易資料`.*    FROM `交易資料`     join `Bank_Person_Info`on `交易資料`.`交易號碼`=`Bank_Person_Info`.`UUID`    WHERE `交易號碼`='". $USER_UUID ."'OR`轉出號碼`='". $USER_UUID ."'";

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
