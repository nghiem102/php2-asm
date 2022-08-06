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

                    <!-- /.content-header -->

                    <!-- Main content -->
                    <?php $index = 1 ?>
                    <section class="content-header">
                        <div class="container-fluid">
                            <div class="row mb-2">
                                <div class="col-sm-6">
                                    <h1>Danh sách môn học</h1>
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
                                                        <th>Tên môn</th>
                                                        <th>Số lượng Quiz</th>
                                                        <th><a href="mon-hoc/tao-moi"><i class="far fa-plus-square" aria-hidden="true"></i></a></th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <?php foreach ($subjects as $item) : ?>
                                                        <tr>
                                                            <td><?= $index++ ?></td>
                                                            <td><?= $item->name ?></td>
                                                            <td><?= $item->count_quiz ?></td>
                                                            <td>
                                                                <a href="<?= BASE_URL ?>mon-hoc/quizs?subject_id=<?= $item->id ?>"> <i class="fas fa-external-link-alt"></i></a>
                                                                <a href="<?= BASE_URL ?>mon-hoc/cap-nhat?id=<?= $item->id ?>"><i class="fas fa-edit"></i></a>
                                                                <a href="<?= BASE_URL ?>mon-hoc/xoa?id=<?= $item->id ?>"><i class="fas fa-trash"></i></a>
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
                            <!-- /.row -->
                        </div>
                        <!-- /.container-fluid -->
                    </section>
                    <!-- /.content -->
                </div>
                <!-- /.content -->
            </div>
            <!-- /.content-wrapper -->



            <!-- /.control-sidebar -->
            <!-- /.content -->
    </div>
    <!-- /.row (main row) -->
    </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->
    <?php include_once "./app/views/admin/layout/script.php" ?>
    <!-- /.control-sidebar -->
    </div>
    <!-- ./wrapper -->
</body>

</html>