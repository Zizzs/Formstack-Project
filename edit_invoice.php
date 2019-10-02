<html>
    <head>
        <title>Formstack Project</title>
        <link rel="stylesheet" href="css/styles.css">
    </head>
    <body>

<?php
    $id = $_GET['id'];
    $name = $_GET['name'];
    $amount = $_GET['amount'];
    $created = $_GET['created'];
    $modified = $_GET['modified'];
    $exported = $_GET['exported'];

    if(isset($_POST['submit'])){
        $id = $_POST["id"];
        $new_name = $_POST["name"];
        $invoice_amount = $_POST["amount"];
        echo "" . $id . " " . $new_name . " " . $invoice_amount;
        edit_invoice($id, $new_name, $invoice_amount);
    }

    function edit_invoice($id, $name, $amount) {
        // $id = intval($_GET['id']);
        // $new_name = $_POST["name"];
        // $invoice_amount = $_POST["amount"];

        $link = mysqli_connect("localhost", "root", "root", "formstack_project", 8890);

        if($link === false){
            die("ERROR: Could not connect. " . mysqli_connect_error());
        }

        $sql = "UPDATE invoices SET name=?, amount=?, modified=now() WHERE id=?";
        echo $id;
        $stmt = $link->prepare($sql);
       
        $stmt->bind_param("sii", $name, $amount, $id);
        $stmt->execute();

        header("Location: view_invoices.php");
    }

?>

    <div>
        <div>
            <form method="post" action="edit_invoice.php">
                <label for="id"> ID: </label> <input readonly type="text" name="id" value=<?php echo $id ?>><br><br>
                <label for="name">Client Name: </label><input type="text" name="name" value=<?php echo $name ?>><br><br>
                <label for="amount">Amount In Dollars: </label><input type="number" name="amount" value=<?php echo $amount ?>><br><br>
                <label for="created">Created: </label><span name="created"><?php echo $created ?></span><br><br>
                <label for="modified">Modified: </label><span name="modified"><?php echo $modified ?></span><br><br>
                <label for="exported">Exported: </label><span name="exported"><?php echo $exported ?></span><br><br>
                <input type="submit" name="submit" value="Submit">
            </form>
        </div>
    </div>



    <div>
        <a href="index.php">Home</p>
    </div>

    </body>
</html>