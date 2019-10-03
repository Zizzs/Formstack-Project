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
        edit_invoice($id, $new_name, $invoice_amount);
    }

    if(isset($_POST['delete'])){
        $id = $_POST["id"];
        delete_invoice($id);
    }

    function edit_invoice($id, $name, $amount) {
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

    function delete_invoice($id) {
        $link = mysqli_connect("localhost", "root", "root", "formstack_project", 8890);
    
        if($link === false){
            die("ERROR: Could not connect. " . mysqli_connect_error());
        }
    
        $sql = "DELETE FROM invoices WHERE id=?";
        $stmt = $link->prepare($sql);
        
        $stmt->bind_param("i", $id);
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
                <input type="submit" name="submit" value="Submit"><input type="submit" name="delete" value="Delete">
            </form>
        </div>
    </div>



    <footer>
        <p class="footer_text"><a href="index.php">Home</a></p>
    </footer>

    </body>
</html>