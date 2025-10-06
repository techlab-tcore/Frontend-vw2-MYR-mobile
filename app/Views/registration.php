<section class="container wrap-registration position-relative">
    <dl class="row g-0 m-0 p-xl-5 p-lg-5 p-md-5 p-0">
        <dd class="col-xl-6 col-lg-6 col-md-6 col-12 m-auto">

            <div class="card border-0 shadow">
                <div class="card-body p-xl-5 p-lg-5 p-md-5 p-4">
                    <h2 class="text-center pb-3 text-uppercase"><?=$secTitle;?></h2>
                    <?=form_open('', ['class'=>'form-validation regisForm','novalidate'=>'novalidate']);?>
                    <div class="input-group mb-3">
                        <span class="input-group-text bg-white"><i class="bx bx-mobile"></i></span>
                        <input type="text" pattern="^[0-9]{10,11}$" class="form-control rounded-end" id="regisUsername" name="mobile" placeholder="<?=lang('Input.mobileno');?>" required>
                        <small class="w-100 form-text"><?=lang('Validation.mobile');?></small>
                    </div>
                    <div class="input-group mb-3">
                        <span class="input-group-text bg-white"><i class="bx bx-barcode-reader"></i></span>
                        <input type="text" class="form-control" id="floatingTAC" name="veritac" placeholder="<?=lang('Input.smstac');?>" required>
                        <button type="button" class="btn btn-primary btn-tac" id="timer" onclick="requestTac();"><?=lang('Nav.gettac');?></button>
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
                    </div>
                    <?=form_close();?>
                </div>
            </div>

        </dd>
    </dl>
</section>

<script>
document.addEventListener('DOMContentLoaded', (event) => {
    $('.regisForm').on('submit', function(e) {
        e.preventDefault();

        if (this.checkValidity() !== false) {
            generalLoading();

            $('.regisForm [type=submit]').prop('disabled', true);

            var params = {};
            var formObj = $(this).closest("form");
            $.each($(formObj).serializeArray(), function (index, value) {
                params[value.name] = value.value;
            });

            $.post('/user/registration', {
                params
            }, function(data, status) {
                $('.regisForm [type=submit]').prop('disabled', false);
                const obj = JSON.parse(data);
                if( obj.code==1 ) {
                    swal.fire("Success!", obj.message, "success").then(()=>{
                        window.location.replace("<?=base_url();?>");
                    });
                } else {
                    swal.fire("Error!", obj.message + " (Code: "+obj.code+")", "error").then(() => {
                        $('.regisForm [type=submit]').prop('disabled', false);
                    });
                }
            })
            .done(function() {
                $('.regisForm [type=submit]').prop('disabled', false);
            })
            .fail(function() {
                swal.fire("Error!", "Oopss! There are something wrong. Please try again later.", "error").then(()=>{
                    $('.regisForm [type=submit]').prop('disabled', false);
                });
            });
        }
    });
});
</script>