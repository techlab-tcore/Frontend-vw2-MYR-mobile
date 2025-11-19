<!--<?//=view('announcement');?>-->

<section class="row gx-3 bg-light p-3 d-flex align-items-stretch maccount">
    <figure class="col-2 m-0 p-0"><img class="w-100" src="<?=base_url('assets/img/avatar.png');?>"></figure>
    <div class="col-7">
        <span class="userFullName d-block w-100 fw-semibold">---</span>
        <small class="badge bg-primary fw-normal"><?=lang('Label.cash');?><span class="ms-1 userCash">0.00</span></small><br>
        <small class="badge bg-primary fw-normal"><?=lang('Label.chip');?><span class="ms-1 userChip">0.00</span></small>
    </div>
    <a class="col-3 d-flex align-items-center justify-content-center text-center text-decoration-none affQR" href="javascript:void(0);" data-bs-toggle="modal" data-bs-target=".modal-affiliateQR">
        <img class="w-75" src="<?=base_url('assets/img/icon/affiliate_btn.png');?>">
    </a>
</section>

<section class="maccount-settings">
<h6 class="px-3 fw-semibold d-flex justify-content-center align-items-center text-center"><?=lang('Label.affiliate');?></h6>
<div class="container mb-3">
  <div class="card shadow rounded-4">
    <div class="card-body">
      <div class="row text-center">
        <div class="col-6 border-end">
          <span class="d-block"><?=lang('Label.directplayer');?></span><p class="color-major fs-2 m-0 affiliateDirect">---</p>
        </div>
        <div class="col-6">
          <span class="d-block"><?=lang('Label.downlineplayer');?></span><p class="color-major fs-2 m-0 affiliateDownline">---</p>
        </div>
      </div>
    </div>
  </div>
</div>

<div class="container">
<div class="card shadow border-0">
    <div class="card-body">
        <div class="list-group list-group-flush">

        <!-- Bank Account -->
        <a href="<?=base_url('user/mbank-account');?>" class="list-group-item list-group-item-action d-flex align-items-center border-bottom">
            <i class="btn-bankaccount me-3" aria-hidden="true"></i>
            <?=lang('Nav.bankacc');?>
            <i class="bx bx-chevron-right ms-auto"></i>
        </a>

        <!-- Commission Report -->
        <!--<a href="<?=base_url('affiliate-log');?>" class="list-group-item list-group-item-action d-flex align-items-center border-bottom">
            <i class="btn-commissionreport me-3" aria-hidden="true"></i>
            <?=lang('Label.comreport');?>
            <i class="bx bx-chevron-right ms-auto"></i>
        </a>-->

        <!-- Message -->
        <a href="<?=base_url('message');?>" class="list-group-item list-group-item-action d-flex align-items-center border-bottom">
            <i class="btn-message me-3" aria-hidden="true"></i>
            <?=lang('Nav.message');?>
            <i class="bx bx-chevron-right ms-auto"></i>
        </a>

        <!-- Settings -->
        <a href="<?=base_url('settings');?>" class="list-group-item list-group-item-action d-flex align-items-center border-bottom">
            <i class="btn-settings me-3" aria-hidden="true"></i>
            <?=lang('Label.settings');?>
            <i class="bx bx-chevron-right ms-auto"></i>
        </a>

        <!-- Log out -->
        <a href="<?=base_url('user/logout');?>" class="list-group-item list-group-item-action d-flex align-items-center" >
            <i class="icn-logout me-3" aria-hidden="true"></i>    
            <?=lang('Nav.logout');?>
            <i class="bx bx-chevron-right ms-auto"></i>
        </a>


    </div>
  </div>
</div>
</div>

<script>
document.addEventListener('DOMContentLoaded', (event) => {
  affiliateProfile();
    $('.mobile-footer [data-page=account] a').addClass("active");
});
</script>