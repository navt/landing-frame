    <div class="uk-container uk-margin-top uk-margin-large-bottom">
        <p class="uk-text-large uk-text-center">Страница всех блоков текста.</p>
        <nav class="uk-navbar-container" uk-navbar>
            <div class="uk-navbar-left">
                <ul class="uk-navbar-nav">
                    <li><a href="page/create/">Создать блок</a></li>
                    <li><a href="staff/all/">Пользователи</a></li>
                    <li><a href="main/">Главная</a></li>
                    <li><a href="staff/logout/">Выход</a></li>
                </ul>
            </div>
        </nav>

        <table class="uk-table">
            <caption>Общая таблица: идентификатор, уникальный код, блок текста</caption>
            <thead>
                <tr>
                    <th>id</th>
                    <th>ucode</th>
                    <th>dictum</th>
                    <th>services</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($blocks as $block): ?>
                <tr>
                    <td><?php echo $block["id"];?></td>
                    <td><?php echo $block["ucode"];?></td>
                    <td><?php 
                            if (strpos($block["dictum"], "src=") !== false) {
                                Hlp::img($block["dictum"], ["width"=>"200"]);
                            } elseif (strpos($block["dictum"], "href=") !== false) {
                                Hlp::a($block["dictum"]);
                            } else {
                                echo $block["dictum"];
                            }?>
                    </td>
                    <td>
                        <a href="/page/edit/<?php echo $block["id"];?>" class="uk-icon-link uk-margin-small-right" uk-icon="file-edit" title="Редактировать"></a>
                        <form style="display: inline;" method="post" action="page/delete/">
                            <input name="id" type="hidden" value="<?php echo $block["id"];?>">
                            <button class="uk-button uk-button-link" uk-icon="trash" title="Удалить"></button>
                        </form>
                    </td>
                </tr>
                <?php endforeach;?>
            </tbody>
        </table>
    </div>