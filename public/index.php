<?php
require_once __DIR__ . '/../vendor/autoload.php';
initSession();
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

<body>
    <div class="grid grid-flow-row auto-rows-max">
        <? require_once __DIR__ . '/../resources/views/layouts/header.php'; ?>
        <main class="mt-10">
            <?php require_once __DIR__ . '/../app/autoloading.php'; ?>
        </main>
        <? require_once __DIR__ . '/../resources/views/layouts/footer.php'; ?>
    </div>
</body>

<script type="module" src="<?= BASE_URL ?>/js/app.min.js"></script>

</html>