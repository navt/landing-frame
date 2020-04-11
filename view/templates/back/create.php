    <div class="uk-container uk-margin-top uk-margin-large-bottom">
        <?php if (isset($this->sess->msg)): ?>
            <p class="uk-text-large uk-text-center">
                <?php echo $this->sess->msg; 
                    $this->sess->msg = null; ?>
            </p>    
        <?php endif; ?>
        <form method="post" action="page/insert/">
            <fieldset class="uk-fieldset uk-form-label">
                <label class="uk-form-label">ucode (латиница, цифры, _, начинается с буквы)</label>
                <div class="uk-margin">
                    <input class="uk-input uk-form-width-large" type="text" name="ucode" value="">
                </div>
                <label class="uk-form-label">dictum</label>
                <div class="uk-margin">
                    <textarea class="uk-textarea" rows="2" name="dictum"></textarea>
                </div>
            </fieldset>
            <button class="uk-button uk-button-primary uk-button-small">Сохранить</button>
            <a class="uk-button uk-button-primary uk-button-small" href="page/blocks/">Отменить</a>
        </form>
    </div>

