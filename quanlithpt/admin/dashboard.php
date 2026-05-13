<?php
#dashboard la bang dieu khien va no chia thanh 2 phan cua admin va hoc sinh, va day la cua admin.
#no giong nhu la mot controler vay hoac co the noi la menu cua ho so ca nhan, cho la vay di
#tk:admin mk:password (u t thich dat the day van de gi khong?)
session_start();

include '../main/db.php';

$student_count =
mysqli_num_rows(
    mysqli_query($conn,"SELECT * FROM students")
);

$subject_count =
mysqli_num_rows(
    mysqli_query($conn,"SELECT * FROM subjects")
);

$exam_count =
mysqli_num_rows(
    mysqli_query($conn,"SELECT * FROM exams")
);

$result_count =
mysqli_num_rows(
    mysqli_query($conn,"SELECT * FROM graduation_results")
);
$pass_count = mysqli_num_rows(

    mysqli_query(

        $conn,

        "SELECT * FROM graduation_results
        WHERE result_status='ĐẬU'"
    )
);

$fail_count = mysqli_num_rows(

    mysqli_query(

        $conn,

        "SELECT * FROM graduation_results
        WHERE result_status='RỚT'"
    )
);

$subjects = mysqli_query(

    $conn,

    "SELECT subject_name FROM subjects"
);

$subject_names = [];

while($s = mysqli_fetch_assoc($subjects)){

    $subject_names[] = $s['subject_name'];
}
include '../skin/header.php';
include '../skin/navbar.php';
?>

<div class="d-flex">

    <?php include '../skin/sidebar.php'; ?>

    <div class="container-fluid p-4">

        <h2 class="mb-4">
            Dashboard
        </h2>

        <div class="row">

            <div class="col-md-3">

                <div class="dashboard-card bg-student">

                    <h3>

                        <?= $student_count ?>

                    </h3>

                    <p>
                        Thí sinh
                    </p>

                </div>

            </div>

            <div class="col-md-3">

                <div class="dashboard-card bg-subject">

                    <h3>

                        <?= $subject_count ?>

                    </h3>

                    <p>
                        Môn thi
                    </p>

                </div>

            </div>

            <div class="col-md-3">

                <div class="dashboard-card bg-exam">

                    <h3>

                        <?= $exam_count ?>

                    </h3>

                    <p>
                        Điểm thi
                    </p>

                </div>

            </div>

            <div class="col-md-3">

                <div class="dashboard-card bg-result">

                    <h3>

                        <?= $result_count ?>

                    </h3>

                    <p>
                        Kết quả
                    </p>

                </div>

            </div>

        </div>

    </div>

</div>
<div class="row mt-5">

    <!-- Beans va cut -->

    <div class="col-md-6">

        <div class="card shadow">

            <div class="card-body">

                <h4 class="mb-4">
                    Thống kê tốt nghiệp
                </h4>

                <canvas id="graduationChart"></canvas>

            </div>

        </div>

    </div>

    <!-- monthi -->

    <div class="col-md-6">

        <div class="card shadow">

            <div class="card-body">

                <h4 class="mb-4">
                    Thống kê môn thi
                </h4>

                <canvas id="subjectChart"></canvas>

            </div>

        </div>

    </div>

</div>
<script>

    // beansvacuts

    const graduationChart = document
        .getElementById('graduationChart');

    new Chart(graduationChart, {

        type: 'doughnut',

        data: {

            labels: ['Đậu','Rớt'],

            datasets: [{

                data: [
                    <?= $pass_count ?>,
                    <?= $fail_count ?>
                ]

            }]
        }
    });

    // Monthi

    const subjectChart = document
        .getElementById('subjectChart');

    new Chart(subjectChart, {

        type: 'bar',

        data: {

            labels: <?= json_encode($subject_names) ?>,

            datasets: [{

                label:'Số môn',

                data: <?= json_encode(
                    array_fill(
                        0,
                        count($subject_names),
                        1
                    )
                ) ?>

            }]
        }
    });

</script>
<?php
include '../skin/footer.php';
?>