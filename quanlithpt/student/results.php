<?php

session_start();

include '../main/db.php';

$user_id = $_SESSION['user']['id'];

$student_query = mysqli_query(

    $conn,

    "SELECT * FROM students
    WHERE user_id='$user_id'"
);

$student = mysqli_fetch_assoc($student_query);

$student_id = $student['id'];

$sql = "SELECT exams.*,
        subjects.subject_name

        FROM exams

        LEFT JOIN subjects
        ON exams.subject_id = subjects.id

        WHERE exams.student_id='$student_id'";

$result = mysqli_query($conn,$sql);
$chart_labels = [];
$chart_scores = [];

$chart_query = mysqli_query($conn,$sql);

while($c = mysqli_fetch_assoc($chart_query)){

    $chart_labels[] = $c['subject_name'];
    $chart_scores[] = $c['score'];
}
$graduation = mysqli_query(

    $conn,

    "SELECT * FROM graduation_results
    WHERE student_id='$student_id'"
);

$graduation_result = mysqli_fetch_assoc($graduation);

include '../skin/header.php';
include '../skin/navbar.php';
?>

<div class="container mt-5">

    <div class="card shadow">

        <div class="card-body">

            <h2 class="mb-4">
                Kết quả thi
            </h2>

            <table class="table table-bordered">

                <thead class="table-dark">

                    <tr>

                        <th>Môn thi</th>
                        <th>Điểm</th>

                    </tr>

                </thead>

                <tbody>

                    <?php while($row = mysqli_fetch_assoc($result)): ?>

                    <tr>

                        <td>
                            <?= $row['subject_name'] ?>
                        </td>

                        <td>

                            <span class="badge bg-success">

                                <?= $row['score'] ?>

                            </span>

                        </td>

                    </tr>

                    <?php endwhile; ?>

                </tbody>

            </table>
<div class="mt-5">

    <h4 class="mb-4">
        Biểu đồ điểm thi
    </h4>

    <canvas id="scoreChart"></canvas>

</div>
            <hr>

            <?php if($graduation_result): ?>

                <h4>

                    Điểm trung bình:

                    <span class="badge bg-primary">

                        <?= round($graduation_result['average_score'],2) ?>

                    </span>

                </h4>

                <h4 class="mt-3">

                    Kết quả:

                    <?php if($graduation_result['result_status']=='ĐẬU'): ?>

                        <span class="badge bg-success">

                            ĐẬU

                        </span>

                    <?php else: ?>

                        <span class="badge bg-danger">

                            RỚT

                        </span>

                    <?php endif; ?>

                </h4>

            <?php endif; ?>

        </div>

    </div>

</div>
<script>

    const scoreChart =
        document.getElementById('scoreChart');

    new Chart(scoreChart, {

        type: 'bar',

        data: {

            labels:
                <?= json_encode($chart_labels) ?>,

            datasets: [{

                label:'Điểm thi',

                data:
                    <?= json_encode($chart_scores) ?>

            }]
        },

        options: {

            scales: {

                y: {

                    beginAtZero:true,
                    max:10

                }
            }
        }
    });

</script>
<?php
include '../skin/footer.php';
?>