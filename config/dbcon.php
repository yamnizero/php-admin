
<?php 

    define('DB_SERVER',"localhost");
    define('DB_USERNAME',"root");
    define('DB_PASSWORD',"");
    define('DB_DATEBASE',"appleservices");

    $conn = mysqli_connect(DB_SERVER,DB_USERNAME,DB_PASSWORD,DB_DATEBASE);

    if (!$conn) {
        die("COnnection Failed: ".mysqli_connect_errno());
    }