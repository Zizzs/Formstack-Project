<html>
 <head>
  <title>Formstack Project</title>
  <link rel="stylesheet" href="css/styles.css">
 </head>
 <body>
 <?php
    $user = 'root';
    $password = 'root';
    $db = 'formstack_project';
    $host = 'localhost';
    $port = 8890;
 
    $link = mysqli_init();
    $success = mysqli_real_connect(
        $link, 
        $host, 
        $user, 
        $password, 
        $db,
        $port
    );  
?> 
    <p id="title_header">Client Management Page</p>

    <a href="create_invoice.php">Create a new invoice</p>
    
 </body>
</html>