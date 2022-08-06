<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Quizs</title>
    <?php include_once "./app/views/admin/layout/style.php" ?>

</head>

<body class="hold-transition sidebar-mini layout-fixed">
    <div class="wrapper">

        <!-- Navbar -->
        <?php include_once "./app/views/admin/layout/header.php"; ?>
        <!-- /.navbar -->

        <!-- Main Sidebar Container -->
        <?php include_once "./app/views/admin/layout/sidebar.php"; ?>

        <!-- /.content-header -->

        <!-- Main content -->
        <section class="content">
            <div class="container-fluid">
                <div class="content-wrapper">
                    <?php $index = 1 ?>
                    <section class="content-header">
                        <div class="container-fluid">
                            <div class="row mb-2">
                                <div class="col-sm-6">
                                    <h1>Danh sách sinh viên</h1>
                                    <h6 class="m-2"> <i>Tổng số: <?= count($student) ?> sv </i></h6>
                                </div>
                            </div>
                        </div><!-- /.container-fluid -->
                    </section>

                    <!-- Main content -->
                    <section class="content">
                        <div class="container-fluid">
                            <div class="row">
                                <div class="col-12">
                                    <div class="card">
                                        <!-- /.card-header -->
                                        <div class="card-body">
                                            <table class="table table-bordered table-striped  text-center">
                                                <thead>
                                                    <tr>
                                                        <th>#</th>
                                                        <th>Tên</th>
                                                        <th>Email</th>
                                                        <th>Avatar</th>
                                                        <th>
                                                            <a href="<?= BASE_URL ?>sinh-vien/them-moi"><i class="fa fa-plus-square"></i></a>
                                                        </th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <?php foreach ($student as $item) : ?>
                                                        <tr>
                                                            <td><?= $index++ ?></td>
                                                            <td><?= $item->name ?></td>
                                                            <td><?= $item->email ?></td>
                                                            <td><img src="<?= BASE_URL ?>public/image/user/<?= $item->avatar ?>" width="80" height="100px" class="img-fluid ${3|rounded-top,rounded-right,rounded-bottom,rounded-left,rounded-circle,|}" alt=""></td>
                                                            <td>
                                                                <a href="<?= BASE_URL ?>sinh-vien/cap-nhat?id=<?= $item->id ?> ?>"><i class="fas fa-edit"></i></a>
                                                                <a href="<?= BASE_URL ?>sinh-vien/xoa?id=<?= $item->id ?> ?>"><i class="fas fa-trash"></i></a>
                                                            </td>
                                                        </tr>
                                                    <?php endforeach ?>
                                                </tbody>
                                            </table>
                                        </div>
                                        <!-- /.card-body -->
                                    </div>
                                    <!-- /.card -->
                                </div>
                                <!-- /.col -->
                            </div>
                            <!-- Button trigger modal -->

                        </div>
                        <!-- /.container-fluid -->
                    </section>
                    <!-- /.content -->
                </div>
                <!-- /.content -->
            </div>
            <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->
    <?php include_once "./app/views/admin/layout/script.php" ?>
    </div>
    <!-- ./wrapper -->
</body>

</html>



<!-- /.control-sidebar -->