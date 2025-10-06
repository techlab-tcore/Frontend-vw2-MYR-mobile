<div class="container">
    <!--<?//=view('announcement');?>-->

    <dl class="row">
        <!--
        <dd class="col-xl-3 col-lg-3 col-md-4 col-12">
            <?//=view('template/sidenav');?>
        </dd>
        -->
        <dd class="col-xl-12 col-lg-12 col-md-12 col-12">
            <h4 class="text-uppercase d-xl-none d-lg-none d-md-none d-block"><?=$secTitle;?></h4>

            <!-- Aff.LossRebate Settlement -->
            <section class="wrap-afflossrebate bg-secondary rounded-4 p-3">
                <dl class="row g-2 m-0">
                    <dd class="col-xl-4 col-lg-4 col-md-4 col-8"><?=lang('Label.thisweekwinlose');?>:</dd>
                    <dd class="col-xl-8 col-lg-8 col-md-8 col-4"><span class="actualWinlose">0.00</span></dd>
                    <dd class="col-xl-4 col-lg-4 col-md-4 col-8"><?=lang('Label.thisweekearn');?>:</dd>
                    <dd class="col-xl-8 col-lg-8 col-md-8 col-4"><?=$_ENV['currency'];?> <span class="actualLossRebate">0.00</span></dd>
                    <dd class="col-xl-4 col-lg-4 col-md-4 col-8">
                        <?=lang('Label.totalearn');?>:<br>
                        <small>(3% <?=lang('Label.basedownlineloss');?>)</small>
                    </dd>
                    <dd class="col-xl-8 col-lg-8 col-md-8 col-4"><?=$_ENV['currency'];?> <span class="actualLossRebate">0.00</span></dd>

                    <dd class="col-xl-4 col-lg-4 col-md-4 col-12 ms-auto text-end">
                        <button type="button" class="btn btn-primary text-uppercase" onclick="affLossRebateSettlement();"><?=lang('Nav.claimnow');?></button>
                    </dd>
                </dl>
            </section>
            <!-- End Aff.LossRebate Settlement -->

            <div class="card border-0 profileRight">
                <section class="card-body p-xl-5 p-lg-5 p-md-5 p-3">
                    <?=form_open('',['class'=>'form-validation customForm filterForm pb-4','novalidate'=>'novalidate']);?>
                    <div class="row">
                        <div class="col-xl-5 col-lg-5 col-md-5 col-12 mb-3">
                            <div class="row">
                                <label class="col-xl-4 col-lg-4 col-md-4 col-12 col-form-label text-dark"><?=lang('Input.startdate');?></label>
                                <div class="col-xl-8 col-lg-8 col-md-8 col-12">
                                    <input type="text" class="form-control bg-white" name="start" value="<?=date('Y-m-d',strtotime("-7 days"));?>" readonly required>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-5 col-lg-5 col-md-5 col-12 mb-3">
                            <div class="row">
                                <label class="col-xl-4 col-lg-4 col-md-4 col-12 col-form-label text-dark"><?=lang('Input.enddate');?></label>
                                <div class="col-xl-8 col-lg-8 col-md-8 col-12">
                                    <input type="text" class="form-control bg-white" name="end" value="<?=date('Y-m-d',strtotime("-1 days"));?>" readonly required>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-5 col-lg-5 col-md-5 col-12 mb-3">
                            <div class="row">
                                <label class="col-xl-4 col-lg-4 col-md-4 col-12 col-form-label text-dark"><?=lang('Input.dateby');?></label>
                                <div class="col-xl-8 col-lg-8 col-md-8 col-12">
                                    <select class="form-select" name="dateby">
                                    <option value="1"><?=lang('Label.createdate');?></option>
                                    <option value="0"><?=lang('Label.approvedate');?></option>
                                    <option value="2"><?=lang('Label.enddate');?></option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-2 col-lg-2 col-md-2 col-12 mb-3">
                            <button type="submit" class="btn btn-primary"><?=lang('Nav.submit');?></button>
                        </div>
                    </div>
                    <?=form_close();?>

                    <table id="afflblogTable" class="w-100 nowrap table table-sm table-bordered table-hover">
                        <thead class="">
                        <tr>
                        <td><?=lang('Label.createdate');?></td>
                        <td><?=lang('Label.maxeffectdays');?>/#ID</td>
                        <td><?=lang('Label.lossrebate');?></td>
                        <td><?=lang('Label.cash');?></td>
                        <td><?=lang('Label.chip');?></td>
                        </tr>
                        </thead>
                        <tbody></tbody>
                    </table>
                </section>
            </div>
        </dd>
    </dl>
</div>

<link rel="stylesheet" href="<?=base_url('assets/vendors/datatable/datatables.min.css');?>">
<script src="<?=base_url('assets/vendors/datatable/datatables.min.js');?>"></script>
<script type="text/javascript" src="<?=base_url('assets/js/table_lang.js');?>"></script>
<script>
document.addEventListener('DOMContentLoaded', (event) => {
    $('.sideMainNav [data-page=afflblog]').addClass("active");
    // document.getElementsByClassName("nav-affLossRebateLog")[0].classList.add("active");

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
    affLossRebateListing();

    var pageindex = 1, debug = false;
    const afflblogTable = $('#afflblogTable').DataTable({
        dom: "<'row'<'col-12 overflow-auto'tr>>" + "<'row mt-3'<'col-xl-6 col-lg-6 col-md-6 col-12'i><'col-xl-6 col-lg-6 col-md-6 col-12'p>>",
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
            const dateby = $('.filterForm [name=dateby]').val();
            
            var payload = JSON.stringify({
                pageindex: pageindex,
                rowperpage: data.length,
                start: fromdate,
                end: todate,
                dateby: dateby
            });
            $.ajax({
                url: '/list/affiliate/loss-rebate/history',
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
            $('#afflblogTable tbody tr td.dataTables_empty').removeClass('text-end');
            $('#afflblogTable tbody tr').find('td:nth-child(5)').addClass('text-end');

            var popoverTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="popover"]'))
            var popoverList = popoverTriggerList.map(function (popoverTriggerEl) {
                return new bootstrap.Popover(popoverTriggerEl)
            });
        },
        aoColumnDefs: [{
            aTargets: [3,4],
            render: function ( data, type, row ) {
                return parseFloat(data).toFixed(5).replace(/(\.\d{2})\d*/, "$1").replace(/(\d)(?=(\d{3})+\b)/g, "$1,");
            },
            fnCreatedCell: function (nTd, sData, oData, iRow, iCol) {
                parseFloat(sData) < 0 ? $(nTd).addClass('text-danger') : '';
            }
        }]
    });

    $('.filterForm').off().on('submit', function(e) {
        e.preventDefault();

        if (this.checkValidity() !== false) {
            afflblogTable.draw();
        }
    });
});

function affLossRebateSettlement()
{
    $.get('/user/affiliate/loss-rebate/settlement', function(data, status) {
        const obj = JSON.parse(data);
        if( obj.code==1 ) {
            swal.fire("Success!", obj.message, "success").then(() => {
                refreshBalance();
            });
        } else if( obj.code==0 ) {
            swal.fire("Hmmm...", obj.message, "info");
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

function affLossRebateListing()
{
    generalLoading();

    $.get('/affiliate/loss-rebate/listing', function(data, status) {
        const obj = JSON.parse(data);
        if( obj.code==1 ) {
            swal.close();
            // swal.fire("Success!", obj.message, "success").then(() => {
            //     refreshBalance();
            // });

            $('.actualWinlose').html(obj.actualWinlose);
            $('.actualLossRebate').html(obj.actualLoseRebate);
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