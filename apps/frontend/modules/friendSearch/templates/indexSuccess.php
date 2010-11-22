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
    
		<?php include_partial('friendSearch/include/inviteForm', array('peopleName'=>$peopleName, 'emailAddress'=>$emailAddress)) ?>
    
	    <?php
			echo form_tag('friendSearch/search', array('id'=>'friendSearchForm', 'onsubmit'=>'doSearchFriends(); return false'));
				echo input_hidden_tag('isIE', null);
		?>
	    <div id="searchDiv">
	    	<table width="500" border="0" cellspacing="1" cellpadding="0">
		      <tr class="rank_heading">
		        <td>Username</td>
		        <td>E-mail</td>
		      </tr>
		      <tr class="rank_heading">
		        <td><?php echo input_tag('username', null, array('size'=>25, 'autocomplete'=>'off')) ?></td>
		        <td><?php echo input_tag('emailAddress', null, array('size'=>35, 'autocomplete'=>'off')) ?></td>
		      </tr>
		      <tbody id="friendSearchContent">
		      <?php
				include_partial('friendSearch/include/search', array('criteria'=>$criteria));
		      ?>
		      </tbody>
		    </table>
		</div>
		</form>
	</td>
  </tr>
</table>
<div class="buttonBarForm" id="friendSearchButtonBar" style="border: 0px transparent">
	<?php echo button_tag('friendFilterSubmit', 'Procurar amigos', array('onclick'=>'doSearchFriends()')) ?>
	<?php echo getFormLoading('event') ?>
</div>