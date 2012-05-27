<div class="wrapper">
	<!-- Fullscreen tabs -->
    <div class="widget">    
        <ul class="tabs">
            <li><a href="#tab1">Principal</a></li>
			<?php echo submit_tag('salvar', array('class'=>'button redB', 'style'=>'margin: 3px 10px', 'onclick'=>'$("#peopleForm").submit()')); ?>
        </ul>
        <div class="tab_container">
		<?php
			echo form_remote_tag(array(
				'url'=>'people/save',
				'success'=>'handleSuccessPeople(response)',
				'failure'=>'handleFailurePeople(response.responseText)',
				'loading'=>'showIndicator()',
				),
				array('class'=>'form', 'id'=>'peopleForm'));
//			echo form_tag('people/save', array('class'=>'form', 'id'=>'peopleForm'));
			
			$iRankAdmin  = $sf_user->hasCredential('iRankAdmin');
			
			echo input_hidden_tag('peopleId', $peopleObj->getId());
		?>
			<div id="tab1" class="tab_content"><?php include_partial('people/tab/main', array('peopleObj'=>$peopleObj, 'iRankAdmin'=>$iRankAdmin)) ?></div>
		</form>
        </div>	
        <div class="clear"></div>		 
    </div>
</div>