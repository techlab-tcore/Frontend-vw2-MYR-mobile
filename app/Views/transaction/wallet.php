<section class="container d-xl-none d-lg-none d-md-none d-block">

    <div class="d-flex align-items-center">
                <i class="bx bx-chevron-left d-xl-none d-lg-none d-md-none me-2" style="cursor: pointer;" onclick="history.back();"></i>
                <h6 class="text-uppercase d-xl-none d-lg-none d-md-none d-block m-0"><?=lang('Label.mainwallet');?></h6>
            </div>

    <div class="card shadow">
        <div class="card-body">
            <div class="row text-center pb-1">
                <div class="col-6 border-end">
                    <div class="d-flex align-items-center justify-content-between">
                        <span class="d-block"><?=lang('Label.cash');?></span>
                        <img class="wallet-icon" src="<?=base_url('assets/img/wallet/cash.png');?>">
                    </div>
                    <p class="text-success fs-4 m-0 userCash">---</p>
                    
                </div>
                <div class="col-6">
                    <div class="d-flex align-items-center justify-content-between">
                        <span class="d-block"><?=lang('Label.chip');?></span>
                        <img class="wallet-icon" src="<?=base_url('assets/img/wallet/chips.png');?>">
                    </div>
                    <p class="text-success fs-4 m-0 userChip">---</p>
                </div>
            </div>
            <button class="btn-depRestore" onclick="refreshAndWithdrawGame();"><?=lang('Nav.restore');?></button>
        </div>
    </div>

    <div class="card shadow my-3">
        <div class="card-body">

            <div class="list-group list-group-flush">

                <!-- Deposit -->
                <a href="<?=base_url('user-account/deposit');?>" class="list-group-item list-group-item-action d-flex align-items-center border-bottom">
                    <i class="btn-bankaccount me-3" aria-hidden="true"></i>
                    <?=lang('Nav.deposit');?>
                    <i class="bx bx-chevron-right ms-auto"></i>
                </a>

                <!-- Withdrawal-->
                <a href="<?=base_url('user-account/withdrawal');?>" class="list-group-item list-group-item-action d-flex align-items-center">
                    <i class="btn-commissionreport me-3" aria-hidden="true"></i>
                    <?=lang('Nav.withdrawal');?>
                    <i class="bx bx-chevron-right ms-auto"></i>
                </a>

            </div>

        </div>
    </div>
    
</section>

<script>
document.addEventListener('DOMContentLoaded', (event) => {
    affiliateProfile();
});
</script>