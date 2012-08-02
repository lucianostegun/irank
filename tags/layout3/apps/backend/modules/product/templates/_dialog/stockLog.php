<div class="uDialog">
    <div id="productItemStockLogDialog" title="Atualização de estoque de produtos">
		<?php
			echo form_remote_tag(array(
				'url'=>'product/saveStockLog',
				'success'=>'handleSuccessProductItemStockLog(response)',
				'failure'=>'handleFailureProductItemStockLog(response.responseText)',
				'loading'=>'showIndicator()',
				),
				array('class'=>'form', 'id'=>'productItemStockLogForm'));
			
			echo input_hidden_tag('productItemId', null, array('id'=>'productItemStockLogProductItemId'));
		?>
			<table width="100%" cellspacing="0" cellpadding="0">
				<tr>
					<td style="vertical-align: top">
						<div class="formRow">
							<label>Unidades</label>
							<div class="formRight">
								<?php echo input_tag('stock', null, array('size'=>4, 'maxlength'=>3, 'id'=>'productItemStockLogStock')) ?>
								<div class="formNote error" id="productItemStockLogFormErrorStock"></div>
							</div>
							<div class="clear"></div>
						</div>
						<div class="formRow">
							<label>Ação</label>
							<div class="formRight">
								<span class="multi"><?php echo radiobutton_tag('stockAction', 'incrase', true, array('id'=>'productItemStockLogStockActionIncrase')) ?><label class="text mt2" for="productItemStockLogStockActionIncrase">Incluir</label></span>
								<span class="multi"><?php echo radiobutton_tag('stockAction', 'decrase', false, array('id'=>'productItemStockLogStockActionDecrase')) ?><label class="text mt2" for="productItemStockLogStockActionDecrase">Excluir</label></span>
								<div class="clear"></div>
								<div class="formNote error" id="productItemStockLogFormErrorStockAction"></div>
							</div>
							<div class="clear"></div>
						</div>
						<div class="formRow">
							<label>Comentários</label>
							<div class="formRight">
								<?php echo textarea_tag('comments', null, array('id'=>'productItemStockLogComments')) ?>
								<div class="formNote error" id="productItemStockLogFormErrorComments"></div>
							</div>
							<div class="clear"></div>
						</div>
					</td>
				</tr>
			</table>
        	<?php echo submit_image_tag('blank.gif', array('class'=>'invisible')); ?>
		</form>
    </div>
</div>