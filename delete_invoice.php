<?php

        $id = $_GET['id'];
        
        $link = mysqli_connect("localhost", "root", "root", "formstack_project", 8890);
    
        if($link === false){
            die("ERROR: Could not connect. " . mysqli_connect_error());
        }
    
        $sql = "DELETE FROM invoices WHERE id=?";
        $stmt = $link->prepare($sql);
        
        $stmt->bind_param("i", $id);
        $stmt->execute();
    
        header("Location: view_invoices.php");
    
?>