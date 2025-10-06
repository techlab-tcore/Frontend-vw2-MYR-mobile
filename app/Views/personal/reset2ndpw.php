<div class="container">

    <dl class="row">
        <!--
        <dd class="col-xl-3 col-lg-3 col-md-4 col-12">
            <?//=view('template/sidenav');?>
        </dd>
        -->
        <dd class="col-xl-12 col-lg-12 col-md-12 col-12">
            <div class="d-flex align-items-center">
                <i class="bx bx-chevron-left d-xl-none d-lg-none d-md-none me-2" style="cursor: pointer;" onclick="history.back();"></i>
                <h6 class="text-uppercase d-xl-none d-lg-none d-md-none d-block m-0"><?=lang('Label.scrPwd');?></h6>
            </div>
            <div class="card border-0 profileRight">
                <div class="card-body p-xl-5 p-lg-5 p-md-5 p-3">
                    <nav class="history-menu btn-gameprovider <?=$_SESSION['lang'];?>" role="tablist">
                        <a class="nav-link bg-gradient active d-flex justify-content-center align-items-center" href="#" data-bs-toggle="pill" data-bs-target="#pass-secondary"><?=lang('Nav.secondpass');?></a>
                        <a class="nav-link bg-gradient d-flex justify-content-center align-items-center" href="#" data-bs-toggle="pill" data-bs-target="#resetpass-secondary"><?=lang('Nav.resetsecondpass');?></a>
                    </nav>
                    
                    <article class="tab-content">
                        <section class="tab-pane fade p-xl-5 p-lg-5 p-md-3 p-3 show active" id="pass-secondary">
                            <?=form_open('',['class'=>'form-validation customForm chg2ndPassForm','novalidate'=>'novalidate']);?>
                            <div class="row mb-3">
                                <label class="col-xl-4 col-lg-4 col-md-4 col-12 col-form-label text-dark position-relative required2"><?=lang('Input.current2ndpass');?></label>
                                <div class="col-xl-8 col-lg-8 col-md-8 col-12">
                                    <input type="text" class="form-control" pattern=".{6,}" name="current2ndpass" required>
                                    <small class="invalid-feedback"><?=lang('Validation.2ndpassword',[6]);?></small>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label class="col-xl-4 col-lg-4 col-md-4 col-12 col-form-label text-dark position-relative required2"><?=lang('Input.new2ndpass');?></label>
                                <div class="col-xl-8 col-lg-8 col-md-8 col-12">
                                    <input type="text" class="form-control" pattern=".{6,}" name="new2ndpass" required>
                                    <small class="invalid-feedback"><?=lang('Validation.new2ndpass',[6]);?></small>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label class="col-xl-4 col-lg-4 col-md-4 col-12 col-form-label text-dark position-relative required2"><?=lang('Input.confirm2ndpass');?></label>
                                <div class="col-xl-8 col-lg-8 col-md-8 col-12">
                                    <input type="text" class="form-control" pattern=".{6,}" name="cnew2ndpass" required>
                                    <small class="invalid-feedback"><?=lang('Validation.match2ndpass');?></small>
                                </div>
                            </div>
                            <div class="row mb-5">
                                <div class="col-xl-8 col-lg-8 col-md-8 col-12 ms-auto">
                                    <button type="submit" class="btn btn-primary me-1"><?=lang('Nav.submit');?></button>
                                    <a target="_blank" class="btn btn-secondary whatsapp" href=""><i class='bx bxl-whatsapp'></i>Whatsapp</a>
                                </div>
                            </div>
                            <?=form_close();?>
                        </section>
                        <section class="tab-pane fade p-xl-5 p-lg-5 p-md-3 p-3" id="resetpass-secondary">
                            <?=form_open('',['class'=>'form-validation customForm reset2ndPassForm','novalidate'=>'novalidate']);?>
                            <div class="row mb-3">
                                <label class="col-xl-4 col-lg-4 col-md-4 col-12 col-form-label text-dark position-relative required2"><?=lang('Input.smstac');?></label>
                                <div class="col-xl-8 col-lg-8 col-md-8 col-12">
                                    <div class="input-group">
                                        <input type="text" class="form-control" id="floatingTAC" name="veritac" placeholder="<?=lang('Input.smstac');?>" required>
                                        <button type="button" class="btn btn-primary btn-2nd-tac" id="2ndPassTimer" onclick="requestSecondpwdSmsTac();"><?=lang('Nav.gettac');?></button>
                                        <small class="invalid-feedback">Tac Number Required</small>
                                    </div>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label class="col-xl-4 col-lg-4 col-md-4 col-12 col-form-label text-dark position-relative required2"><?=lang('Input.new2ndpass');?></label>
                                <div class="col-xl-8 col-lg-8 col-md-8 col-12">
                                    <input type="text" class="form-control" pattern=".{6,}" name="reset2ndpass" required>
                                    <small class="invalid-feedback"><?=lang('Validation.new2ndpass',[6]);?></small>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label class="col-xl-4 col-lg-4 col-md-4 col-12 col-form-label text-dark position-relative required2"><?=lang('Input.confirm2ndpass');?></label>
                                <div class="col-xl-8 col-lg-8 col-md-8 col-12">
                                    <input type="text" class="form-control" pattern=".{6,}" name="creset2ndpass" required>
                                    <small class="invalid-feedback"><?=lang('Validation.match2ndpass');?></small>
                                </div>
                            </div>
                            <div class="row mb-5">
                                <div class="col-xl-8 col-lg-8 col-md-8 col-12 ms-auto">
                                    <button type="submit" class="btn btn-primary me-1"><?=lang('Nav.submit');?></button>
                                    <a target="_blank" class="btn btn-secondary whatsapp" href=""><i class='bx bxl-whatsapp'></i>Whatsapp</a>
                                </div>
                            </div>
                            <?=form_close();?>
                        </section>
                    </article>
                </div>
            </div>
        </dd>
    </dl>
</div>

<script>
document.addEventListener('DOMContentLoaded', (event) => {
    $('.sideMainNav [data-page=password]').addClass("active");
    // document.getElementsByClassName("nav-profilePass")[0].classList.add("active");

    $('.chgPassForm').on('submit', function(e) {
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

            $('.chgPassForm [type=submit]').prop('disabled', true);

            var params = {};
            var formObj = $(this).closest("form");
            $.each($(formObj).serializeArray(), function (index, value) {
                params[value.name] = value.value;
            });

            $.post('/user/login-password/modify', {
                params
            }, function(data, status) {
                $('.chgPassForm [type=submit]').prop('disabled', false);
                const obj = JSON.parse(data);
                if( obj.code==1 ) {
                    swal.fire("Success!", obj.message, "success").then(() => {
                        $('form').removeClass('was-validated');
                        $('form').trigger('reset');
                        $.get('/user/logout', function(data, status) {
                            location.reload();
                        });
                    });
                } else {
                    swal.fire("Error!", obj.message + " (Code: "+obj.code+")", "error").then(() => {
                        $('.chgPassForm [type=submit]').prop('disabled', false);
                    });
                }
            })
            .done(function() {
                $('.chgPassForm [type=submit]').prop('disabled', false);
            })
            .fail(function() {
                swal.fire("Error!", "Oopss! There are something wrong. Please try again later.", "error").then(()=>{
                    $('.chgPassForm [type=submit]').prop('disabled', false);
                });
            });
        }
    });

    $('.chg2ndPassForm').on('submit', function(e) {
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

            $('.chg2ndPassForm [type=submit]').prop('disabled', true);

            var params = {};
            var formObj = $(this).closest("form");
            $.each($(formObj).serializeArray(), function (index, value) {
                params[value.name] = value.value;
            });

            $.post('/user/secondary-password/modify', {
                params
            }, function(data, status) {
                $('.chg2ndPassForm [type=submit]').prop('disabled', false);
                const obj = JSON.parse(data);
                if( obj.code==1 ) {
                    swal.fire("Success!", obj.message, "success").then(() => {
                        $('form').removeClass('was-validated');
                        $('form').trigger('reset');
                    });
                } else {
                    swal.fire("Error!", obj.message + " (Code: "+obj.code+")", "error").then(() => {
                        $('.chg2ndPassForm [type=submit]').prop('disabled', false);
                    });
                }
            })
            .done(function() {
                $('.chg2ndPassForm [type=submit]').prop('disabled', false);
            })
            .fail(function() {
                swal.fire("Error!", "Oopss! There are something wrong. Please try again later.", "error").then(()=>{
                    $('.chg2ndPassForm [type=submit]').prop('disabled', false);
                });
            });
        }
    });

    $('.reset2ndPassForm').on('submit', function(e) {
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

            $('.reset2ndPassForm [type=submit]').prop('disabled', true);

            var params = {};
            var formObj = $(this).closest("form");
            $.each($(formObj).serializeArray(), function (index, value) {
                params[value.name] = value.value;
            });

            $.post('/user/secondary-password/reset', {
                params
            }, function(data, status) {
                $('.reset2ndPassForm [type=submit]').prop('disabled', false);
                const obj = JSON.parse(data);
                if( obj.code==1 ) {
                    swal.fire("Success!", obj.message, "success").then(() => {
                        $('form').removeClass('was-validated');
                        $('form').trigger('reset');
                    });
                } else {
                    swal.fire("Error!", obj.message + " (Code: "+obj.code+")", "error").then(() => {
                        $('.reset2ndPassForm [type=submit]').prop('disabled', false);
                    });
                }
            })
            .done(function() {
                $('.reset2ndPassForm [type=submit]').prop('disabled', false);
            })
            .fail(function() {
                swal.fire("Error!", "Oopss! There are something wrong. Please try again later.", "error").then(()=>{
                    $('.reset2ndPassForm [type=submit]').prop('disabled', false);
                });
            });
        }
    });
});

function requestSecondpwdSmsTac()
{
    //Disable Get Tac Button
    $('.btn-2nd-tac').prop('disabled', true);

    $.get('secondpassword/sms/send', function(data, status) {
        const obj = JSON.parse(data);
        if( obj.code==1 ) {
            secondpasstimer();
        } else if( obj.code==39 ) {
            forceUserLogout();
        } else {
            swal.fire("Error!", obj.message + " (Code: "+obj.code+")", "error");
            $('.btn-2nd-tac').prop('disabled', false);
        }
    });
}

function secondpasstimer()
{
    //$('.btn-tac').prop('disabled', true);

    var seconds = 120;
    var countdown = setInterval(function() {
        seconds--;
        document.getElementById("2ndPassTimer").textContent = seconds;
        if (seconds <= 0) {
            clearInterval(countdown);
            document.getElementById("2ndPassTimer").textContent = 'Get TAC';
            $('.btn-2nd-tac').prop('disabled', false);
            // timer();
        }
    }, 1000);
}
</script>