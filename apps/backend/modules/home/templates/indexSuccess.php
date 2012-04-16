<?php
	$clubId = $sf_user->getAttribute('clubId');
?>
        	<div class="pageTitle">
            	<h5>Administração iRank</h5>

            	<span>Seja bem-vindo ao centro de controle e gerenciamento de rankings, eventos e resultados do <b>iRank</b><br/>
            	Navegue pelo menu ao lado para acessar suas opções ou utilize as opções rápidas abaixo, que representam suas opções mais acessadas.</span>
        	</div>
        	<div class="middleNav">
            	<ul>
                	<li class="mUser"><a title=""><span class="users"></span></a>
                    	<ul class="mSub1">
                        	<li><a href="#" title="">Add user</a></li>
                        	<li><a href="#" title="">Statistics</a></li>

                        	<li><a href="#" title="">Orders</a></li>
                    	</ul>
                	</li>
                	<li class="mMessages"><a title=""><span class="messages"></span></a>
                    	<ul class="mSub2">
                        	<li><a href="#" title="">New tickets<span class="numberRight">8</span></a></li>
                        	<li><a href="#" title="">Pending tickets<span class="numberRight">12</span></a></li>

                        	<li><a href="#" title="">Closed tickets</a></li>
                    	</ul>
                	</li>
                	<li class="mFiles"><a href="#" title="Or you can use a tooltip" class="tipN"><span class="files"></span></a></li>
                	<li class="mOrders"><a title=""><span class="orders"></span><span class="numberMiddle">8</span></a>
                    	<ul class="mSub4">
                        	<li><a href="#" title="">Pending uploads</a></li>

                        	<li><a href="#" title="">Statistics</a></li>
                        	<li><a href="#" title="">Trash</a></li>
                    	</ul>
                	</li>
            	</ul>
            	<div class="clear"></div>
        	</div>
        	<div class="clear"></div>

    	</div>
	</div>
    
	<div class="line"></div>
    
	<!-- Page statistics and control buttons area -->
	<div class="statsRow">
    	<div class="wrapper">
        	<div class="controlB">
            	<ul>
                	<li><a href="#" title=""><img src="/images/backend/icons/control/32/plus.png" alt="" /><span>Add new session</span></a></li>
                	<li><a href="#" title=""><img src="/images/backend/icons/control/32/database.png" alt="" /><span>New DB entry</span></a></li>
                	<?php if( $iRankAdmin ): ?>
                	<li><?php echo link_to(image_tag('backend/icons/control/32/hire-me').'<span>Novo usuário</span>', 'userAdmin/new') ?></li>
                	<?php endif; ?>
                	<li><a href="#" title=""><img src="/images/backend/icons/control/32/statistics.png" alt="" /><span>Check statistics</span></a></li>
                	<li><a href="#" title=""><img src="/images/backend/icons/control/32/comment.png" alt="" /><span>Review comments</span></a></li>
                	<li><a href="#" title=""><img src="/images/backend/icons/control/32/order-149.png" alt="" /><span>Check orders</span></a></li>
            	</ul>

            	<div class="clear"></div>
        	</div>
    	</div>
	</div>
    
	<div class="line"></div>
    
	<!-- Main content wrapper -->
	<div class="wrapper">
    
    	<?php include_partial('home/club/resume', array('clubId'=>$clubId)) ?>
    
	</div>
</div>