
<html>
    <head>
        <title>Formstack Project</title>
        <link rel="stylesheet" href="css/styles.css">
        <link href="https://fonts.googleapis.com/css?family=Raleway|Roboto&display=swap" rel="stylesheet">
    </head>
    <body>
    <div class="header_div">
        <a href="index.php"><img class="logo" src="assets\logo.png" alt="Logo"></a>
        <p class="header_text">Invoice Management Portal</p>
    </div>
    <div class="header_bar"></div>
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

    header("Location: view_invoices.php");
}


?>


        <div id="create_invoice_div">
        <p id="create_invoice_text">Create an Invoice</p>
            <form method="post" action="create_invoice.php">
                <label for="name">Client Name: </label><input type="text" name="name"><br><br>
                <label for="amount">Invoice Amount In Dollars: </label><input type="text" name="amount"><br><br>
                <input type="submit" name="submit" value="Submit">
            </form>
        </div>

        <footer>
            <span class="footer_text"><a href="index.php">Home</a></span>
            <span><a href="view_invoices.php">View Invoices</span>
        </footer>
    </body>
</html>