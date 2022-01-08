<?php
    $balanceInfo = $cashTableObj->getBalanceStats();
    $changes     = $balanceInfo['changes'];
?>
<!-- General balance widget -->
<div class="genBalance">
    <a href="javascript:void(0)" title="" class="amount" style="width: 187px">
        <span>Saldo atual (Buyin+Rake)</span>
        <span class="moneyCode <?php echo ($balanceInfo['value']>10000?'small':'') ?>" id="mainBalanceCode">R$</span>
        <span class="balanceAmount" id="mainBalanceAmount"><?php echo Util::formatFloat($balanceInfo['value'], true) ?></span>
    </a>
</div>
