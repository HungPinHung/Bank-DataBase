<?php
    //連結__SQL_CONNETCTION.php
    include './__SQL_CONNETCTION.php';

    $USER_UUID = $_GET["UUID"]; 
    
    $SQL_COMMAND = "SELECT DISTINCT `銀行員工`.`E_Name`,`銀行員工`.`職位`,    (SELECT COUNT(*) AS 帳戶數量 from`帳戶資料` where `帳戶資料`.`Principal_ID`='".$USER_UUID."') AS Account_Count,    `帳戶資料`.`Frist_Name`,    `帳戶資料`.`Last_Name`,    `編號`    FROM `銀行員工`,`帳戶資料`    WHERE`銀行員工`.`E_ID`=`帳戶資料`.`Principal_ID` and `E_ID`='".$USER_UUID."'    GROUP BY    `銀行員工`.`E_Name`, `銀行員工`.`職位`,`帳戶資料`.`Frist_Name`,    `帳戶資料`.`Last_Name`,`編號`;";
    
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
