<?php

include '../../main/db.php';

mysqli_query($conn,"DELETE FROM graduation_results");

$students = mysqli_query(
    $conn,
    "SELECT * FROM students"
);

while($student = mysqli_fetch_assoc($students)){

    $student_id = $student['id'];

    $scores_query = mysqli_query(
        $conn,

        "SELECT score
         FROM exams
         WHERE student_id='$student_id'"
    );

    $total = 0;
    $count = 0;

    $failed = false;

    while($score = mysqli_fetch_assoc($scores_query)){

        $s = $score['score'];

        $total += $s;
        $count++;

        if($s < 1){
            $failed = true;
        }
    }

    if($count > 0){

        $average = $total / $count;

    }else{

        $average = 0;
    }

    if($average >= 5 && !$failed){

        $status = 'ĐẬU';

    }else{

        $status = 'RỚT';
    }

    mysqli_query(

        $conn,

        "INSERT INTO graduation_results(
            student_id,
            average_score,
            result_status
        )

        VALUES(
            '$student_id',
            '$average',
            '$status'
        )"
    );
}

header("Location: index.php");

?>