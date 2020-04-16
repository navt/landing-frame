    <div class="uk-container uk-margin-top uk-margin-large-bottom">
        <?php if (isset($this->sess->msg)): ?>
            <p class="uk-text-large uk-text-center">
                <?php echo $this->sess->msg; 
                    $this->sess->msg = null; ?>
            </p>    
        <?php endif; ?>
        <div class="add-any">    
            <form method="post" action="page/insert/">
                <fieldset class="uk-fieldset uk-form-label">
                    <label class="uk-form-label">ucode (латиница, цифры, _, начинается с буквы)</label>
                    <div class="uk-margin">
                        <input class="uk-input uk-form-width-large" type="text" name="ucode" value="">
                    </div>
                    <label class="uk-form-label">dictum (текстовый блок)</label>
                    <div class="uk-margin">
                        <textarea class="uk-textarea" rows="2" name="dictum"></textarea>
                    </div>
                </fieldset>
                <button class="uk-button uk-button-primary uk-button-small">Сохранить блок</button>
                <a class="uk-button uk-button-primary uk-button-small" href="page/blocks/">Отменить</a>
            </form>
        </div>    

        <button class="uk-button uk-button-default uk-button-small uk-margin" type="button" 
                uk-toggle="target: .add-any">Или добавить изображение</button>
        <div class="add-any" hidden>
            <form enctype="multipart/form-data" method="post" action="page/saveFile/">
                <fieldset class="uk-fieldset uk-form-label">
                    <label class="uk-form-label">ucode (латиница, цифры, _, начинается с буквы)</label>
                    <div class="uk-margin">
                        <input class="uk-input uk-form-width-large" type="text" name="ucode" value="">
                    </div>
                    <label class="uk-form-label">dictum (изображение)&nbsp;</label>
                    <div class="uk-margin">
                        <!-- Поле maxFileSize должно быть указано до поля загрузки файла -->
                        <input type="hidden" name="maxFileSize" value="50000000" />
                        <!-- Название элемента input определяет имя в массиве $_FILES -->
                        <input class="uk-form-small" name="userfile" type="file" />
                    </div>
                </fieldset>
                <button class="uk-button uk-button-primary uk-button-small">Сохранить изображение</button>
                <a class="uk-button uk-button-primary uk-button-small" href="page/blocks/">Отменить</a>
            </form>
        </div>
 
    </div>