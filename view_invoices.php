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
        <div id="all_invoice_div_parent">
        <a id="new_invoice_button_view_page" href="create_invoice.php">Create a new invoice</a>
        <div id="all_invoice_div_header" class="all_invoice_div">
            <p>Id</p>
            <p>Name</p>
            <p>Amount</p>
            <p>Created</p>
            <p>Modified</p>
            <p>Exported</p>
            <p>Tools</p>
        </div> 
        <hr>
            
<?php

$name = $_POST["name"];
$invoice_amount = $_POST["amount"];

$link = mysqli_connect("localhost", "root", "root", "formstack_project", 8890);

if($link === false){
    die("ERROR: Could not connect. " . mysqli_connect_error());
}

$sql = "select * from invoices";

$result = $link->query($sql);

$row_num = 1;
if($result->num_rows > 0) {
    
    while($row = $result->fetch_assoc()) {
        $id = $row['id'];
        $name = $row['name'];
        $amount = $row['amount'];
        $created = $row['created'];
        $modified = $row['modified'];
        $exported = $row['exported'];

        if($created === $exported) {
            $exported = "No Exports";
        };

        if($created === $modified) {
            $modified = "Not Modified";
        }

        echo '<div class="all_invoice_div invoice_row_'.$row_num.'">';
        echo '<p>' . $id . '</p>';
        echo '<p>' . $name . '</p>';
        echo '<p>' . $amount . '</p>';
        echo '<p>' . $created . '</p>';
        echo '<p>' . $modified . '</p>';
        echo '<p>' . $exported . '</p>';
        echo '<p><a href="edit_invoice.php?id='.$id.'&name='.$name.'&amount='.$amount.'&created='.$created.'&modified='.$modified.'&exported='.$exported.'">Edit</a> | ';
        echo '<a href="delete_invoice.php?id='.$id.'">Delete</a> | ';
        echo '<a href="create_csv.php?id='.$id.'&name='.$name.'&amount='.$amount.'&created='.$created.'&modified='.$modified.'&exported='.$exported.'&page=view_all">Create CSV</a> </p> ';
        echo '</div>';

        if($row_num === 1) {
            $row_num = 0;
        } else {
            $row_num = 1;
        }
    }
}

mysqli_close($link);

?>

        </div>

        </div>
        <footer>
            <span class="footer_text"><a href="index.php">Home</a></span>
            <span><a href="view_invoices.php">View Invoices</span>
        </footer>
    </body>
</html>