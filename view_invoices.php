<html>
    <head>
        <title>Formstack Project</title>
        <link rel="stylesheet" href="css/styles.css">
    </head>
    <body>
        <div id="all_invoice_div">
            <p>Id</p>
            <p>Name</p>
            <p>Amount</p>
            <p>Created</p>
            <p>Modified</p>
            <p>Exported</p>
            <p>Tools</p>
            
<?php

$name = $_POST["name"];
$invoice_amount = $_POST["amount"];

$link = mysqli_connect("localhost", "root", "root", "formstack_project", 8890);

if($link === false){
    die("ERROR: Could not connect. " . mysqli_connect_error());
}

$sql = "select * from invoices";

$result = $link->query($sql);

if($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        $id = $row['id'];
        $name = $row['name'];
        $amount = $row['amount'];
        $created = $row['created'];
        $modified = $row['modified'];
        $exported = $row['exported'];

        echo '<p>' . $id . '</p>';
        echo '<p>' . $name . '</p>';
        echo '<p>' . $amount . '</p>';
        echo '<p>' . $created . '</p>';
        echo '<p>' . $modified . '</p>';
        echo '<p>' . $exported . '</p>';
        echo '<p><a href="edit_invoice.php?id='.$id.'&name='.$name.'&amount='.$amount.'&created='.$created.'&modified='.$modified.'&exported='.$exported.'">Edit</a></p>';

        //echo '<p> Id: ' . $id . ' - Name: ' . $name . ' - Amount: ' . $amount . ' - Created: ' . $created . ' - Modified: ' . $modified . ' - Exported: ' . $exported . ' | <a href="edit_invoice.php?name='. $name .'">Edit</a></p>';
    }
}


mysqli_close($link);
?>

        </div>
        <div>
            <a href="index.php">Home</p>
        </div>
    </body>
</html>