<?php include "header.php"; ?>

        <div class="header_div">
            <a href="index.php"><img class="logo" src="assets\logo.png" alt="Logo"></a>
            <p class="header_text">Invoice Management Portal</p>
        </div>
        <div class="header_bar"></div>

        <p id="search_invoice_text">Search By Id</p>
        <div id="search_invoice_div">
            <form method="post" action="search_invoices.php">
                <label for="id">Invoice Id: </label><input type="text" name="id"><br><br>
                <input type="submit" name="submit" value="Submit">
            </form>
        </div>

<?php include "footer.php"; ?>

<?php

    if(isset($_POST['submit'])){
        $id = $_POST["id"];
        search_invoice($id);
    }

    function search_invoice($id) {
        include 'db.php';
        
        $data = ["search_invoices", $id];
        $result = DBQuery($data); 

        if($result->num_rows > 0) {
            while($row = $result->fetch_assoc()){
                //<a href="edit_invoice.php?id='.$id.'&name='.$name.'&amount='.$amount.'&created='.$created.'&modified='.$modified.'&exported='.$exported.'">Edit</a>
                header("Location: edit_invoice.php?id=".$row['id']."&name=".$row['name']."&amount=".$row['amount']."&created=".$row['created']."&modified=".$row['modified']."&exported=".$row['exported']);
            };
        } else {
            echo "Zero Results";
        }
    }


?>