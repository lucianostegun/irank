<span><?php echo __('generalCredit') ?>:</span> <span class="<?php echo ($balance<0?'negative':'positive') ?>Credit"><?php echo Util::formatFloat($balance, true) ?></span>