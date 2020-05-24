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
        <div class="uk-container uk-margin-top uk-margin-bottom">
            <h1><?php echo $h1;?></h1>
            <!-- вывод блока текста -->
            <p><?php echo $readme;?></p>
            
            <h4>Картинка</h4>
            <!-- вывод изображения -->
            <p><?php Hlp::img($image_dog, ["title"=>"Собака"]); ?></p>
            <div uk-lightbox>
                <?php Hlp::a($a_image_dog,["class"=>"uk-button uk-button-default uk-button-small"]); ?>
            </div>
            
            <!-- так в шаблон можно включить элементы разметки из другого файла-->
            <?php include BDIR."/view/templates/front/link.php"; ?>
            
            <h4>Заказать обратный звонок</h4>
            <!-- заготовка формы -->
            <form method="post" action="main/dummy/">
                <label class="uk-form-label">Введите ваш телефон. &nbsp;</label>
                <input class="uk-input uk-form-small uk-form-width-medium" type="text" name="phone" >&nbsp; 
                <button class="uk-button uk-button-primary uk-button-small" name="button" value="send">
                    Заказать
                </button>
            </form>
            <p class="uk-text-center">&COPY; <?php echo date("Y")." ".$company;?> </p>
        </div>
    </body>
</html>