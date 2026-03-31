<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Required Meta Tags Always Come First -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Title -->
    <title>Hello, world!</title>

    <!-- Favicon -->
    <link rel="shortcut icon" href="<?= base_url('assets/img/icon.png') ?>">

    <!-- Font -->
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500;700&display=swap" rel="stylesheet">

    <!-- CSS Front Template -->
    <link rel="stylesheet" href="<?= base_url('assets/css/theme.min.css') ?>">
</head>

<body>
    <main id="content" role="main" class="main">
        <!-- Content -->
        <div class="content container-fluid">
            <div class="row justify-content-center align-items-sm-center py-sm-10">
                <div class="col-9 col-sm-6 col-lg-4">
                    <div class="text-center text-sm-end me-sm-4 mb-5 mb-sm-0">
                        <img class="img-fluid" src="<?= base_url('assets/svg/illustrations/oc-thinking.svg') ?>" alt="Image Description">
                    </div>
                </div>
                <!-- End Col -->

                <div class="col-sm-6 col-lg-4 text-center text-sm-start">
                    <h1 class="display-1 mb-0">404</h1>
                    <p class="lead">Maaf, halaman yang Anda cari tidak ditemukan.</p>
                    <a class="btn btn-primary" href="<?= base_url() ?>">Halaman Utama</a>
                </div>
                <!-- End Col -->
            </div>
            <!-- End Row -->
        </div>
        <!-- End Content -->

        <!-- Footer -->

        <div class="footer">
            <div class="row justify-content-between align-items-center">
                <div class="col">
                    <p class="fs-6 mb-0">&copy; Copyright. <span class="d-none d-sm-inline-block"><?= date('Y') ?> Damai Jaya - Super App.</span></p>
                </div>
                <!-- End Col -->
            </div>
            <!-- End Row -->
        </div>

        <!-- End Footer -->
    </main>

    <!-- JS Global Compulsory -->
    <script src="<?= base_url('assets/vendor/bootstrap/dist/js/bootstrap.bundle.min.js') ?>"></script>

    <!-- JS Front Dashboard -->
</body>

</html>