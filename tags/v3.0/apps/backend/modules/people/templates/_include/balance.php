<?php
    $profit  = People::getQuickResume('profit', $peopleObj->getId());
    $changes = 100;
?>
<!-- General balance widget -->
<div class="genBalance">
    <a href="javascript:void(0)" title="" class="amount">
        <span>Total em prêmios</span>
        <span class="moneyCode <?php echo ($profit>10000?'small':'') ?>" id="mainBalanceCode">R$</span>
        <span class="balanceAmount" id="mainBalanceAmount"><?php echo Util::formatFloat($profit, true) ?></span>
    </a>
    <?php if( !is_null($changes) ): ?>
    <a href="javascript:void(0)" title="" class="amChanges">
        <strong class="<?php echo ($changes>0?'sPositive':($changes<0?'sNegative':'sZero')) ?>" title="'Diferença de premiação em relação ao ano anterior'" id="mainBalanceChanges"><?php echo Util::formatFloat(abs($changes), true, 0) ?>%</strong>
    </a>
    <?php endif; ?>
</div>
<div class="sidebarSep"></div>