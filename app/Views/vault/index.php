<div class="container">

    <dl class="row">
        <!--
        <dd class="col-xl-3 col-lg-3 col-md-4 col-12">
            <?//=view('template/sidenav');?>
        </dd>
        -->
        <dd class="col-xl-12 col-lg-12 col-md-12 col-12">
            <h4 class="color-major text-uppercase d-xl-none d-lg-none d-md-none d-block"><?=$secTitle;?></h4>
            <div class="card border-0 profileRight">
                <div class="card-header profileWallet border-0 p-3 bg-dark rounded-4 text-light">
                    <?=view('profile-wallet');?>
                </div>
                <section class="bg-major-grey p-3">
                    <div class="row m-0">
                        <label class="col-xl-4 col-lg-4 col-md-4 col-12 d-flex align-items-center"><i class="bx bxs-box me-1"></i><?=lang('Label.vaultbalance');?></label>
                        <div class="col-xl-8 col-lg-8 col-md-8 col-12">
                            <p class="color-major m-0 fs-2 vaultBalance">---</p>
                        </div>
                    </div>
                </section>
                <div class="card-body p-xl-5 p-lg-5 p-md-5 p-3">
                    <?=form_open('',['class'=>'form-validation customForm vaultForm','novalidate'=>'novalidate']);?>
                    <div class="row mb-3">
                        <label class="col-xl-3 col-lg-3 col-md-3 col-12 col-form-label text-dark position-relative required2"><?=lang('Input.amount');?></label>
                        <div class="col-xl-9 col-lg-9 col-md-9 col-12">
                            <input type="number" step="any" class="form-control" name="amount" required>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label class="col-xl-3 col-lg-3 col-md-3 col-12 col-form-label text-dark position-relative required2"><?=lang('Input.vaultpin');?></label>
                        <div class="col-xl-9 col-lg-9 col-md-9 col-12">
                            <div class="input-group">
                                <input type="password" class="form-control" name="vaultpin" required>
                                <button class="btn btn-primary rounded-end" type="button" data-bs-toggle="modal" data-bs-target=".modal-editpin"><?=lang('Nav.editpin');?></button>
                                <small class="invalid-feedback"><?=lang('Validation.vaultpin');?></small>
                            </div>
                        </div>
                    </div>
                    <div class="row mb-5">
                        <div class="col-xl-9 col-lg-9 col-md-9 col-12 ms-auto">
                            <button type="submit" class="btn btn-primary"><?=lang('Nav.submit');?></button>
                        </div>
                    </div>
                    <?=form_close();?>
                </div>
            </div>
        </dd>
    </dl>
</div>

<section class="modal fade modal-setupVaultPin" id="modal-setupVaultPin" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="modal-setupVaultPin" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-fullscreen-xl-down">
        <article class="modal-content border-0">
            <div class="modal-body p-0">
                <div class="p-4 bg-major position-relative rounded-top">
                    <h4 class="m-0"><?=lang('Label.newvaultpin');?></h2>
                </div>
                <?=form_open('', ['class'=>'form-validation customForm p-5 setupVaultPinForm', 'novalidate'=>'novalidate']);?>
                <div class="row mb-3">
                    <label class="col-xl-6 col-lg-6 col-md-6 col-12 col-form-label text-dark position-relative required2"><?=lang('Input.vaultpin');?></label>
                    <div class="col-xl-6 col-lg-6 col-md-6 col-12">
                        <input type="text" class="form-control" pattern="^[0-9]{6,6}$" name="pin" required>
                        <small class="invalid-feedback"><?=lang('Validation.newvaultpin',[6]);?></small>
                    </div>
                </div>
                <div class="row mb-3">
                    <label class="col-xl-6 col-lg-6 col-md-6 col-12 col-form-label text-dark position-relative required2"><?=lang('Input.confirmpin');?></label>
                    <div class="col-xl-6 col-lg-6 col-md-6 col-12">
                        <input type="text" class="form-control" pattern="^[0-9]{6,6}$" name="cnewpin" required>
                        <small class="invalid-feedback"><?=lang('Validation.matchpin');?></small>
                    </div>
                </div>
                <div class="d-grid gap-2">
                    <button type="submit" class="btn btn-primary"><?=lang('Nav.submit');?></button>
                </div>
                <?=form_close();?>
            </div>
        </article>
    </div>
</section>

<section class="modal fade modal-editpin" id="modal-editpin" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="modal-editpin" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-fullscreen-xl-down">
        <article class="modal-content border-0">
            <div class="modal-body p-0">
                <div class="p-4 bg-major position-relative rounded-top">
                    <button type="button" class="btn-close me-3 mt-3" aria-label="Close" data-bs-dismiss="modal"></button>
                    <h4 class="m-0"><?=lang('Label.editvaultpin');?></h4>
                </div>
                <?=form_open('', ['class'=>'form-validation customForm p-5 editVaultPinForm', 'novalidate'=>'novalidate']);?>
                <div class="row mb-3">
                    <label class="col-xl-4 col-lg-4 col-md-4 col-12 col-form-label text-dark"><?=lang('Input.currentpin');?></label>
                    <div class="col-xl-8 col-lg-8 col-md-8 col-12">
                        <input type="password" pattern="^[0-9]{6,6}$" class="form-control" name="pin" required>
                        <small class="invalid-feedback"><?=lang('Validation.vaultpin',[6]);?></small>
                    </div>
                </div>
                <div class="row mb-3">
                    <label class="col-xl-4 col-lg-4 col-md-4 col-12 col-form-label text-dark"><?=lang('Input.newpin');?></label>
                    <div class="col-xl-8 col-lg-8 col-md-8 col-12">
                        <input type="password" pattern="^[0-9]{6,6}$" class="form-control" name="newpin" required>
                        <small class="invalid-feedback"><?=lang('Validation.vaultpin',[6]);?></small>
                    </div>
                </div>
                <div class="row mb-3">
                    <label class="col-xl-4 col-lg-4 col-md-4 col-12 col-form-label text-dark"><?=lang('Input.confirmpin');?></label>
                    <div class="col-xl-8 col-lg-8 col-md-8 col-12">
                        <input type="password" pattern="^[0-9]{6,6}$" class="form-control" name="cnewpin" required>
                        <small class="invalid-feedback"><?=lang('Validation.matchpin');?></small>
                    </div>
                </div>
                <div class="d-grid gap-2">
                    <button type="submit" class="btn btn-primary"><?=lang('Nav.submit');?></button>
                </div>
                <?=form_close();?>
            </div>
        </article>
    </div>
</section>

<script>
document.addEventListener('DOMContentLoaded', (event) => {
    $('.sideMainNav [data-page=vault]').addClass("active");
    document.getElementsByClassName("nav-profileVault")[0].classList.add("active");

    checkExistVaultPin();

    $('.setupVaultPinForm').off().on('submit', function(e) {
        e.preventDefault();

        if (this.checkValidity() !== false) {
            $('.setupVaultPinForm [type=submit]').prop('disabled', true);

            var params = {};
            var formObj = $(this).closest("form");
            $.each($(formObj).serializeArray(), function (index, value) {
                params[value.name] = value.value;
            });
            
            $.post('/user/vault-pin/modify', {
                params
            }, function(data, status) {
                const obj = JSON.parse(data);
                if( obj.code==1 ) {
                    swal.fire("Success!", obj.message, "success").then(() => {
                        $('.modal-setupVaultPin').modal('hide');
                    });
                } else {
                    swal.fire("Error!", obj.message + " (Code: "+obj.code+")", "error").then(() => {
                        $('.setupVaultPinForm [type=submit]').prop('disabled', false);
                    });
                }
            })
            .done(function() {
                $('.setupVaultPinForm [type=submit]').prop('disabled', false);
            })
            .fail(function() {
                swal.fire("Error!", "Oopss! There are something wrong. Please try again later.", "error").then(() => {
                    $('.setupVaultPinForm [type=submit]').prop('disabled', false);
                });
            });
        }
    });

    const setupVaultPinEvent = document.getElementById('modal-setupVaultPin');
    setupVaultPinEvent.addEventListener('hidden.bs.modal', function (event) {
        $('.modal').find('form').removeClass('was-validated');
        $('.modal').find('form').trigger('reset');
    });

    $('.vaultForm').off().on('submit', function(e) {
        e.preventDefault();

        if (this.checkValidity() !== false) {
            $('.vaultForm [type=submit]').prop('disabled', true);

            var params = {};
            var formObj = $(this).closest("form");
            $.each($(formObj).serializeArray(), function (index, value) {
                params[value.name] = value.value;
            });
            
            $.post('/user/vault/balance/transfer', {
                params
            }, function(data, status) {
                const obj = JSON.parse(data);
                if( obj.code==1 ) {
                    swal.fire("Success!", obj.message, "success").then(() => {
                        refreshBalance();
                    });
                } else {
                    swal.fire("Error!", obj.message + " (Code: "+obj.code+")", "error").then(() => {
                        $('.vaultForm [type=submit]').prop('disabled', false);
                    });
                }
            })
            .done(function() {
                $('.vaultForm [type=submit]').prop('disabled', false);
                $('form').removeClass('was-validated');
                $('form').trigger('reset');
            })
            .fail(function() {
                swal.fire("Error!", "Oopss! There are something wrong. Please try again later.", "error").then(() => {
                    $('.vaultForm [type=submit]').prop('disabled', false);
                });
            });
        }
    });

    $('.editVaultPinForm').on('submit', function(e) {
        e.preventDefault();

        if (this.checkValidity() !== false) {
            $('.editVaultPinForm [type=submit]').prop('disabled', true);

            var params = {};
            var formObj = $(this).closest("form");
            $.each($(formObj).serializeArray(), function (index, value) {
                params[value.name] = value.value;
            });
            
            $.post('/user/vault-pin/modify', {
                params
            }, function(data, status) {
                const obj = JSON.parse(data);
                if( obj.code==1 ) {
                    swal.fire("Success!", obj.message, "success").then(() => {
                        $('.modal-editpin').modal('hide');
                        $('.editVaultPinForm [type=submit]').prop('disabled', false);
                    });
                } else {
                    swal.fire("Error!", obj.message + " (Code: "+obj.code+")", "error").then(() => {
                        $('.editVaultPinForm [type=submit]').prop('disabled', false);
                    });
                }
            })
            .done(function() {
                $('.editVaultPinForm [type=submit]').prop('disabled', false);
            })
            .fail(function() {
                swal.fire("Error!", "Oopss! There are something wrong. Please try again later.", "error").then(() => {
                    $('.editVaultPinForm [type=submit]').prop('disabled', false);
                });
            });
        }
    });

    const editpinEvent = document.getElementById('modal-editpin');
    editpinEvent.addEventListener('hidden.bs.modal', function (event) {
        $('.modal').find('form').removeClass('was-validated');
        $('.modal').find('form').trigger('reset');
    });
});

function checkExistVaultPin()
{
    generalLoading();

    $.get('/user/vault-pin/check', function(data, status) {
        const obj = JSON.parse(data);
        if( obj.code==1 ) {
            swal.close();
            if( obj.havePassword==true ) {
                // verify2ndPass(user,amount);
            } else {
                $('.modal-setupVaultPin').modal('toggle');
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
</script>