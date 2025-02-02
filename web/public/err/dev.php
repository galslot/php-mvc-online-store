<?php
    /**
     * @var $errno \wfm\ErrorHandler
     * @var $errstr \wfm\ErrorHandler
     * @var $errfile \wfm\ErrorHandler
     * @var $errline \wfm\ErrorHandler
     */
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Ошибка</title>
</head>
<body>

    <h1>Произошла ошибка</h1>

    <h5><b>Код ошибки:</b> <?= $errno ?></h5>
    <h5><b>Текст ошибки:</b> <?= $errstr ?></h5>
    <h5><b>Файл:</b> <?= $errfile ?></h5>
    <h5><b>Строка:</b> <?= $errline ?></h5>

</body>
</html>


