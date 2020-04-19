<!DOCTYPE html>
<html>
    <head>
        <title><?php echo $title;?></title>
        <base href="<?php echo BURI;?>">
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="description" content="<?php echo $description;?>" />
        <meta name="keywords" content="<?php echo $keywords;?>" />
        <link rel="stylesheet" href="view/css/uikit.min.css" />
        <script src="view/js/uikit.min.js"></script>
        <script src="view/js/uikit-icons.min.js"></script>
    </head>
    <body>
        <div class="uk-container">
            <h1><?php echo $h1;?></h1>
            <!-- вывод блока текста -->
            <p><?php echo $readme;?></p>
            <!-- вывод изображения -->
            <p><?php Hlp::img($image_dog, ["title"=>"Собака"]); ?></p>
            <!-- вывод ссылки на скачивание файла -->
            <p><?php Hlp::a($hello); ?></p>
            <p class="uk-text-center">&COPY; <?php echo date("Y")." ".$company;?> </p>
        </div>
    </body>
</html>