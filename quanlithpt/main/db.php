<?php
#day la database, cam duoc nghich
$conn = mysqli_connect(
    "localhost",
    "root",
    "",
    "QUANLITHPT"
);

if(!$conn){
    die("Kết nối thất bại: " . mysqli_connect_error());
}

?>