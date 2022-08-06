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
                  <h1>Danh sách quiz</h1>
                  <h6 class="m-2">Môn học: <i><?= $subject->name ?></i> </h6>
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
                            <th>Tên quiz</th>
                            <th>Thời gian làm bài(phút) </th>
                            <th>Bắt đầu/ kết thúc</th>
                            <th>Trạng thái</th>
                            <th>Thống kê điểm</th>
                            <th><a href="<?= BASE_URL ?>mon-hoc/quizs/tao-moi?subject_id=<?= $subject->id ?>"><i class="far fa-plus-square" aria-hidden="true"></i></a></th>
                          </tr>
                        </thead>
                        <tbody>
                          <?php foreach ($quizs as $item) : ?>
                            <tr>
                              <td><?= $index++ ?></td>
                              <td><?= $item->name ?></td>
                              <td><?= $item->duration_minutes ?></td>
                              <td style="list-style-type:none">
                                <li><?= $item->start_time ?></li>
                                <li><?= $item->end_time ?></li>
                              </td>
                              <td>
                                <?php if ($item->status == 1) { ?>
                                  <a href="" class="btn btn-success">Mở</a>
                                <?php  } else { ?>
                                  <a href="" class="btn btn-danger">Đóng</a>
                                <?php  } ?>
                              </td>
                              <td><a href="<?= BASE_URL?>chi-tiet-diem?quiz_id=<?= $item->id?>">Chi tiêt</a></td>
                              <td>
                                <a href="<?= BASE_URL ?>mon-hoc/cau-hoi?quiz_id=<?= $item->id ?>"> <i class="fas fa-external-link-alt"></i></a>
                                <a href="<?= BASE_URL ?>mon-hoc/quizs/cap-nhat?id=<?= $item->id ?>"><i class="fas fa-edit"></i></a>
                                <a href="<?= BASE_URL ?>mon-hoc/quizs/xoa?id=<?= $item->id ?>&subject_id=<?= $item->subject_id ?>"><i class="fas fa-trash"></i></a>
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
    </section>
  </div>
  <!-- /.content-wrapper -->
  <?php include_once "./app/views/admin/layout/script.php" ?>
  <!-- /.control-sidebar -->
  </div>
  <!-- ./wrapper -->
</body>

</html>