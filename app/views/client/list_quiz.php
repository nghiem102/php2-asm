<!doctype html>
<html lang="en">

<head>
    <title>Title</title>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
</head>

<body>
    <div class="container">
        <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
            <a class="navbar-brand" href="#"><img src="<?= BASE_URL ?>public/image/logofpt.png" width="150px" alt=""></a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav mr-auto">
                    <li class="nav-item active">
                        <a class="nav-link bg-light text-dark rounded-circle" href="<?= BASE_URL ?>homepage">Môn học <span class="sr-only">(current)</span></a>
                    </li>
                </ul>
                <form class="form-inline my-2 my-lg-0">
                    <input class="form-control mr-sm-2" type="text" placeholder="Search" aria-label="Search">
                    <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button>
                </form>
            </div>
        </nav>
        <section class="m-4">
            <div class="row">
                <div class="alert alert-success col-12" role="alert">
                    <h4 class="alert-heading"> Danh sách quiz môn <?= $subject->name ?></h4>
                </div>
            </div>
            <div class="row">

                <?php foreach ($quizs as $item) : ?>
                    <div class="card col-6">
                        <div class="card-body">
                            <h4 class="card-title"><?= $item->name ?></h4>
                            <h6 class="card-subtitle mb-2 text-muted"> Thời gian làm bài: <?= $item->duration_minutes ?> phút</h6>
                            <h6 class="card-subtitle mb-2 text-muted"> Bắt đầu: <?= $item->start_time ?> </h6>
                            <h6 class="card-subtitle mb-2 text-muted"> Kết thúc: <?= $item->end_time ?> </h6>
                            <a href="<?= BASE_URL ?>client-exam-quiz?quiz_id=<?= $item->id ?>" class="btn btn btn-primary <?= $item->status == 0 ? "disabled" : "" ?>">Bắt đầu</a>
                        </div>
                    </div>
                <?php endforeach ?>
            </div>

        </section>
    </div>
    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
</body>

</html>