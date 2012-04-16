<div class="loginWrapper">
    <div class="loginLogo"><img src="/images/backend/loginLogo.png" alt="" /></div>
    <div class="nNote nFailure hideit" id="loginErrorPanel" style="display: none">
        <p><strong>ACESSO NEGADO!</strong>Usuário/Senha inválidos.</p>
    </div>
    <div class="widget">
        <div class="title"><img src="/images/backend/icons/dark/files.png" alt="" class="titleIcon" /><h6 id="headerTitle">Identificação</h6><h5 id="indicator">processando, aguarde...</h5></div>
		<?php echo form_tag('login/login', array('class'=>'form', 'onsubmit'=>'doLogin(); return false', 'id'=>'loginForm')); ?>
            <fieldset>
                <div class="formRow">
                    <label for="login">Usuário:</label>
                    <div class="loginInput"><input type="text" name="username" class="validate[required]" id="username" /></div>
                    <div class="clear"></div>
                </div>
                
                <div class="formRow">
                    <label for="pass">Senha:</label>
                    <div class="loginInput"><input type="password" name="password" class="validate[required]" id="password" /></div>
                    <div class="clear"></div>
                </div>
                
                <div class="loginControl">
                    <div class="rememberMe"><input type="checkbox" id="remMe" name="remMe" /><label for="remMe">Lembrar de mim</label></div>
                    <input type="submit" value="Entrar" class="dredB logMeIn" />
                    <div class="clear"></div>
                </div>
            </fieldset>
        </form>
    </div>
</div>
