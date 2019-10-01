<html>
 <head>
  <title>PHP Test</title>
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

  echo '<p>Text</p>'; ?> 

 </body>
</html>