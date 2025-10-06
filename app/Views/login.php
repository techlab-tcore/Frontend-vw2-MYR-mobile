<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta http-equiv="Content-Security-Policy" content="upgrade-insecure-requests">
<meta id="meta-viewport" name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, viewport-fit=cover">
<meta name="robots" content="index, follow">
<meta name="description" content="">

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

<title><?=$_ENV['company'];?></title>

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
                    <!--<nav class="dropdown mobile-lang d-inline-block d-flex justify-content-end pb-3">
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
                    </nav>-->
                    <nav class="navbar dropdown mobile-lang d-inline-block d-flex pb-3">
                        <a class="btn btn-primary btn-sm mt-4 rounded btn-regis-login" href="<?=$_ENV['download'];?>"><i class='bx bx-download'></i></a>
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
                    <?=form_open('', ['class'=>'form-validation loginForm','novalidate'=>'novalidate']);?>
                    <div class="form-floating mb-3">
                        <select class="form-select" name="regionCode" required>
                            <option value="MYR" <?php if($region=='MYR'): echo 'selected'; endif;?>><?=lang('Label.malaysia');?></option>
                            <option value="SGD" <?php if($region=='SGD'): echo 'selected'; endif;?>> <?=lang('Label.singapore');?></option>
                        </select>
                        <label for="floatingPassword" class=""><?=lang('Input.regioncode');?></label>
                    </div>
                    <div class="form-floating mb-3">
                        <input type="text" class="form-control" id="contact" name="username" pattern="^[a-zA-Z0-9]{8,11}$" value="<?=$mobileno;?>" placeholder="<?=lang('Input.mobileno');?>" required>
                        <small class="invalid-feedback"><?=lang('Validation.mobile',[10,11]);?></small>
                        <label for="floatingUsername" class=""><?=lang('Input.mobileno');?></label>
                    </div>
                    <div class="form-floating mb-3">
                        <input type="password" class="form-control" id="password" name="password" pattern=".{6,}" value="<?=$pwd;?>" placeholder="<?=lang('Input.password');?>" required>
                        <small class="invalid-feedback"><?=lang('Validation.password',[6]);?></small>
                        <label for="floatingPassword" class=""><?=lang('Input.password');?></label>
                    </div>
                    <div class="form-check mb-3">
                        <input class="form-check-input" type="checkbox" value="isRememberMe" id="rememberMe">
                        <label class="form-check-label" for="rememberMe"><?=lang('Label.rememberme');?></label>
                    </div>
                    <div class="d-grid gap-2">
                        <button type="submit" class="btn btn-primary btn-lg shadow" onclick="isRememberMe();"><?=lang('Nav.login');?></button>
                        <a target="_blank" class="btn btn-secondary whatsapp" href=""><i class='bx bxl-whatsapp'></i>Whatsapp</a>
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
            </div>

        </dd>
    </dl>
</section>

<script>
document.addEventListener('DOMContentLoaded', (event) => {
    //User Login
    $('.loginForm').on('submit', function(e) {
    e.preventDefault();

        if (this.checkValidity() !== false) {
            generalLoading();

            $('.loginForm [type=submit]').prop('disabled', true);

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
                $('.loginForm [type=submit]').prop('disabled', false);
            })
            .fail(function() {
                $('.loginForm [type=submit]').prop('disabled', false);
                swal.fire("Error!", "Oopss! There are something wrong. Please try again later.", "error");
            });
        }
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
    //$.get('/device/check', function(data, status) {
    //    const obj = JSON.parse(data);
    //});

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

function generalLoading()
{
    swal.fire({
        showConfirmButton: false,
        imageUrl: '<?=base_url('assets/img/loading.gif');?>',
        imageAlt: '<?=$_ENV['company'];?>',
        background: 'transparent'
	});
}
</script>