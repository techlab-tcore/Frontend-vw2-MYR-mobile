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

<title><?=$_ENV['company'];?> | Online Casino Malaysia | Trusted Online Gambling Sites</title>

<link rel="icon" sizes="192x192" href="<?=base_url('assets/img/logo/favicon.ico');?>">
<link rel="icon" type="image/x-icon" href="<?=base_url('assets/img/logo/favicon.ico');?>">

<script src="<?=base_url('assets/js/jquery-3.5.1.min.js');?>"></script>
<link rel="manifest" href="<?=base_url('manifest.json');?>">
<link rel="stylesheet" href="<?=base_url('assets/vendors/bootstrap/css/bootstrap.min.css');?>">
<link rel="stylesheet" href="<?=base_url('assets/vendors/sweetalert2/sweetalert2.min.css');?>">
<link rel="stylesheet" href="<?=base_url('assets/vendors/boxicons/css/boxicons.min.css');?>">
<link rel="stylesheet" href="<?=base_url('assets/css/custom.css?v='.rand());?>">
<link rel="stylesheet" href="<?=base_url('assets/css/master.css?v='.rand());?>">
<link rel="stylesheet" href="<?=base_url('assets/css/responsive.css?v='.rand());?>">
<link rel="stylesheet" href="<?=base_url('assets/vendors/chatscreen/style.css?v='.rand());?>">
</head>
<body>

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

<div class="outer-container home-page bg-second" id="pMain">

<section class="container wrap-registration position-relative">
    <dl class="row g-0 m-0 p-xl-5 p-lg-5 p-md-5 p-0">
        <dd class="col-xl-6 col-lg-6 col-md-6 col-12 m-auto">

            <div class="card border-0 shadow">
                <div class="card-body p-xl-5 p-lg-5 p-md-5 p-4">
                    <h2 class="text-center pb-3 text-uppercase"><?=$secTitle;?></h2>
                    <?=form_open('', ['class'=>'form-validation addBankCardForm','novalidate'=>'novalidate']);?>
                    <div class="input-group mb-3">
                        <span class="input-group-text bg-white"><i class="bx bxs-user-badge"></i></span>
                        <input type="text" class="form-control rounded-end" name="holder" readOnly required>
                    </div>
                    <div class="input-group mb-3">
                        <span class="input-group-text bg-white"><i class="bx bxs-bank"></i></span>
                        <select class="form-select" name="bank" id="bank-list" required></select>
                    </div>
                    <div class="input-group mb-3">
                        <span class="input-group-text bg-white"><i class="bx bxs-credit-card"></i></span>
                        <input type="text" class="form-control" name="accno" pattern="[0-9]+" placeholder="<?=lang('Input.bankacc');?>" required>
                    </div>
                    <div class="d-grid gap-2">
                        <button type="submit" class="btn btn-primary btn-lg"><?=lang('Nav.submit');?></button>
                    </div>
                    <?=form_close();?>
                </div>
            </div>

        </dd>
    </dl>
</section>

</div>

<script src="<?=base_url('assets/vendors/bootstrap/js/bootstrap.bundle.min.js');?>"></script>
<script src="<?=base_url('assets/vendors/sweetalert2/sweetalert2.min.js');?>"></script>
<script src="<?=base_url('assets/js/master.js?v='.rand());?>"></script>
<script src="<?=base_url('assets/vendors/chatscreen/chatscreen.js?v='.rand());?>"></script>

</body>
</html>

<script>
document.addEventListener('DOMContentLoaded', (event) => {
    checkIfEmptyBankAccount(3);
    getProfile();

    $('.addBankCardForm').off().on('submit', function(e) {
        e.preventDefault();

        if (this.checkValidity() !== false) {
            $('.addBankCardForm [type=submit]').prop('disabled', true);

            var params = {};
            var formObj = $(this).closest("form");
            $.each($(formObj).serializeArray(), function (index, value) {
                params[value.name] = value.value;
            });
            
            $.post('/user/bank-account/add', {
                params
            }, function(data, status) {
                const obj = JSON.parse(data);
                if( obj.code == 1 ) {
                    swal.fire(obj.message, obj.code, 'success').then(() => {
                        // setupInitialFullName(params['holder']);
                        window.location.replace("<?=base_url();?>");
                    });
                } else if( obj.code==39 ) {
                    forceUserLogout();
                } else {
                    swal.fire("Error!", obj.message + " (Code: "+obj.code+")", "error");
                    $('.addBankCardForm [type=submit]').prop('disabled', false);
                }
            })
            .done(function() {
            })
            .fail(function() {
            });
        }
    });
});

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

function getProfile()
{
    // $.get('/user-profile', function(data, status) {
    //     const obj = JSON.parse(data);
    //     if( obj.code == 1 ) {
            refreshBalance();
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