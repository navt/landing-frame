    <div class="uk-container uk-margin-top uk-margin-large-bottom">
        <?php if (isset($this->sess->msg)): ?>
            <p class="uk-text-large uk-text-center">
                <?php echo $this->sess->msg; ?>
            </p>    
        <?php endif; ?>
        <form method="post" action="staff/insert/">
            <fieldset class="uk-fieldset uk-form-label">
                <label class="uk-form-label">e-mail</label>
                <div class="uk-margin">
                    <input class="uk-input uk-form-width-large" type="text" name="email" 
                           value="<?php if (isset($this->sess->msg)) {
                               echo $this->sess->inEmail;
                           }?>">
                </div>
                <label class="uk-form-label">Пароль</label>
                <div class="uk-margin">
                    <input class="uk-input uk-form-width-large" type="text" name="hash" 
                           value="<?php if (isset($this->sess->msg)) {
                               echo $this->sess->inHash;
                           }?>">
                </div>
                <label class="uk-form-label">Роль</label>
                <div class="uk-margin">
                    <select class="uk-select uk-form-width-large" name="role" >
                        <option selected disabled>Выберите роль</option>
                        <option>Administrator</option>
                        <option>Editor</option>
                    </select>
                </div>
                
            </fieldset>
            <button class="uk-button uk-button-primary uk-button-small">Сохранить</button>
            <a class="uk-button uk-button-primary uk-button-small" href="staff/all/">Отменить</a>
        </form>
        <?php $this->sess->msg = null; ?>
    </div>

