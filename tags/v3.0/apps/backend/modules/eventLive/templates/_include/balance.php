<?php
    $balanceInfo = $eventLiveObj->getBalanceStats();
    $changes     = $balanceInfo['changes'];
?>
<!-- General balance widget -->
<div class="genBalance">
    <a href="javascript:void(0)" title="" class="amount">
        <span>Total arrecadado</span>
        <span class="moneyCode <?php echo ($balanceInfo['value']>10000?'small':'') ?>" id="mainBalanceCode">R$</span>
        <span class="balanceAmount" id="mainBalanceAmount"><?php echo Util::formatFloat($balanceInfo['value'], true) ?></span>
    </a>
    <span class="hidden" id="previousBalanceAmount"><?php echo Util::formatFloat($balanceInfo['previous'], true) ?></span>
    <?php if( !is_null($changes) ): ?>
    <a href="javascript:void(0)" title="" class="amChanges">
        <strong class="<?php echo ($changes>0?'sPositive':($changes<0?'sNegative':'sZero')) ?>" title="'Diferença de arrecadação em relação ao evento anterior'" id="mainBalanceChanges"><?php echo Util::formatFloat(abs($changes), true, 0) ?>%</strong>
    </a>
    <?php endif; ?>
</div>
<div class="sidebarSep"></div>