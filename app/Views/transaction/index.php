<div class="container">
    <!--<?//=view('announcement');?>-->

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
                <section class="card-body p-xl-5 p-lg-5 p-md-5 p-3">
                    <?=form_open('',['class'=>'form-validation customForm filterForm pb-4','novalidate'=>'novalidate']);?>
                    <div class="row mb-3">
                        <label class="col-xl-2 col-lg-2 col-md-2 col-12 col-form-label text-dark"><?=lang('Input.types');?></label>
                        <div class="col-xl-4 col-lg-4 col-md-4 col-12">
                            <select class="form-select" name="types">
                            <option value="0"><?=lang('Label.all');?></option>
                                <option value="1"><?=lang('Label.deposit');?></option>
                                <option value="2"><?=lang('Label.withdrawal');?></option>
                                <option value="3"><?=lang('Label.promotion');?></option>
                                <option value="5"><?=lang('Label.affiliate');?></option>
                                <option value="6"><?=lang('Label.credittransfer');?></option>
                                <option value="8"><?=lang('Label.jackpot');?></option>
                                <option value="9"><?=lang('Label.fortunetoken');?></option>
                                <!-- <option value="10"><?//=lang('Label.pgtransfer');?></option> -->
                                <option value="11"><?=lang('Label.refcomm');?></option>
                                <option value="12"><?=lang('Label.depcomm');?></option>
                                <!-- <option value="13"><?//=lang('Label.lossrebate');?></option> -->
                                <option value="14"><?=lang('Label.affsharereward');?></option>
                                <option value="15"><?=lang('Label.dailyfreereward');?></option>
                                <!-- <option value="16"><?//=lang('Label.affloserebate');?></option> -->
                                <option value="17"><?=lang('Label.fortunereward');?></option>
                            </select>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-xl-5 col-lg-5 col-md-5 col-12 mb-3">
                            <div class="row">
                                <label class="col-xl-4 col-lg-4 col-md-4 col-12 col-form-label text-dark"><?=lang('Input.startdate');?></label>
                                <div class="col-xl-8 col-lg-8 col-md-8 col-12">
                                    <input type="text" class="form-control bg-white" name="start" value="<?=date('Y-m-d');?>" readonly required>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-5 col-lg-5 col-md-5 col-12 mb-3">
                            <div class="row">
                                <label class="col-xl-4 col-lg-4 col-md-4 col-12 col-form-label text-dark"><?=lang('Input.enddate');?></label>
                                <div class="col-xl-8 col-lg-8 col-md-8 col-12">
                                    <input type="text" class="form-control bg-white" name="end" value="<?=date('Y-m-d');?>" readonly required>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-2 col-lg-2 col-md-2 col-12 mb-3">
                            <button type="submit" class="btn btn-primary"><?=lang('Nav.submit');?></button>
                        </div>
                    </div>
                    <?=form_close();?>

                    <table id="paymentTable" class="w-100 nowrap table table-bordered">
                        <thead class="bg-major color-major-grey">
                        <tr>
                        <td><?=lang('Label.createdate');?></td>
                        <td><?=lang('Input.status');?></td>
                        <td><?=lang('Input.types');?></td>
                        <td><?=lang('Input.remark');?></td>
                        <td><?=lang('Input.amount');?></td>
                        </tr>
                        </thead>
                        <tbody></tbody>
                    </table>
                </section>
            </div>
        </dd>
    </dl>
</div>

<section class="modal fade modal-permission" id="modal-permission" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="modal-permission" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title"><?=lang('Label.permission');?></h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <?=form_open('', ['class'=>'form-validation', 'novalidate'=>'novalidate','autocomplete'=>'off'], ['pid'=>'','bankid'=>'','cardno'=>'','accno'=>'']);?>
                <div class="mb-3 row">
                    <label class="col-4 col-form-label"><?=lang('Input.username');?></label>
                    <div class="col-8">
                        <input type="text" class="form-control-plaintext" name="username" readonly>
                    </div>
                </div>
                <div class="mb-3 row">
                    <label class="col-4 col-form-label"><?=lang('Input.amount');?></label>
                    <div class="col-8">
                        <input type="text" class="form-control-plaintext" name="amount" readonly>
                    </div>
                </div>
                <div class="mb-3 row">
                    <label class="col-4 col-form-label"><?=lang('Input.status');?></label>
                    <div class="col-8">
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="status" id="status-yes" value="1" required>
                            <label class="form-check-label" for="status-yes"><?=lang('Label.approve');?></label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="status" id="status-no" value="2">
                            <label class="form-check-label" for="status-no"><?=lang('Label.reject');?></label>
                        </div>
                    </div>
                </div>
                <div class="mb-3 row">
                    <label class="col-4 col-form-label"><?=lang('Input.remark');?></label>
                    <div class="col-8">
                        <textarea class="form-control" name="remark"></textarea>
                    </div>
                </div>
                <div class="text-end">
                    <button type="button" class="btn btn-light" data-bs-dismiss="modal"><?=lang('Nav.close');?></button>
                    <button type="submit" class="btn btn-primary"><?=lang('Nav.submit');?></button>
                </div>
                <?=form_close();?>
            </div>
        </div>
    </div>
</section>

<link rel="stylesheet" href="<?=base_url('assets/vendors/datatable/datatables.min.css');?>">
<script src="<?=base_url('assets/vendors/datatable/datatables.min.js');?>"></script>
<script type="text/javascript" src="<?=base_url('assets/js/table_lang.js');?>"></script>
<script>
document.addEventListener('DOMContentLoaded', (event) => {
    $('.sideMainNav [data-page=history]').addClass("active");
    // document.getElementsByClassName("nav-profileHistory")[0].classList.add("active");
    $('.btn-profileWallet [data-click="history"]').addClass("active");

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

    airdatepicker();
    checkExist2ndPass();

    var pageindex = 1, debug = false;
    const paymentTable = $('#paymentTable').DataTable({
        dom: "<'row'<'col-12 overflow-auto'tr>>" + "<'row mt-3'<'col-xl-6 col-lg-6 col-md-6 col-12'i><'col-xl-6 col-lg-6 col-md-6 col-12'p>>",
        responsive: {
            details: {
                renderer: $.fn.dataTable.Responsive.renderer.tableAll({
                    tableClass: 'table table-bordered'
                })
            }
        },
        language: langs,
        ordering: false,
        deferRender: true,
        serverSide: true,
        processing: true,
        destroy: true,
        ajax: function(data, callback, settings) {
            if (settings._iRecordsTotal == 0) {
                pageindex = 1;
            } else {
                var pageindex = settings._iDisplayStart/settings._iDisplayLength + 1;
            }

            const fromdate = $('.filterForm [name=start]').val();
            const todate = $('.filterForm [name=end]').val();
            const paytype = $('.filterForm [name=types]').val();
            
            var payload = JSON.stringify({
                pageindex: pageindex,
                rowperpage: data.length,
                start: fromdate,
                end: todate,
                type: paytype,
            });
            $.ajax({
                url: '/list/transaction/history',
                type: 'post',
                data: payload,
                contentType:"application/json; charset=utf-8",
                dataType:"json",
                success: function(res){
                    if (res.code !== 1) {
                        // alert(res.message);
                        callback({
                            recordsTotal: 0,
                            recordsFiltered: 0,
                            data: []
                        });

                        return;
                    } else {
                        callback({
                            recordsTotal: res.totalRecord,
                            recordsFiltered: res.totalRecord,
                            data: res.data
                        });
                    }
                    return;
                }
            });
        },
        drawCallback: function(oSettings, json) {
            $('#paymentTable tbody tr td.dataTables_empty').removeClass('text-end');
            $('#paymentTable tbody tr').find('td:nth-child(5)').addClass('text-end');

            var popoverTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="popover"]'))
            var popoverList = popoverTriggerList.map(function (popoverTriggerEl) {
                return new bootstrap.Popover(popoverTriggerEl)
            });
        },
        aoColumnDefs: [{
            aTargets: [4],
            render: function ( data, type, row ) {
                return parseFloat(data).toFixed(5).replace(/(\.\d{2})\d*/, "$1").replace(/(\d)(?=(\d{3})+\b)/g, "$1,");
            }
        }]
    });

    $('.filterForm').off().on('submit', function(e) {
        e.preventDefault();

        if (this.checkValidity() !== false) {
            paymentTable.draw();
        }
    });

    $('.modal-permission form').on('submit', function(e) {
        e.preventDefault();

        if (this.checkValidity() !== false) {
            //generalLoading();
            $('.modal-permission [type=submit]').prop('disabled',true);

            var params = {};
            var formObj = $(this).closest("form");
            $.each($(formObj).serializeArray(), function (index, value) {
                params[value.name] = value.value;
            });

            // checkExist2ndPass();
            verify2ndPass(params['pid'],params['username'],params['status'],params['remark']);

            //$.post('/transaction/permission', {
            //    params
            //}, function(data, status) {
            //    const obj = JSON.parse(data);
                // console.log(obj);
            //    if( obj.code == 1 ) {
            //        swal.fire("", obj.message, "success").then(() => {                      
            //            getProfile();
            //            paymentTable.ajax.reload(null,false);

            //            $('.modal-permission').modal('hide');
            //            $('.modal-permission [type=submit]').prop('disabled',false);
            //        });
            //    } else if( obj.code==39 ) {
            //        forceUserLogout();
            //    } else {
            //        swal.fire("", obj.message + " (Code: "+obj.code+")", "error").then(() => {                      
            //            $('.modal-permission [type=submit]').prop('disabled',false);
            //        });
            //    }
            //})
            //.done(function() {
            //})
            //.fail(function() {
            //    swal.fire("", "Please try again later.", "error");
            //});
        }
    });

    const permissionEvent = document.getElementById('modal-permission');
    permissionEvent.addEventListener('shown.bs.modal', function (event) {
        // getCompBankCard('compbankcard');
    });
    permissionEvent.addEventListener('hidden.bs.modal', function (event) {
        $('.modal').find('form').removeClass('was-validated');
        $('.modal').find('form').trigger('reset');
    });
});

function responseWithdrawal(pid,username,payStatus,remark)
{
    generalLoading();

    var params = {};
    params['pid'] = pid;
    params['username'] = username;
    params['status'] = payStatus;
    params['remark'] = remark;
    params['bankid'] = '';
    params['accno'] = '';
    params['cardno'] = '';

    $.post('/transaction/permission', {
        params
    }, function(data, status) {
        const obj = JSON.parse(data);
        // console.log(obj);
        if( obj.code == 1 ) {
            swal.fire("", obj.message, "success").then(() => {                      
                getProfile();
                // paymentTable.ajax.reload(null,false);
                $('#paymentTable').DataTable().ajax.reload(null,false);

                $('.modal-permission').modal('hide');
                $('.modal-permission [type=submit]').prop('disabled',false);
            });
        } else if( obj.code==39 ) {
            forceUserLogout();
        } else {
            swal.fire("", obj.message + " (Code: "+obj.code+")", "error").then(() => {                      
                $('.modal-permission [type=submit]').prop('disabled',false);
            });
        }
    })
    .done(function() {
    })
    .fail(function() {
        swal.fire("", "Please try again later.", "error").then(() => {                      
            $('.modal-permission [type=submit]').prop('disabled',false);
        });
    });
}

function permission(pid,username,amount,bankid,cardno,accno)
{
    const decision = status==1 ? '<?=lang('Nav.approve');?>' : '<?=lang('Nav.reject');?>';

    $('.modal-permission').modal('toggle');
    $('.modal-permission [name=decision]').val(decision);
    $('.modal-permission [name=username]').val(username);
    $('.modal-permission [name=amount]').val(amount);
    $('.modal-permission [name=pid]').val(pid);
    $('.modal-permission [name=bankid]').val(bankid);
    $('.modal-permission [name=cardno]').val(cardno);
    $('.modal-permission [name=accno]').val(accno);
}

function verify2ndPass(pid,username,payStatus,remark)
{
    $('.modal-permission').modal('hide');
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
                    responseWithdrawal(pid,username,payStatus,remark);
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

function airdatepicker()
{
    $('[name=start]').datepicker({
        autoClose: true,
        changeMonth: true,
        changeYear: true,
        language: '<?=$_SESSION['lang']=='cn' || $_SESSION['lang']=='zh' ? 'zh' : 'en'?>',
        dateFormat: 'yyyy-mm-dd',
        maxDate: new Date(),
        todayButton: new Date(),
        clearButton: true
    });
    $('[name=end]').datepicker({
        autoClose: true,
        changeMonth: true,
        changeYear: true,
        language: '<?=$_SESSION['lang']=='cn' || $_SESSION['lang']=='zh' ? 'zh' : 'en'?>',
        dateFormat: 'yyyy-mm-dd',
        maxDate: new Date(),
        todayButton: new Date(),
        clearButton: true
    });
}
</script>