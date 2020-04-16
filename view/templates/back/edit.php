    <div class="uk-container uk-margin-top uk-margin-large-bottom">
        <form method="post" action="page/update/">
            <fieldset class="uk-fieldset uk-form-label">
                <input  type="hidden" name="id" value="<?php echo $id;?>">
                <label class="uk-form-label">ucode</label>
                <div class="uk-margin">
                    <input class="uk-input uk-form-width-large" type="text" name="ucode" value="<?php echo $ucode;?>">
                </div>
                <label class="uk-form-label">dictum</label>
                <div class="uk-margin">
                    <textarea class="uk-textarea" rows="5" name="dictum"><?php echo $dictum;?></textarea>
                </div>
            </fieldset>
            <button class="uk-button uk-button-primary uk-button-small">Сохранить</button>
            <a class="uk-button uk-button-primary uk-button-small" href="page/blocks/">Отменить</a>
        </form>
    </div>

