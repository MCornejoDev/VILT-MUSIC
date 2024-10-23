<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
    $_SESSION['errors'] = [];
    $_SESSION['messages'] = [];
}
require_once __DIR__ . '/../vendor/autoload.php';
require_once __DIR__ . '/../config/app.php';
require_once __DIR__ . '/../resources/views/components/input/input.php'; ?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cornejo Music</title>
    <link rel="shortcut icon" href="<?= BASE_URL ?>/img/logo.ico" type="image/x-icon">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700&display=swap">
    <link rel="stylesheet" href="<?= BASE_URL ?>/css/app.min.css">
</head>

<body class="font-weight-bold">
    <? require_once __DIR__ . '/../resources/views/layouts/header.php'; ?>
    <div class="mt-10">
        <?php require_once __DIR__ . '/../app/autoloading.php'; ?>
    </div>
    <? require_once __DIR__ . '/../resources/views/layouts/footer.php'; ?>
</body>

<script type="module" src="<?= BASE_URL ?>/js/app.min.js"></script>

</html>