    <div class="uk-container uk-margin-top uk-margin-large-bottom">
        <p class="uk-text-large uk-text-center">Пользователи</p>
        <nav class="uk-navbar-container" uk-navbar>
            <div class="uk-navbar-left">
                <ul class="uk-navbar-nav">
                    <li><a href="staff/create/">Создать польователя</a></li>
                    <li><a href="page/blocks/">Блоки текста</a></li>
                    <li><a href="staff/logout/">Выход</a></li>
                </ul>
            </div>
        </nav>
        <table class="uk-table">
            <caption>Общая таблица: идентификатор, e-mail, хеш пароля, роль</caption>
            <thead>
                <tr>
                    <th>id</th>
                    <th>email</th>
                    <th>hash</th>
                    <th>role</th>
                    <th>services</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($users as $user): ?>
                <tr>
                    <td><?php echo $user["id"];?></td>
                    <td><?php echo $user["email"];?></td>
                    <td><?php echo $user["hash"];?></td>
                    <td><?php echo $user["role"];?></td>
                    <td>
                        <a href="/staff/edit/<?php echo $user["id"];?>" class="uk-icon-link uk-margin-small-right" uk-icon="file-edit" title="Редактировать"></a>
                        <a href="/staff/refresh/<?php echo $user["id"];?>" class="uk-icon-link" uk-icon="refresh" title="Изменить пароль"></a>
                        <form style="display: inline;" method="post" action="staff/delete/">
                            <input name="id" type="hidden" value="<?php echo $user["id"];?>">
                            <button class="uk-button uk-button-link" uk-icon="trash" title="Удалить"></button>
                        </form>
                    </td>
                </tr>
                <?php endforeach;?>
            </tbody>
        </table>
    </div>    

