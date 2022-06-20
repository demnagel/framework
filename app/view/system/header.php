<!doctype html>
<html lang="ru">
<head>
    <meta charset="utf-8" />
    <title></title>
    <link rel="stylesheet" href="/assets/css/main.css" />
    <script src="https://code.jquery.com/jquery-latest.min.js"></script>
    <script src="/assets/js/script.js"></script>
</head>
<body>
<section class="wrapper">
<? \App\Core\View::renderFile('/template/auth', [], ['/user/registration' , '/user/login']); ?>