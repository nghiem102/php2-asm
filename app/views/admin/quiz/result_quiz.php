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
        <!-- Main content -->
        <section class="content">
            <div class="container-fluid">
                <div class="content-wrapper">
                    <?php $index = 1 ?>
                    <section class="content-header">
                        <div class="container-fluid">
                            <div class="row mb-2">
                                <div class="col-sm-6">
                                    <h1>Thống kê điểm</h1>
                                    <h6 class="m-2"> <i><?= $quiz->name ?></i> </h6>
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
                                            <table class="table">
                                                <thead>
                                                    <tr>
                                                        <th>Tên sinh viên</th>
                                                        <th>Thời gian bắt đầu</th>
                                                        <th>Thời gian kết thúc</th>
                                                        <th>Số câu đã làm</th>
                                                        <th>Số câu đã đúng</th>
                                                        <th>Điểm</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <?php $index = 0; foreach ($student_quiz as $key => $value) { ?>
                                                        <tr>
                                                            <td><?= $value->name ?></td>
                                                            <td><?= $value->start_time ?></td>
                                                            <td><?= $value->end_time ?></td>
                                                            <td><?= $value->answered?></td>
                                                            <td><?= $question_correct[$index++]->count_correct?></td>
                                                            <td><?= $value->score ?></td>
                                                        </tr>
                                                    <?php } ?>
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
        </section>
    </div>
    <!-- /.content-wrapper -->
    <?php include_once "./app/views/admin/layout/script.php" ?>
    <!-- /.control-sidebar -->
    </div>
    <!-- ./wrapper -->
</body>

</html>