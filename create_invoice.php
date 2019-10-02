<?php

$name = "";
$invoice_amount = 0;


if(isset($_POST['submit'])){
    save_invoice();
}

function save_invoice() {

    
    $name = $_POST["name"];
    $invoice_amount = $_POST["amount"];

    $link = mysqli_connect("localhost", "root", "root", "formstack_project", 8890);

    if($link === false){
        die("ERROR: Could not connect. " . mysqli_connect_error());
    }

    $sql = "insert into invoices
        (name, created, modified, exported, amount) 
        VALUES ( ? , now(), now(), now(), ? )";

    $stmt = $link->prepare($sql);
    $stmt->bind_param("si", $name, $invoice_amount);
    $stmt->execute();

    // if(mysqli_query($link, $sql)){
    //     echo "Records inserted";
    // } else {
    //     echo "ERROR: Could not execute";
    // }

    mysqli_close($link);
}


?>

<p>Create an Invoice</p>

<div>
    <form method="post" action="create_invoice.php">
        <label for="name">Client Name: </label><input type="text" name="name"><br>
        <label for="amount">Invoice Amount In Dollars: </label><input type="text" name="amount"><br>
        <input type="submit" name="submit" value="Submit">
    </form>
</div>

<div>
    <a href="index.php">Home</p>
</div>