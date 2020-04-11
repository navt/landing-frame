    <div class="uk-container uk-margin-top uk-margin-large-bottom">
        <?php if (isset($this->sess->msg)): ?>
            <p class="uk-text-large uk-text-center">
                <?php echo $this->sess->msg; ?>
            </p>    
        <?php endif; ?>
        <div class="uk-child-width-expand" uk-grid>
            <div>&nbsp;</div>
            <div>
                <form method="post" action="staff/index/">
                    <fieldset class="uk-fieldset uk-form-label">
                        <label class="uk-form-label">Логин</label>
                        <div class="uk-margin">
                            <input class="uk-input uk-width-1-1" type="text" name="login" 
                               value="<?php if (isset($this->sess->msg)) {
                                   Hlp::html($this->sess->inEmail);
                               }?>">
                        </div>
                        <label class="uk-form-label">Пароль</label>
                        <div class="uk-margin">
                            <input class="uk-input uk-input uk-width-1-1" type="text" name="password" 
                               value="<?php if (isset($this->sess->msg)) {
                                   Hlp::html($this->sess->inPass);
                                   $this->sess->msg = null;
                               }?>">
                        </div>
                    </fieldset>
                    <button class="uk-button uk-button-primary uk-button-small" name="button" value="comein">
                        Войти
                    </button>
                </form>
            </div>    
            <div>&nbsp;</div>
        </div>
    </div>
