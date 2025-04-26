<?php
    //連結__SQL_CONNETCTION.php
    include './__SQL_CONNETCTION.php';

    $USER_UUID = $_COOKIE["UUID"]; 

    $SQL_COMMAND = "SELECT * From `帳戶資料`    Where`帳戶資料`.`Principal_ID`=    (SELECT `Bank_Account_Info`.`User_ID` FROM `Bank_Account_Info` where UUID ='".$USER_UUID."' LIMIT 1)";

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
