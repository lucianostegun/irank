<table width="100%" border="0" cellspacing="0" cellpadding="0" class="onlinepokerrooms_bg2">
  <tr>
	<td align="left" valign="middle" class="poker_heading">
		<?php echo image_tag('frontend/layout/bullet.gif') ?>Encontrar amigos</td>
  </tr>
  <tr>
    <td align="left" valign="top" style="padding:15px 23px 16px 20px;">
		Quer encontrar seus amigos e incluí-los em seus rankings?<br/>
		Simples, você pode localizar usuários já cadastrados em nosso site pesquisando
		pelo username ou e-mail de seu amigo.<br/><br/>
		E lembre-se, caso você não os encontre você pode convidá-los para juntar-se a você
		em seus eventos.
    </td>
  </tr>
  <tr>
    <td align="left" valign="top" style="padding:15px 23px 16px 20px;">
	    <?php
			echo form_tag('friendSearch/search', array('id'=>'friendSearchForm', 'onsubmit'=>'doSearchFriends(); return false'));
		?>
	    <div id="searchDiv">
	    	<table width="500" border="0" cellspacing="1" cellpadding="0">
		      <tr class="rank_heading">
		        <td>Username</td>
		        <td>E-mail</td>
		        <td>Membro desde</td>
		      </tr>
		      <?php
				include_partial('friendSearch/include/search', array('criteria'=>$criteria));
		      ?>
		    </table>
		</div>
		<br/>
		*As pesquisas são limitadas a 20 resultados e não exibem o e-mail completo do usuário
		</form>
	</td>
  </tr>
</table>