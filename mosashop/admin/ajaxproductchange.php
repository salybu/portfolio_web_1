<?php

$conn = mysqli_connect( 'localhost', 'gaeun', 'testtest', 'z_mosashop');

   $ordernum = $_POST['orderid'];

    echo "ordernum ";
    echo $ordernum;

$querys = "UPDATE orderorder SET status = '배송중' WHERE ordernumber = '$ordernum'";
$resultd = mysqli_query($conn, $querys);

?>
