<?php
if (isset($_SESSION['user'])) {
    $userId = $_SESSION['user'];
}
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Task tracking</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css"
          integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
    <link rel="stylesheet" href="/template/css/app.css">
    <!--Подключаем библиотеку jQuery-->
    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1/jquery.min.js"></script>
</head>
<body>
<nav class="navbar navbar-default navbar-fixed-top">
    <div class="container">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar"
                    aria-expanded="false" aria-controls="navbar">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="/">Task Tracking</a>
        </div>
        <div id="navbar" class="navbar-collapse collapse">
            <ul class="nav navbar-nav mr-auto">
                <li><a href="/task/create">Create New Task</a></li>

            </ul>
            <?php if (!isset($userId)) : ?>
                <span><a href="/signin">Sign in</a></span>
            <?php else: ?>
                <!-- Show Name if admin is logged in -->
                <span>Здравствуйте, admin!</span>
                <p><a href="/logOut">Exit</a></p>
            <?php endif; ?>
        </div>
    </div>
</nav>
