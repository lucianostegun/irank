<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<?php
	include_http_metas();
	include_metas();
	include_title();
?>
<script>
	var _ModuleName = 'login';
</script>
</head>

<body class="nobg loginPage">

<!-- Top fixed navigation -->
<div class="topNav">
    <div class="wrapper">
        <div class="userNav">
            <ul>
                <li><a href="http://ww.irank.com.br" title="Página inicial iRank"><img src="/images/backend/icons/topnav/mainWebsite.png" alt="" /><span>iRank website</span></a></li>
                <li><a href="mailto:admin@irank.com.br" title=""><img src="/images/backend/icons/topnav/profile.png" alt="" /><span>Contact admin</span></a></li>
            </ul>
        </div>
        <div class="clear"></div>
    </div>
</div>

<!-- Main content wrapper -->
<?php echo $sf_data->getRaw('sf_content') ?>    


</body>
</html>