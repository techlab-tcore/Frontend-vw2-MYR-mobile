<div class="container">
    <!--<?//=view('announcement');?>-->

    <dl class="row">
        <dd class="col-xl-3 col-lg-3 col-md-4 col-12">
            <?=view('template/sidenav');?>
        </dd>
        <dd class="col-xl-9 col-lg-9 col-md-8 col-12">
            <h4 class="color-major text-uppercase d-xl-none d-lg-none d-md-none d-block"><?=$secTitle;?></h4>
            <div class="card border-0 profileRight">
                <div class="card-header profileWallet border-0">
                    <?=view('profile-wallet');?>
                </div>
                <section class="text-end">
                    <a class="btn btn-primary rounded-0 rounded-start shadow" href="<?=base_url('history/user-balance-transfer');?>"><?=lang('Nav.transferhistory');?></a>
                </section>
                <div class="card-body p-xl-5 p-lg-5 p-md-5 p-3">
                    <?=form_open('',['class'=>'form-validation customForm userTransferForm','novalidate'=>'novalidate']);?>
                    <div class="row mb-3">
                        <label class="col-xl-3 col-lg-3 col-md-3 col-12 col-form-label text-dark position-relative required2"><?=lang('Input.username');?></label>
                        <div class="col-xl-9 col-lg-9 col-md-9 col-12">
                            <input type="text" class="form-control" pattern=".{6,15}" name="playerid" required>
                            <small class="invalid-feedback"><?=lang('Validation.username',[6,15]);?></small>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label class="col-xl-3 col-lg-3 col-md-3 col-12 col-form-label text-dark position-relative required2"><?=lang('Input.amount');?></label>
                        <div class="col-xl-9 col-lg-9 col-md-9 col-12">
                            <input type="number" min="1" step="any" class="form-control" name="amount" placeholder="MIN: 1.00" required>
                        </div>
                    </div>
                    <div class="row mb-5">
                        <div class="col-xl-9 col-lg-9 col-md-9 col-12 ms-auto">
                            <button type="submit" class="btn btn-secondary"><?=lang('Nav.submit');?></button>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-xl-9 col-lg-9 col-md-9 col-12 ms-auto">
                            <small class="d-block bg-major-light text-dark p-xl-5 p-lg-5 p-md-5 p-3">
                                <h5 class="color-major2"><?=lang('Label.importantnotice');?></h5>
                                <div class="noticeInfo">Player's Username os CASE-SENSITIVE</div>
                                <div class="noticeInfo">Please make sure the receipient's username</div>
                                <div class="noticeInfo">Daily Limit: Unlimited</div>
                                <div class="noticeInfo">Total Allowed: Unlimited</div>
                            </small>
                        </div>
                    </div>
                    <?=form_close();?>
                </div>
            </div>
        </dd>
    </dl>
</div>

<script>
document.addEventListener('DOMContentLoaded', (event) => {
    document.getElementsByClassName("nav-profileUTransfer")[0].classList.add("active");

    $('.userTransferForm').off().on('submit', function(e) {
        e.preventDefault();

        if (this.checkValidity() !== false) {
            $('.userTransferForm [type=submit]').prop('disabled', true);

            var params = {};
            var formObj = $(this).closest("form");
            $.each($(formObj).serializeArray(), function (index, value) {
                params[value.name] = value.value;
            });
            
            checkExist2ndPass(params['playerid'],params['amount']);
        }
    });
});

function userTransfer(user,amount)
{
    var params = {};
    params['playerid'] = user;
    params['amount'] = amount;
    
    $.post('/balance/user/transfer', {
        params
    }, function(data, status) {
        const obj = JSON.parse(data);
        if( obj.code==1 ) {
            swal.fire("Success!", obj.message, "success").then(() => {
                refreshBalance();
            });
        } else {
            swal.fire("Error!", obj.message + " (Code: "+obj.code+")", "error").then(() => {
                $('.userTransferForm [type=submit]').prop('disabled', false);
            });
        }
    })
    .done(function() {
        $('.userTransferForm [type=submit]').prop('disabled', false);
        $('form').removeClass('was-validated');
        $('form').trigger('reset');
    })
    .fail(function() {
        swal.fire("Error!", "Oopss! There are something wrong. Please try again later.", "error").then(() => {
            $('.userTransferForm [type=submit]').prop('disabled', false);
        });
    });
}

function verify2ndPass(user,amount)
{
    $('.verify2ndPassForm').off().on('submit', function(e) {
        e.preventDefault();

        if (this.checkValidity() !== false) {
            swal.fire({
                title: 'Processing...',
                showConfirmButton: false,
                allowOutsideClick: false,
                allowEscapeKey: false,
                customClass: {
                    container: 'bg-major'
                }
            });

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
                    userTransfer(user,amount);
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

function checkExist2ndPass(user,amount)
{
    swal.fire({
        title: 'Checking Credential...',
        showConfirmButton: false,
        allowOutsideClick: false,
        allowEscapeKey: false,
        customClass: {
            container: 'bg-major'
        }
    });

    $.get('/user/secondary-password/exist', function(data, status) {
        const obj = JSON.parse(data);
        if( obj.code==1 ) {
            swal.close();
            if( obj.havePassword==true ) {
                $('.modal-check2ndPass').modal('toggle');
                verify2ndPass(user,amount);
            } else {
                $('.modal-setup2ndPass').modal('toggle');
                $('.userTransferForm [type=submit]').prop('disabled', true);
            }
        } else {
            swal.fire("Error!", obj.message + " (Code: "+obj.code+")", "error").then(() => {
                $('.userTransferForm [type=submit]').prop('disabled', true);
            });
        }
    })
    .done(function() {
        $('.userTransferForm [type=submit]').prop('disabled', true);
    })
    .fail(function() {
        swal.fire("Error!", "Oopss! There are something wrong. Please try again later.", "error");
    });
}
</script>