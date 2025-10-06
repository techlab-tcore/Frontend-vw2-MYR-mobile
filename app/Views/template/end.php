        </div>
    </div>
</div>

<section class="toast-container position-fixed top-0 start-50 translate-middle-x p-3">
    <div id="liveToast" class="toast hide border-0" role="alert" aria-live="assertive" aria-atomic="true">
        <div class="toast-header">
            <span class="me-auto text-primary"><?=lang('Label.notif');?></span>
            <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
        </div>
        <div class="toast-body"></div>
    </div>
</section>

<section class="wrap-jackpot p-xl-5 p-lg-5 p-md-3 p-3">
    <div class="text-end"><button type="button" class="btn btn-primary" onclick="closeJackpot();"><i class='bx bx-x me-1'></i><?=lang('Nav.close');?></button></div>
    <figure class="d-inline-block position-relative m-0">
        <img class="w-100" src="<?=base_url('assets/img/jackpot/'.$_SESSION['lang'].'/angpow.gif');?>" alt="<?=$_ENV['company'];?>" title="<?=$_ENV['company'];?>">
        <span class="d-block text-warning jackpotAmount"></span>
    </figure>
</section>

<section class="modal fade modal-angpow" id="modal-angpow" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="modal-angpow" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content bg-transparent border-0">
            <div class="modal-body p-2">
                <button type="button" class="btn-close-angpow" data-bs-dismiss="modal"><img class="w-100 d-block" src="<?=base_url('assets/img/close.png');?>"></button>
            </div>
        </div>
    </div>
</section>

<section class="modal fade modal-login" id="modal-login" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="modal-login" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <article class="modal-content border-0">
            <div class="modal-body p-0">
                <div class="py-4 bg-major position-relative rounded-top">
                    <button type="button" class="btn-close me-3 mt-3" aria-label="Close" data-bs-dismiss="modal"></button>
                    <!--<figure class="m-2 text-center"><img class="d-inline-block" src="<?=base_url('assets/img/logo/logo.png');?>" alt="<?=$_ENV['company'];?>" title="<?=$_ENV['company'];?>"></figure>-->
                </div>
                <div class="bg-major pb-4">
                    <img class="mx-auto w-75 d-block" src="<?=base_url('assets/img/logo/logo.png');?>" alt="<?=$_ENV['company'];?>" title="<?=$_ENV['company'];?>">
                    <!--<figure class="m-2 text-center"><img class="d-inline-block" src="<?=base_url('assets/img/logo/logo.png');?>" alt="<?=$_ENV['company'];?>" title="<?=$_ENV['company'];?>"></figure>-->
                </div>
                <?=form_open('', ['class'=>'form-validation customForm px-5 pb-5', 'novalidate'=>'novalidate']);?>
                <div class="form-floating mb-3">
                    <select class="form-select" name="regionCode" required>
                        <option value="MYR" selected><?=lang('Label.malaysia');?></option>
                        <option value="SGD"><?=lang('Label.singapore');?></option>
                    </select>
                    <label for="floatingPassword" class=""><?=lang('Input.regioncode');?></label>
                </div>
                <div class="form-floating mb-3">
                    <input type="text" class="form-control" id="username" name="username" pattern="^[a-zA-Z0-9]{8,11}$" placeholder="<?=lang('Input.mobileno');?>" required>
                    <small class="invalid-feedback"><?=lang('Validation.mobile',[10,11]);?></small>
                    <label for="floatingUsername" class=""><?=lang('Input.mobileno');?></label>
                </div>
                <div class="form-floating mb-3">
                    <input type="password" class="form-control" id="password" name="password" pattern=".{6,}" placeholder="<?=lang('Input.password');?>" required>
                    <a class="text-decoration-none d-inline-block btn-showpass mt-2" href="javascript:void(0);" onclick="showhidepass('password')"><i class='bx bx-hide'></i></a>
                    <small class="invalid-feedback"><?=lang('Validation.password',[6]);?></small>
                    <label for="floatingPassword" class=""><?=lang('Input.password');?></label>
                </div>
                <div class="form-check mb-3">
                    <input class="form-check-input" type="checkbox" value="isRememberMe" id="rememberMe">
                    <label class="form-check-label" for="rememberMe"><?=lang('Label.rememberme');?></label>
                </div>
                <div class="d-grid gap-2">
                    <button type="submit" class="btn btn-primary btn-lg shadow" onclick="isRememberMe();"><?=lang('Nav.login');?></button>
                </div>
                <small class="d-block mt-3 text-center">
                    <a class="d-inline-block text-decoration-none" href="<?=base_url('forgot-password');?>"><i class='bx bxs-lock me-1'></i><?=lang('Nav.forgotpass');?></a>
                </small>    
                <div class="mt-5 text-center">
                    <!-- <small class="d-block border-bottom pb-3 mb-3"><?//=lang('Validation.donthaveaccount');?> <a href="<?//=base_url('create-account');?>"><?//=lang('Nav.regisnow');?></a></small> -->
                    <small class="d-block border-top pt-3"><?=lang('Validation.encounter');?></small>
                </div>
                <?=form_close();?>
            </div>
        </article>
    </div>
</section>

<section class="modal fade modal-check2ndPass" id="modal-check2ndPass" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="modal-check2ndPass" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-fullscreen-xl-down">
        <article class="modal-content border-0">
            <div class="modal-body p-0">
                <div class="p-4 bg-major position-relative rounded-top">
                    <button type="button" class="btn-close me-3 mt-3" aria-label="Close" data-bs-dismiss="modal"></button>
                    <h4 class="m-0"><?=lang('Label.veri2ndpass');?></h2>
                </div>
                <?=form_open('', ['class'=>'form-validation customForm p-5 verify2ndPassForm', 'novalidate'=>'novalidate']);?>
                <div class="row mb-3">
                    <label class="col-xl-6 col-lg-6 col-md-6 col-12 col-form-label text-dark position-relative required2"><?=lang('Input.2ndpass');?></label>
                    <div class="col-xl-6 col-lg-6 col-md-6 col-12">
                        <input type="text" class="form-control" pattern=".{6,}" name="secondarypass" required>
                        <small class="invalid-feedback"><?=lang('Validation.2ndpassword',[6]);?></small>
                    </div>
                </div>
                <div class="d-grid gap-2">
                    <button type="submit" class="btn btn-primary btn-lg fw-bold"><?=lang('Nav.submit');?></button>
                </div>
                <?=form_close();?>
            </div>
        </article>
    </div>
</section>

<section class="modal fade modal-setup2ndPass" id="modal-setup2ndPass" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="modal-setup2ndPass" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-fullscreen-xl-down">
        <article class="modal-content border-0">
            <div class="modal-body p-0">
                <div class="p-4 bg-major position-relative rounded-top">
                    <h4 class="m-0"><?=lang('Label.new2ndpass');?></h2>
                </div>
                <?=form_open('', ['class'=>'form-validation customForm p-5 setup2ndPassForm', 'novalidate'=>'novalidate']);?>
                <div class="row mb-3">
                    <label class="col-xl-6 col-lg-6 col-md-6 col-12 col-form-label text-dark position-relative required2"><?=lang('Input.2ndpass');?></label>
                    <div class="col-xl-6 col-lg-6 col-md-6 col-12">
                        <input type="text" class="form-control" pattern=".{6,}" name="new2ndpass" required>
                        <small class="invalid-feedback"><?=lang('Validation.new2ndpass',[6]);?></small>
                    </div>
                </div>
                <div class="row mb-3">
                    <label class="col-xl-6 col-lg-6 col-md-6 col-12 col-form-label text-dark position-relative required2"><?=lang('Input.confirmpass');?></label>
                    <div class="col-xl-6 col-lg-6 col-md-6 col-12">
                        <input type="text" class="form-control" pattern=".{6,}" name="cnew2ndpass" required>
                        <small class="invalid-feedback"><?=lang('Validation.match2ndpass');?></small>
                    </div>
                </div>
                <div class="d-grid gap-2">
                    <button type="submit" class="btn btn-primary btn-lg fw-bold"><?=lang('Nav.submit');?></button>
                </div>
                <?=form_close();?>
            </div>
        </article>
    </div>
</section>

<?php if( isset($_SESSION['logged_in']) ): ?>
<section class="modal fade modal-affiliateQR" id="modal-affiliateQR" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="modal-affiliateQR" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-fullscreen-xl-down">
        <article class="modal-content border-0 bg-major">
            <div class="modal-header">
                <h5 class="modal-title"><?=lang('Label.affiliate');?></h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body px-0 pb-3 text-center">
                <div class="qrcard">
                    <figure class="px-3 pt-2 pb-3 w-50 mx-auto my-0">
                        <img class="w-100" src="<?=base_url('assets/img/logo/logo.png');?>" title="<?=$_ENV['company'];?>" alt="<?=$_ENV['company'];?>">
                    </figure>
                    <div class="text-center w-50 mx-auto p-2 bg-white rounded-3">
                        <figure id="qrcode" class="w-100 p-0 m-0"></figure>
                    </div>

                    <!-- <span class="fs-5 color-major"><?//=$_SESSION['username'];?></span> -->
                    <input type="text" class="form-control border-0 my-0 w-75 mx-auto bg-transparent text-warning text-center" placeholder="<?=lang('Validation.nickname');?>">

                    <div class="bg-primary p-2 my-3">
                        <span class="d-block">SCAN UNTUK DAFTAR</span>
                        <span class="d-block">SCAN TO REGISTER</span>
                        <span class="d-block">只需扫二维码即马上可注册</span>
                    </div>
                </div>
                <div class="">
                    <a href="javascript:void(0);" class="btn btn-primary btn-qrreg"><?=lang('Nav.share');?></a>
                    <a href="javascript:void(0);" class="btn btn-primary getscreen" onclick="getScreen();"><?=lang('Nav.save');?></a>
                </div>
            </div>
        </article>
    </div>
</section>
<?php endif; ?>

<!-- Games -->
<section class="modal fade modal-gameLanding" id="modal-gameLanding" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="modal-gameLanding" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content p-0 border-0">
            <div class="modal-header">
                <button type="button" class="btn btn-primary" onclick="getProfile();"><?=$_ENV['currency'];?><span class="ms-1 userBalance"></span></button>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body bg-dark">
                <figure class="text-center text-light">
                    <img class="w-50" src="">
                    <input type="text" class="w-100 border-0 bg-transparent text-center text-light" name="gamebalance" readonly>
                    <label><?=lang('Input.gamebalance');?></label>
                </figure>
                <?=form_open('',['class'=>'form-validation customForm','novalidate'=>'novalidate'],['provider'=>'','gname'=>'','species'=>'']);?>
                <div class="d-grid gap-2">
                    <button type="submit" class="btn btn-primary btn-lg"><?=lang('Nav.playgame');?></button>
                </div>
                <?=form_close();?>
            </div>
        </div>
    </div>
</section>

<section class="modal fade modal-gameLobby" id="modal-gameLobby" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="modal-gameLobby" aria-hidden="true">
    <div class="modal-dialog modal-fullscreen-xl-down">
        <div class="modal-content p-0">
            <div class="modal-header">
                <h5 class="modal-title gamename"></h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body p-0">
                <article class="lobby" id="gameLobby"></article>
            </div>
        </div>
    </div>
</section>

<section class="modal fade modal-slotLobby" id="modal-slotLobby" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="modal-slotLobby" aria-hidden="true">
    <div class="modal-dialog modal-fullscreen-xl-down">
        <div class="modal-content p-0">
            <div class="modal-body p-0 position-relative">
                <a class="draggable-lobby"><img class="d-inline-block w-100" src="<?=base_url('assets/img/btn_home.png');?>"></a>
                <article class="lobby" id="slotLobby"></article>
            </div>
        </div>
    </div>
</section>

<section class="modal fade modal-prompt" id="modal-prompt" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="modal-prompt" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content border-0">
            <div class="modal-header">
                <h5 class="modal-title"><?=lang('Label.notif');?></h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body p-0">
                <article class="p-4">
                    <ul class="row list-unstyled m-0">
                        <li class="col-6">
                            <a class="btn btn-primary w-100 text-uppercase btn-lobby" href="javascript:void(0);"><?=lang('Nav.lobby');?></a>
                        </li>
                        <li class="col-6">
                            <a class="btn btn-danger bg-gradient w-100 text-uppercase btn-exit" href="javascript:void(0);"><?=lang('Nav.exitgame');?></a>
                        </li>
                    </ul>
                </article>
            </div>
        </div>
    </div>
</section>

<section class="modal fade modal-appLanding" id="modal-appLanding" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="modal-appLanding" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content p-0 border-0">
            <div class="modal-header">
                <button type="button" class="btn btn-primary" onclick="getProfile();"><?=$_ENV['currency'];?><span class="ms-1 userBalance"></span></button>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body bg-dark">
                <figure class="text-center text-light">
                    <img class="w-50" src="">
                    <input type="text" class="w-100 border-0 bg-transparent text-center text-light" name="gamebalance" readonly>
                    <label><?=lang('Input.gamebalance');?></label>
                </figure>
                <?=form_open('',['class'=>'form-validation customForm','novalidate'=>'novalidate'],['provider'=>'','gname'=>'','species'=>'','platform'=>'']);?>
                <div class="mb-3">
                    <div class="input-group">
                        <div class="input-group-text btn btn-primary"><i class="bx bxs-user"></i></div>
                        <input type="text" class="form-control form-control-lg bg-white" name="gameuserid" id="gameuserid" readonly>
                        <button type="button" class="btn btn-primary" id="btn-copygid"><i class="bx bxs-copy-alt"></i></button>
                    </div>
                </div>
                <div class="mb-3">
                    <div class="input-group">
                        <div class="input-group-text btn btn-primary"><i class="bx bxs-lock"></i></div>
                        <input type="text" class="form-control form-control-lg bg-white" name="gameuserpass" id="gameuserpass" readonly>
                        <button type="button" class="btn btn-primary" id="btn-copygpass"><i class="bx bxs-copy-alt"></i></button>
                    </div>
                </div>
                <div class="d-grid gap-2">
                    <button type="submit" class="btn btn-primary btn-lg"><?=lang('Nav.playgame');?></button>
                    <a target="_blank" class="text-decoration-none btn btn-link text-primary btn-download" href=""><?=lang('Nav.dwgameapp');?></a>
                </div>
                <?=form_close();?>
            </div>
        </div>
    </div>
</section>

<section class="modal fade modal-appUrlLanding" id="modal-appUrlLanding" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="modal-appUrlLanding" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content p-0 border-0">
            <div class="modal-header">
                <button type="button" class="modal-title modalBalance userBalance" onclick="getProfile();"></button>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body bg-dark">
                <figure class="text-center text-light">
                    <img class="w-50" src="">
                    <input type="text" class="w-100 border-0 bg-transparent text-center text-light" name="gamebalance" readonly>
                    <label><?=lang('Input.gamebalance');?></label>
                </figure>
                <?=form_open('',['class'=>'form-validation customForm','novalidate'=>'novalidate'],['provider'=>'','gname'=>'','species'=>'','platform'=>'']);?>
                <div class="d-grid gap-2 d-md-block">
                    <button type="submit" class="btn btn-primary btn-lg"><?=lang('Nav.playgame');?></button>
                </div>
                <?=form_close();?>
            </div>
        </div>
    </div>
</section>
<!--Exclusive-->
<section class="modal fade modal-exclusiveLanding" id="modal-exclusiveLanding" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="modal-exclusiveLanding" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content p-0 border-0">
            <div class="modal-header">
                <button type="button" class="btn btn-primary" onclick="getProfile();"><?=$_ENV['currency'];?><span class="ms-1 userBalance"></span></button>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body bg-dark">
                <figure class="text-center text-light">
                    <img class="providerLogo w-50" src="">
                    <input type="text" class="w-100 border-0 bg-transparent text-center text-light" name="gamebalance" readonly>
                    <label><?=lang('Input.gamebalance');?></label>
                </figure>
                <?=form_open('',['class'=>'form-validation customForm','novalidate'=>'novalidate'],['provider'=>'','gname'=>'','species'=>'','gamecode'=>'']);?>
                <div class="d-grid gap-2">
                    <button type="submit" class="btn btn-primary btn-lg"><?=lang('Nav.playgame');?></button>
                </div>
                <?=form_close();?>
                <figure class="text-center text-light">
                    <img class="gameRules w-100 pt-2" src="">
                    <iframe class="w-100 pt-2" src=""></iframe>
                </figure>
            </div>
        </div>
    </div>
</section>

<section class="modal fade modal-lottoLanding" id="modal-lottoLanding" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="modal-lottoLanding" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content p-0 border-0">
            <div class="modal-header">
                <button type="button" class="btn btn-primary" onclick="getProfile();"><?=$_ENV['currency'];?><span class="ms-1 userBalance"></span></button>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body bg-dark">
                <figure class="text-center text-light">
                    <img class="w-50" src="">
                    <input type="text" class="w-100 border-0 bg-transparent text-center text-light" name="gamebalance" readonly>
                    <label><?=lang('Input.gamebalance');?></label>
                </figure>
                <?=form_open('',['class'=>'form-validation customForm','novalidate'=>'novalidate'],['provider'=>'','gname'=>'','species'=>'']);?>
                <div class="d-grid gap-2">
                    <button type="submit" class="btn btn-primary btn-lg"><?=lang('Nav.playgame');?></button>
                </div>
                <?=form_close();?>
                <figure class="text-center text-light">
                    <img class="lottoPrize w-100 pt-2" src="">
                </figure>
            </div>
        </div>
    </div>
</section>

<section class="modal fade modal-lottoBonusLanding" id="modal-lottoBonusLanding" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="modal-lottoBonusLanding" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content p-0 border-0">
            <div class="modal-header">
                <button type="button" class="btn btn-primary" onclick="getProfile();"><?=$_ENV['currency'];?><span class="ms-1 userBalance"></span></button>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body bg-dark">
                <figure class="text-center text-light">
                    <img class="w-50" src="">
                    <input type="text" class="w-100 border-0 bg-transparent text-center text-light" name="gamebalance" readonly>
                    <label><?=lang('Input.gamebalance');?></label>
                </figure>
                <?=form_open('',['class'=>'form-validation customForm','novalidate'=>'novalidate'],['provider'=>'','gname'=>'','species'=>'']);?>
                <div class="mb-3 text-center">
                    <div class="input-group mb-3">
                        <span class="input-group-text btn-primary minLottoBonus">0</span>
                        <input type="number" step="any" class="form-control text-center" min="1" name="amount" required>
                        <span class="input-group-text btn-primary maxLottoBonus">0</span>
                    </div>
                </div>
                <div class="d-grid gap-2">
                    <button type="submit" class="btn btn-primary btn-lg"><?=lang('Nav.claimbonus');?></button>
                    <a target="_blank" class="btn btn-primary btn-lg btn-play"><?=lang('Nav.playgame');?></a>
                </div>
                <?=form_close();?>
            </div>
        </div>
    </div>
</section>

<section class="modal fade modal-singleGameLanding" id="modal-singleGameLanding" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="modal-singleGameLanding" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content p-0 border-0">
            <div class="modal-header">
                <button type="button" class="btn btn-primary" onclick="getProfile();"><?=$_ENV['currency'];?><span class="ms-1 userBalance"></span></button>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body bg-dark">
                <figure class="text-center text-light">
                    <img class="d-inline-block w-50" src="">
                </figure>
                <?=form_open('',['class'=>'form-validation','novalidate'=>'novalidate'],['provider'=>'','gname'=>'','species'=>'']);?>
                <div class="d-grid gap-2">
                    <button type="submit" class="btn btn-primary btn-lg"><?=lang('Nav.playgame');?></button>
                </div>
                <?=form_close();?>
            </div>
        </div>
    </div>
</section>
<!-- End Games -->

<!-- Promotion -->
<section class="modal fade modal-promoBox" id="modal-promoBox" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="modal-promoBox" aria-hidden="true">
	<div class="modal-dialog modal-lg modal-dialog-scrollable">
		<article class="modal-content border-0">
			<div class="modal-header">
				<h5 class="modal-title promo-title"></h5>
				<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
			</div>
			<div class="modal-body">
				<img class="w-100 pb-3 promo-banner" src="">
				<div class="promo-desc"></div>
			</div>
			<div class="modal-footer promo-button"></div>
		</article>
	</div>
</section>
<!-- End Promotion -->

<!-- News -->
<section class="modal fade modal-newsBox" id="modal-newsBox" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="modal-newsBox" aria-hidden="true">
	<div class="modal-dialog modal-lg modal-dialog-scrollable">
		<article class="modal-content border-0">
			<div class="modal-header">
				<h5 class="modal-title news-title"></h5>
				<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
			</div>
			<div class="modal-body">
                <figure class="news-desc text-center">
                </figure>
			</div>
			<div class="modal-footer news-button"></div>
		</article>
	</div>
</section>
<!-- End News -->

<!-- AV News -->
<section class="modal fade modal-AVnewsBox" id="modal-AVnewsBox" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="modal-AVnewsBox" aria-hidden="true">
	<div class="modal-dialog modal-fullscreen">
		<article class="modal-content border-0">
			<div class="modal-header">
				<h5 class="modal-title news-title"><?=lang('Label.avvideotitle');?></h5>
				<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
			</div>
			<div class="modal-body">
                <figure class="AVnews-desc text-center h-100 w-100">
                    <!--<iframe src="https://drive.google.com/file/d/1o3iMd2TB4IWuOWxx9R6y-IqC3GP5o5LA/preview" class="w-100 h-100" allow="autoplay"></iframe>-->
                    <!--<iframe src="https://drive.google.com/file/d/16GQzfu7xLh-hT4NmLeRy8NGX5ADAOQJ3/preview" class="w-100 h-100" allow="autoplay"></iframe>-->
                        <video id="myVideo" class="h-100 w-100" controls loop playsinline controlsList="nodownload" oncontextmenu="return false;">
                            <source src="https://g-tcdl.com/gamecards_app/gamecard_vworld/resource/V2AV2.mp4" type="video/mp4"></source>
                            Your browser does not support the video tag.
                        </video>
                </figure>
			</div>
			<div class="modal-footer AVnews-button"></div>
		</article>
	</div>
</section>
<!-- End AV News -->

<!--- ByPassBlockPopUp --->
<section class="modal fade modal-byPassPopUp" id="modal-byPassPopUp" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="modal-byPassPopUp" aria-hidden="true">
	<div class="modal-dialog modal-dialog-centered">
		<article class="modal-content border-0">
			<div class="modal-header visually-hidden">
				<h5 class="modal-title fs-5">Notification</h5>
				<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
			</div>
			<div class="modal-body text-center">
                <p><?=lang('Validation.opennewtab');?></p>
				<a target="_blank" class="btn btn-primary" href="javascript:void(0);" data-bs-dismiss="modal" aria-label="Close">OK</a>
			</div>
		</article>
	</div>
</section>
<!--- End ByPassBlockPopUp --->

<!--Permission to responde credit withdrawal -->
<section class="modal fade modal-pendingPermission" id="modal-pendingPermission" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="modal-pendingPermission" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title"><?=lang('Label.permission');?></h5>
                <!--<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>-->
            </div>
            <div class="modal-body">
                <?=form_open('', ['class'=>'form-validation', 'novalidate'=>'novalidate','autocomplete'=>'off'], ['pid'=>'','bankid'=>'','cardno'=>'','accno'=>'']);?>
                <div class="mb-3 row">
                    <label class="col-4 col-form-label"><?=lang('Input.username');?></label>
                    <div class="col-8">
                        <input type="text" class="form-control-plaintext" name="username" readonly>
                    </div>
                </div>
                <div class="mb-3 row">
                    <label class="col-4 col-form-label"><?=lang('Input.amount');?></label>
                    <div class="col-8">
                        <input type="text" class="form-control-plaintext" name="amount" readonly>
                    </div>
                </div>
                <div class="mb-3 row">
                    <label class="col-4 col-form-label"><?=lang('Input.status');?></label>
                    <div class="col-8">
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="status" id="status-yes" value="1" required>
                            <label class="form-check-label" for="status-yes"><?=lang('Label.approve');?></label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="status" id="status-no" value="2">
                            <label class="form-check-label" for="status-no"><?=lang('Label.reject');?></label>
                        </div>
                    </div>
                </div>
                <div class="mb-3 row">
                    <label class="col-4 col-form-label"><?=lang('Input.remark');?></label>
                    <div class="col-8">
                        <textarea class="form-control" name="remark"></textarea>
                    </div>
                </div>
                <div class="text-end">
                    <!--<button type="button" class="btn btn-light" data-bs-dismiss="modal"><?=lang('Nav.close');?></button>-->
                    <button type="submit" class="btn btn-primary"><?=lang('Nav.submit');?></button>
                </div>
                <?=form_close();?>
            </div>
        </div>
    </div>
</section>
<!--End Permission to responde credit withdrawal -->

<script src="<?=base_url('assets/vendors/bootstrap/js/bootstrap.bundle.min.js');?>"></script>
<script src="<?=base_url('assets/vendors/sweetalert2/sweetalert2.min.js');?>"></script>
<script src="<?=base_url('assets/vendors/airdatepicker/js/datepicker.min.js');?>"></script>
<script src="<?=base_url('assets/vendors/airdatepicker/js/i18n/datepicker.en.js');?>"></script>
<script src="<?=base_url('assets/vendors/airdatepicker/js/i18n/datepicker.zh.js');?>"></script>
<script src="<?=base_url('assets/js/master.js?v='.rand());?>"></script>
<script src="<?=base_url('assets/js/add2home.js?v='.rand());?>"></script>
<script src="<?=base_url('assets/vendors/html2canvas/html2canvas.js');?>"></script>
<script src="<?=base_url('assets/vendors/qrcode/qrcode.min.js');?>"></script>
<script src="<?=base_url('assets/vendors/chatscreen/chatscreen.js?v='.rand());?>"></script>

<audio id="audio" src="<?=base_url('assets/sound/celebration.mp3');?>" autostart="false" ></audio>

<?php if( isset($_SESSION['logged_in']) ): ?>
<script src="<?=base_url('assets/vendors/draggable/draggabilly.js');?>"></script>
<script src="<?=base_url('assets/vendors/draggable/draggabilly.pkgd.min.js');?>"></script>

<!--
<nav class="btn-float-fw draggable-fw <?//=$_SESSION['lang'];?>" id="btn-float-fw">
    <a class="text-decoration-none d-inline-block px-3" href="javascript:void(0);" onclick="closeFloatFW();"><i class='bx bx-x'></i></a>
    <a class="text-decoration-none d-inline-block fortuneWheel" href="<?//=base_url('fortune-wheel');?>"></a>
</nav>

<nav class="btn-float-angpow draggable" id="btn-float-angpow">
    <a href="javascript:void(0);" class="btn-float-close" onclick="closeFloatAngpow();"></a>
    <button type="button" class="angpow" onclick="redeemLossRebate()"></button>
</nav>
-->

<!-- Hidden Bar -->
<!--
<section class="wrap-sideToggle d-none">
    <button type="button" class="btn p-0 border-0 btn-sideToggle" data-bs-toggle="button" autocomplete="off"><img class="w-100" src="<?//=base_url('assets/img/btn_giftbox.gif');?>"></button>
    <article class="p-3 rounded-bottom rounded-3">
        <a class="d-block text-decoration-none mb-3" href="javascript:void(0);" onclick="redeemLossRebate()"><img class="w-100" src="<?=base_url('assets/img/btn_hide_angpow.gif');?>"></a>
        <a class="d-block text-decoration-none" href="<?=base_url('fortune-wheel');?>"><img class="w-100" src="<?=base_url('assets/img/btn_hide_fortunewheel.gif');?>"></a>
    </article>
</section>
-->
<!-- End Hidden Bar -->
<?php endif; ?>
</body>
</html>

<script>
const logged = '<?=$session;?>';
document.addEventListener('DOMContentLoaded', (event) => {
    $.get('/device/check', function(data, status) {
        const obj = JSON.parse(data);
        if( obj.mobile==true ) {
            $('.btn-sideToggle').off().on('click', function(e) {
                e.preventDefault();
                const sideToggle = document.querySelector('.btn-sideToggle');
                let status = sideToggle.classList.contains('active');
                if( status==true ) {
                    document.getElementsByClassName("wrap-sideToggle")[0].classList.add('show');
                } else {
                    document.getElementsByClassName("wrap-sideToggle")[0].classList.remove('show');
                }
            });
        } else {
            // if( logged )
            // {
            //     var $draggable = $('.draggable').draggabilly({
            //         containment: true
            //     });

            //     var startOrientation = $('.draggable').data('draggabilly');
            //     startOrientation.setPosition(1380,545);

            //     $draggable.on('staticClick',function( event, pointer ) {
            //         // event.stopPropagation();
            //         // event.preventDefault();
            //         // redeemLossRebate();
            //     });

            //     window.addEventListener("orientationchange", function() {
            //         // console.log("the orientation of the device is now " + screen.orientation.angle);
            //         var revertOrientation = $('.draggable').data('draggabilly');
            //         revertOrientation.setPosition(1380,545);
            //     }, false);
            // }
        }
    });

    if( logged )
    {
        // refreshBalance();
        announcementList();
        getProfile();
        //loginCheckExist2ndPass(); //login check 2nd password
        //triggerPendinglist(); //membertransfer

        const affiliateQREvent = document.getElementById('modal-affiliateQR');
        affiliateQREvent.addEventListener('shown.bs.modal', function (event) {
            affiliateQR();
        });
        affiliateQREvent.addEventListener('hidden.bs.modal', function (event) {
            document.getElementById("qrcode").innerHTML = '';
        });

        // var $draggableFw = $('.draggable-fw').draggabilly({
        //     containment: true
        // });

        // var startOrientationFw = $('.draggable-fw').data('draggabilly');
        // // startOrientationFw.setPosition(left,top);
        // startOrientationFw.setPosition(9,476);

        // $draggableFw.on('staticClick',function( event, pointer ) {
        //     // event.stopPropagation();
        //     // event.preventDefault();
        //     // redeemLossRebate();
        // });

        // window.addEventListener("orientationchange", function() {
        //     // console.log("the orientation of the device is now " + screen.orientation.angle);
        //     var revertOrientationFw = $('.draggable-fw').data('draggabilly');
        //     revertOrientationFw.setPosition(20,476);
        // }, false);
    }

    getLiveChat();

    let copyGid = document.getElementById('btn-copygid');
    copyGid.addEventListener('click', () => {
        let str = document.getElementById('gameuserid');
        str.select();
        str.setSelectionRange(0, 99999);
        document.execCommand('copy');
    });

    let copyGpass = document.getElementById('btn-copygpass');
    copyGpass.addEventListener('click', () => {
        let str = document.getElementById('gameuserpass');
        str.select();
        str.setSelectionRange(0, 99999);
        document.execCommand('copy');
    });

    $('.modal-login form').on('submit', function(e) {
        e.preventDefault();

        if (this.checkValidity() !== false) {
            generalLoading();

            $('.modal-login [type=submit]').prop('disabled', true);

            var params = {};
            var formObj = $(this).closest("form");
            $.each($(formObj).serializeArray(), function (index, value) {
                params[value.name] = value.value;
            });

            $.post('/user/login', {
                params
            }, function(data, status) {
                const obj = JSON.parse(data);
                if( obj.code==1 ) {
                    window.location.replace("<?=base_url();?>");
                    swal.close();
                } else {
                    swal.fire("Error!", obj.message + " (Code: "+obj.code+")", "error");
                }
            })
            .done(function() {
                $('.modal-login [type=submit]').prop('disabled', false);
            })
            .fail(function() {
                $('.modal-login [type=submit]').prop('disabled', false);
                swal.fire("Error!", "Oopss! There are something wrong. Please try again later.", "error");
            });
        }
    });

    const loginEvent = document.getElementById('modal-login');
    loginEvent.addEventListener('hidden.bs.modal', function (event) {
        $('.modal').find('form').removeClass('was-validated');
        $('.modal').find('form').trigger('reset');
    });

    const check2ndPassEvent = document.getElementById('modal-check2ndPass');
    check2ndPassEvent.addEventListener('hidden.bs.modal', function (event) {
        $('.modal').find('form').removeClass('was-validated');
        $('.modal').find('form').trigger('reset');
    });

    $('.setup2ndPassForm').off().on('submit', function(e) {
        e.preventDefault();

        if (this.checkValidity() !== false) {
            $('.setup2ndPassForm [type=submit]').prop('disabled', true);

            var params = {};
            var formObj = $(this).closest("form");
            $.each($(formObj).serializeArray(), function (index, value) {
                params[value.name] = value.value;
            });
            
            $.post('/user/secondary-password/modify', {
                params
            }, function(data, status) {
                const obj = JSON.parse(data);
                if( obj.code==1 ) {
                    swal.fire("Success!", obj.message, "success").then(() => {
                        $('.modal-setup2ndPass').modal('hide');
                    });
                } else {
                    swal.fire("Error!", obj.message + " (Code: "+obj.code+")", "error").then(() => {
                        $('.setup2ndPassForm [type=submit]').prop('disabled', false);
                    });
                }
            })
            .done(function() {
                $('.setup2ndPassForm [type=submit]').prop('disabled', false);
            })
            .fail(function() {
                swal.fire("Error!", "Oopss! There are something wrong. Please try again later.", "error").then(() => {
                    $('.setup2ndPassForm [type=submit]').prop('disabled', false);
                });
            });
        }
    });

    const setup2ndPassEvent = document.getElementById('modal-setup2ndPass');
    setup2ndPassEvent.addEventListener('hidden.bs.modal', function (event) {
        $('.modal').find('form').removeClass('was-validated');
        $('.modal').find('form').trigger('reset');
    });

    // Games
    $('.modal-gameLanding .btn-close, .modal-gameLobby .btn-close, .modal-slotLobby .btn-close, .modal-prompt .btn-exit, .modal-appLanding .btn-close, .modal-appUrlLanding .btn-close, .modal-lottoLanding .btn-close, .modal-exclusiveLanding .btn-close, .modal-singleGameLanding .btn-close').off().on('click', function(e) {
        e.preventDefault();
        const provider = $(this).data('provider');
        $('.modal-slotLobby').modal('hide');
        $('.modal-prompt').modal('hide');
        $('.modal-appLanding').modal('hide');
        $('.modal-appUrlLanding').modal('hide');
        // alert(provider);
        if( provider ) {
            gameWithdrawal(provider);
        }
    });

    $('.modal-gameLanding form').on('submit', function(e) {
        e.preventDefault();
        let name = $('.modal-gameLanding [name=gname]').val();

        if (this.checkValidity() !== false) {
            generalLoading();

            $('.modal-gameLanding [type=submit]').prop('disabled', true);

            $.get('/device/check', function(dataDevice, statusDevice) {
                const objDevice = JSON.parse(dataDevice);

                let isMobile;
                if( objDevice.mobile==true ) {
                    isMobile = 1;
                } else {
                    isMobile = 0;
                }

                var params = {};
                var formObj = $('.modal-gameLanding form').closest("form");
                $.each($(formObj).serializeArray(), function (index, value) {
                    params[value.name] = value.value;
                    params['isMobile'] = isMobile;
                    params['credit'] = $('.modal-gameLanding .userBalance').html();
                    params['type'] = 1;
                });

                $.post('/game/lobby/open', {
                    params
                }, function(data, status) {
                    const obj = JSON.parse(data);
                    if( obj.code==1 ) {
                        swal.close();
                        refreshBalance();

                        if( objDevice.mobile==true ) {
                            if( params['species']==1 ) {
                                getGameBalance(1,params['provider']);
                                $('.modal-gameLobby').modal('toggle');
                                $('.modal-gameLobby .gamename').html(name);
                                $('.modal-gameLobby .btn-close').data('provider', params['provider']);
                            } else if( params['species']==2 ) {
                                getGameBalance(2,params['provider']);
                                $('.modal-slotLobby').modal('toggle');
                                // $('.modal-slotLobby .btn-close').data('provider', params['provider']);
                                // $('.modal-slotLobby .draggable').attr('href',obj.url);

                                prompt(params['provider'], obj.url);
                            }
                        } else {
                            if( params['species']==1 ) {
                                getGameBalance(1,params['provider']);
                            } else if( params['species']==2 ) {
                                getGameBalance(2,params['provider']);
                            }
                            window.open(obj.url, '_blank');
                        }
                        gameLobby(params['species'], obj.url);
                    } else {
                        swal.fire("Error!", obj.message + " (Code: "+obj.code+")", "error");
                    }
                })
                .done(function() {
                    $('.modal-gameLanding [type=submit]').prop('disabled', false);
                })
                .fail(function() {
                    swal.fire("Error!", "Oopss! There are something wrong. Please try again later.", "error");
                });
            });
        }
    });

    const gameLandingModel = document.getElementById('modal-gameLanding');
    gameLandingModel.addEventListener('hidden.bs.modal', function (event) {
        $(this).find('.btn-close').data('provider','');
        $(this).find('[name=gamebalance]').val(0);
    });

    const gameLobbyModel = document.getElementById('modal-gameLobby');
    gameLobbyModel.addEventListener('hidden.bs.modal', function (event) {
        $(this).find('.lobby').html('');
    });

    const slotLobbyModel = document.getElementById('modal-slotLobby');
    slotLobbyModel.addEventListener('hidden.bs.modal', function (event) {
        $('.modal-prompt .btn-exit').data('provider', '');
        $(this).find('.btn-close').data('provider', '');
        $(this).find('.lobby').html('');
    });
    slotLobbyModel.addEventListener('shown.bs.modal', function (event) {
        var $draggableLobby = $('.draggable-lobby').draggabilly({
            containment: true
        });

        var startOrientationLobby = $('.draggable-lobby').data('draggabilly');
        startOrientationLobby.setPosition(100,0);

        $draggableLobby.on('staticClick',function( event, pointer ) {
            // $('.modal-slotLobby').modal('toggle');
            $('.modal-prompt').modal('toggle');
        });

        window.addEventListener("orientationchange", function() {
            // console.log("the orientation of the device is now " + screen.orientation.angle);
            var revertOrientationLobby = $('.draggable-lobby').data('draggabilly');
            revertOrientationLobby.setPosition(200,0);
        }, false);
    });

    const promptyModel = document.getElementById('modal-prompt');
    promptyModel.addEventListener('hidden.bs.modal', function (event) {
        // $(this).find('.btn-exit').data('provider', '');
    });

    $('.modal-appLanding form').on('submit', function(e) {
        e.preventDefault();
        let name = $('.modal-appLanding [name=gname]').val();

        if (this.checkValidity() !== false) {
            generalLoading();

            $('.modal-appLanding [type=submit]').prop('disabled', true);

            $.get('/device/check', function(dataDevice, statusDevice) {
                const objDevice = JSON.parse(dataDevice);

                let isMobile;
                if( objDevice.mobile==true ) {
                    isMobile = 1;
                } else {
                    isMobile = 0;
                }

                var params = {};
                var formObj = $('.modal-appLanding form').closest("form");
                $.each($(formObj).serializeArray(), function (index, value) {
                    params[value.name] = value.value;
                    params['isMobile'] = isMobile;
                    params['credit'] = $('.modal-appLanding .userBalance').html();
                    params['type'] = 1;
                });

                $.post('/game/lobby/open', {
                    params
                }, function(data, status) {
                    const obj = JSON.parse(data);
                    if( obj.code==1 ) {
                        swal.close();
                        const checkJson = isJson(obj.url);
                        const station = JSON.parse(obj.url);

                        refreshBalance();
                        getGameBalance(params['species'], params['provider']);

                        if( objDevice.mobile==true && checkJson==true ) {
                            if( objDevice.platform=='Android' ) {
                                station.Android!='' ? window.location = station.Android : '';
                            } else if( objDevice.platform=='iOS' ) {
                                station.IOS!='' ? window.open(station.IOS, '_blank') : '';
                            }
                        }
                    } else {
                        swal.fire("Error!", obj.message + " (Code: "+obj.code+")", "error");
                    }
                })
                .done(function() {
                    $('.modal-appLanding [type=submit]').prop('disabled', false);
                })
                .fail(function() {
                    swal.fire("Error!", "Oopss! There are something wrong. Please try again later.", "error");
                });
            });
        }
    });

    const applandingModel = document.getElementById('modal-appLanding');
    applandingModel.addEventListener('hidden.bs.modal', function (event) {
        $(this).find('form').trigger('reset');
        $(this).find('form').removeClass('was-validated');
        $(this).find('[type=submit]').prop('disabled', false);
        $(this).find('.btn-download').attr('href','');
        $(this).find('.btn-close').data('provider','');
        $('.modal-appLanding [name=gamebalance]').val(0);
    });

    $('.modal-appUrlLanding form').on('submit', function(e) {
        e.preventDefault();
        let name = $('.modal-appUrlLanding [name=gname]').val();

        if (this.checkValidity() !== false) {
            generalLoading();

            $('.modal-appUrlLanding [type=submit]').prop('disabled', true);

            $.get('/device/check', function(dataDevice, statusDevice) {
                const objDevice = JSON.parse(dataDevice);

                let isMobile;
                if( objDevice.mobile==true ) {
                    isMobile = 1;
                } else {
                    isMobile = 0;
                }

                var params = {};
                var formObj = $('.modal-appUrlLanding form').closest("form");
                $.each($(formObj).serializeArray(), function (index, value) {
                    params[value.name] = value.value;
                    params['isMobile'] = isMobile;
                    params['credit'] = $('.modal-appUrlLanding .userBalance').html();
                    params['type'] = 1;
                });

                $.post('/game/lobby/open', {
                    params
                }, function(data, status) {
                    const obj = JSON.parse(data);
                    if( obj.code==1 ) {
                        swal.close();
                        refreshBalance();
                        getGameBalance(params['species'], params['provider']);
                        window.open(obj.url);
                    } else {
                        swal.fire("Error!", obj.message + " (Code: "+obj.code+")", "error");
                    }
                })
                .done(function() {
                    $('.modal-appUrlLanding [type=submit]').prop('disabled', false);
                })
                .fail(function() {
                    swal.fire("Error!", "Oopss! There are something wrong. Please try again later.", "error");
                });
            });
        }
    });

    //exclusive
    const exclusiveLandingModel = document.getElementById('modal-exclusiveLanding');
    exclusiveLandingModel.addEventListener('hidden.bs.modal', function (event) {
        $(this).find('form').trigger('reset');
        $(this).find('form').removeClass('was-validated');
        $(this).find('.btn-close').data('provider','');
        $('.modal-exclusiveLanding [name=gamebalance]').val(0);
    });

    //exclusive
    $('.modal-exclusiveLanding form').on('submit', function(e) {
        e.preventDefault();

        let species = $('.modal-exclusiveLanding [name=species]').val();
        let name = $('.modal-exclusiveLanding [name=gname]').val();
        let provider = $('.modal-exclusiveLanding [name=provider]').val();
        let code = $('.modal-exclusiveLanding [name=gamecode]').val();

        if (species == 2) {
            singleGameLandingExpress(species, name, provider, code);
        } else if (species == 1) {
            gameLandingExpress(species, name, provider)
        }

        $('.modal-exclusiveLanding').modal('hide');
    });

    $('.modal-lottoLanding form').on('submit', function(e) {
        e.preventDefault();
        let name = $('.modal-lottoLanding [name=gname]').val();

        if (this.checkValidity() !== false) {
            generalLoading();

            $('.modal-lottoLanding [type=submit]').prop('disabled', true);

            $.get('/device/check', function(dataDevice, statusDevice) {
                const objDevice = JSON.parse(dataDevice);

                let isMobile;
                if( objDevice.mobile==true ) {
                    isMobile = 1;
                } else {
                    isMobile = 0;
                }

                var params = {};
                var formObj = $('.modal-lottoLanding form').closest("form");
                $.each($(formObj).serializeArray(), function (index, value) {
                    params[value.name] = value.value;
                    params['isMobile'] = isMobile;
                    params['credit'] = $('.modal-lottoLanding .userBalance').html();
                    params['type'] = 1;

                    if( params['provider']=='GD' || params['provider']=='GDS' || params['provider']=='GD8' ) {
                        var lottoBalance = $('header .maxLottoBonus').html();
                        params['lotto'] = params['credit'] - lottoBalance;
                    }
                });

                //block lotto credit-in
                if ( params['provider'] == 'GD8' || params['provider'] == 'GDS' || params['provider'] == 'GD' ) 
                {
                    $.post('/game/lobby/openlotto', {
                        params
                    }, function(data, status) {
                        const obj = JSON.parse(data);
                        if( obj.code==1 ) {
                            swal.close();
                            refreshBalance();
                            getGameBalance(5,params['provider']);
                            byPassBlockPopUp(obj.url);
                            //window.open(obj.url, '_blank');
                        } else {
                            swal.fire("Error!", obj.message + " (Code: "+obj.code+")", "error");
                        }
                    })
                    .done(function() {
                        $('.modal-lottoLanding [type=submit]').prop('disabled', false);
                    })
                    .fail(function() {
                        swal.fire("Error!", "Oopss! There are something wrong. Please try again later.", "error");
                    });
                } 
                else
                {
                    $.post('/game/lobby/open', {
                        params
                    }, function(data, status) {
                        const obj = JSON.parse(data);
                        if( obj.code==1 ) {
                            swal.close();
                            refreshBalance();
                            getGameBalance(5,params['provider']);
                            byPassBlockPopUp(obj.url);
                            //window.open(obj.url, '_blank');
                        } else {
                            swal.fire("Error!", obj.message + " (Code: "+obj.code+")", "error");
                        }
                    })
                    .done(function() {
                        $('.modal-lottoLanding [type=submit]').prop('disabled', false);
                    })
                    .fail(function() {
                        swal.fire("Error!", "Oopss! There are something wrong. Please try again later.", "error");
                    });
                }
            });
        }
    });

    const lottoLandingModel = document.getElementById('modal-lottoLanding');
    lottoLandingModel.addEventListener('hidden.bs.modal', function (event) {
        $(this).find('form').trigger('reset');
        $(this).find('form').removeClass('was-validated');
        $(this).find('.btn-close').data('provider','');
        $('.modal-lottoLanding [name=gamebalance]').val(0);
    });

    $('.modal-lottoBonusLanding form').on('submit', function(e) {
        e.preventDefault();
        let name = $('.modal-lottoBonusLanding [name=gname]').val();

        if (this.checkValidity() !== false) {
            generalLoading();

            $('.modal-lottoBonusLanding [type=submit]').prop('disabled', true);

            $.get('/device/check', function(dataDevice, statusDevice) {
                const objDevice = JSON.parse(dataDevice);

                let isMobile;
                if( objDevice.mobile==true ) {
                    isMobile = 1;
                } else {
                    isMobile = 0;
                }

                var params = {};
                var formObj = $('.modal-lottoBonusLanding form').closest("form");
                $.each($(formObj).serializeArray(), function (index, value) {
                    params[value.name] = value.value;
                    params['isMobile'] = isMobile;
                });

                $.post('/DIY-promotion/transfer', {
                    params
                }, function(data, status) {
                    const obj = JSON.parse(data);
                    if( obj.code==1 ) {
                        $('.modal-lottoBonusLanding').find('form').trigger('reset');
                        $('.modal-lottoBonusLanding').find('form').removeClass('was-validated');
                        swal.close();
                        refreshBalance();
                        getGameBalance(6,params['provider']);
                        window.open(obj.url, '_blank');
                    } else {
                        swal.fire("Error!", obj.message + " (Code: "+obj.code+")", "error");
                    }
                })
                .done(function() {
                    $('.modal-lottoBonusLanding [type=submit]').prop('disabled', false);
                })
                .fail(function() {
                    swal.fire("Error!", "Oopss! There are something wrong. Please try again later.", "error");
                });
            });
        }
    });

    const lottoBonusLandingModel = document.getElementById('modal-lottoBonusLanding');
    lottoBonusLandingModel.addEventListener('hidden.bs.modal', function (event) {
        $(this).find('form').trigger('reset');
        $(this).find('form').removeClass('was-validated');
        $(this).find('[name=amount]').removeAttr('max');
    });
    // End Games

    // Promotion
    const promoBoxEvent = document.getElementById('modal-promoBox');
    promoBoxEvent.addEventListener('hidden.bs.modal', function (event) {
        $('.modal').find('form').removeClass('was-validated');
        $('.modal').find('form').trigger('reset');

        document.getElementsByClassName('promo-title')[0].innerHTML = '';
        document.getElementsByClassName('promo-desc')[0].innerHTML = '';
        document.getElementsByClassName('promo-banner')[0].setAttribute("src", '');
    });
    // End Promotion

    //Close AV
    $('.modal-AVnewsBox .btn-close').off().on('click', function(e) {
        e.preventDefault();
        
        var x = document.getElementById("myVideo");
        x.pause();
        $('.modal-AVnewsBox').modal('hide');
        //$("#modal-AVnewsBox iframe").attr("src", $("#modal-AVnewsBox iframe").attr("src"));
        //$("#modal-AVnewsBox video source").attr("src", $("#modal-AVnewsBox source").attr("src"));
    });

    //membertransfer
    $('.modal-pendingPermission form').on('submit', function(e) {
        e.preventDefault();

        if (this.checkValidity() !== false) {
            // generalLoading();
            $('.modal-pendingPermission [type=submit]').prop('disabled',true);

            var params = {};
            var formObj = $(this).closest("form");
            $.each($(formObj).serializeArray(), function (index, value) {
                params[value.name] = value.value;
            });

            // checkExist2ndPass();
            if (params['status'] == '1') { //approve
                verify2ndPassPending(params['pid'],params['username'],params['status'],params['remark']);
            } else { //reject
                responsePendingWithdrawal(params['pid'],params['username'],params['status'],params['remark']);
            }
        }
    });

    const pendingPermissionEvent = document.getElementById('modal-pendingPermission');
    pendingPermissionEvent.addEventListener('shown.bs.modal', function (event) {
        // getCompBankCard('compbankcard');
    });
    pendingPermissionEvent.addEventListener('hidden.bs.modal', function (event) {
        $('.modal').find('form').removeClass('was-validated');
        $('.modal').find('form').trigger('reset');
    });
    
});

//membertransfer
function triggerPendinglist()
{
    $.get('/user/creditwithdraw/trigger', function(data, status) {
        const obj = JSON.parse(data);
        if( obj.code == 1 ) {
            pendingPermission(obj.pid,obj.username,obj.amount,obj.bankid,obj.cardno,obj.accno)
        }
    })
    .done(function() {
    })
    .fail(function() {
        swal.fire("Error!", "Oopss! There are something wrong. Please try again later.", "error");
    });
}

//membertransfer
function pendingPermission(pid,username,amount,bankid,cardno,accno)
{
    //const decision = status==1 ? '<?=lang('Nav.approve');?>' : '<?=lang('Nav.reject');?>';

    $('.modal-pendingPermission').modal('show');
    //$('.modal-pendingPermission [name=decision]').val(decision);
    $('.modal-pendingPermission [name=username]').val(username);
    $('.modal-pendingPermission [name=amount]').val(amount);
    $('.modal-pendingPermission [name=pid]').val(pid);
    $('.modal-pendingPermission [name=bankid]').val(bankid);
    $('.modal-pendingPermission [name=cardno]').val(cardno);
    $('.modal-pendingPermission [name=accno]').val(accno);
}

//membertransfer
function verify2ndPassPending(pid,username,payStatus,remark)
{
    $('.modal-pendingPermission').modal('hide');
    $('.modal-check2ndPass').modal('toggle');

    $('.verify2ndPassForm').off().on('submit', function(e) {
        e.preventDefault();

        if (this.checkValidity() !== false) {
            generalLoading();

            $('.verify2ndPassForm [type=submit]').prop('disabled', true);

            var params = {};
            var formObj = $(this).closest("form");
            $.each($(formObj).serializeArray(), function (index, value) {
                params[value.name] = value.value;
            });

            $.post('/user/secondary-password/verify', {
                params
            }, function(data, status) {
                const obj = JSON.parse(data);
                if( obj.code==1 ) {
                    swal.close();

                    $('.modal-check2ndPass').modal('hide');
                    responsePendingWithdrawal(pid,username,payStatus,remark);
                } else {
                    swal.fire("Error!", obj.message + " (Code: "+obj.code+")", "error").then(() => {
                        $('.verify2ndPassForm [type=submit]').prop('disabled', false);
                    });
                }
            })
            .done(function() {
                $('.verify2ndPassForm [type=submit]').prop('disabled', false);
            })
            .fail(function() {
                swal.fire("Error!", "Oopss! There are something wrong. Please try again later.", "error").then(()=>{
                    $('.verify2ndPassForm [type=submit]').prop('disabled', false);
                });
            });
        }
    });
}

//membertransfer
function responsePendingWithdrawal(pid,username,payStatus,remark)
{
    generalLoading();

    var params = {};
    params['pid'] = pid;
    params['username'] = username;
    params['status'] = payStatus;
    params['remark'] = remark;
    params['bankid'] = '';
    params['accno'] = '';
    params['cardno'] = '';

    $.post('/transaction/permission', {
        params
    }, function(data, status) {
        const obj = JSON.parse(data);
        // console.log(obj);
        if( obj.code == 1 ) {
            swal.fire("", obj.message, "success").then(() => {                      
                getProfile();
                // paymentTable.ajax.reload(null,false);
                //$('#paymentTable').DataTable().ajax.reload(null,false);

                $('.modal-pendingPermission').modal('hide');
                $('.modal-pendingPermission [type=submit]').prop('disabled',false);
            });
        } else if( obj.code==39 ) {
            forceUserLogout();
        } else {
            swal.fire("", obj.message + " (Code: "+obj.code+")", "error").then(() => {                      
                $('.modal-pendingPermission [type=submit]').prop('disabled',false);
            });
        }
    })
    .done(function() {
    })
    .fail(function() {
        swal.fire("", "Please try again later.", "error").then(() => {                      
            $('.modal-pendingPermission [type=submit]').prop('disabled',false);
        });
    });
}
//end member transfer

// Category
function callingNews()
{
    generalLoading();

    //var params = {};
    //params['type'] = 5;

    $.get('/list/news', function(data, status) {
        document.getElementById("grid-news").innerHTML = data;
    })
    .done(function() {
        swal.close();
    })
    .fail(function() {
        swal.fire("Error!", "Oopss! There are something wrong. Please try again later.", "error");
    });
}

//News Landing
function newsReview(id)
{
    $('.modal-newsBox').modal('toggle');

    generalLoading();

    var params = {};
    params['id'] = id;

    $.post('/news/read-only/get', {
        params
    }, function(data, status) {
        const obj = JSON.parse(data);
        if( obj.code==1 ) {
            swal.close();
            $('.modal-newsBox .news-title').html(obj.data.title);
            $('.modal-newsBox .news-desc').html(obj.data.content);
            $('.modal-newsBox img').attr('class','w-100');
        } else {
            swal.fire("Error!", obj.message + " (Code: "+obj.code+")", "error").then(() => {
                $('.modal-newsBox').modal('hide');
            });
        }
    })
    .done(function() {
    })
    .fail(function() {
        swal.fire("Error!", "Oopss! There are something wrong. Please try again later.", "error").then(()=>{
            $('.modal-newsBox').modal('hide');
        });
    });
}

function callingAppGames()
{
    generalLoading();

    var params = {};
    params['type'] = 1;

    $.post('/list/app/games', {
        params
    }, function(data, status) {
        document.getElementById("grid-appgame").innerHTML = data;
    })
    .done(function() {
        swal.close();
    })
    .fail(function() {
        swal.fire("Error!", "Oopss! There are something wrong. Please try again later.", "error");
    });
}

function callingLotto()
{
    generalLoading();

    var params = {};
    params['type'] = 5;

    $.post('/list/lottery/games', {
        params
    }, function(data, status) {
        document.getElementById("grid-lottery").innerHTML = data;
    })
    .done(function() {
        swal.close();
    })
    .fail(function() {
        swal.fire("Error!", "Oopss! There are something wrong. Please try again later.", "error");
    });
}

function callingKeno()
{
    generalLoading();

    var params = {};
    params['type'] = 4;

    $.post('/list/keno/games', {
        params
    }, function(data, status) {
        document.getElementById("grid-keno").innerHTML = data;
    })
    .done(function() {
        swal.close();
    })
    .fail(function() {
        swal.fire("Error!", "Oopss! There are something wrong. Please try again later.", "error");
    });
}

function callingSport()
{
    generalLoading();

    var params = {};
    params['type'] = 3;

    $.post('/list/sportbook/games', {
        params
    }, function(data, status) {
        document.getElementById("grid-sport").innerHTML = data;
    })
    .done(function() {
        swal.close();
    })
    .fail(function() {
        swal.fire("Error!", "Oopss! There are something wrong. Please try again later.", "error");
    });
}

function callingESport()
{
    generalLoading();

    var params = {};
    params['type'] = 8;

    $.post('/list/esport/games', {
        params
    }, function(data, status) {
        document.getElementById("grid-esport").innerHTML = data;
    })
    .done(function() {
        swal.close();
    })
    .fail(function() {
        swal.fire("Error!", "Oopss! There are something wrong. Please try again later.", "error");
    });
}

function callingCasino()
{
    generalLoading();

    var params = {};
    params['type'] = 2;

    $.post('/list/live-casino/games', {
        params
    }, function(data, status) {
        document.getElementById("grid-casino").innerHTML = data;
    })
    .done(function() {
        swal.close();
    })
    .fail(function() {
        swal.fire("Error!", "Oopss! There are something wrong. Please try again later.", "error");
    });
}

function callingSlot()
{
    generalLoading();

    var params = {};
    params['type'] = 1;

    $.post('/list/slot/games', {
        params
    }, function(data, status) {
        document.getElementById("grid-slot").innerHTML = data;
    })
    .done(function() {
        swal.close();
    })
    .fail(function() {
        swal.fire("Error!", "Oopss! There are something wrong. Please try again later.", "error");
    });
}
// End Category

// Games
function prompt(provider, lobby)
{
    $('.modal-prompt .btn-exit').data('provider', provider);

    $('.modal-prompt .btn-lobby').on('click', function(e) {
        document.getElementById("slotLobby").innerHTML='';
        $('.modal-prompt').modal('toggle');
        gameLobby(2,lobby);
    });
}

function expressLobby(name, provider)
{
    generalLoading();
    
    $.get('/device/check', function(dataDevice, statusDevice) {
        const objDevice = JSON.parse(dataDevice);

        let isMobile;
        if( objDevice.mobile==true ) {
            isMobile = 1;
        } else {
            isMobile = 0;
        }

        var params = {};
        params['provider'] = provider;
        params['isMobile'] = isMobile;
        params['credit'] = $('header .userBalance').html();
        params['type'] = 1;

        $.post('/game/lobby/open', {
            params
        }, function(data, status) {
            const obj = JSON.parse(data);
            if( obj.code==1 ) {
                swal.close();
                refreshBalance();

                if( objDevice.mobile==true ) {
                    window.open(obj.url, '_parent');
                } else {
                    window.open(obj.url, '_blank');
                }
            } else {
                swal.fire("Error!", obj.message + " (Code: "+obj.code+")", "error");
            }
        })
        .done(function() {
        })
        .fail(function() {
            swal.fire("Error!", "Oopss! There are something wrong. Please try again later.", "error");
        });
    });
}

function expressFloatLobby(species, name, provider)
{
    generalLoading();
    
    $.get('/device/check', function(dataDevice, statusDevice) {
        const objDevice = JSON.parse(dataDevice);

        let isMobile;
        if( objDevice.mobile==true ) {
            isMobile = 1;
        } else {
            isMobile = 0;
        }
        // let isMobile;
        // if( objDevice.mobile==true && objDevice.platform=='iOS' ) {
        //     isMobile = 3;
        // } else if( objDevice.mobile==true && objDevice.platform=='Android' ) {
        //     isMobile = 2;
        // } else {
        //     isMobile = 0;
        // }

        var params = {};
        params['provider'] = provider;
        params['isMobile'] = isMobile;
        params['credit'] = $('header .userBalance').html();
        params['type'] = 1;

        $.post('/game/lobby/open', {
            params
        }, function(data, status) {
            const obj = JSON.parse(data);
            if( obj.code==1 ) {
                swal.close();
                refreshBalance();

                // if( objDevice.mobile==true ) {
                //     // window.open(obj.url, '_parent');

                //     if( provider=='VP' )
                //     {
                //         window.open(obj.url, '_blank');
                //     } else {
                //         if( objDevice.platform!='iOS' )
                //         {
                //             if( species==1 ) {
                //                 $('.modal-gameLobby').modal('toggle');
                //                 $('.modal-gameLobby .gamename').html(name);
                //                 $('.modal-gameLobby .btn-close').data('provider', params['provider']);
                //             } else if( species==2 ) {
                //                 $('.modal-slotLobby').modal('toggle');
                //                 prompt(params['provider'], obj.url);
                //             }
                //             gameLobby(species, obj.url);
                //         } else {
                //             window.open(obj.url, '_blank');
                //         }
                //     }
                // } else {
                //     window.open(obj.url, '_blank');
                        byPassBlockPopUp(obj.url);
                // }
            } else {
                swal.fire("Error!", obj.message + " (Code: "+obj.code+")", "error");
            }
        })
        .done(function() {
        })
        .fail(function() {
            swal.fire("Error!", "Oopss! There are something wrong. Please try again later.", "error");
        });
    });
}

function gameLobby(species, lobby)
{
    var node = document.createElement('iframe');
    node.setAttribute('allowfullscreen','allowfullscreen');
    node.setAttribute('frameborder','0');
    node.setAttribute('loading','lazy');
    node.setAttribute('width','100%');
    node.setAttribute('height','100%');
    node.src = lobby;
    node.seamless;

    if( species==1 ) {
        document.getElementById("gameLobby").appendChild(node);
    } else if( species==2 ) {
        document.getElementById("slotLobby").appendChild(node);
    }
}

function gameWithdrawal(provider) 
{
    generalLoading();

    var params = {};
    params['provider'] = provider;
    params['type'] = 2;

    $.post('/game/lobby/close', {
        params
    }, function(data, status) {
        const obj = JSON.parse(data);
        if( obj.code==1 ) {
            refreshBalance();
            $('.modal').modal('hide');
        } else {
            swal.fire("Error!", obj.message + " (Code: "+obj.code+")", "error");
        }
    })
    .done(function() {
        swal.close();
    })
    .fail(function() {
        swal.fire("Error!", "Oopss! There are something wrong. Please try again later.", "error");
    });
}

function getGameBalance(species, provider)
{
    var params = {};
    params['provider'] = provider;

    $.post('/game/balance/check', {
        params
    }, function(data, status) {
        const obj = JSON.parse(data);
        if( obj.code==1 ) {
            if( species==1 || species==2 ) {
                $('.modal-gameLanding [name=gamebalance]').val(obj.balance);
                // obj.balance>0 ? $('.modal-gameLanding .btn-close').data('provider', provider) : '';
                $('.modal-gameLanding .btn-close').data('provider', provider);
                $('.modal-exclusiveLanding [name=gamebalance]').val(obj.balance); //exclusive
                $('.modal-exclusiveLanding .btn-close').data('provider', provider); //exclusive
            } else if( species==3 ) {
                $('.modal-appLanding [name=gamebalance]').val(obj.balance);
                // obj.balance>0 ? $('.modal-appLanding .btn-close').data('provider', provider) : '';
                $('.modal-appLanding .btn-close').data('provider', provider);
            } else if( species==4 ) {
                $('.modal-appUrlLanding [name=gamebalance]').val(obj.balance);
                // obj.balance>0 ? $('.modal-appUrlLanding .btn-close').data('provider', provider) : '';
                $('.modal-appUrlLanding .btn-close').data('provider', provider);
            } else if( species==5 ) {
                $('.modal-lottoLanding [name=gamebalance]').val(obj.balance);
                // obj.balance>0 ? $('.modal-lottoLanding .btn-close').data('provider', provider) : '';
                $('.modal-lottoLanding .btn-close').data('provider', provider);
            } else if( species==6 ) {
                $('.modal-lottoBonusLanding [name=gamebalance]').val(obj.balance);
                let maxLottoBonus = $('.modal-lottoBonusLanding .maxLottoBonus').html();
                $('.modal-lottoBonusLanding [name=amount]').attr('max', maxLottoBonus);
            }
        } else {
            swal.fire("Error!", obj.message + " (Code: "+obj.code+")", "error");
        }
    })
    .done(function() {
    })
    .fail(function() {
        swal.fire("Error!", "Oopss! There are something wrong. Please try again later.", "error");
    });
}

function appUrlLanding(species, name, provider)
{
    if( logged )
    {
        $('.modal-appUrlLanding').modal('toggle');
        $('.modal-appUrlLanding img').attr('src','<?=$_ENV['gameProviderLogo'];?>/'+provider+'.png');
        $('.modal-appUrlLanding [name=gname]').val(name);
        $('.modal-appUrlLanding [name=provider]').val(provider);
        $('.modal-appUrlLanding [name=species]').val(species);
        getGameBalance(species, provider);
    } else {
        alertToast('bg-light', '<?=lang('Validation.loginaccount');?>');
    }
}

const pop = (url, w, h) => {
    // const popup = window.open(url, '_blank', 'toolbar=0,location=0,directories=0,status=1,menubar=0,titlebar=0,scrollbars=1,resizable=1,width=500,height=500');
    const popup = window.open(url, '_blank');
    return popup !== null && typeof popup !== 'undefined'
}

function byPassBlockPopUp(url) {
    $('.modal-byPassPopUp').modal('toggle');
    $('.modal-byPassPopUp .modal-body a').attr('onclick', 'return pop("'+url+'",300,200);');
}

function appLanding(species, name, provider)
{
    if( logged )
    {
        generalLoading();

        $('.modal-appLanding').modal('toggle');
        $('.modal-appLanding img').attr('src','<?=$_ENV['gameProviderLogo'];?>/'+provider+'.png');
        $('.modal-appLanding [name=gname]').val(name);
        $('.modal-appLanding [name=provider]').val(provider);
        $('.modal-appLanding [name=species]').val(species);
        getGameBalance(species, provider);

        var params = {};
        params['provider'] = provider;
        params['isMobile'] = 1;

        $.post('/game/lobby/get', {
            params
        }, function(data, status) {
            const obj = JSON.parse(data);
            if( obj.code==1 ) {
                const checkJson = isJson(obj.url);
                const station = JSON.parse(obj.url);

                $('.modal-appLanding [name=gameuserid]').val(station.LoginId);
                $('.modal-appLanding [name=gameuserpass]').val(station.Password);

                $.get('/device/check', function(data, status) {
                    const obj = JSON.parse(data);
                    if( checkJson==true ) {
                        if( obj.platform=='Android' ) {
                            $('.modal-appLanding .btn-download').attr('href',station.AndroidDownloadURL);
                        } else if( obj.platform=='iOS' ) {
                            $('.modal-appLanding .btn-download').attr('href',station.IOSDownloadURL);
                        } else {
                            $('.modal-appLanding .btn-download').attr('href',station.AndroidDownloadURL);
                        }
                    }
                });
            } else {
                swal.fire("Error!", obj.message + " (Code: "+obj.code+")", "error");
            }
        })
        .done(function() {
            swal.close();
        })
        .fail(function() {
            swal.fire("Error!", "Oopss! There are something wrong. Please try again later.", "error");
        });
    } else {
        alertToast('bg-light', '<?=lang('Validation.loginaccount');?>');
    }
}

function gameLandingExpress(species, name, provider)
{
    if( logged )
    {
        expressFloatLobby(species, name, provider);
    } else {
        alertToast('bg-light', '<?=lang('Validation.loginaccount');?>');
    }
}

function gameLanding(species, name, provider)
{
    if( logged )
    {
        $('.modal-gameLanding').modal('toggle');
        $('.modal-gameLanding img').attr('src','<?=$_ENV['gameProviderLogo'];?>/'+provider+'.png');
        $('.modal-gameLanding [name=gname]').val(name);
        $('.modal-gameLanding [name=provider]').val(provider);
        $('.modal-gameLanding [name=species]').val(species);
        getGameBalance(species, provider);
    } else {
        alertToast('bg-light', '<?=lang('Validation.loginaccount');?>');
    }
}

//exclusive
function exclusiveLanding(species, name, provider, gamecode, lang)
{
    if( logged )
    {
        if( species==2 ) {
            $('.modal-exclusiveLanding').modal('toggle');
            $('.modal-exclusiveLanding img.providerLogo').attr('src','<?=$_ENV['gameProviderLogo'];?>/'+provider+'.png');
            //$('.modal-exclusiveLanding img.gameRules').attr('src','<?=$_ENV['exGameRules'];?>/game_rules_'+lang+'.jpg');
            $('.modal-exclusiveLanding iframe').attr('src','');
            $('.modal-exclusiveLanding iframe').attr('class','d-none');
            $('.modal-exclusiveLanding [name=gname]').val(name);
            $('.modal-exclusiveLanding [name=provider]').val(provider);
            $('.modal-exclusiveLanding [name=species]').val(species);
            $('.modal-exclusiveLanding [name=gamecode]').val(gamecode);
            getGameBalance(species, provider);
        } else if( species==1 ) {
            $('.modal-exclusiveLanding').modal('toggle');
            $('.modal-exclusiveLanding img.providerLogo').attr('src','<?=$_ENV['gameProviderLogo'];?>/'+provider+'.png');
            $('.modal-exclusiveLanding img.gameRules').attr('src','');
            $('.modal-exclusiveLanding iframe').attr('src','<?=$_ENV['exGameRules'];?>/racing_'+lang+'.html');
            $('.modal-exclusiveLanding iframe').attr('class','d-block w-100 min-vh-100');
            $('.modal-exclusiveLanding [name=gname]').val(name);
            $('.modal-exclusiveLanding [name=provider]').val(provider);
            $('.modal-exclusiveLanding [name=species]').val(species);
            $('.modal-exclusiveLanding [name=gamecode]').val(gamecode);
            getGameBalance(species, provider);
        }
    } else {
        alertToast('bg-light', '<?=lang('Validation.loginaccount');?>');
    }
}

function lottoLanding(species, name, provider, lang)
{
    if( logged )
    {
        $('.modal-lottoLanding').modal('toggle');
        $('.modal-lottoLanding img').attr('src','<?=$_ENV['gameProviderLogo'];?>/'+provider+'.png');
        $('.modal-lottoLanding img.lottoPrize').attr('src','<?=$_ENV['lottoPrize'];?>/'+provider+'_prize_'+lang+'.png');
        $('.modal-lottoLanding [name=gname]').val(name);
        $('.modal-lottoLanding [name=provider]').val(provider);
        $('.modal-lottoLanding [name=species]').val(species);
        getGameBalance(species, provider);
    } else {
        alertToast('bg-light', '<?=lang('Validation.loginaccount');?>');
    }
}

function lottoBonusLanding(species, name, provider)
{
    if( logged )
    {
        $('.modal-lottoBonusLanding').modal('toggle');
        $('.modal-lottoBonusLanding img').attr('src','<?=$_ENV['gameProviderLogo'];?>/'+provider+'.png');
        $('.modal-lottoBonusLanding [name=gname]').val(name);
        $('.modal-lottoBonusLanding [name=provider]').val(provider);
        $('.modal-lottoBonusLanding [name=species]').val(species);
        getGameBalance(species, provider);

        $.get('/device/check', function(dataDevice, statusDevice) {
            const objDevice = JSON.parse(dataDevice);

            let isMobile;
            if( objDevice.mobile==true ) {
                isMobile = 1;
            } else {
                isMobile = 0;
            }

            var params = {};
            params['provider'] = provider;
            params['isMobile'] = isMobile;

            $.post('/game/lobby/get', {
                params
            }, function(data, status) {
                const obj = JSON.parse(data);
                if( obj.code==1 ) {
                    $('.modal-lottoBonusLanding .btn-play').attr('href',obj.url);
                } else {
                    swal.fire("Error!", obj.message + " (Code: "+obj.code+")", "error");
                }
            })
            .done(function() {
            })
            .fail(function() {
                swal.fire("Error!", "Oopss! There are something wrong. Please try again later.", "error");
            });
        });
    } else {
        alertToast('bg-light', '<?=lang('Validation.loginaccount');?>');
    }
}

function expressSingleFloatLobby(species, name, provider,code) 
{
    generalLoading();
    
    $.get('/device/check', function(dataDevice, statusDevice) {
        const objDevice = JSON.parse(dataDevice);

        let isMobile;
        if( objDevice.mobile==true ) {
            isMobile = 1;
        } else {
            isMobile = 0;
        }

        var params = {};
        params['provider'] = provider;
        params['gcode'] = code;
        params['isMobile'] = isMobile;
        params['credit'] = $('header .userBalance').html();
        params['type'] = 1;

        $.post('/single-game/open', {
            params
        }, function(data, status) {
            const obj = JSON.parse(data);
            if( obj.code==1 ) {
                swal.close();
                refreshBalance();

                if( objDevice.mobile==true ) {
                    // window.open(obj.url, '_parent');
                    if( species==1 ) {
                        $('.modal-gameLobby').modal('toggle');
                        $('.modal-gameLobby .gamename').html(name);
                        $('.modal-gameLobby .btn-close').data('provider', params['provider']);
                    } else if( species==2 ) {
                        $('.modal-slotLobby').modal('toggle');
                        prompt(params['provider'], obj.url);
                    }
                    gameLobby(species, obj.url);
                } else {
                    window.open(obj.url, '_blank');
                }
            } else {
                swal.fire("Error!", obj.message + " (Code: "+obj.code+")", "error");
            }
        })
        .done(function() {
        })
        .fail(function() {
            swal.fire("Error!", "Oopss! There are something wrong. Please try again later.", "error");
        });
    });
}

function expressSingleFloatLobby(species, name, provider,code)
{
    generalLoading();
    
    $.get('/device/check', function(dataDevice, statusDevice) {
        const objDevice = JSON.parse(dataDevice);

        let isMobile;
        if( objDevice.mobile==true ) {
            isMobile = 1;
        } else {
            isMobile = 0;
        }

        var params = {};
        params['provider'] = provider;
        params['gcode'] = code;
        params['isMobile'] = isMobile;
        params['credit'] = $('header .userBalance').html();
        params['type'] = 1;

        $.post('/single-game/open', {
            params
        }, function(data, status) {
            const obj = JSON.parse(data);
            if( obj.code==1 ) {
                swal.close();
                refreshBalance();

                if( objDevice.mobile==true ) {
                    // window.open(obj.url, '_parent');
                    if( species==1 ) {
                        $('.modal-gameLobby').modal('toggle');
                        $('.modal-gameLobby .gamename').html(name);
                        $('.modal-gameLobby .btn-close').data('provider', params['provider']);
                    } else if( species==2 ) {
                        $('.modal-slotLobby').modal('toggle');
                        prompt(params['provider'], obj.url);
                    }
                    gameLobby(species, obj.url);
                } else {
                    window.open(obj.url, '_blank');
                }
            } else {
                swal.fire("Error!", obj.message + " (Code: "+obj.code+")", "error");
            }
        })
        .done(function() {
        })
        .fail(function() {
            swal.fire("Error!", "Oopss! There are something wrong. Please try again later.", "error");
        });
    });
}

function singleGameLandingExpress(species, name, provider,code)
{
    if( logged )
    {
        expressSingleFloatLobby(species, name, provider,code);
    } else {
        alertToast('bg-light', '<?=lang('Validation.loginaccount');?>');
    }
}

function singleGame(name,code,provider)
{
	generalLoading();

	$.get('/device/check', function(dataDevice, statusDevice) {
		const objDevice = JSON.parse(dataDevice);

        let isMobile;
        if( objDevice.mobile==true ) {
            isMobile = 1;
        } else {
            isMobile = 0;
        }

		var params = {};
		params['isMobile'] = isMobile;
		params['credit'] = $('.wallet-wrapper .userBalance').html();
		params['provider'] = provider;
		params['gcode'] = code;
		params['type'] = 1;

		$.post('/single-game/open', {
			params
		}, function(data, status) {
			const obj = JSON.parse(data);
			if( obj.code==1 ) {
				swal.close();
				getProfile();

				// $('.modal-singleGameLanding').modal('show');
				// $('.modal-singleGameLanding .btn-close').data('provider', provider);
				// $('.modal-singleGameLanding img').attr('src','<?//=$_ENV['gameProviderLogo'];?>/'+provider+'.png');

				if( objDevice.mobile==true ) {
					window.open(obj.url, '_parent');
				} else {
					window.open(obj.url, '_blank');
				}
			} else {
				swal.fire("Error!", obj.message + " (Code: "+obj.code+")", "error");
			}
		})
		.done(function() {
		})
		.fail(function() {
			swal.fire("Error!", "Oopss! There are something wrong. Please try again later.", "error");
		});
	});
}

function refreshAndWithdrawGame()
{
	generalLoading();

	$.get('/refresh-credit/all', function(data, status) {
		const obj = JSON.parse(data);
		if( obj.code==1 ) {
			swal.close();
			getProfile();
		} else {
			swal.fire("Error!", obj.message + " (Code: "+obj.code+")", "error");
		}
	})
	.done(function() {
	})
	.fail(function() {
		swal.fire("Error!", "Oopss! There are something wrong. Please try again later.", "error");
	});
}
// End Games

// Odds
function lottoOdds()
{
    const odds = document.getElementById("prompt-lottoOdds");
    odds.classList.add("d-block");
}

function closeLottoOdds()
{
    const odds = document.getElementById("prompt-lottoOdds");
    odds.classList.remove("d-block");
}
// End Odds

// Affiliate
function affiliateQR()
{
    const affURL = '<?=$session ? $_ENV['affiliate']:'';?>/' + btoa('<?=$session ? $_SESSION['token']:'';?>');
    var qcode = new QRCode(document.getElementById("qrcode"), {
        text: affURL,
        correctLevel : QRCode.CorrectLevel.H
    });

    $('.modal-affiliateQR .btn-qrreg').attr('onclick', "copyRegUrl('" + affURL + "')");
}

function copyRegUrl(url)
{
    swal.fire({
        title: 'Affiliate URL',
        text: url,  
        showCancelButton: true,
        confirmButtonText: 'Copy',
    })
    .then((value) => {
        if (value.isConfirmed) {
            var str = $('.swal2-html-container')[0].innerText;
            // console.log(str);
            navigator.clipboard.writeText(str);
        }
    });
}

function getScreen()
{
	html2canvas($(".modal-affiliateQR .qrcard"), {
        dpi: 1024,
        // scale: 4,
        logging: false,
        // width: 466,
        // height: 772,
        letterRendering: true,
        allowTaint: true,
        useCORS: false,
        foreignObjectRendering : true,
		onrendered: function(canvas) {
			$(".modal-affiliateQR .getscreen").attr('href', canvas.toDataURL("image/png").replace(/^data:image\/png/, "data:application/octet-stream"));
			$(".modal-affiliateQR .getscreen").attr('download', '<?=$_ENV['company'];?>.png');
			// $(".modal-affiliateQR .getscreen")[0].click();
		}
	});
}

// End Affiliate

// Promotion
function claimPromo(promoId)
{
    var params = {};
    params['promotion'] = promoId;

    $.post('/payment/promotion-claim', {
        params
    }, function(data, status) {
        const obj = JSON.parse(data);
        if( obj.code==1 ) {
            swal.fire("Success!", obj.message, "success").then(() => {
                // $('#bcTable').DataTable().ajax.reload(null,false);
            });
        } else {
            swal.fire("Error!", obj.message + " (Code: "+obj.code+")", "error");
        }
    })
    .done(function() {
    })
    .fail(function() {
        swal.fire("Error!", "Oopss! There are something wrong. Please try again later.", "error").then(()=>{
        });
    });
}

function getPromoReadOnly(id)
{
    $('.modal-promoBox').modal('toggle');

    generalLoading();
    
    var params = {};
    params['id'] = id;

    $.post('/promotion/read-only/get', {
        params
    }, function(data, status) {
        const obj = JSON.parse(data);
        if( obj.code==1 ) {
            swal.close();
            $('.modal-promoBox .promo-title').html(obj.data.title);
            document.getElementsByClassName('promo-desc')[0].innerHTML = obj.data.content;
            document.getElementsByClassName('promo-banner')[0].setAttribute("src", obj.data.image);
        } else {
            swal.fire("Error!", obj.message + " (Code: "+obj.code+")", "error").then(() => {
                $('.modal-promoBox').modal('hide');
            });
        }
    })
    .done(function() {
    })
    .fail(function() {
        swal.fire("Error!", "Oopss! There are something wrong. Please try again later.", "error").then(()=>{
            $('.modal-promoBox').modal('hide');
        });
    });
}

function getPromo(promoId)
{
    $('.modal-promoBox').modal('toggle');

    generalLoading();

    var params = {};
    params['promoId'] = promoId;

    $.post('/promotion/get', {
        params
    }, function(data, status) {
        const obj = JSON.parse(data);
        if( obj.code==1 ) {
            swal.close();
			$('.modal-promoBox .promo-title').html(obj.data.title);
            document.getElementsByClassName('promo-desc')[0].innerHTML = obj.data.content;
            document.getElementsByClassName('promo-banner')[0].setAttribute("src", obj.data.img);

			if( logged && obj.data.continueClaim==true ) {
				document.getElementsByClassName('promo-button')[0].innerHTML = '<button class="btn btn-primary" onclick="claimPromo(\''+obj.data.id+'\');">Claim</button>';
			} else {
				document.getElementsByClassName('promo-button')[0].innerHTML = '';
			}
        } else {
            swal.fire("Error!", obj.message + " (Code: "+obj.code+")", "error").then(() => {
                $('.modal-promoBox').modal('hide');
            });
        }
    })
    .done(function() {
    })
    .fail(function() {
        swal.fire("Error!", "Oopss! There are something wrong. Please try again later.", "error").then(()=>{
            $('.modal-promoBox').modal('hide');
        });
    });
}
// End Promotion

// Support
function getLiveChat()
{
    $.get('/support/live-chat', function(data, status) {
        const obj = JSON.parse(data);
        if( obj.code==1 ) {
            $('a.liveChat').attr('href', obj.liveChatUrl);
        } else {
            swal.fire("Error!", obj.message + " (Code: "+obj.code+")", "error");
        }

        supportList();
    })
    .done(function() {
    })
    .fail(function() {
        swal.fire("Error!", "Oopss! There are something wrong. Please try again later.", "error");
    });
}

async function supportList()
{
    $.get('/list/support', function(data, status) {
        const obj = JSON.parse(data);
        const random = Math.floor(Math.random() * obj.data.length);
        if( obj.code==1 ) {
            $('a.whatsapp').attr('href','https://wa.me/6' + obj.data[random].whatsapp);

            $('a.whatsapp-forgotpass').attr('href','https://wa.me/6' + obj.data[random].whatsapp + '?text=Forgot Password');
        } else {
            swal.fire("Error!", obj.message + " (Code: "+obj.code+")", "error");
        }

        userUplineContact();
    })
    .done(function() {
    })
    .fail(function() {
        swal.fire("Error!", "Oopss! There are something wrong. Please try again later.", "error");
    });
}

async function userUplineContact()
{
    $.get('/user/upline/contact', function(data, status) {
        const obj = JSON.parse(data);
        if( obj.code==1 ) {
            // $('a.whatsapp').attr('href','https://wa.me/6' + obj.whatsapp);
            $('a.telegram').attr('href','https://t.me/' + obj.telegram);

            // $('a.whatsapp-forgotpass').attr('href','https://wa.me/6' + obj.whatsapp + '?text=Forgot Password');
        } else {
            swal.fire("Error!", obj.message + " (Code: "+obj.code+")", "error");
        }
    })
    .done(function() {
    })
    .fail(function() {
        swal.fire("Error!", "Oopss! There are something wrong. Please try again later.", "error");
    });
}

function userUplineContact4BigJackpot(code)
{
    $.get('/user/upline/contact', function(data, status) {
        const obj = JSON.parse(data);
        if( obj.code==1 ) {
            var encodeText = 'UID: <?=$session ?  $_SESSION['token']:'';?>%0a';
            encodeText += '<?=lang('Input.password');?>: ' + code;

            $('a.whatsapp-jackpot').attr('href','https://wa.me/6' + obj.whatsapp + '?text=' + encodeText);
        } else {
            // swal.fire("Error!", obj.message + " (Code: "+obj.code+")", "error");
        }
    })
    .done(function() {
    })
    .fail(function() {
        swal.fire("Error!", "Oopss! There are something wrong. Please try again later.", "error");
    });
}
// End Support

// Jackpot
function playSound()
{
    var x = document.getElementById("audio");
    x.play();
}

function closeJackpot()
{
    document.getElementsByClassName('wrap-jackpot')[0].classList.remove('show');
}

function closeBigJackpot()
{
    document.getElementsByClassName('wrap-bigJackpot')[0].classList.remove('show','d-flex');
}

function jackportTrigger()
{
    $.get('/user/jackpot/trigger', function(data, status) {
        const obj = JSON.parse(data);
        if( obj.code == 1 ) {
            refreshBalance();
            playSound();
            
            if( obj.jackpotAmount==2999 ) {
                document.getElementsByClassName('wrap-bigJackpot')[0].classList.add('show','d-flex');
                $('.wrap-bigJackpot .jackpotAmount').html('<?=$_ENV['currency'];?> ' + obj.jackpotAmount);
                $('.wrap-bigJackpot .jackpotPass').html(obj.password);

                userUplineContact4BigJackpot(obj.password);

                $('.wrap-bigJackpot .img-bigjackpot').attr('src','<?=base_url('assets/img/jackpot/jackpot_motor.gif');?>');
            } else if( obj.jackpotAmount==1999 ) {
                document.getElementsByClassName('wrap-bigJackpot')[0].classList.add('show','d-flex');
                $('.wrap-bigJackpot .jackpotAmount').html('<?=$_ENV['currency'];?> ' + obj.jackpotAmount);
                $('.wrap-bigJackpot .jackpotPass').html(obj.password);

                userUplineContact4BigJackpot(obj.password);

                $('.wrap-bigJackpot .img-bigjackpot').attr('src','<?=base_url('assets/img/jackpot/jackpot_mobile.gif');?>');
            } else if( obj.jackpotAmount==999 ) {
                document.getElementsByClassName('wrap-bigJackpot')[0].classList.add('show','d-flex');
                $('.wrap-bigJackpot .jackpotAmount').html('<?=$_ENV['currency'];?> ' + obj.jackpotAmount);
                $('.wrap-bigJackpot .jackpotPass').html(obj.password);

                userUplineContact4BigJackpot(obj.password);

                $('.wrap-bigJackpot .img-bigjackpot').attr('src','<?=base_url('assets/img/jackpot/jackpot_necklace.gif');?>');
            } else if( obj.jackpotAmount==299 ) {
                document.getElementsByClassName('wrap-bigJackpot')[0].classList.add('show','d-flex');
                $('.wrap-bigJackpot .jackpotAmount').html('<?=$_ENV['currency'];?> ' + obj.jackpotAmount);
                $('.wrap-bigJackpot .jackpotPass').html(obj.password);

                userUplineContact4BigJackpot(obj.password);

                $('.wrap-bigJackpot .img-bigjackpot').attr('src','<?=base_url('assets/img/jackpot/jackpot_ring.gif');?>');
            } else {
                document.getElementsByClassName('wrap-jackpot')[0].classList.add('show');
                $('.wrap-jackpot img').attr('src','<?=base_url('assets/img/jackpot/'.$_SESSION['lang'].'/angpow.gif');?>');
                document.getElementsByClassName('jackpotAmount')[0].innerHTML = '<?=$_ENV['currency'];?> ' + obj.jackpotAmount;
            }
        } else if( obj.code==39 ) {
            forceUserLogout();
        } else {
            swal.fire("Error!", obj.message + " (Code: "+obj.code+")", "error");
        }
    })
    .done(function() {
    })
    .fail(function() {
    });
}

function runningBigJackpot(timer)
{
    $.get('/user/jackpot/running-big-prize', function(data, status) {
        const obj = JSON.parse(data);
        if( obj.code == 1 ) {
            // if( obj.getJackpot==true && obj.type==5 ) {
            //     playSound();
            //     document.getElementsByClassName('wrap-bigJackpot')[0].classList.add('show','d-flex');
            //     $('.wrap-bigJackpot .jackpotAmount').html('<?=$_ENV['currency'];?> ' + obj.jackpotAmount);
            //     $('.wrap-bigJackpot .jackpotPass').html(obj.password);

            //     userUplineContact4BigJackpot(obj.password);

            //     // if( obj.jackpotAmount==2999 ) {
            //     //     $('.wrap-bigJackpot .img-bigjackpot').attr('src','<?//=base_url('assets/img/jackpot/jackpot_motor.gif');?>');
            //     // } else if( obj.jackpotAmount==1999 ) {
            //     //     $('.wrap-bigJackpot .img-bigjackpot').attr('src','<?//=base_url('assets/img/jackpot/jackpot_mobile.gif');?>');
            //     // } else if( obj.jackpotAmount==999 ) {
            //     //     $('.wrap-bigJackpot .img-bigjackpot').attr('src','<?//=base_url('assets/img/jackpot/jackpot_necklace.gif');?>');
            //     // } else {
            //         $('.wrap-bigJackpot .img-bigjackpot').attr('src','<?//=base_url('assets/img/jackpot/jackpot_default.gif');?>');
            //     // }
            // } else {
                // let bigJackpotStatus = $(".wrap-bigJackpot").hasClass('show');
                // if( bigJackpotStatus==true ) {
                //     closeBigJackpot();
                //     var sound = document.getElementById("audio");
                //     sound.pause();
                //     sound.currentTime = 0;
                // }
            // }

            if( obj.getJackpot==true )
            {
                jackportTrigger();
            }
        } else if( obj.code==39 ) {
            forceUserLogout();
        } else {
            swal.fire("Error!", obj.message + " (Code: "+obj.code+")", "error");
        }
    })
    .done(function() {
        refreshIncoming(timer);
    })
    .fail(function() {
    });
}

function runningJackpot()
{
    $.get('/user/jackpot/running-count', function(data, status) {
        const obj = JSON.parse(data);
        if( obj.code == 1 ) {
            if( obj.type!=5 && obj.getJackpot==true ) {
                jackportTrigger();
            } else if( obj.type==5 && obj.getJackpot==true ) {
                runningBigJackpot(60);
            }
        } else if( obj.code==39 ) {
            forceUserLogout();
        } else {
            swal.fire("Error!", obj.message + " (Code: "+obj.code+")", "error");
        }
    })
    .done(function() {
    })
    .fail(function() {
    });
}

function specialCount()
{
    $.get('/user/jackpot/running-big-prize', function(data, status) {
        const obj = JSON.parse(data);
        if( obj.code == 1 ) {
            if( obj.getJackpot==true )
            {
                jackportTrigger();
            }
        } else if( obj.code==39 ) {
            forceUserLogout();
        }
    })
    .done(function() {
    })
    .fail(function() {
    });
}

if( logged )
{
    var schedule;
    function refreshIncoming(timer)
    {
        refresh = timer * 1000;
        schedule = setTimeout(function() {
            runningBigJackpot(timer);
        }, refresh);
    }
    function startRefresh()
    {
        clearTimeout(schedule);
        refreshIncoming(60);
    }
    startRefresh();
}
// End Jackpot

// Loss Rebate
function redeemLossRebate()
{
    generalLoading();

    $('.btn-float.angpow').prop('disabled',true);

    $.get('/loss-rebate/request', function(data, status) {
        const obj = JSON.parse(data);
        if( obj.code==1 ) {
            refreshProfile();
            $('.modal-angpow').modal('show');
            $('.modal-angpow .modal-body').addClass('claim-lossrebate');
        } else if( obj.code==62 ) {
            $('.modal-angpow').modal('show');
            $('.modal-angpow .modal-body').addClass('deposit-lossrebate');
        } else if( obj.code==22 || obj.code==84 ) {
            $('.modal-angpow').modal('show');
            $('.modal-angpow .modal-body').addClass('no-lossrebate');
        } else {
            swal.fire("Error!", obj.message + " (Code: "+obj.code+")", "error");
        }
    })
    .done(function() {
        swal.close();
        $('.btn-float.angpow').prop('disabled',false);
    })
    .fail(function() {
        swal.fire("Error!", "Oopss! There are something wrong. Please try again later.", "error");
    });
}

function closeFloatAngpow()
{
	document.getElementById("btn-float-angpow").style.display="none";
}
// End Loss Rebate

// Fortune Wheel
function closeFloatFW()
{
    document.getElementById("btn-float-fw").style.display="none";
}
// End Fortune Wheel

// SMS Tac
function requestSmsTac(dom)
{
    const contact = $('.'+dom+' [name=mobile]').val();

    if( contact=='' ) {
        swal.fire("Error!", "<?=lang('Validation.mobile');?>", "warning");
        return false;
    } else {
        $('.regisForm [name=mobile').prop('readonly', true);
        var pass = Math.floor(100 + Math.random() * 900000);
        
        //Disable Get Tac Button
        $('.btn-tac').prop('disabled', true);

        sms(contact,pass);
    }
}

function requestTac()
{
    const contact = $('.regisForm [name=mobile]').val();

    if( contact=='' ) {
        swal.fire("Error!", "<?=lang('Validation.mobile');?>", "warning");
        return false;
    } else {
        $('.regisForm [name=mobile').prop('readonly', true);
        var pass = Math.floor(100 + Math.random() * 900000);

        //Disable Get Tac Button
        $('.btn-tac').prop('disabled', true);
        
        sms(contact,pass);
    }
}

function requestAffTac()
{
    const contact = $('.affRegisForm [name=mobile]').val();

    if( contact=='' ) {
        swal.fire("Error!", "<?=lang('Validation.mobile');?>", "warning");
        return false;
    } else {
        $('.affRegisForm [name=mobile').prop('readonly', true);
        var pass = Math.floor(100 + Math.random() * 900000);
        sms(contact,pass);
    }
}

function sms(contact,pass)
{
    let content = '[<?=$_ENV['company'];?>]--' + pass + '--';
        content += 'Code to be used once for <?=$_ENV['company'];?> login security verification. Do not share Code with others. Disregard this SMS if you did not intend to log in.';

    var params = {};
    params['contact'] = contact;
    params['message'] = content;
    params['veritac'] = pass;

    $.post('/sms/send', {
        params
    }, function(data, status) {
        const obj = JSON.parse(data);
        if( obj.code==1 ) {
            timer();
        } else if( obj.code==39 ) {
            forceUserLogout();
        } else {
            swal.fire("Error!", obj.message + " (Code: "+obj.code+")", "error");
        }
    });
}

function timer()
{
    //$('.btn-tac').prop('disabled', true);

    var seconds = 120;
    var countdown = setInterval(function() {
        seconds--;
        document.getElementById("timer").textContent = seconds;
        if (seconds <= 0) {
            clearInterval(countdown);
            document.getElementById("timer").textContent = 'Get TAC';
            $('.btn-tac').prop('disabled', false);
            // timer();
        }
    }, 1000);
}
// End SMS Tac

// Checking Procedures
function loginCheckExist2ndPass()
{
    generalLoading();

    $.get('/user/secondary-password/exist', function(data, status) {
        const obj = JSON.parse(data);
        if( obj.code==1 ) {
            swal.close();
            if( obj.havePassword==true ) {
                // verify2ndPass(user,amount);
            } else {
                $('.modal-setup2ndPass').modal('toggle');
            }
        } else {
            swal.fire("Error!", obj.message + " (Code: "+obj.code+")", "error").then(() => {
                // $('.userTransferForm [type=submit]').prop('disabled', true);
            });
        }
    })
    .done(function() {
    })
    .fail(function() {
        swal.fire("Error!", "Oopss! There are something wrong. Please try again later.", "error");
    });
}

function checkAndGoWithdrawal(min)
{
    generalLoading();

    $.get('/user/balance', function(data, status) {
		const obj = JSON.parse(data);
		if( obj.code==1 ) {
			swal.close();

            if( obj.balance>=min ) {
                window.location.replace('<?=base_url('withdrawal');?>');
            } else {
                swal.fire('<?=lang('Label.notif');?>', '<?=lang('Validation.withdrawalert6');?> <?=$_ENV['currency'];?>'+min, 'warning');
            }
		} else if( obj.code==39 ) {
            forceUserLogout();
        } else {
			swal.fire("Error!", obj.message + " (Code: "+obj.code+")", "error");
		}
	})
	.done(function() {
	})
	.fail(function() {
		swal.fire("Error!", "Oopss! There are something wrong. Please try again later.", "error");
	});
}

function loginCheckIfEmptyBankAccount()
{
    generalLoading();

    $.get('/list/raw/bank-account/user', function(data, status) {
		const obj = JSON.parse(data);
		if( obj.code==1 ) {
			swal.close();
            $('.modal-login').modal('hide');
            
            if( obj.data=='' ) {
                window.location.replace("<?=base_url('user/initial/bank-account');?>");
            } else {
                window.location.replace("<?=base_url();?>");
            }
		} else if( obj.code==39 ) {
            forceUserLogout();
        } else {
			swal.fire("Error!", obj.message + " (Code: "+obj.code+")", "error");
		}
	})
	.done(function() {
	})
	.fail(function() {
		swal.fire("Error!", "Oopss! There are something wrong. Please try again later.", "error");
	});
}

async function checkIfEmptyBankAccount(pattern)
{
    generalLoading();

    $.get('/list/raw/bank-account/user', function(data, status) {
		const obj = JSON.parse(data);
		if( obj.code==1 ) {
			swal.close();
            
            if( pattern==1 ) { // Login
                $('.modal-login').modal('hide');
                if( obj.data=='' ) {
                    window.location.replace("<?=base_url('user/initial/bank-account');?>");
                } else {
                    window.location.replace("<?=base_url();?>");
                }
            } else if( pattern==2 ) { // Check in home
                if( obj.data=='' ) {
                    window.location.replace("<?=base_url('user/initial/bank-account');?>");
                }
            } else if( pattern==3 ) { // Check in initial bc
                if( obj.data=='' ) {
                    getBankList('bank-list');
                } else {
                    $('.addBankCardForm').hide();
                    window.location.replace("<?=base_url();?>");
                }
            }
		} else if( obj.code==39 ) {
            forceUserLogout();
        } else {
			swal.fire("Error!", obj.message + " (Code: "+obj.code+")", "error");
		}
	})
	.done(function() {
	})
	.fail(function() {
		swal.fire("Error!", "Oopss! There are something wrong. Please try again later.", "error");
	});
}
// End Payment Check

// SEO
//getSEO();
function getSEO()
{
    $.get('/content/seo', function(data, status) {
        const obj = JSON.parse(data);
        if( obj.code == 1 ) {
            const seo = obj.data;
            if( seo!='' )
            {
                seo.forEach( (item, index) => {
                    $('.seoTitle').html(item.title);
                    $('.seoContent').html(item.content);
                });
            }
        } else if( obj.code==39 ) {
            forceUserLogout();
        }
        // else {
        //     swal.fire("Error!", obj.message + " (Code: "+obj.code+")", "error");
        // }
    })
    .done(function() {
    })
    .fail(function() {
    });
}
// End SEO

function getProfile()
{
    // $.get('/user-profile', function(data, status) {
    //     const obj = JSON.parse(data);
    //     if( obj.code == 1 ) {
            refreshBalance();
            specialCount();
    //         if( obj.data.jackpot==true ) {
    //             jackportTrigger();
    //         }
    //     } else if( obj.code==39 ) {
    //         forceUserLogout();
    //     } else {
    //         swal.fire("Error!", obj.message + " (Code: "+obj.code+")", "error");
    //     }
    // })
    // .done(function() {
    // })
    // .fail(function() {
    // });
}

function announcementList()
{
    var annExist = document.getElementById("annlist");

    $.get('/list/announcement/all', function(data, status) {
        const obj = JSON.parse(data);
        if( obj.code == 1 ) {
            if( obj.data!='' ) {
                const msg = obj.data;
                msg.forEach( (item, index) => {
                    var node = document.createElement("a");
                    node.classList.add('mx-5');
                    node.setAttribute('href', 'javascript:void(0);');
                    node.innerHTML = item.content;

                    if( !!annExist ) {
                        document.getElementById("annlist").appendChild(node);
                    }
                });
            } else {
                let str = '<a class="mx-5" href="javascript:void(0);">Enjoy gaming with <?=$_ENV['company'];?> even more! Asia Most Trusted Platform. Play Safe, Play me!</a>';

                if( !!annExist ) {
                    document.getElementById("annlist").innerHTML = str;
                }
            }
        } else if( obj.code==39 ) {
            forceUserLogout();
        } else {
            swal.fire("Error!", obj.message + " (Code: "+obj.code+")", "error");
        }
    })
    .done(function() {
    })
    .fail(function() {
    });
}

function gameProviderList(element)
{
    $.get('/list/game-provider', function(data, status) {
        const obj = JSON.parse(data);
        // console.log(obj);
        if( obj.code == 1 ) {
            const gp = obj.data;
            var nodeLast = document.createElement("option");
            var textnodeLast = document.createTextNode('ALL');
            nodeLast.setAttribute("value", 'ALL');
            nodeLast.appendChild(textnodeLast);
            document.getElementById(element).appendChild(nodeLast);
            
            gp.forEach(function(item, index) {
                var node = document.createElement("option");
                var textnode = document.createTextNode(item.name);
                node.setAttribute("value", item.code);
                node.appendChild(textnode);
                document.getElementById(element).appendChild(node);
            });
        } else if( obj.code==39 ) {
            forceUserLogout();
        } else {
            swal.fire("Error!", obj.message + " (Code: "+obj.code+")", "error");
        }
    })
    .done(function() {
    })
    .fail(function() {
        swal.fire("Error!", "Oopss! There are something wrong. Please try again later.", "error");
    });
}

function getCompanyCDM(element) {
    generalLoading();

    $.get('/list/bank-account/company', function(data, status) {
        const obj = JSON.parse(data);
        if( obj.data=='' ) {
            document.getElementById("deposit-CDM").innerHTML = '';
        }

        if( obj.code==1 && obj.data!='' ) {
            const bankCard = obj.data;
            var nodeLast = document.createElement("option");
            var textnodeLast = document.createTextNode('<?=lang('Label.selectbank');?>');
            nodeLast.setAttribute("value", '');
            nodeLast.appendChild(textnodeLast);
            document.getElementById(element).appendChild(nodeLast);

            bankCard.forEach(function(item, index) {
                var node = document.createElement("option");
                var textnode = document.createTextNode(item.name);
                node.setAttribute("value", item.bank);
                node.setAttribute("data-html", true);
                node.setAttribute("data-cardno", item.cardno);
                node.setAttribute("data-accno", item.accno);
                node.setAttribute("data-holder", item.holder);
                node.setAttribute("data-remark", item.remark);
                node.setAttribute("data-mindep", item.minDeposit);
                node.setAttribute("data-maxdep", item.maxDeposit);
                node.appendChild(textnode);
                document.getElementById(element).appendChild(node);
            });
        } else {
            // swal.fire("<?//=lang('Label.error');?>!", obj.message + " (Code: "+obj.code+")", "error");
        }
    })
    .done(function() {
        swal.close();
    })
    .fail(function() {
        // swal.fire("Error!", "Oopss! There are something wrong. Please try again later.", "error");
    });
}

function getBankList(element)
{
    $.get('/list/bank', function(data, status) {
        const obj = JSON.parse(data);
        if( obj.code==1 ) {
            const bank = obj.data;
            bank.forEach(function(item, index) {
                var node = document.createElement("option");
                var textnode = document.createTextNode(item.name);
                node.setAttribute("value", item.bank);
                node.appendChild(textnode);
                document.getElementById(element).appendChild(node);
            });
        } else {
            swal.fire("Error!", obj.message + " (Code: "+obj.code+")", "error");
        }
    })
    .done(function() {
    })
    .fail(function() {
        swal.fire("Error!", "Oopss! There are something wrong. Please try again later.", "error");
    });
}

function generalLoading()
{
    // swal.fire({
    //     title: '<?//=lang('Label.loading');?>',
	// 	showConfirmButton: false,
	// 	allowOutsideClick: false,
	// 	allowEscapeKey: false,
	// 	customClass: {
	// 		container: 'loading-gif'
	// 	}
	// });

    swal.fire({
        showConfirmButton: false,
        imageUrl: '<?=base_url('assets/img/loading.gif');?>',
        imageAlt: '<?=$_ENV['company'];?>',
        background: 'transparent'
	});
}

function showTime() {
    let current = new Date();
    let cDate = current.getFullYear() + '-' + (current.getMonth() + 1) + '-' + current.getDate();
    let cTime = current.getHours() + ":" + current.getMinutes() + ":" + current.getSeconds();
    let dateTime = cDate + ' ' + cTime;
    let MsiaDate = dateTime.toLocaleString("en-US", {timeZone: "Asia/Kuala_Lumpur"});
    document.getElementById("clock").innerHTML = 'GMT+8 ' + MsiaDate;
}
setInterval(showTime, 1000);

//Game Rules
function expressgameRules(species, name, provider) {  
    swal.fire({
        backdrop: true,
        allowOutsideClick: false,
        allowEscapeKey: false,
        padding: '0.5rem',
        title: '<?=lang('Validation.slotgamerulestitle');?>',
        html: '<?=lang('Validation.slotgamerulescontent');?>',
        customClass: {
	 		container: 'gamerules-content'
	 	},
        showDenyButton: true,
        confirmButtonText: '<?=lang('Nav.entergame');?>',
        denyButtonText: '<?=lang('Nav.cancel');?>',
    }).then( (result) => {
        if( result.isConfirmed ) {
            gameLandingExpress(species, name, provider);
        } else if ( result.isDenied ) {
            swal.close();
        }
    });
}

function expressSportRules(species, name, provider) {  
    swal.fire({
        backdrop: true,
        allowOutsideClick: false,
        allowEscapeKey: false,
        padding: '0.5rem',
        title: '<?=lang('Validation.useragreetitle');?>',
        html: '<?=lang('Validation.sportgamerulescontent');?>',
        customClass: {
	 		container: 'gamerules-content'
	 	},
        showDenyButton: true,
        confirmButtonText: '<?=lang('Nav.entergame');?>',
        denyButtonText: '<?=lang('Nav.cancel');?>',
    }).then( (result) => {
        if( result.isConfirmed ) {
            gameLandingExpress(species, name, provider);
        } else if ( result.isDenied ) {
            swal.close();
        }
    });
}

function appgameRules(species, name, provider) {  
    swal.fire({
        backdrop: true,
        allowOutsideClick: false,
        allowEscapeKey: false,
        padding: '0.5rem',
        title: '<?=lang('Validation.slotgamerulestitle');?>',
        html: '<?=lang('Validation.slotgamerulescontent');?>',
        customClass: {
	 		container: 'gamerules-content'
	 	},
        showDenyButton: true,
        confirmButtonText: '<?=lang('Nav.entergame');?>',
        denyButtonText: '<?=lang('Nav.cancel');?>',
    }).then( (result) => {
        if( result.isConfirmed ) {
            appLanding(species, name, provider);
        } else if ( result.isDenied ) {
            swal.close();
        }
    });
}

function appUrlgameRules(species, name, provider) {  
    swal.fire({
        backdrop: true,
        allowOutsideClick: false,
        allowEscapeKey: false,
        padding: '0.5rem',
        title: '<?=lang('Validation.slotgamerulestitle');?>',
        html: '<?=lang('Validation.slotgamerulescontent');?>',
        customClass: {
	 		container: 'gamerules-content'
	 	},
        showDenyButton: true,
        confirmButtonText: '<?=lang('Nav.entergame');?>',
        denyButtonText: '<?=lang('Nav.cancel');?>',
    }).then( (result) => {
        if( result.isConfirmed ) {
            appUrlLanding(species, name, provider);
        } else if ( result.isDenied ) {
            swal.close();
        }
    });
}

function exclusivegameRules(species, name, provider, gamecode, lang) {
    swal.fire({
        backdrop: true,
        allowOutsideClick: false,
        allowEscapeKey: false,
        padding: '0.5rem',
        title: '<?=lang('Validation.slotgamerulestitle');?>',
        html: '<?=lang('Validation.slotgamerulescontent');?>',
        customClass: {
	 		container: 'gamerules-content'
	 	},
        showDenyButton: true,
        confirmButtonText: '<?=lang('Nav.entergame');?>',
        denyButtonText: '<?=lang('Nav.cancel');?>',
    }).then( (result) => {
        if( result.isConfirmed ) {
            exclusiveLanding(species, name, provider, gamecode, lang);
        } else if ( result.isDenied ) {
            swal.close();
        }
    });
}

function singlegameRules(species, name, provider,code) {
    swal.fire({
        backdrop: true,
        allowOutsideClick: false,
        allowEscapeKey: false,
        padding: '0.5rem',
        title: '<?=lang('Validation.slotgamerulestitle');?>',
        html: '<?=lang('Validation.slotgamerulescontent');?>',
        customClass: {
	 		container: 'gamerules-content'
	 	},
        showDenyButton: true,
        confirmButtonText: '<?=lang('Nav.entergame');?>',
        denyButtonText: '<?=lang('Nav.cancel');?>',
    }).then( (result) => {
        if( result.isConfirmed ) {
            singleGameLandingExpress(species, name, provider,code);
        } else if ( result.isDenied ) {
            swal.close();
        }
    });
}

function expressLobbygameRules(name, provider) {
    swal.fire({
        backdrop: true,
        allowOutsideClick: false,
        allowEscapeKey: false,
        padding: '0.5rem',
        title: '<?=lang('Validation.slotgamerulestitle');?>',
        html: '<?=lang('Validation.slotgamerulescontent');?>',
        customClass: {
	 		container: 'gamerules-content'
	 	},
        showDenyButton: true,
        confirmButtonText: '<?=lang('Nav.entergame');?>',
        denyButtonText: '<?=lang('Nav.cancel');?>',
    }).then( (result) => {
        if( result.isConfirmed ) {
            expressLobby(name, provider);
        } else if ( result.isDenied ) {
            swal.close();
        }
    });
}

function expressLobbySportgameRules(name, provider) {
    swal.fire({
        backdrop: true,
        allowOutsideClick: false,
        allowEscapeKey: false,
        padding: '0.5rem',
        title: '<?=lang('Validation.useragreetitle');?>',
        html: '<?=lang('Validation.sportgamerulescontent');?>',
        customClass: {
	 		container: 'gamerules-content'
	 	},
        showDenyButton: true,
        confirmButtonText: '<?=lang('Nav.entergame');?>',
        denyButtonText: '<?=lang('Nav.cancel');?>',
    }).then( (result) => {
        if( result.isConfirmed ) {
            expressLobby(name, provider);
        } else if ( result.isDenied ) {
            swal.close();
        }
    });
}

//End Game Rules
</script>