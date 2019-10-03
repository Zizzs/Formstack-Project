<?php

    $id = $_GET['id'];
    $name = $_GET['name'];
    $amount = $_GET['amount'];
    $created = $_GET['created'];
    $modified = $_GET['modified'];
    $exported = $_GET['exported'];

    $link = mysqli_connect("localhost", "root", "root", "formstack_project", 8890);

    if($link === false){
        die("ERROR: Could not connect. " . mysqli_connect_error());
    }

    $sql = "UPDATE invoices SET exported=now() WHERE id=?";
    $stmt = $link->prepare($sql);
   
    $stmt->bind_param("i",$id);
    $stmt->execute();

    header('Content-Type: text/csv');
    header('Content-Disposition: attachment; filename="invoice.csv"');
    $data[0] = array(
            "ID",
            "Name",
            "Amount",
            "Created",
            "Modified",
            "Exported"
    );

    $data[1] = array(
        $id,
        $name,
        $amount,
        $created,
        $modified,
        $exported
    );

    $fp = fopen('php://output', 'wb');
    foreach ( $data as $line ) {
        fputcsv($fp, $line, ",");
    }
    fclose($fp);
?>