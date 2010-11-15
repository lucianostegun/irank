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

        <td width="230" align="left" valign="top" style="padding:18px 0px 0px 18px;"><a href="index.html"><img src="/images/frontend/layout/logo.gif" alt="" width="181" height="116" border="0" /></a></td>
        <td width="380" align="left" valign="top"><img src="/images/frontend/layout/header_img.png" alt="" width="380" height="156" /></td>
        <td align="left" valign="middle">
        <table width="324%" border="0" cellspacing="4" cellpadding="0">
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
            <td align="center" valign="middle" class="border_menu_right border_menu_right"><?php echo link_to('Encontrar amigos', 'myRanking') ?></td>
            <td align="center" valign="middle" class="border_menu_right border_menu_right"><a href="#">Poker Tips</a></td>
            <td align="center" valign="middle" class="border_menu_right border_menu_right"><a href="#">Poker Strategy</a></td>
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
		        <td width="250" align="left" valign="top" style="padding-right:46px">
		        	<?php include_partial('home/include/mainMenu') ?>
		        </td>
		        <td width="700" align="left" valign="top">
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
        <td align="center" valign="top"><a href="index.html">Home</a>   |  <a href="playpoker.html">Play Poker</a>   |  <a href="#">Download Poker</a>   |  <a href="#">Free Poker</a>   |  <a href="#">Poker Tips</a>   |  <a href="#">Poker Strategy</a>   ||  <a href="#">Contact</a>

        </td>
      </tr>
    </table></td>
  </tr>
</table> 

<!-- Begin http://www.casinotemplates.org | http://www.gamingguide.net Code | Do Not Remove -->
<table width="950" border="0" align="center" cellpadding="0" cellspacing="0">
<tr><td align="left" valign="middle">
      <div align="center">Template by <a href="http://www.casinotemplates.org" target="_blank"><font color="#FFFFFF">Poker Templates</font></a> &amp; <a href="http://www.gamingguide.net" target="_blank"><font color="#FFFFFF">USA Online Casino</font></a></div>

</td></tr></table>
<!-- End http://www.casinotemplates.org | http://www.gamingguide.net Code | Do Not Remove -->


<?php
	$dhtmlxWindowsObj = new DhtmlxWindows();
	$dhtmlxWindowsObj->build();
?>

</body>
</html>
