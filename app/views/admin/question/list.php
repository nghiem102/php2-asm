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
                                    <h1>Danh sách câu hỏi</h1>
                                    <h6 class="m-2"> <i><?= $subject->name . '/' . $quiz->name ?></i> </h6>
                                </div>
                            </div>
                        </div><!-- /.container-fluid -->
                    </section>
                    <section class="content">
                        <div class="container-fluid">
                            <div class="row">
                                <table class="ml-3">
                                    <tr>
                                        <td>Thời gian làm bài:</td>
                                        <td><?= $quiz->duration_minutes ?> phút</td>
                                    </tr>
                                    <tr>
                                        <td>Thời gian bắt đầu:</td>
                                        <td><?= $quiz->start_time ?></td>
                                    </tr>
                                    <tr>
                                        <td>Thời gian kết thúc:</td>
                                        <td><?= $quiz->end_time ?></td>
                                    </tr>
                                </table>
                            </div>
                        </div>
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
                                                        <th>Câu hỏi</th>
                                                        <th>Đáp án</th>
                                                        <th>
                                                            <a href="<?= BASE_URL ?>mon-hoc/cau-hoi/them-moi?quiz_id=<?= $quiz->id ?>"><i class="fa fa-plus-square"></i></a>
                                                        </th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <?php foreach ($question as $item) : ?>
                                                        <tr>
                                                            <td><?= $index++ ?></td>
                                                            <td><?= $item->name ?></td>
                                                            <td>
                                                                <ul style="list-style-type: lower-alpha;">
                                                                    <?php foreach ($answer as  $value) { ?>
                                                                        <?php if ($item->id === $value->question_id) { ?>
                                                                            <li style="color:<?= $value->is_correct == 1 ? "green" : "red" ?>">
                                                                                <?= $value->content ?>
                                                                            </li>
                                                                        <?php } ?>
                                                                    <?php } ?>
                                                                </ul>
                                                            </td>
                                                            <td>
                                                                <a href="<?= BASE_URL ?>mon-hoc/cau-hoi/xoa?quiz_id=<?= $quiz->id ?>&question_id=<?= $item->id ?>"><i class="fas fa-trash"></i></a>
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