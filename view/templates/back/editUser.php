    <div class="uk-container uk-margin-top uk-margin-large-bottom">
        <?php if (isset($this->sess->msg)): ?>
            <p class="uk-text-large uk-text-center">
                <?php echo $this->sess->msg; ?>
            </p>    
        <?php endif; ?>
        <form method="post" action="staff/update/">
            <fieldset class="uk-fieldset uk-form-label">
                <!-- id -->
                <input  type="hidden" name="id" value="<?php echo $id; ?>">
                <label class="uk-form-label">e-mail</label>
                <div class="uk-margin">
                    <input class="uk-input uk-form-width-large" type="text" name="email" 
                           value="<?php echo $email; ?>">
                </div>
                <!--Пароль-->
                <input  type="hidden" name="hash" value="<?php echo $hash; ?>">
                <label class="uk-form-label">Роль</label>
                <div class="uk-margin">
                    <select class="uk-select uk-form-width-large" name="role" >
                        <option selected disabled>Выберите роль</option>
                        <option>Administrator</option>
                        <option>Editor</option>
                    </select>
                </div>
                
            </fieldset>
            <input name="token" type="hidden" value="<?php echo $this->user->token; ?>">
            <button class="uk-button uk-button-primary uk-button-small">Сохранить</button>
            <a class="uk-button uk-button-primary uk-button-small" href="staff/all/">Отменить</a>
        </form>
        <?php $this->sess->msg = null; ?>
    </div>

