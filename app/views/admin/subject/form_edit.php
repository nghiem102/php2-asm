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
    <section class="content">
      <div class="container-fluid">
        <div class="content-wrapper">
          <section class="content">
            <div class="container-fluid">
              <div class="row">
                <!-- left column -->
                <div class="col-md-8">
                  <!-- jquery validation -->
                  <div class="card ">
                    <div class="card-header">
                      <h3 class="card-title">Sửa môn học</h3>
                    </div>
                    <!-- /.card-header -->
                    <!-- form start -->
                    <form id="quickForm" method="post" action="<?= BASE_URL ?>mon-hoc/luu-cap-nhat">
                      <div class="card-body">
                        <?php if (isset($msg)) {
                          echo $msg;
                        } ?>
                        <div class="form-group">
                          <label for="name">Tên môn học</label>
                          <input type="text" name="name" class="form-control" value="<?= $subject->name ?>" id="name" placeholder="Tên">
                        </div>
                      </div>
                      <!-- /.card-body -->
                      <div class="card-footer">
                        <input type="hidden" name="author_id" value="<?= $_SESSION['user']['id'] ?>">
                        <input type="hidden" name="id" value="<?= $_GET['id'] ?>">
                        <button type="submit" class="btn btn-success">Thêm</button>
                      </div>
                    </form>
                  </div>
                  <!-- /.card -->
                </div>
                <!--/.col (left) -->
                <!-- right column -->
                <div class="col-md-6">

                </div>
                <!--/.col (right) -->
              </div>
              <!-- /.row -->
            </div><!-- /.container-fluid -->
          </section>
        </div>
        <!-- /.content-wrapper -->
        <?php include_once "./app/views/admin/layout/script.php" ?>
        <!-- /.control-sidebar -->
      </div>
      <!-- ./wrapper -->
</body>

</html>