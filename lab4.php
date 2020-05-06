<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="style.css" rel="stylesheet" />
    <title>Brrraddy</title>
</head>

<body>
<div class = "main">

    <?php
// Запись регулярного выражения для формата DD.MM.YYYY с учётом того что день и месяц могут быть однозначными, а год двузначным.
        $exReg = "/(0?[1-9]|[1-2][0-9]|3[0-1])\.(0?[1-9]|1[0-2])\.([0-9]{4}|[0-9]{2})/";
// Запись регулярного выражения для формата MM/DD/YYYY с учётом того что день и месяц могут быть однозначными, а год двузначным.
        $otherReg = "/(0?[1-9]|1[0-2])\/(0?[1-9]|[1-2][0-9]|3[0-1])\/([0-9]{4}|[0-9]{2})/";
// Чтение текста из файла
        $buf = '';
        $fp = fopen('MyFile.html', 'r');
        while (!feof($fp)) {
            $buf .= fread($fp, 1);
        }
// Замена  формата MM/DD/YYYY на формат DD.MM.YYYY при помощи масок регулярного выражения
        $buf = preg_replace($otherReg,"<p style=\"color: red;\">$2.$1.$3</p>", $buf);
// Прибавление единицы к году
        $buf = preg_replace_callback($exReg,
            function($matches){
                return $matches[1] . '.' . $matches[2] . '.' . ($matches[3] + 1);
            },
            $buf
        );
//Подсветка
        $buf = preg_replace($exReg, "<p style=\"color: red;\">$0</p>", $buf);
        echo $buf;
        fclose($fp);
    ?>

</div>
</body>
</html>
