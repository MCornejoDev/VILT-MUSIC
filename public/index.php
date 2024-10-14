<?php
session_start();
require __DIR__ . '/../vendor/autoload.php';
require __DIR__ . '/../config/app.php';
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cornejo Music</title>
    <link rel="shortcut icon" href="<?= BASE_URL ?>/img/logo.png" type="image/x-icon">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.2/css/all.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700&display=swap">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.4.1/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/mdbootstrap/4.14.1/css/mdb.min.css" rel="stylesheet">
    <link rel="stylesheet" href="<?= BASE_URL ?>/css/app.min.css">
</head>

<body class="font-weight-bold">
    <? require_once __DIR__ . '/../resources/views/layouts/header.php'; ?>
    <div class="mb-5 container-fluid">
        <div class="row">
            <?php require_once __DIR__ . '/../app/autoloading.php'; ?>
        </div>
    </div>
    <? require_once __DIR__ . '/../resources/views/layouts/footer.php'; ?>
</body>

<script type="module" src="<?= BASE_URL ?>/js/app.min.js"></script>

</html>