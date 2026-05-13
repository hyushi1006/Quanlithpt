<?php

session_start();

include '../../main/db.php';

$sql = "SELECT * FROM subjects";

$result = mysqli_query($conn,$sql);

include '../../skin/header.php';
include '../../skin/navbar.php';
?>

<div class="d-flex">

    <?php include '../../skin/sidebar.php'; ?>

    <div class="container-fluid p-4">

        <div class="d-flex justify-content-between mb-3">

            <h2>
                Quản lý môn thi
            </h2>

            <a href="create.php"
                class="btn btn-primary">

                Thêm môn thi
            </a>

        </div>

        <div class="card shadow">

            <div class="card-body">

                <table class="table table-bordered table-hover">

                    <thead class="table-dark">

                        <tr>

                            <th>ID</th>
                            <th>Tên môn thi</th>
                            <th>Hành động</th>

                        </tr>

                    </thead>

                    <tbody>

                        <?php while($row = mysqli_fetch_assoc($result)): ?>

                        <tr>

                            <td>
                                <?= $row['id'] ?>
                            </td>

                            <td>
                                <?= $row['subject_name'] ?>
                            </td>

                            <td>

                                <a href="edit.php?id=<?= $row['id'] ?>"
                                    class="btn btn-warning btn-sm">

                                    Sửa
                                </a>

                                <a href="delete.php?id=<?= $row['id'] ?>"
                                    class="btn btn-danger btn-sm"
                                    onclick="return confirm('Xóa môn thi?')">

                                    Xóa
                                </a>

                            </td>

                        </tr>

                        <?php endwhile; ?>

                    </tbody>

                </table>

            </div>

        </div>

    </div>

</div>

<?php
include '../../skin/footer.php';
?>