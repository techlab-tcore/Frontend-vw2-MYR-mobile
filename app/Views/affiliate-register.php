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
<link rel="stylesheet" href="<?=base_url('assets/vendors/bootstrap/css/bootstrap.min.css');?>">
<link rel="stylesheet" href="<?=base_url('assets/vendors/sweetalert2/sweetalert2.min.css');?>">
<link rel="stylesheet" href="<?=base_url('assets/vendors/boxicons/css/boxicons.min.css');?>">
<link rel="stylesheet" href="<?=base_url('assets/css/custom.css?v='.rand());?>">
<link rel="stylesheet" href="<?=base_url('assets/css/master.css?v='.rand());?>">
<link rel="stylesheet" href="<?=base_url('assets/css/responsive.css?v='.rand());?>">
<link rel="stylesheet" href="<?=base_url('assets/vendors/chatscreen/style.css?v='.rand());?>">
</head>
<body class="h-100" oncontextmenu="return false;">

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

<div class="outer-container home-page bg-second h-100" id="pMain">

<section class="container wrap-registration position-relative">
    <dl class="row g-0 m-0 p-xl-5 p-lg-5 p-md-5 p-0">
        <dd class="col-xl-6 col-lg-6 col-md-6 col-12 m-auto">

            <div class="card border-0 shadow">
                <div class="card-body p-xl-5 p-lg-5 p-md-5 p-4">
                    <nav class="navbar dropdown mobile-lang d-inline-block d-flex pb-3">
                        <button type="button" class="btn btn-primary btn-sm mt-4 rounded btn-regis-login" data-bs-toggle="modal" data-bs-target=".modal-login"><?=lang('Nav.login');?></button>
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
                    <h2 class="text-center pb-3 text-uppercase"><?=$secTitle;?></h2>
                    <?=form_open('', ['class'=>'form-validation affRegisForm','novalidate'=>'novalidate']);?>
                    <div class="input-group mb-3">
                        <span class="input-group-text bg-white"><?=lang('Label.referrer');?></span>
                        <input type="text" class="form-control rounded-end bg-light" id="referrerid" name="rid" value="<?=$loginId;?>" placeholder="<?=lang('Label.invalidreferrer');?>" readonly>
                    </div>
                    <!--
                    <div class="input-group mb-3">
                        <span class="input-group-text bg-white"><i class="bx bx-mobile"></i></span>
                        <input type="text" pattern="^[0-9]{10,11}$" class="form-control rounded-end" id="regisUsername" name="mobile" placeholder="<?=lang('Input.mobileno');?>" required>
                        <small class="w-100 form-text"><?=lang('Validation.mobile');?></small>
                    </div>
                    -->
                    <div class="input-group mb-3">
                        <span class="input-group-text bg-white"><i class="bx bx-mobile"></i></span>
                        <select class="form-select regi-mobile-code" name="regionCode" required>
                            <option value="MYR" selected><?=lang('Label.malaysia');?></option>
                            <option value="SGD"><?=lang('Label.singapore');?></option>
                        </select>
                        <input type="text" pattern="^[0-9]{8,11}$" class="form-control rounded-end" id="regisUsername" name="mobile" placeholder="e.g.<?=$_ENV['sampleMobile'];?>" required>
                        <small class="w-100 form-text"><?=lang('Validation.mobile');?></small>
                    </div>
                    <div class="input-group mb-3">
                        <span class="input-group-text bg-white"><i class="bx bx-barcode-reader"></i></span>
                        <input type="text" class="form-control" id="floatingTAC" name="veritac" placeholder="<?=lang('Input.smstac');?>" required>
                        <button type="button" class="btn btn-primary btn-tac" id="timer" onclick="requestAffTac();"><?=lang('Nav.gettac');?></button>
                        <small class="w-100 form-text text-danger"><?=lang('Validation.tacexceed');?></small>
                    </div>
                    <div class="input-group mb-3">
                        <span class="input-group-text bg-white"><i class="bx bx-lock"></i></span>
                        <input type="password" pattern=".{6,}" class="form-control rounded-end" id="regisPass" name="password" placeholder="<?=lang('Input.password');?>" required>
                        <small class="w-100 form-text"><?=lang('Validation.password');?></small>
                    </div>
                    <div class="input-group mb-3">
                        <span class="input-group-text bg-white"><i class="bx bxs-user-badge"></i></span>
                        <input type="text" pattern="^[a-zA-Z ]{3,}$" class="form-control rounded-end" id="floatingFname" name="fname" placeholder="<?=lang('Input.fullname');?>" required>
                        <small class="w-100 form-text"><?=lang('Validation.fullname');?></small>
                    </div>
                    <div class="d-grid gap-2">
                        <button type="submit" class="btn btn-primary btn-lg"><?=lang('Nav.submit');?></button>
                        <a target="_blank" class="btn btn-secondary whatsapp" href=""><i class='bx bxl-whatsapp'></i>Whatsapp</a>
                    </div>
                    <?=form_close();?>
                </div>
            </div>

        </dd>
    </dl>
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

<script>
document.addEventListener('DOMContentLoaded', (event) => {
    $('.affRegisForm').on('submit', function(e) {
        e.preventDefault();

        if (this.checkValidity() !== false) {
            generalLoading();

            $('.affRegisForm [type=submit]').prop('disabled', true);

            var params = {};
            var formObj = $(this).closest("form");
            $.each($(formObj).serializeArray(), function (index, value) {
                params[value.name] = value.value;
                params['affiliate'] = '<?=$affiliate;?>';
            });

            $.post('/user/registration', {
                params
            }, function(data, status) {
                $('.affRegisForm [type=submit]').prop('disabled', false);
                const obj = JSON.parse(data);
                if( obj.code==1 ) {
                    swal.fire("Success!", obj.message, "success").then(()=>{
                        window.location.replace("<?=base_url();?>");
                    });
                } else {
                    swal.fire("Error!", obj.message + " (Code: "+obj.code+")", "error").then(() => {
                        $('.affRegisForm [type=submit]').prop('disabled', false);
                    });
                }
            })
            .done(function() {
                $('.affRegisForm [type=submit]').prop('disabled', false);
            })
            .fail(function() {
                swal.fire("Error!", "Oopss! There are something wrong. Please try again later.", "error").then(()=>{
                    $('.affRegisForm [type=submit]').prop('disabled', false);
                });
            });
        }
    });

        //User Login
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
});
</script>

</div>

<script src="<?=base_url('assets/vendors/bootstrap/js/bootstrap.bundle.min.js');?>"></script>
<script src="<?=base_url('assets/vendors/sweetalert2/sweetalert2.min.js');?>"></script>
<script src="<?=base_url('assets/js/master.js?v='.rand());?>"></script>
<script src="<?=base_url('assets/vendors/chatscreen/chatscreen.js?v='.rand());?>"></script>

</body>
</html>

<script>
document.addEventListener('DOMContentLoaded', (event) => {
    $.get('/device/check', function(data, status) {
        const obj = JSON.parse(data);
    });

    getLiveChat();
});

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

        //userUplineContact();
    })
    .done(function() {
    })
    .fail(function() {
        swal.fire("Error!", "Oopss! There are something wrong. Please try again later.", "error");
    });
}


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
        sms(contact,pass);
    }
}

function requestAffTac()
{
    const contact = $('.affRegisForm [name=mobile]').val();
    const regioncode = $('.affRegisForm [name=regionCode]').val();

    if( contact=='' ) {
        swal.fire("Error!", "<?=lang('Validation.mobile');?>", "warning");
        return false;
    } else {
        $('.affRegisForm [name=mobile').prop('readonly', true);
        var pass = Math.floor(100000 + Math.random() * 900000);

        //Disable Get Tac Button
        $('.btn-tac').prop('disabled', true);

        // if (regioncode == 'MYR') {
            sms(contact,pass,regioncode);
        // } else {
            // whatsappTAC(contact,pass, regioncode);
        // }
    }
}

function sms(contact,pass,regioncode)
{
    let content = '[<?=$_ENV['SMScompany'];?>]--' + pass + '--';
        content += 'Code to be used once for login security verification. Do not share Code with others. Disregard this SMS if you did not intend to log in.';

    var params = {};
    params['regioncode'] = regioncode;
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
            $('.btn-tac').prop('disabled', false);
            $('.affRegisForm [name=mobile').prop('readonly', false);
        }
    });
}

function whatsappTAC(contact,pass,mobilecode)
{
    let content = '[<?=$_ENV['SMScompany'];?>]--' + pass + '--';
        content += 'Code to be used once for login security verification.';

    var params = {};
    params['contact'] = contact;
    params['message'] = content;
    params['veritac'] = pass;
    params['mobilecode'] = mobilecode;

    $.post('/whatsapp/send-tac', {
        params
    }, function(data, status) {
        const obj = JSON.parse(data);
        if( obj.code==1 ) {
            swal.close();
            timer();
        } else if( obj.code==39 ) {
            forceUserLogout();
        } else {
            swal.fire("Error!", obj.message + " (Code: "+obj.code+")", "error");
            $('.btn-tac').prop('disabled', false);
            $('.affRegisForm [name=mobile').prop('readonly', false);
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

function generalLoading()
{
    swal.fire({
        title: '<?=lang('Label.loading');?>',
		showConfirmButton: false,
		allowOutsideClick: false,
		allowEscapeKey: false,
		customClass: {
			container: 'loading-gif'
		}
	});
}
</script>