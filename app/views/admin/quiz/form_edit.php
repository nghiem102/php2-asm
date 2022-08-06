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

                    <section class="content">
                        <div class="container-fluid">
                            <div class="row">
                                <div class="col-md-8">
                                    <div class="card ">
                                        <div class="card-header">
                                            <h1 class="card-title">Sửa quiz</h1>
                                            <br>
                                        </div>
                                        <h6 class="m-4">Môn học: <i><?= $subject->name ?></i></h6>

                                        <form id="quickForm" method="post" action="<?= BASE_URL ?>mon-hoc/quizs/luu-cap-nhat">

                                            <input type="hidden" name="subject_id" value="<?= $subject->id ?>">
                                            <input type="hidden" name="quiz_id" value="<?= $quiz->id ?>">
                                            <div class="card-body">
                                                <div class="form-group">
                                                    <label for="name">Tên quiz</label>
                                                    <input type="text" name="name" class="form-control" id="name" value="<?= $quiz->name ?>">
                                                </div>
                                                <div class="form-group">
                                                    <label for="name">Thời gian (phút)</label>
                                                    <input type="text" name="duration" class="form-control" id="duration" value="<?= $quiz->duration_minutes ?>">
                                                </div>
                                                <?php
                                                $start = new DateTime($quiz->start_time);
                                                $start_time = $start->format('Y-m-d\TH:i:s');
                                                $end = new DateTime($quiz->end_time);
                                                $end_time = $end->format('Y-m-d\TH:i:s');
                                                ?>
                                                <div class="form-group">
                                                    <label for="name">Thời gian bắt đầu</label>
                                                    <input type="datetime-local" name="start_time" class="form-control" id="start_time" value="<?= $start_time ?>">
                                                </div>
                                                <div class="form-group">
                                                    <label for="name">Thời gian kết thúc</label>
                                                    <input type="datetime-local" name="end_time" class="form-control" id="end_time" value="<?= $end_time ?>">
                                                </div>
                                                <div class="form-group">
                                                    <label for="name">Trạng thái</label>
                                                    <select class="form-control" name="status">
                                                        <option value="1" <?= $quiz->status == 1 ? 'selected' : "" ?>>Mở</option>
                                                        <option value="0" <?= $quiz->status == 0 ? 'selected' : "" ?>>Đóng</option>
                                                    </select>
                                                </div>
                                                <div class="form-group">
                                                    <label for="name">Đảo câu</label>
                                                    <select class="form-control" name="shuffle">
                                                        <option value="1" <?= $quiz->is_shuffle == 1 ? 'selected' : "" ?>>Có</option>
                                                        <option value="0" <?= $quiz->is_shuffle == 0 ? 'selected' : "" ?>>Không</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="card-footer">
                                                <input type="hidden" name="author_id" value="<?= $_SESSION['user']['id'] ?>">
                                                <button type="submit" class="btn btn-success">Sửa</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                </div>
                            </div>
                        </div>
                    </section>
                    <!-- /.content -->
                </div>
                <!-- /.content-wrapper -->
                <?php include_once "./app/views/admin/layout/script.php" ?>
            </div>
            <!-- ./wrapper -->
</body>

</html>