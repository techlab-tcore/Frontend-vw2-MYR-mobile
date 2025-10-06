<div class="container">
    <?//=view('announcement');?>

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
                    <?=form_open('', ['class'=>'row row-cols-lg-auto g-3 align-items-center filterForm pb-2', 'novalidate'=>'novalidate']);?>
                    <div class="col-xl-auto col-lg-auto col-md-auto col-12">
                        <div class="input-group">
                            <span class="input-group-text"><?=lang('Input.startdate');?></span>
                            <input type="text" class="form-control bg-white" name="start" value="<?=date('Y-m-d');?>" readonly>
                        </div>
                    </div>
                    <div class="col-xl-auto col-lg-auto col-md-auto col-12">
                        <div class="input-group">
                            <span class="input-group-text"><?=lang('Input.enddate');?></span>
                            <input type="text" class="form-control bg-white" name="end" value="<?=date('Y-m-d');?>" readonly>
                        </div>
                    </div>
                    <div class="col-xl-auto col-lg-auto col-md-auto col-12">
                        <div class="input-group">
                            <span class="input-group-text"><?=lang('Input.game');?></span>
                            <select class="form-select" id="gameprovider" name="gameprovider"></select>
                        </div>
                    </div>
                    <div class="col-xl-auto col-lg-auto col-md-auto col-12">
                        <button type="submit" class="btn btn-primary w-100"><?=lang('Nav.submit');?></button>
                    </div>
                    <?=form_close();?>

                    <table id="paymentTable" class="w-100 nowrap table table-sm table-bordered table-hover">
                        <thead class="table-style">
                        <tr>
                        <th><?=lang('Input.date');?></th>
                        <th><?=lang('Input.game');?></th>
                        <th><?=lang('Label.roundid');?></th>
                        <th><?=lang('Label.turnover');?></th>
                        <th><?=lang('Label.win');?></th>
                        <th><?=lang('Label.winlose');?></th>
                        </tr>
                        </thead>
                        <tfoot class="table-style">
                        <tr>
                        <th colspan="3" class="text-end"><?=lang('Label.total');?>:</th>
                        <th class="text-end">&nbsp;</th>
                        <th class="text-end">&nbsp;</th>
                        <th class="text-end">&nbsp;</th>
                        </tr>
                        </tfoot>
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
    $('.sideMainNav [data-page=refbetlog]').addClass("active");
    // document.getElementsByClassName("nav-scoreLog")[0].classList.add("active");
    $('.btn-profileWallet [data-click="refbetlog"]').addClass("active");

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
    gameProviderList('gameprovider');

    var pageindex = 1, debug = false;
    const paymentTable = $('#paymentTable').DataTable({
        dom: "<'row'<'col-12 overflow-auto'tr>>" + "<'row mt-3'<'col-xl-6 col-lg-6 col-md-6 col-12'i><'col-xl-6 col-lg-6 col-md-6 col-12'p>>",
        // responsive: {
        //     details: {
        //         renderer: $.fn.dataTable.Responsive.renderer.tableAll({
        //             tableClass: 'table table-bordered'
        //         })
        //     }
        // },
        language: langs,
        ordering: false,
        deferRender: true,
        serverSide: true,
        processing: true,
        destroy: true,
        pageLength: 20,
        ajax: function(data, callback, settings) {
            if (settings._iRecordsTotal == 0) {
                pageindex = 1;
            } else {
                var pageindex = settings._iDisplayStart/settings._iDisplayLength + 1;
            }

            const fromdate = $('.filterForm [name=start]').val();
            const todate = $('.filterForm [name=end]').val();
            const gp = $('.filterForm [name=gameprovider]').val()==null ? 'ALL' : $('.filterForm [name=gameprovider]').val();
            
            var payload = JSON.stringify({
                pageindex: pageindex,
                rowperpage: data.length,
                start: fromdate,
                end: todate,
                parent: '<?=$parent;?>',
                provider: gp
            });
            $.ajax({
                url: '/list/game/reference-bet-log',
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
        footerCallback: function ( row, data, start, end, display ) {
            var api = this.api(), data;
            var intVal = function(i){ return typeof i === 'string' ? i.replace(/[\$,]/g, '')*1 : typeof i === 'number' ? i : 0; };

            // var grandtotal = api.column(17).data().reduce(function(a, b){ return intVal(a) + intVal(b); }, 0);
            // var totalOverPage = api.column(4, {page: 'current'}).data().reduce(function(a, b){ return intVal(a) + intVal(b); }, 0);

            var totalOverPage = api.column(4).data().reduce(function(a, b){ return intVal(a) + intVal(b); }, 0);
            var truncate = parseFloat(totalOverPage).toFixed(5).replace(/(\.\d{2})\d*/, "$1").replace(/(\d)(?=(\d{3})+\b)/g, "$1,");
            var sum = parseFloat(truncate) < 0 ? '<span class="text-danger">'+truncate+'</span>' : truncate;
            $(api.column(4).footer()).html(sum);

            var totalOverPage2 = api.column(5).data().reduce(function(a, b){ return intVal(a) + intVal(b); }, 0);
            var truncate2 = parseFloat(totalOverPage2).toFixed(5).replace(/(\.\d{2})\d*/, "$1").replace(/(\d)(?=(\d{3})+\b)/g, "$1,");
            var sum2 = parseFloat(truncate2) < 0 ? '<span class="text-danger">'+truncate2+'</span>' : truncate2;
            $(api.column(5).footer()).html(sum2);

            var totalOverPage3 = api.column(3).data().reduce(function(a, b){ return intVal(a) + intVal(b); }, 0);
            var truncate3 = parseFloat(totalOverPage3).toFixed(5).replace(/(\.\d{2})\d*/, "$1").replace(/(\d)(?=(\d{3})+\b)/g, "$1,");
            var sum3 = parseFloat(truncate3) < 0 ? '<span class="text-danger">'+truncate3+'</span>' : truncate3;
            $(api.column(3).footer()).html(sum3);
        },
        drawCallback: function(oSettings, json) {
            $('#paymentTable tbody tr td.dataTables_empty').removeClass('text-end');
            $('#paymentTable tbody tr').find('td').not('td:first-child,td:nth-child(2),td:nth-child(3),td:nth-child(4)').addClass('text-end');
        },
        aoColumnDefs: [{
            aTargets: [3,4,5],
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
            paymentTable.draw();
        }
    });
});

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