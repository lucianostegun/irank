<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
<?php
include_http_metas();
include_metas();
include_title();

$moduleName = $sf_context->getModuleName();
?>
<script>
	var _webRoot = '<?php echo $sf_request->getScriptName() ?>';
	var _isDebug = <?php echo (Util::isDebug()?'true':'false') ?>;
</script>
</head>

<body>
	<div id="debugDiv"></div>
<table width="100%" border="0" align="center" cellpadding="0" cellspacing="0">
  <tr>
    <td align="center" valign="top" class="header_bg"><table width="950" border="0" cellspacing="0" cellpadding="0">
      <tr>

        <td width="230" align="left" valign="top" style="padding:25px 20px 0px 18px;"><?php echo link_to(image_tag('frontend/layout/logo'), '/home') ?></td>
        <td width="380" align="left" valign="top"><img src="/images/frontend/layout/header_img.png" alt="" width="380" height="156" /></td>
        <td align="left" valign="middle">
        <table width="324" border="0" cellspacing="4" cellpadding="0">
          <tr>
            <td width="68" align="left" valign="top">
				<div id="quickLogin">
					<div class="middle" id="quickLoginContent">
						<?php
							if( MyTools::isAuthenticated() )
								include_partial('login/include/userMenu');
							else
								include_partial('login/include/quickLogin');
						?>
					</div>
					<div class="base"></div>
				</div>
            </td>
          </tr>
        </table>
        </td>
      </tr>
    </table></td>
  </tr>
  <tr>
    <td height="79" align="center" valign="top" class="menu_bg menu" style="padding-top:18px;"><table width="950" border="0" cellspacing="0" cellpadding="0">
      <tr>
        <td align="center" valign="top">
        <table width="100%" border="0" cellspacing="0" cellpadding="0">
          <tr>
            <td align="center" valign="middle" class="border_menu_right"><?php echo link_to('Home', 'home') ?></td>
            <td align="center" valign="middle" class="border_menu_right border_menu_right"><?php echo link_to('Cadastro', 'sign') ?></td>
            <td align="center" valign="middle" class="border_menu_right border_menu_right"><?php echo link_to('Meu ranking', 'ranking') ?></td>
            <td align="center" valign="middle" class="border_menu_right border_menu_right"><?php echo link_to('Convidar amigos', 'friendInvite') ?></td>
            <td align="center" valign="middle" class="border_menu_right border_menu_right"><?php echo link_to('Feedback', 'feedback') ?></td>
            <td align="center" valign="middle" class="border_menu_right"><?php echo link_to('Contato', 'contact') ?></td>
          </tr>
        </table>
        </td>
      </tr>
    </table></td>
  </tr>
  <tr>
    <td align="center" valign="top">
		<table width="950" border="0" cellspacing="0" cellpadding="0">
		      <tr>
		        <td width="200" align="left" valign="top" style="padding-right:10px">
		        	<?php include_partial('home/include/mainMenu') ?>
		        </td>
		        <td width="740" align="left" valign="top">
		        	<?php echo $sf_content ?>
		        </td>
		      </tr>
		    </table>
    </td>
  </tr>
  <tr>
    <td height="27" align="center" valign="top"></td>
  </tr>
  <tr>

    <td height="111" align="center" valign="top" class="footer" style="padding-top:23px;"><table width="950" border="0" cellspacing="0" cellpadding="0">
      <tr>
        <td align="center" valign="top">
        	<?php echo link_to('home', '/') ?> | 
        	<?php echo link_to('cadastro', '/sign') ?> | 
        	<?php echo link_to('meu ranking', '/ranking') ?> | 
        	<?php echo link_to('convidar amigos', '/friendInvite') ?> | 
        	<?php echo link_to('contato', '/contact') ?> | 
        </td>
      </tr>
    </table></td>
  </tr>
</table> 

<!-- Begin http://www.casinotemplates.org | http://www.gamingguide.net Code | Do Not Remove -->
<table width="950" border="0" align="center" cellpadding="0" cellspacing="0">
<tr><td align="left" valign="middle">
      <div align="center">Template by <a href="http://www.casinotemplates.org" target="_blank"><font color="#000000">Poker Templates</font></a> &amp; <a href="http://www.gamingguide.net" target="_blank"><font color="#000000">USA Online Casino</font></a></div>

</td></tr></table>
<!-- End http://www.casinotemplates.org | http://www.gamingguide.net Code | Do Not Remove -->


<?php
	$dhtmlxWindowsObj = new DhtmlxWindows();
	$dhtmlxWindowsObj->build();
?>

</body>
</html>
