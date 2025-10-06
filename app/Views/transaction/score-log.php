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

                    <table id="scorelogTable" class="w-100 nowrap table table-bordered">
                        <thead class="bg-major color-major-grey">
                        <tr>
                        <td><?=lang('Label.createdate');?></td>
                        <td><?=lang('Input.status');?></td>
                        <td><?=lang('Input.game');?></td>
                        <td><?=lang('Input.types');?></td>
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

<link rel="stylesheet" href="<?=base_url('assets/vendors/datatable/datatables.min.css');?>">
<script src="<?=base_url('assets/vendors/datatable/datatables.min.js');?>"></script>
<script type="text/javascript" src="<?=base_url('assets/js/table_lang.js');?>"></script>
<script>
document.addEventListener('DOMContentLoaded', (event) => {
    $('.sideMainNav [data-page=scorelog]').addClass("active");
    // document.getElementsByClassName("nav-scoreLog")[0].classList.add("active");
    $('.btn-profileWallet [data-click="scorelog"]').addClass("active");

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

    var pageindex = 1, debug = false;
    const scorelogTable = $('#scorelogTable').DataTable({
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
            
            var payload = JSON.stringify({
                pageindex: pageindex,
                rowperpage: data.length,
                start: fromdate,
                end: todate
            });
            $.ajax({
                url: '/list/game-credit/log',
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
            $('#scorelogTable tbody tr td.dataTables_empty').removeClass('text-end');
            $('#scorelogTable tbody tr').find('td:nth-child(5)').addClass('text-end');

            var popoverTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="popover"]'))
            var popoverList = popoverTriggerList.map(function (popoverTriggerEl) {
                return new bootstrap.Popover(popoverTriggerEl)
            });
        },
        aoColumnDefs: [{
            aTargets: [4],
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
            scorelogTable.draw();
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