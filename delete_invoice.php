<?php

        $id = $_GET['id'];

        include 'db.php';

        $data = ["delete_invoice", $id];
    
        DBQuery($data);
    
?>