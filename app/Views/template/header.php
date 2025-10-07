<header class="hd-primary px-2">
    <div class="navbar navbar-expand-lg p-0">

        <!--<button class="navbar-toggler border-0 p-0 me-3" type="button" data-bs-toggle="offcanvas" data-bs-target="#mainNavCanvas" aria-controls="mainNavCanvas" aria-expanded="false" aria-label="Toggle navigation"><i class='bx bx-menu'></i></button>-->

        <a class="navbar-brand mx-xl-0 mx-lg-0 mx-md-0 me-auto d-xl-none d-lg-none d-md-none d-inline-block" href="<?=base_url();?>"><img class="w-100" src="<?=base_url('assets/img/logo/logo.png');?>" alt="<?=$_ENV['company'];?>" title="<?=$_ENV['company'];?>"></a>

        <span class="visually-hidden maxLottoBonus"></span>
        <!-- Desktop -->
        <section class="w-100 d-xl-block d-lg-block d-md-block d-none topNav">
            <ul class="nav hstack">
                <li class="nav-item">
                    <a target="_blank" class="nav-link" href="<?=$_ENV['download'];?>"><i class="bx bx-cloud-download me-1"></i><?=lang('Nav.download');?></a>
                </li>
                <li class="nav-item">
                    <a target="_blank" class="nav-link liveChat" href="javascript:void(0):"><i class="bx bx-support me-1"></i><?=lang('Nav.livechat');?></a>
                </li>

                <li class="nav-item visually-hidden">
                    <a class="nav-link userBalance" href="javascript:void(0):"></a>
                </li>

                <li class="nav-item ms-auto">
                    <a class="nav-link" href="javascript:void(0):" id="clock"></a>
                </li>

                <li class="nav-item dropdown ms-3">
                    <a class="nav-link dropdown-toggle" href="#" id="dropdownMenuLang" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        <i class="<?=$_SESSION['lang'];?>"></i>
                        <?php
                        if( $_SESSION['lang']=='cn' ): echo '简体中文';
                        elseif( $_SESSION['lang']=='th' ): echo 'ภาษาไทย';
                        elseif( $_SESSION['lang']=='vn' ): echo 'TIẾNG VIỆT';
                        elseif( $_SESSION['lang']=='my' ): echo 'Bahasa';
                        else: echo 'English'; endif;
                        ?>
                    </a>
                    <ul class="dropdown-menu dropdown-menu-end rounded-3 shadow-lg menuLang" aria-labelledby="dropdownMenuLang">
                        <li><a class="dropdown-item" href="javascript:void(0)" onclick="translation('cn')">简体中文</a></li>
                        <li><a class="dropdown-item" href="javascript:void(0)" onclick="translation('en')"><i></i>English</a></li>
                        <li><a class="dropdown-item" href="javascript:void(0)" onclick="translation('my')"><i></i>Bahasa</a></li>
                        <li><a class="dropdown-item" href="javascript:void(0)" onclick="translation('th')"><i></i>ภาษาไทย</a></li>
                        <li><a class="dropdown-item" href="javascript:void(0)" onclick="translation('vn')"><i></i>TIẾNG VIỆT</a></li>
                    </ul>
                </li>
            </ul>
        </section>
        <!-- End Desktop -->

        <!-- Mobile -->
        <div class="d-xl-none d-lg-none d-md-none d-inline-block">
            <?php if( !isset($_SESSION['logged_in']) ): ?>
                <button type="button" class="btn btn-primary btn-sm me-1" data-bs-toggle="modal" data-bs-target=".modal-login"><?=lang('Nav.login');?></button>
                <!-- <a class="btn btn-secondary btn-sm me-2" href="<?//=base_url('create-account');?>"><?//=lang('Nav.join');?></a> -->
            <?php else: ?>
                <!-- <span class="me-3" onclick="refreshBalance()"><i class='bx bxs-coin-stack me-1'></i><span class="userBalance text-success"></span></span> -->
                <span class="me-3"><?=$_SESSION['username'];?></span>
            <?php endif; ?>
        </div>

        <nav class="dropdown mobile-lang d-xl-none d-lg-none d-md-none d-inline-block">
            <a class="btn-lang dropdown-toggle" href="#" role="button" id="dropdownMenuLang" data-bs-toggle="dropdown" aria-expanded="false">
                <i class="<?=$_SESSION['lang'];?>"></i>
            </a>
            <ul class="dropdown-menu dropdown-menu-end rounded-3 shadow-lg menuLang" aria-labelledby="dropdownMenuLang">
                <li><a class="dropdown-item" href="javascript:void(0)" onclick="translation('cn')">简体中文</a></li>
                <li><a class="dropdown-item" href="javascript:void(0)" onclick="translation('en')"><i></i>English</a></li>
                <li><a class="dropdown-item" href="javascript:void(0)" onclick="translation('my')"><i></i>Bahasa</a></li>
                <li><a class="dropdown-item" href="javascript:void(0)" onclick="translation('th')"><i></i>ภาษาไทย</a></li>
                <li><a class="dropdown-item" href="javascript:void(0)" onclick="translation('vn')"><i></i>TIẾNG VIỆT</a></li>
            </ul>
        </nav>
        <section class="offcanvas offcanvas-start bg-second d-xl-none d-lg-none d-md-none d-inline-block" tabindex="-1" id="mainNavCanvas" aria-labelledby="mainNavCanvas">
            <div class="offcanvas-header bg-second justify-content-center">
                <h5 class="offcanvas-title text-center"><img class="w-50" src="<?=base_url('assets/img/logo/logo.png');?>" alt="<?=$_ENV['company'];?>" title="<?=$_ENV['company'];?>"></h5>
                <!-- <button type="button" class="btn-close text-reset btn-close-white" data-bs-dismiss="offcanvas" aria-label="Close"></button> -->
            </div>
            <div class="offcanvas-body">
                <ul class="list-unstyled list-group list-group-flush">
                    <li>
                        <a class="list-group-item bg-transparent" href="<?=base_url();?>"><img class="me-2" src="<?=base_url('assets/img/icon/home.png');?>"><?=lang('Nav.home');?></a>
                    </li>
                    <?php if( isset($_SESSION['logged_in']) ): ?>
                        <li>
                            <a class="list-group-item bg-transparent color-major" href="<?=base_url('user-account/deposit');?>"><img class="me-2" src="<?=base_url('assets/img/icon/deposit.png');?>"><?=lang('Nav.deposit');?></a>
                        </li>
                        <li>
                            <a class="list-group-item bg-transparent" href="<?=base_url('user-account/withdrawal');?>"><img class="me-2" src="<?=base_url('assets/img/icon/withdraw.png');?>"><?=lang('Nav.withdrawal');?></a>
                        </li>
                        <!--<li>
                            <a class="list-group-item bg-transparent" href="<?=base_url('fortune-wheel');?>">
                                <?=lang('Nav.fortunewheel');?>
                                <span class="badge rounded-pill bg-danger ms-1 userFortuneToken">0</span>
                            </a>
                        </li>-->
                        <!--<li>
                            <a class="list-group-item bg-transparent" href="<?=base_url('user-balance-transfer');?>"><?=lang('Nav.utransfer');?></a>
                        </li>-->
                        <!--<li>
                            <a class="list-group-item bg-transparent" href="<?=base_url('user-vault');?>"><img class="me-2" src="<?=base_url('assets/img/icon/safety_box.png');?>"><?=lang('Nav.vault');?></a>
                        </li>-->
                        <li>
                            <a class="list-group-item bg-transparent" href="<?=base_url('transaction/history');?>"><img class="me-2" src="<?=base_url('assets/img/icon/transaction.png');?>"><?=lang('Nav.history');?></a>
                        </li>
                        <li>
                            <a class="list-group-item bg-transparent" href="<?=base_url('bet-log');?>"><img class="me-2" src="<?=base_url('assets/img/icon/bet_log.png');?>"><?=lang('Nav.betlog');?></a>
                        </li>
                        <li>
                            <a class="list-group-item bg-transparent" href="<?=base_url('realtime-bet-log');?>"><img class="me-2" src="<?=base_url('assets/img/icon/realtime_log.png');?>"><?=lang('Nav.refbetlog');?></a>
                        </li>
                        <li>
                            <a class="list-group-item bg-transparent" href="<?=base_url('score-log');?>"><img class="me-2" src="<?=base_url('assets/img/icon/game_log.png');?>"><?=lang('Nav.scorelog');?></a>
                        </li>
                        <li>
                            <a class="list-group-item bg-transparent" href="<?=base_url('affiliate-log');?>"><img class="me-2" src="<?=base_url('assets/img/icon/affiliate.png');?>"><?=lang('Nav.afflog');?></a>
                        </li>
                        <!--<li>
                            <a class="list-group-item bg-transparent" href="<?=base_url('affiliate-loss-rebate-log');?>"><?=lang('Nav.afflossrebatelog');?></a>
                        </li>-->
                        <li>
                            <a class="list-group-item bg-transparent" href="<?=base_url('user/bank-account');?>"><img class="me-2" src="<?=base_url('assets/img/icon/bank.png');?>"><?=lang('Nav.bankacc');?></a>
                        </li>
                        <li>
                            <a class="list-group-item bg-transparent" href="<?=base_url('user-password');?>"><img class="me-2" src="<?=base_url('assets/img/icon/password.png');?>"><?=lang('Nav.password');?></a>
                        </li>
                        <!--
                        <li>
                            <a class="list-group-item bg-transparent" href="javascript:void(0);"><?//=lang('Nav.commlist');?></a>
                        </li>
                        -->
                        <li>
                            <a class="list-group-item bg-transparent" href="<?=base_url('message');?>"><img class="me-2" src="<?=base_url('assets/img/icon/message.png');?>"><?=lang('Nav.message');?></a>
                        </li>
                    <?php else: ?>
                        <!--
                        <li>
                            <a class="list-group-item bg-transparent color-major" href="javascript:void(0);" data-bs-toggle="modal" data-bs-target=".modal-login"><img class="me-2" src="<?=base_url('assets/img/icon/login.png');?>"><?=lang('Nav.login');?></a>
                        </li>
                        -->
                        <!--
                        <li>
                            <a class="list-group-item bg-transparent color-major2" href="<?=base_url('create-account');?>"><?=lang('Nav.join');?></a>
                        </li>
                        -->
                    <?php endif; ?>
                        <li>
                            <a class="list-group-item bg-transparent" target="_blank" href="<?=$_ENV['download'];?>"><img class="me-2" src="<?=base_url('assets/img/icon/download.png');?>"><?=lang('Nav.download');?></a>
                        </li>

                    <?php if( isset($_SESSION['logged_in']) ): ?>
                        <li>
                            <a class="list-group-item bg-transparent text-danger" href="<?=base_url('user/logout');?>"><img class="me-2" src="<?=base_url('assets/img/icon/logout.png');?>"><?=lang('Nav.logout');?></a>
                        </li>
                    <?php endif; ?>
                    <!--
                    <li>
                        <a class="list-group-item bg-transparent whatsapp" target="_blank">Whatsapp</a>
                    </li>
                    <li>
                        <a class="list-group-item bg-transparent telegram" target="_blank">Telegram</a>
                    </li>
                    <li>
                        <a class="list-group-item bg-transparent liveChat" target="_blank"><?//=lang('Nav.livechat');?></a>
                    </li>
                    -->
                </ul>
            </div>
        </section>
        <!-- End Mobile -->

    </div>
</header>

<main>