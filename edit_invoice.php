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

    if($created === $exported) {
        $exported = "No Exports";
    }

    if($created === $modified) {
        $modified = "Not Modified";
    }

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

    function delete_invoice($id){
        include 'db.php';

        $data = ["delete_invoice", $id];

        DBQuery($data);
    }

    function edit_invoice($id, $name, $amount) {
        include 'db.php';

        $data = ["edit_invoices", $name, $amount, $id];

        DBQuery($data);
    }

?>

    <div>
        <div id="edit_invoice_div">
            <form method="post" action="edit_invoice.php">
                <label class="edit_label_text" for="id"> ID: </label> <input readonly type="text" name="id" value=<?php echo $id ?>><br><br>
                <label class="edit_label_text" for="name">Client Name: </label><input type="text" name="name" value=<?php echo $name ?>><br><br>
                <label class="edit_label_text" for="amount">Amount In Dollars: </label><input type="number" name="amount" value=<?php echo $amount ?>><br><br>
                <label class="edit_label_text" for="created">Created: </label><span name="created"><?php echo $created ?></span><br><br>
                <label class="edit_label_text" for="modified">Modified: </label><span name="modified"><?php echo $modified ?></span><br><br>
                <label class="edit_label_text" for="exported">Exported: </label><span name="exported"><?php echo $exported ?></span><br><br>
                <input type="submit" name="submit" value="Submit"><input type="submit" name="delete" value="Delete">
                <?php echo '<a href="create_csv.php?id='.$id.'&name='.$name.'&amount='.$amount.'&created='.$created.'&modified='.$modified.'&exported='.$exported.'&page=view_edit">Create CSV</a>'; ?>
            </form>
        </div>
    </div>



    <footer>
        <span class="footer_text"><a href="index.php">Home</a> | </span>
        <span><a href="view_invoices.php">View Invoices</a> | </span>
        <span><a href="search_invoices.php">Search Invoices</a></span>
    </footer>

    </body>
</html>