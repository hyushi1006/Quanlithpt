<?php
#thuc su thi phan nay ngu lam, dung dong 1 cai gi ca
session_start();

include '../../main/db.php';

$sql = "SELECT * FROM students";
$result = mysqli_query($conn,$sql);

include '../../skin/header.php';
include '../../skin/navbar.php';
?>

<div class="d-flex">

    <?php include '../../skin/sidebar.php'; ?>

    <div class="container-fluid p-4">

        <div class="d-flex justify-content-between mb-3">

            <h2>
                Quản lý thí sinh
            </h2>

            <a href="create.php"
                class="btn btn-primary">

                Thêm thí sinh
            </a>

        </div>

        <div class="card shadow">

            <div class="card-body">

                <table class="table table-bordered table-hover">

                    <thead class="table-dark">

                        <tr>
                            <th>ID</th>
                            <th>Ảnh</th>
                            <th>Họ tên</th>
                            <th>Giới tính</th>
                            <th>SĐT</th>
                            <th>Trường</th>
                            <th>Hành động</th>
                        </tr>

                    </thead>

                    <tbody>

                        <?php while($row = mysqli_fetch_assoc($result)): ?>

                        <tr>

                            <td><?= $row['id'] ?></td>

                            <td>

                                <?php if($row['avatar']): ?>

                                    <img
                                        src="../../uploads/students/<?= $row['avatar'] ?>"
                                        class="avatar">

                                <?php endif; ?>

                            </td>

                            <td><?= $row['full_name'] ?></td>
                            <td><?= $row['gender'] ?></td>
                            <td><?= $row['phone'] ?></td>
                            <td><?= $row['school'] ?></td>

                            <td>

                                <a href="edit.php?id=<?= $row['id'] ?>"
                                    class="btn btn-warning btn-sm">

                                    Sửa
                                </a>

                                <a href="delete.php?id=<?= $row['id'] ?>"
                                    class="btn btn-danger btn-sm"
                                    onclick="return confirm('Xóa thí sinh này?')">

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