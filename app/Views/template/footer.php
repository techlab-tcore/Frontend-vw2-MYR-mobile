</main>

<!-- Desktop -->
<footer class="w-100">
    <div class="container pt-4">
        <!--
        <section class="d-xl-block d-lg-block d-md-block d-none">
            <div class="hstack gap-3 m-3 shadow bg-white py-4 px-4 rounded supportZone">
                <img class="d-inline-block cs24" src="<?=base_url('assets/img/support/24hr.png');?>">
                <div class="vr"></div>
                <a target="_blank" class="d-inline-block whatsapp" href=""><img class="" src="<?=base_url('assets/img/support/whatsapp.png');?>"></a>
                <a target="_blank" class="d-inline-block telegram" href=""><img class="" src="<?=base_url('assets/img/support/telegram.png');?>"></a>
                <a target="_blank" class="d-inline-block liveChat" href=""><img class="" src="<?=base_url('assets/img/support/livechat.png');?>"></a>
            </div>
        </section>

        <section class="row gx-5 py-3">
            <div class="col-xl-4 col-lg-4 col-md-4 col-12">
                <h6 class="footer-link-header"><?=lang('Label.pgmethod');?></h6>
                <dl class="row m-0 gx-3 footer-paymethod">
                    <dd class="col"><i></i></dd>
                    <dd class="col"><i></i></dd>
                    <dd class="col"><i></i></dd>
                    <dd class="col"><i></i></dd>
                    <dd class="col"><i></i></dd>
                </dl>
            </div>
            <div class="col-xl-2 col-lg-2 col-md-2 col-12 d-lg-inline-block d-md-inline-block d-none">
                <h6 class="footer-link-header"><?=lang('Label.browser');?></h6>
                <dl class="row m-0 gx-0 footer-browser">
                    <dd class="col"><i></i></dd>
                    <dd class="col"><i></i></dd>
                    <dd class="col"><i></i></dd>
                </dl>
            </div>
            <div class="col-2 mx-auto d-xl-inline-block d-lg-inline-block d-md-inline-block d-none">
                <h6 class="footer-link-header"><?=lang('Label.responsible');?></h6>
                <dl class="row m-0 gx-0 footer-responsible">
                    <dd class="col"><i></i></dd>
                    <dd class="col"><i></i></dd>
                    <dd class="col"><i></i></dd>
                </dl>
            </div>
            <div class="col-xl-4 col-lg-4 col-md-4 col-12">
                <h6 class="footer-link-header"><?=lang('Label.license');?></h6>
                <dl class="row m-0 gx-3 footer-license">
                    <dd class="col"><i></i></dd>
                    <dd class="col"><i></i></dd>
                    <dd class="col"><i></i></dd>
                    <dd class="col"><i></i></dd>
                    <dd class="col"><i></i></dd>
                </dl>
            </div>
        </section>
        -->

        <section class="footer-link extra-wrapper d-xl-block d-lg-block d-md-block d-none">
            <dl class="row g-1 m-0">
                <dd class="col-xl-6 col-lg-6 col-md-6 col-12">
                    <a class="d-inline-block text-decoration-none border-end border-dark pe-2" href="">About Us</a>
                    <a target="_blank" class="d-inline-block text-decoration-none border-end border-dark px-2 liveChat" href="">Live Chat</a>
                    <a class="d-inline-block text-decoration-none border-end border-dark px-2" href="">Terms & Conditions</a>
                    <a class="d-inline-block text-decoration-none border-end border-dark px-2" href="">Affiliate</a>
                    <a class="d-inline-block text-decoration-none px-2 whatsapp" href="">Contact Us</a>
                </dd>
                <dd class="col-xl-6 col-lg-6 col-md-6 col-12 text-end">
                    <small>&copy; <?=date('Y');?> <?=$_ENV['company'];?>. All rights reserved.</small>
                </dd>
            </dl>
        </section>
    </div>

    <section class="bg-white py-3 footer-phase">
        <div class="container">
            <h5 class="seoTitle"></h5>
            <span class="seoContent fw-light"></span>
        </div>
    </section>
</footer>
<!-- End Desktop -->

<!-- Mobile -->
<section class="fixed-bottom d-xl-none d-lg-none d-md-none d-block pt-3 border-0 shadow-none">
    <div class="mobile-footer <?=$_SESSION['lang'];?>">
        <section class="container">
            <ul class="list-unstyled row gx-3 justify-content-md-center m-0">
                <?php if( isset($_SESSION['logged_in']) ): ?>
                <li class="col m-0" data-page="history"><a class="nav-link" href="<?=base_url('transaction/mindex');?>"><i></i></a></li>
                <?php else: ?>
                <li class="col m-0" data-page="history"><a class="nav-link" href="javascript:void(0);" onclick="alertToast('bg-light', '<?=lang('Validation.loginaccount')?>');"><i></i></a></li>
                <?php endif; ?>

                <li class="col m-0" data-page="promotion"><a class="nav-link" href="<?=base_url('promotions');?>"><i></i></a></li>

                <li class="col m-0 position-relative" data-page="home"><a class="nav-link" href="<?=base_url();?>"><i></i></a></li>
                <?php if( isset($_SESSION['logged_in']) ): ?>
                <li class="col m-0" data-page="affiliate"><a class="nav-link" href="javascript:void(0);" data-bs-toggle="modal" data-bs-target=".modal-affiliateQR"><i></i></a></li>
                <?php else: ?>
                <li class="col m-0" data-page="affiliate"><a class="nav-link" href="javascript:void(0);" onclick="alertToast('bg-light', '<?=lang('Validation.loginaccount')?>');"><i></i></a></li>
                <?php endif; ?>

                <?php if( isset($_SESSION['logged_in']) ): ?>
                <!-- <li class="col m-0" data-page="share"><a class="nav-link" href="javascript:void(0);" data-bs-toggle="modal" data-bs-target=".modal-affiliateQR"><i></i></a></li> -->
                
                <li class="col m-0" data-page="account"><a class="nav-link" href="<?=base_url('user/account');?>"><i></i></a></li>
                <?php else: ?>
                <li class="col m-0" data-page="account"><a class="nav-link" href="javascript:void(0);" onclick="alertToast('bg-light', '<?=lang('Validation.loginaccount')?>');"><i></i></a></li>
                <?php endif; ?>
            </ul>
        </section>
    </div>
</section>
<!-- End Mobile -->