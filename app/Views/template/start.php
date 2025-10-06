<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta http-equiv="Content-Security-Policy" content="upgrade-insecure-requests">
<meta id="meta-viewport" name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, viewport-fit=cover">
<meta name="robots" content="index, follow">
<meta name="description" content="Malaysia Trusted Online Casino - Visit <?=$_ENV['siteurl'];?> Now! Explore the best online gambling games including live casino, sports betting, slot games, and more!">

<meta name="theme-color" content="#000">
<meta name="msapplication-TileColor" content="#000">
<meta name="mobile-web-app-capable" content="yes">
<meta name="apple-mobile-web-app-capable" content="yes">
<meta name="apple-mobile-web-app-capable" content="yes" />
<meta name="mobile-web-app-capable" content="yes" />
<meta name="apple-mobile-web-app-status-bar-style" content="black-translucent">
<meta name="apple-mobile-web-app-title" content="#000">
<meta name="msapplication-navbutton-color" content="#000">

<link rel="apple-touch-icon" sizes="192x192" href="<?=base_url('assets/img/logo/appicon/192x192.png');?>">
<link rel="apple-touch-icon" sizes="180x180" href="<?=base_url('assets/img/logo/appicon/180x180.png');?>">
<link rel="apple-touch-icon" sizes="152x152" href="<?=base_url('assets/img/logo/appicon/152x152.png');?>">
<link rel="apple-touch-icon" sizes="144x144" href="<?=base_url('assets/img/logo/appicon/144x144.png');?>">
<link rel="apple-touch-icon" sizes="120x120" href="<?=base_url('assets/img/appicon/120x120.png');?>">
<link rel="apple-touch-icon" sizes="114x114" href="<?=base_url('assets/img/logo/appicon/114x114.png');?>">
<link rel="apple-touch-icon" sizes="96x96" href="<?=base_url('assets/img/logo/appicon/96x96.png');?>">
<link rel="apple-touch-icon" sizes="76x76" href="<?=base_url('assets/img/logo/appicon/76x76.png');?>">
<link rel="apple-touch-icon" sizes="72x72" href="<?=base_url('assets/img/logo/appicon/72x72.png');?>">
<link rel="apple-touch-icon" sizes="60x60" href="<?=base_url('assets/img/logo/appicon/60x60.png');?>">
<link rel="apple-touch-icon" sizes="57x57" href="<?=base_url('assets/img/logo/appicon/57x57.png');?>">
<link rel="apple-touch-icon" sizes="32x32" href="<?=base_url('assets/img/logo/appicon/32x32.png');?>">
<link rel="apple-touch-icon" sizes="16x16" href="<?=base_url('assets/img/logo/appicon/16x16.png');?>">

<title><?=$_ENV['company'];?> | Online Game Malaysia | Trusted Online Gambling Sites</title>

<link rel="icon" sizes="192x192" href="<?=base_url('assets/img/logo/favicon.ico');?>">
<link rel="icon" type="image/x-icon" href="<?=base_url('assets/img/logo/favicon.ico');?>">

<script src="<?=base_url('assets/js/jquery-3.5.1.min.js');?>"></script>
<link rel="manifest" href="<?=base_url('manifest.json');?>">
<link rel="stylesheet" href="<?=base_url('assets/vendors/bootstrap/css/bootstrap.min.css');?>">
<link rel="stylesheet" href="<?=base_url('assets/vendors/airdatepicker/css/datepicker.min.css');?>">
<link rel="stylesheet" href="<?=base_url('assets/vendors/sweetalert2/sweetalert2.min.css');?>">
<link rel="stylesheet" href="<?=base_url('assets/vendors/boxicons/css/boxicons.min.css');?>">
<link rel="stylesheet" href="<?=base_url('assets/css/custom.css?v='.rand());?>">
<link rel="stylesheet" href="<?=base_url('assets/css/master.css?v='.rand());?>">
<link rel="stylesheet" href="<?=base_url('assets/css/responsive.css?v='.rand());?>">
<link rel="stylesheet" href="<?=base_url('assets/vendors/chatscreen/style.css?v='.rand());?>">

<!-- Google tag (gtag.js) -->
<script async src="https://www.googletagmanager.com/gtag/js?id=G-JEZV7GWTKQ"></script>
<script>
  window.dataLayer = window.dataLayer || [];
  function gtag(){dataLayer.push(arguments);}
  gtag('js', new Date());

  gtag('config', 'G-JEZV7GWTKQ');
</script>

</head>
<body oncontextmenu="return false;">

<section class="chatscreen" id="pMask" style="display: none;"></section>

<script>
document.addEventListener('DOMContentLoaded', (event) => {
    const ua = navigator.userAgent.toLowerCase();
    if (ua.match(/MicroMessenger/i) == "micromessenger") {
        $('#pMask').show();
        $('#pMain').hide();
    } else {
        $('#pMask').hide();
        $('#pMain').show();
    }

    // $.get('/device/check', function(data, status) {
    //     const obj = JSON.parse(data);
    //     if( obj.mobile==false ) {
    //         window.location.href = '<?//=$_ENV['download'];?>';
    //     }
    // });
});
</script>

<!--block inspect-->
<script disable-devtool-auto src='<?=base_url('assets/vendors/block_inspect/block.js');?>' url='https://dl.topv2n.com/'></script>
<script>
document.onkeydown = function(e) {
    if(event.keyCode == 123) {
        return false;
    }
    if(e.ctrlKey && e.shiftKey && e.keyCode == 'I'.charCodeAt(0)){
        return false;
    }
    if(e.ctrlKey && e.shiftKey && e.keyCode == 'J'.charCodeAt(0)){
        return false;
    }
    if(e.ctrlKey && e.keyCode == 'U'.charCodeAt(0)){
        return false;
    }
}
</script>
<!--end block inspect-->

<!--Google Analysis-->
<?=view('google_analysis');?>

<div class="outer-container home-page bg-second" id="pMain">

    <!--- Announcement --->
    <?=view('announcement');?>
    <!--- Announcement --->

    <div class="row g-0">
        <div class="col-xl-2 col-lg-2 col-md-3 col-12 d-xl-block d-lg-block d-md-block d-none">
            <div class="p-3">

                <a class="d-block text-decoration" href="<?=base_url();?>">
                    <img class="mx-auto px-1 mb-3 d-xl-block d-lg-block d-md-block d-none w-100" src="<?=base_url('assets/img/logo/logo.png');?>" alt="<?=$_ENV['company'];?>" title="<?=$_ENV['company'];?>">
                </a>

                <!-- ClientZone -->
                <section class="clientZone">
                    <?php if( !isset($_SESSION['logged_in']) ): ?>
                        <div class="d-grid gap-2 px-4">
                            <button type="button" class="btn-login rounded-pill text-uppercase" data-bs-toggle="modal" data-bs-target=".modal-login"><?=lang('Nav.login');?></button>
                            <!-- <a href="<?//=base_url('create-account');?>" class="btn-register rounded-pill text-uppercase"><?//=lang('Nav.join');?></a> -->
                        </div>
                    <?php else: ?>
                        <div class="d-grid gap-2 px-4 text-center">
                        <label><i class='bx bxs-user-circle me-1'></i><?=$_SESSION['username'];?></label>
                        <b class=""><i class='bx bxs-coin-stack me-1'></i><span class="userBalance text-success"></span><a href="javascript:void(0);" class="ms-1" onclick="getProfile()"><i class='bx bx-refresh'></i></a></b>
                        <a href="<?=base_url('user-account/deposit');?>" class="btn btn-secondary rounded-pill text-uppercase"><?=lang('Nav.deposit');?></a>
                        <button type="button" class="btn btn-secondary rounded-pill text-uppercase" onclick="refreshAndWithdrawGame();"><?=lang('Nav.restore');?></button>
                        </div>
                    <?php endif; ?>
                </section>
                <!-- End ClientZone -->

                <!-- MainNav -->
                <menu class="sideMainNav p-0 text-uppercase">
                    <a data-page="home" class="d-block mb-2 rounded shadow-sm" href="<?=base_url();?>"><img class="me-2" src="<?=base_url('assets/img/icon/home.png');?>"><?=lang('Nav.home');?></a>
                    <a data-page="promos" class="d-block mb-2 rounded shadow-sm" href="<?=base_url('promotions');?>"><img class="me-2" src="<?=base_url('assets/img/icon/promo.png');?>"><?=lang('Nav.promo');?></a>
                    <?php if( isset($_SESSION['logged_in']) ): ?>
                    <a data-page="deposit" class="d-block mb-2 rounded shadow-sm" href="<?=base_url('user-account/deposit');?>"><img class="me-2" src="<?=base_url('assets/img/icon/deposit.png');?>"><?=lang('Nav.deposit');?></a>
                    <a data-page="withdrawal" class="d-block mb-2 rounded shadow-sm" href="<?=base_url('user-account/withdrawal');?>"><img class="me-2" src="<?=base_url('assets/img/icon/withdraw.png');?>"><?=lang('Nav.withdrawal');?></a>

                    <!--<a data-page="fortunew" class="d-block mb-2 rounded position-relative" href="<?//=base_url('fortune-wheel');?>"><?//=lang('Nav.fortunewheel');?><span class="badge rounded-pill bg-danger ms-1 fw-normal userFortuneToken">0</span></a>-->

                    <a data-page="bankacc" class="d-block mb-2 rounded shadow-sm" href="<?=base_url('user/bank-account');?>"><img class="me-2" src="<?=base_url('assets/img/icon/bank.png');?>"><?=lang('Nav.bankacc');?></a>
                    <a data-page="password" class="d-block mb-2 rounded shadow-sm" href="<?=base_url('user-password');?>"><img class="me-2" src="<?=base_url('assets/img/icon/password.png');?>"><?=lang('Nav.password');?></a>
                    <!--<a data-page="vault" class="d-block mb-2 rounded shadow-sm" href="<?=base_url('user-vault');?>"><img class="me-2" src="<?=base_url('assets/img/icon/safety_box.png');?>"><?=lang('Nav.vault');?></a>-->
                    <a data-page="history" class="d-block mb-2 rounded shadow-sm" href="<?=base_url('transaction/history');?>"><img class="me-2" src="<?=base_url('assets/img/icon/transaction.png');?>"><?=lang('Nav.history');?></a>
                    <a data-page="betlog" class="d-block mb-2 rounded shadow-sm" href="<?=base_url('bet-log');?>"><img class="me-2" src="<?=base_url('assets/img/icon/bet_log.png');?>"><?=lang('Nav.betlog');?></a>
                    <a data-page="refbetlog" class="d-block mb-2 rounded shadow-sm" href="<?=base_url('realtime-bet-log');?>"><img class="me-2" src="<?=base_url('assets/img/icon/realtime_log.png');?>"><?=lang('Nav.refbetlog');?></a>
                    <a data-page="scorelog" class="d-block mb-2 rounded shadow-sm" href="<?=base_url('score-log');?>"><img class="me-2" src="<?=base_url('assets/img/icon/game_log.png');?>"><?=lang('Nav.scorelog');?></a>
                    <a data-page="afflog" class="d-block mb-2 rounded shadow-sm" href="<?=base_url('affiliate-log');?>"><img class="me-2" src="<?=base_url('assets/img/icon/affiliate.png');?>"><?=lang('Nav.afflog');?></a>
                    <!--<a data-page="afflblog" class="d-block mb-2 rounded shadow-sm" href="<?//=base_url('affiliate-loss-rebate-log');?>"><?//=lang('Nav.afflossrebatelog');?></a>-->
                    <a data-page="message" class="d-block mb-2 rounded shadow-sm" href="<?=base_url('message');?>"><img class="me-2" src="<?=base_url('assets/img/icon/message.png');?>"><?=lang('Nav.message');?></a>
                    <a class="d-block mb-2 rounded bg-danger text-white" href="<?=base_url('user/logout');?>"><img class="me-2" src="<?=base_url('assets/img/icon/logout.png');?>"><?=lang('Nav.logout');?></a>
                    <?php endif; ?>
                </menu>
                <!-- End MainNav -->
            </div>
        </div>
        <div class="col-xl-10 col-lg-10 col-md-9 col-12 majorBox">