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
                <h6 class="text-uppercase d-xl-none d-lg-none d-md-none d-block m-0"><?=$secTitle;?></h6>
            </div>
            <div class="card border-0 profileRight">
                <div class="card-header profileWallet border-0 p-3 bg-dark rounded-4 text-light">
                    <?=view('profile-wallet');?>
                </div>
                <div class="card-body p-xl-5 p-lg-5 p-md-5 p-3">
                    <figure class="bg-vw2 p-3 rounded default-card-infor">
                        <ul class="list-unstyled row g-2 m-0">
                        <li class="col-auto">
                            <label class="d-block"><?=lang('Label.currency');?></label><h5 class="label-currency text-light m-0"></h5>
                        </li>
                        <li class="col-auto">
                            <label class="d-block"><?=lang('Label.bank');?></label><h5 class="label-bankName text-light m-0"></h5>
                        </li>
                        <li class="col-auto">
                            <label class="d-block"><?=lang('Label.accno');?></label><h5 class="label-accNo color-55vp m-0"></h5>
                        </li>
                        <li class="col-auto">
                            <label class="d-block"><?=lang('Label.holder');?></label><h5 class="label-holder text-light m-0"></h5>
                        </li>
                        </ul>
                    </figure>


                    <?=form_open('',['class'=>'form-validation customForm withdrawalForm','novalidate'=>'novalidate'],['currency'=>'']);?>
                    <div class="row mb-3">
                        <label class="col-xl-3 col-lg-3 col-md-3 col-12 col-form-label text-dark position-relative required2"><?=lang('Input.amount');?></label>
                        <div class="col-xl-9 col-lg-9 col-md-9 col-12">
                            <div class="input-group">
                                <span class="input-group-text bg-vw2 label-currency" id="basic-addon1">---</span>
                                <input type="number" step="any" class="form-control" name="amount" min="<?=$_ENV['minBankWithdrawal'];?>" placeholder="<?=lang('Validation.withdrawal',[$_ENV['minBankWithdrawal']]);?>" required>
                            </div>
                        </div>
                    </div>
                    <div class="row mb-5">
                        <div class="col-xl-9 col-lg-9 col-md-9 col-12 ms-auto">
                            <button type="submit" class="btn btn-primary"><?=lang('Nav.submit');?></button>
                        </div>
                    </div>
                    <div class="row bg-light">
                        <div class="col-xl-9 col-lg-9 col-md-9 col-12">
                            <small class="d-block bg-major-light text-dark p-xl-5 p-lg-5 p-md-5 p-3">
                                <h5 class="color-major2 pb-3"><?=lang('Label.withdrawalpolicy');?></h5>
                                <p><?=lang('Validation.wthpolicy');?></p>
                                <p><?=lang('Validation.wthpolicy1',[100]);?></p>
                                <p><?=lang('Validation.wthpolicy2',[1]);?></p>
                                <p><?=lang('Validation.wthpolicy3',[3,3]);?></p>
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
    $('.sideMainNav [data-page=withdrawal]').addClass("active");
    // document.getElementsByClassName("nav-profileWithdraw")[0].classList.add("active");
    $('.btn-profileWallet [data-click="withdrawal"]').addClass("active");

    getUserDefaultBankCard();

    $('.withdrawalForm').on('submit', function(e) {
        e.preventDefault();

        if (this.checkValidity() !== false) {
            generalLoading();

            $('.withdrawalForm [type=submit]').prop('disabled', true);

            var params = {};
            var formObj = $(this).closest("form");
            $.each($(formObj).serializeArray(), function (index, value) {
                params[value.name] = value.value;
            });

            $.post('/payment/withdrawal/add', {
                params
            }, function(data, status) {
                const obj = JSON.parse(data);
                if( obj.code==1 ) {
                    swal.fire("Success!", obj.message, "success").then(() => {
                        getProfile();
                        $('form').removeClass('was-validated');
                        $('form').trigger('reset');
                    });
                } else {
                    swal.fire("Error!", obj.message + " (Code: "+obj.code+")", "error").then(() => {
                        $('.withdrawalForm [type=submit]').prop('disabled', false);
                    });
                }
            })
            .done(function() {
                $('.withdrawalForm [type=submit]').prop('disabled', false);
            })
            .fail(function() {
                swal.fire("Error!", "Oopss! There are something wrong. Please try again later.", "error").then(()=>{
                    $('.withdrawalForm [type=submit]').prop('disabled', false);
                });
            });
        }
    });
});

async function getUserDefaultBankCard()
{
    generalLoading();

    $.get('/list/raw/bank-account/user', function(data, status) {
        const obj = JSON.parse(data);
        if( obj.code==1 && obj.data!='' ) {
            swal.close();
            // getTransactionCount(2);

            const acc = obj.data;
            acc.forEach(function(item, index) {
                if( item.isDefault==1 ) {
                    $('.label-currency').html(item.currency);
                    $('.label-bankName').html(item.name);
                    $('.label-accNo').html(item.accno);
                    $('.label-holder').html(item.holder);

                    $('.withdrawalForm [name=currency]').val(item.currency);
                }
            });
        } else if( obj.code==1 && obj.data=='' ) {
            swal.fire({
                title: 'Please tied your Withdrawal Bank Card'
            }).then((result) => {
                if (result.isConfirmed) {
                    window.location.replace('<?=base_url('user/bank-account');?>');
                }
            });
        } else if( obj.code==39 ) {
            forceUserLogout();
        } else {
            swal.fire("<?=lang('Label.error');?>!", obj.message + " (Code: "+obj.code+")", "error");
        }
    })
    .done(function() {
    })
    .fail(function() {
        swal.fire("Error!", "Oopss! There are something wrong. Please try again later.", "error");
    });
}
</script>