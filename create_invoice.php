
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

    include 'db.php';

    $data = ["create_invoice", $name, $invoice_amount];

    DBQuery($data);
    
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
            <div class="footer_text">
                <span ><a href="index.php">Home</a> | </span>
                <span ><a href="view_invoices.php">View Invoices</a> | </span> 
                <span><a href="search_invoices.php">Search Invoices</a></span>
            </div>
        </footer>
    </body>
</html>