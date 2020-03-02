<hmtl>
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"
              integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T"
              crossorigin="anonymous">
        <link rel="stylesheet"  href="/<?=APP_ROOT?>/public/css/styles.css">
        <title>Library</title>
    </head>
    <body>
    <div id="wrapper" class="col-md-12">
        <nav class="navbar navbar-expand-sm navbar-light">
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link" href="/<?= APP_ROOT ?>/books/index">Home</a>
                </li>

                <?php if (isset($_SESSION['user_id'])): ?>
                    <li class="nav-item">
                        <a class="nav-link" href="/<?= APP_ROOT ?>/books/my">My books</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="/<?= APP_ROOT ?>/users/edit">My profile</a>
                    </li>
                <?php endif ?>

                <?php
                if (isset($_SESSION['is_admin'])): ?>
                    <li class="nav-item">
                        <a href='/<?= APP_ROOT ?>/users/view' class="nav-link btn">Users</a>
                    </li>
                <?php endif ?>

                <?php if (isset($_SESSION['user_id'])): ?>
                    <li class="nav-item">
                        <a href='/<?= APP_ROOT ?>/users/logout' class="nav-link btn">Logout</a>
                    </li>
                <?php endif ?>

            </ul>
        </nav>

<?php
include('flash_messages.php');
?>