    <div class="uk-container uk-margin-top uk-margin-large-bottom">
        <?php if (isset($this->sess->msg)): ?>
            <p class="uk-text-large uk-text-center">
                <?php echo $this->sess->msg; ?>
            </p>    
        <?php endif; ?>
        <form method="post" action="staff/updatePass/">
            <fieldset class="uk-fieldset uk-form-label">
                <!-- id -->
                <input  type="hidden" name="id" value="<?php echo $id; ?>">
                <label class="uk-form-label">Новый пароль для <?php echo $email; ?></label>
                <div class="uk-margin">
                    <input class="uk-input uk-form-width-large" type="text" name="hash" value="">
                </div>
                
            </fieldset>
            <input name="token" type="hidden" value="<?php echo $this->user->token; ?>">
            <button class="uk-button uk-button-primary uk-button-small">Сохранить</button>
            <a class="uk-button uk-button-primary uk-button-small" href="staff/all/">Отменить</a>
        </form>
        <?php $this->sess->msg = null; ?>
    </div>

