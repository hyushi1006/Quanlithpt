<?php
#day la phan de le te thi xinh, cha co gi de dong vao
include '../../config/db.php';

$id = $_GET['id'];

$sql = "DELETE FROM students WHERE id='$id'";

mysqli_query($conn,$sql);

header("Location: index.php");

?>