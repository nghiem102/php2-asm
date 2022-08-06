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
                                            <h1 class="card-title">Thêm câu hỏi</h1>
                                            <br>
                                        </div>
                                        <h6 class="m-4"><i><?= $subject->name ?>/<?= $quiz->name ?></i></h6>
                                        <div class="card-body">
                                            <form action="<?= BASE_URL ?>mon-hoc/cau-hoi/luu-them-moi" method="post" enctype="multipart/form-data">
                                                <div class="form-group">
                                                    <label for="question">Câu hỏi:</label>
                                                    <textarea name="question" id="question"  class="form-control"  rows="5"></textarea>
                                                    <div>
                                                        Hoặc
                                                    </div>
                                                    <div class="custom-file">
                                                        <input type="file" name="image_question" class="custom-file-input" id="customFile">
                                                        <label class="custom-file-label" for="customFile">Choose file</label>
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label for="question">Câu trả lời:</label>
                                                    
                                                    <table class="table text-center">
                                                        <thead>
                                                            <tr>
                                                                <th>#</th>
                                                                <th colspan="1">Đáp án</th>
                                                                <th>Đúng</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody id="input_option_mulit">
                                                            <tr class="tr_option_input">
                                                                <td>1</td>
                                                                <td><input type="text" name="answer[]" class="answer" required></td>
                                                                <!-- <td><input type="file" name="image_answer[]" class="image_answer"></td> -->
                                                                <td><input type="radio" name="is_correct[]" value="0"></td>
                                                            </tr>
                                                        </tbody>
                                                        <tfoot>
                                                            <tr>
                                                                <input type="hidden" name="quiz_id" value="<?= $quiz->id ?>">
                                                                <td colspan="3">
                                                                <button id="add_tr_answer" type="button" class="btn btn-primary ml-5">Thêm đáp án</button>
                                                                </td>
                                                            </tr>
                                                        </tfoot>
                                                    </table>
                                                </div>
                                                <button type="submit" class="btn btn-success">Thêm</button>

                                            </form>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                </div>
                            </div>
                        </div>
                    </section>
                </div>
                <!-- /.content-wrapper -->

                <!-- /.control-sidebar -->

            </div>
            <!-- ./wrapper -->
            <?php include_once "./app/views/admin/layout/script.php" ?>
            <script>
                $("#add_tr_answer").click(function() {
                    count_tr = $(".tr_option_input").length;
                    console.log(count_tr);
                    $("tbody#input_option_mulit").append(`
                    <tr class="tr_option_input">
                        <td>${count_tr+1}</td>
                        <td><input type="text" name="answer[]" class="answer" required></td>
                        <td><input type="radio" name="is_correct[]" value="${count_tr}"></td>
                    </tr>
                    `)
                })
            </script>
</body>

</html>