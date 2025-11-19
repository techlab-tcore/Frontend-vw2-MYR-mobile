<section class="maccount-settings2 col-xl-12 col-lg-12 col-md-12 col-12">
    
    <div class="d-flex align-items-center">
        <i class="bx bx-chevron-left d-xl-none d-lg-none d-md-none me-2" style="cursor: pointer;" onclick="history.back();"></i>
        <h6 class="text-uppercase d-xl-none d-lg-none d-md-none d-block m-0"><?=lang('Label.personalsettings');?></h6>
    </div>

<div class="container">
    <div class="card shadow border-0 my-1">
    <div class="card-body">
        <div class="list-group list-group-flush">

        <!-- Password -->
        <a class="list-group-item list-group-item-action d-flex align-items-center border-bottom" href="<?=base_url('user-password');?>">
            <i class="icn-password me-3" aria-hidden="true"></i>
            <?=lang('Label.changePwd');?>
            <i class="bx bx-chevron-right ms-auto"></i>
        </a>

        <!-- 2nd Password -->
        <a class="list-group-item list-group-item-action d-flex align-items-center" href="<?=base_url('user-rstpassword');?>">
            <i class="icn-scrpassword me-3" aria-hidden="true"></i>
            <?=lang('Label.scrPwd');?>
            <i class="bx bx-chevron-right ms-auto"></i>
        </a>

    </div>
  </div>
</div>
</div>
</section>