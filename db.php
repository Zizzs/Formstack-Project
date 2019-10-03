<?php
    function DBQuery($data){
        $link = mysqli_connect("localhost", "root", "root", "formstack_project", 8890);

        if($link === false){
            die("ERROR: Could not connect. " . mysqli_connect_error());
        }

        if($data[0] === "view_all_invoices"){

            $sql = "select * from invoices";

            $result = $link->query($sql);

            $link->close();

            return $result;
        }

        if($data[0] === "search_invoices"){

            $sql = "select * from invoices where id=".$data[1];

            $result = $link->query($sql);

            $link->close();

            return $result;
        }

        if($data[0] === "edit_invoices"){

            $sql = "UPDATE invoices SET name=?, amount=?, modified=now() WHERE id=?";

            $stmt = $link->prepare($sql);
       
            $stmt->bind_param("sii", $data[1], $data[2], $data[3]);

            if($stmt->execute()){
                $link->close();
                header("Location: view_invoices.php");
            };
        }

        if($data[0] === "delete_invoice"){
            $sql = "DELETE FROM invoices WHERE id=?";

            $stmt = $link->prepare($sql);
        
            $stmt->bind_param("i", $data[1]);

            if($stmt->execute()){
                header("Location: view_invoices.php");
            };
    
        }

        if($data[0] === "create_invoice"){
            $sql = "insert into invoices
            (name, created, modified, exported, amount) 
            VALUES ( ? , now(), now(), now(), ? )";

            $stmt = $link->prepare($sql);
            $stmt->bind_param("si", $data[1], $data[2]);
            $stmt->execute();

            mysqli_close($link);

            header("Location: view_invoices.php");
        }
    }


?>