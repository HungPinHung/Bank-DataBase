<?php
    function SQL_EXECUTION($EXCUTION_COMMAND) {
        $dbhost = 'localhost';
        $dbuser = 'ciai_dbst';
        $dbpass = '000000';
        $dbname = 'cbb109121';

        $con = mysqli_connect($dbhost, $dbuser, $dbpass, $dbname) or die('Login Error');
        mysqli_select_db($con, $dbname);

        $result = $con->query($EXCUTION_COMMAND);

        mysqli_close($con);
        return $result;
    }

?>