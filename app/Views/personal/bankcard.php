<div class="container">

    <dl class="row">
        <!--
        <dd class="col-xl-3 col-lg-3 col-md-4 col-12">
            <?//=view('template/sidenav');?>
        </dd>
        -->
        <dd class="col-xl-12 col-lg-12 col-md-12 col-12">
            <h4 class="text-uppercase d-xl-none d-lg-none d-md-none d-block"><?=$secTitle;?></h4>
            <div class="card border-0 profileRight">
                <div class="card-body p-xl-5 p-lg-5 p-md-5 p-3">
                    <table id="bcTable" class="w-100 nowrap table table-bordered">
                        <thead class="bg-major color-major-grey">
                        <tr>
                        <td><?=lang('Input.accno');?></td>
                        <td><?=lang('Input.accholder');?></td>
                        <!-- <td><?//=lang('Input.status');?></td> -->
                        <td><?=lang('Input.primary');?></td>
                        </tr>
                        </thead>
                        <tbody></tbody>
                    </table>
                    <hr class="my-xl-5 my-lg-5 my-md-3 my-3">

                    <?=form_open('',['class'=>'form-validation customForm addBankCardForm','novalidate'=>'novalidate']);?>
                    <div class="row mb-3">
                        <label class="col-xl-3 col-lg-3 col-md-3 col-12 col-form-label text-dark position-relative required2"><?=lang('Input.bank');?></label>
                        <div class="col-xl-4 col-lg-4 col-md-4 col-12">
                            <select class="form-select" name="bank" id="bank-list" required>
                            </select>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label class="col-xl-3 col-lg-3 col-md-3 col-12 col-form-label text-dark position-relative required2"><?=lang('Input.accholder');?></label>
                        <div class="col-xl-4 col-lg-4 col-md-4 col-12">
                            <input type="text" class="form-control" name="holder" readOnly required>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label class="col-xl-3 col-lg-3 col-md-3 col-12 col-form-label text-dark position-relative required2"><?=lang('Input.accno');?></label>
                        <div class="col-xl-4 col-lg-4 col-md-4 col-12">
                            <input type="text" class="form-control" name="accno" pattern="[0-9]+" required>
                        </div>
                    </div>
                    <div class="row mb-5">
                        <div class="col-xl-9 col-lg-9 col-md-9 col-12 ms-auto">
                            <button type="submit" class="btn btn-primary"><?=lang('Nav.addbc');?></button>
                        </div>
                    </div>
                    <?=form_close();?>
                </div>
            </div>
        </dd>
    </dl>
</div>

<link rel="stylesheet" href="<?=base_url('assets/vendors/datatable/datatables.min.css');?>">
<script src="<?=base_url('assets/vendors/datatable/datatables.min.js');?>"></script>
<script type="text/javascript" src="<?=base_url('assets/js/table_lang.js');?>"></script>
<script>
document.addEventListener('DOMContentLoaded', (event) => {
    $('.sideMainNav [data-page=bankacc]').addClass("active");
    $('.mobile-footer [data-page=account] a').addClass("active");
    // document.getElementsByClassName("nav-profileBankAcc")[0].classList.add("active");

    if( '<?=$_SESSION['lang']?>' == 'my' ) {
        langs = malay;
    } else if( '<?=$_SESSION['lang']?>' == 'cn' ) {
        langs = chinese;
    } else if( '<?=$_SESSION['lang']?>' == 'zh' ) {
        langs = tradchinese;
    } else if( '<?=$_SESSION['lang']?>' == 'th' ) {
        langs = thai;
    } else if( '<?=$_SESSION['lang']?>' == 'vn' ) {
        langs = viet;
    } else {
        langs = english;
    }

    checkExist2ndPass();
    getBankList('bank-list');

    const bcTable = $('#bcTable').DataTable({
        dom: "<'row mb-3'<'col-xl-6 col-lg-6 col-md-6 col-12'l><'col-xl-6 col-lg-6 col-md-6 col-12'f>>" + "<'row'<'col-12 overflow-auto'tr>>" + "<'row mt-3'<'col-xl-6 col-lg-6 col-md-6 col-12'i><'col-xl-6 col-lg-6 col-md-6 col-12'p>>",
        language: langs,
        paging: true,
        deferRender: true,
        processing: true,
        destroy: true,
        ajax: {
            type : "GET",
            contentType: "application/json; charset=utf-8",
            url: '/list/bank-account/user',
            dataSrc: function(json) {
                if(json == "no data") {
                    return [];
                } else {
                    return json.data;
                }
            }
        },
        responsive: {
            details: {
                renderer: $.fn.dataTable.Responsive.renderer.tableAll({
                    tableClass: 'w-100 nowrap table table-bordered'
                })
            }
        },
    });

    $('.addBankCardForm').off().on('submit', function(e) {
        e.preventDefault();

        if (this.checkValidity() !== false) {
            $('.addBankCardForm [type=submit]').prop('disabled', true);

            var params = {};
            var formObj = $(this).closest("form");
            $.each($(formObj).serializeArray(), function (index, value) {
                params[value.name] = value.value;
            });
            // checkExist2ndPass(1,params['bank'],params['holder'],params['accno']);
            verify2ndPass(1,params['bank'],params['holder'],params['accno'],params['accno']);
        }
    });
});

function addBankCard(bank,holder,accno)
{
    var params = {};
    params['bank'] = bank;
    params['holder'] = holder;
    params['accno'] = accno;

    $.post('/user/bank-account/add', {
        params
    }, function(data, status) {
        $('.addBankCardForm [type=submit]').prop('disabled', false);
        const obj = JSON.parse(data);
        if( obj.code==1 ) {
            swal.fire("Success!", obj.message, "success").then(() => {
                getProfile();
                setDefault(bank,holder,accno,accno);
                $('#bcTable').DataTable().ajax.reload(null,false);
            });
        } else {
            swal.fire("Error!", obj.message + " (Code: "+obj.code+")", "error").then(() => {
                $('.addBankCardForm [type=submit]').prop('disabled', false);
            });
        }
    })
    .done(function() {
        $('.addBankCardForm [type=submit]').prop('disabled', false);
        $('form').removeClass('was-validated');
        $('form').trigger('reset');
    })
    .fail(function() {
        swal.fire("Error!", "Oopss! There are something wrong. Please try again later.", "error").then(()=>{
            $('.addBankCardForm [type=submit]').prop('disabled', false);
        });
    });
}

function setDefault(bank,holder,accno,cardno)
{
    var params = {};
    params['bank'] = bank;
    params['holder'] = holder;
    params['accno'] = accno;
    params['cardno'] = cardno;

    $.post('/user/bank-account/set-default', {
        params
    }, function(data, status) {
        const obj = JSON.parse(data);
        if( obj.code==1 ) {
            $('#bcTable').DataTable().ajax.reload(null,false);
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

function verify2ndPass(type,bank,holder,accno,cardno)
{
    $('.modal-check2ndPass').modal('toggle');
    $('.verify2ndPassForm').off().on('submit', function(e) {
        e.preventDefault();

        if (this.checkValidity() !== false) {
            generalLoading();

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
                    if( type==0 ) {
                        setDefault(bank,holder,accno,cardno);
                    } else if( type==1 ) {
                        addBankCard(bank,holder,accno,cardno);
                    }
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

function checkExist2ndPass()
{
    generalLoading();

    $.get('/user/secondary-password/exist', function(data, status) {
        const obj = JSON.parse(data);
        if( obj.code==1 ) {
            swal.close();
            if( obj.havePassword==true ) {
                // verify2ndPass(user,amount);
            } else {
                $('.modal-setup2ndPass').modal('toggle');
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