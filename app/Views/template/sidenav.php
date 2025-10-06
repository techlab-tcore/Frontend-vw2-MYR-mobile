<ul class="list-group d-xl-block d-lg-block d-md-block d-none profileLeft">
    <li class="list-group-item bg-transparent text-center">
        <img class="w-50 py-3" src="<?=base_url('assets/img/avatar.png');?>" alt="<?=$_ENV['company'];?>" title="<?=$_ENV['company'];?>">
        <p class="text-light m-0 userName"><?=$_SESSION['username'];?></p>
    </li>
    <li class="list-group-item bg-transparent">
        <h3 class="text-uppercase"><?=lang('Label.wallet');?></h3>
        <nav class="nav flex-column">
            <a class="nav-link nav-profileDeposit" href="<?=base_url('user-account/deposit');?>"><?=lang('Nav.deposit');?></a>
            <a class="nav-link nav-profileWithdraw" href="<?=base_url('user-account/withdrawal');?>"><?=lang('Nav.withdrawal');?></a>
            <!-- <a class="nav-link nav-profileUTransfer" href="<?//=base_url('user-balance-transfer');?>"><?//=lang('Nav.utransfer');?></a> -->
            <a class="nav-link nav-profileVault" href="<?=base_url('user-vault');?>"><?=lang('Nav.vault');?></a>
            <a class="nav-link nav-profileHistory" href="<?=base_url('transaction/history');?>"><?=lang('Nav.history');?></a>
            <a class="nav-link nav-betLog" href="<?=base_url('bet-log');?>"><?=lang('Nav.betlog');?></a>
            <a class="nav-link nav-refbetLog" href="<?=base_url('realtime-bet-log');?>"><?=lang('Nav.refbetlog');?></a>
            <a class="nav-link nav-scoreLog" href="<?=base_url('score-log');?>"><?=lang('Nav.scorelog');?></a>
            <a class="nav-link nav-affLog" href="<?=base_url('affiliate-log');?>"><?=lang('Nav.afflog');?></a>
            <!--<a class="nav-link nav-affLossRebateLog" href="<?=base_url('affiliate-loss-rebate-log');?>"><?=lang('Nav.afflossrebatelog');?></a>-->
        </nav>
    </li>
    <li class="list-group-item bg-transparent">
        <h3 class="text-uppercase"><?=lang('Label.uprofile');?></h3>
        <nav class="nav flex-column">
            <a class="nav-link nav-profileBankAcc" href="<?=base_url('user/bank-account');?>"><?=lang('Nav.bankacc');?></a>
            <a class="nav-link nav-profilePass" href="<?=base_url('user-password');?>"><?=lang('Nav.password');?></a>
            <!-- <a class="nav-link nav-profileComm" href="javascript:void(0);"><?//=lang('Nav.commlist');?></a> -->
            <a class="nav-link nav-profileMsg" href="<?=base_url('message');?>"><?=lang('Nav.message');?></a>
        </nav>
    </li>
</ul>