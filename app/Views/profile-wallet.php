<!-- Desktop -->
<section class="d-xl-block d-lg-block d-md-block d-none">
    <dl class="row m-0 g-0">
        <dd class="col-xl-4 col-lg-4 col-md-4 col-6 m-0 text-center position-relative">
            <span class="d-block pt-4"><?=lang('Label.directplayer');?></span><p class="color-major fs-2 m-0 affiliateDirect">---</p>
        </dd>
        <dd class="col-xl-4 col-lg-4 col-md-4 col-6 m-0 text-center position-relative">
            <span class="d-block pt-4"><?=lang('Label.downlineplayer');?></span><p class="color-major fs-2 m-0 affiliateDownline">---</p>
        </dd>
        <dd class="col-xl-4 col-lg-4 col-md-4 col-12 m-0 d-flex align-items-center justify-content-center">
            <button type="button" class="btn btn-primary btn-lg shadow" data-bs-toggle="modal" data-bs-target=".modal-affiliateQR"><i class='bx bx-qr me-1'></i><?=lang('Nav.letshare');?></button>
        </dd>
        <!--
        <dd class="col-xl-4 col-lg-4 col-md-4 col-12 m-0 text-center position-relative">
            <span class="d-block pt-4"><?//=lang('Label.balance');?></span><p class="color-major fs-2 m-0 userBalance">---</p>
        </dd>
        -->
        <dd class="col-xl-4 col-lg-4 col-md-4 col-6 m-0 text-center position-relative">
            <span class="d-block pt-4"><?=lang('Label.cashbalance');?></span><p class="color-major fs-2 m-0 userCash">---</p>
        </dd>
        <dd class="col-xl-4 col-lg-4 col-md-4 col-6 m-0 text-center">
            <span class="d-block pt-4"><?=lang('Label.chipbalance');?></span><p class="color-major fs-2 m-0 userChip">---</p>
        </dd>
    </dl>
</section>
<!-- End Desktop -->

<!-- Mobile -->
<section class="d-xl-none d-lg-none d-md-none d-block">
    <ul class="list-unstyled row m-0 gx-2 pb-2">
        <li class="col-6 text-center">
            <span class="d-block"><?=lang('Label.directplayer');?></span><p class="color-major fs-2 m-0 affiliateDirect">---</p>
        </li>
        <li class="col-6 text-center">
            <span class="d-block"><?=lang('Label.downlineplayer');?></span><p class="color-major fs-2 m-0 affiliateDownline">---</p>
        </li>
    </ul>
    <ul class="list-unstyled row m-0 gx-2">
        <li class="col-7">
            <small class="d-block w-100 text-primary"><?=lang('Label.mainwallet');?></small>
            <data class="d-block">
                <small><?=lang('Label.cash');?></small> <b class="userCash">0.00</b>
            </data>
            <data>
                <small><?=lang('Label.chip');?></small> <b class="userChip">0.00</b>
            </data>
        </li>
        <li class="col-5 d-grid gap-2">
            <button type="button" class="btn btn-primary btn-sm" onclick="getProfile();"><i class="bx bx-refresh me-1"></i><?=lang('Nav.refresh');?></button>
            <button type="button" class="btn btn-primary btn-sm" onclick="refreshAndWithdrawGame();"><?=lang('Nav.restore');?></button>
        </li>
    </ul>
    <!--
    <div class="pt-3 btn-profileWallet <?//=$_SESSION['lang'];?>">
        <a class="btn btn-outline-secondary btn-sm text-decoration-none text-uppercase" data-click="deposit" href="<?//=base_url('user-account/deposit');?>"><?//=lang('Nav.deposit');?></a>
        <a class="btn btn-outline-secondary btn-sm text-decoration-none text-uppercase" data-click="withdrawal" href="<?//=base_url('user-account/withdrawal');?>"><?//=lang('Nav.withdrawal');?></a>
        <a class="btn btn-outline-secondary btn-sm text-decoration-none text-uppercase" data-click="scorelog" href="<?//=base_url('score-log');?>"><?//=lang('Nav.scorelog');?></a>
        <a class="btn btn-outline-secondary btn-sm text-decoration-none text-uppercase" data-click="history" href="<?//=base_url('transaction/history');?>"><?//=lang('Nav.history');?></a>
    </div>
    -->
</section>
<!-- End Mobile -->

<script>
document.addEventListener('DOMContentLoaded', (event) => {
    affiliateProfile();
});
</script>