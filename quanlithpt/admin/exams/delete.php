<?php

include '../../main/db.php';

$id = $_GET['id'];

mysqli_query(
    $conn,
    "DELETE FROM exams WHERE id='$id'"
);

header("Location: index.php");

?>