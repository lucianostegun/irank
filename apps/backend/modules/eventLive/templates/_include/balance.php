<?php
    $previousBalanceValue = $eventLiveObj->getPreviousEventLive()->getTotalBuyin(true);
    $mainBalanceValue     = $eventLiveObj->getTotalBuyin(true);
    $mainBalanceChanges   = $eventLiveObj->getBalanceDifference();
?>
<!-- General balance widget -->
<div class="genBalance">
    <a href="javascript:void(0)" title="" class="amount">
        <span>Total arrecadado</span>
        <span class="balanceAmount" id="mainBalanceAmount">R$ <?php echo Util::formatFloat($mainBalanceValue, true) ?></span>
    </a>
    <span class="hidden" id="previousBalanceAmount"><?php echo Util::formatFloat($previousBalanceValue, true) ?></span>
    <?php if( !is_null($mainBalanceChanges) ): ?>
    <a href="javascript:void(0)" title="" class="amChanges">
        <strong class="<?php echo ($mainBalanceChanges>0?'sPositive':($mainBalanceChanges<0?'sNegative':'sZero')) ?>" title="'Diferença de arrecadação em relação ao evento anterior'" id="mainBalanceChanges"><?php echo Util::formatFloat(abs($mainBalanceChanges), true, 1) ?>%</strong>
    </a>
    <?php endif; ?>
</div>
<div class="sidebarSep"></div>