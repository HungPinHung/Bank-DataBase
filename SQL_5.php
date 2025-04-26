<?php
    //連結__SQL_CONNETCTION.php
    include './__SQL_CONNETCTION.php';
    
    $USER_UUID = $_GET["UUID"]; 
    
    $SQL_COMMAND = "SELECT E_Name,`交易資料`.`交易類型`,`交易資料`.`編號`,`交易資料`.`交易金額`,`交易資料`.`轉出號碼`,`交易資料`.`交易號碼` FROM `銀行員工`,`交易資料` where `銀行員工`.`E_ID`=`交易資料`.`交易行員_ID`and `E_ID`=(SELECT `User_ID` FROM`Bank_Account_Info` WHERE`UUID`='".$USER_UUID."' and `Role`='Service')";

    
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
