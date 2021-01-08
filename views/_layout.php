<!DOCTYPE html>
<html>
<head>
    <title>Задачник</title>
    <link rel="stylesheet" href="/css/bootstrap.css">
    <link rel="stylesheet" href="/css/main.css?v=2">
    <script src="/js/jquery.js"></script>
    <script src="/js/bootstrap.min.js"></script>
    <script src="/js/main.js?v=1"></script>
</head>
<body>
<div class="container">
    <?php if(!\lib\App::$isAdmin): ?>
    <a href="?r=admin">Войти как администратор</a>
    <?php else: ?>
    <a href="?r=admin/logout">Выйти</a>
    <?php endif; ?>
    <?= $content ?>
</div>
</body>
</html>

