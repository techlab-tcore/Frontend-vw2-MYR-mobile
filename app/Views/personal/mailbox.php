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
                <div class="card-body p-xl-5 p-lg-5 p-md-5 p-3">
                    <nav class="nav nav-tabs">
                        <a class="nav-link bg-gradient active" href="#" data-bs-toggle="pill" data-bs-target="#pass-login"><?=lang('Nav.inbox');?></a>
                    </nav>
                    <article class="tab-content">
                        <section class="tab-pane fade p-xl-5 p-lg-5 p-md-3 p-3 show active" id="pass-login">
                            <table id="msgTable" class="w-100 table table-bordered">
                                <thead class="bg-major color-major-grey">
                                <tr>
                                <td><?=lang('Input.date');?></td>
                                <td><?=lang('Input.title');?></td>
                                <td><?=lang('Label.action');?></td>
                                </tr>
                                </thead>
                                <tbody></tbody>
                            </table>
                        </section>
                    </article>
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
    $('.sideMainNav [data-page=message]').addClass("active");
    $('.mobile-footer [data-page=message] a').addClass("active");
    // document.getElementsByClassName("nav-profileMsg")[0].classList.add("active");

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

    const msgTable = $('#msgTable').DataTable({
        dom: "<'row mb-3'<'col-xl-6 col-lg-6 col-md-6 col-12'l><'col-xl-6 col-lg-6 col-md-6 col-12'f>>" + "<'row'<'col-12 overflow-auto'tr>>" + "<'row mt-3'<'col-xl-6 col-lg-6 col-md-6 col-12'i><'col-xl-6 col-lg-6 col-md-6 col-12'p>>",
        ajax: {
            type : "GET",
            contentType: "application/json; charset=utf-8",
            url: "/list/mail/user",
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
                    tableClass: 'w-100 table table-bordered'
                })
            }
        },
        language: langs,
        processing: true,
        stateSave: true,
        deferRender: true
    });

    $('.modal-mailbox').on('hidden.bs.modal', function(e) {
        msgTable.ajax.reload(null, false);
        getMail();
    });
});

function openMail(id){

    var params = {};
    params['mailid'] = id;

    if (id !== ""){
        generalLoading();
        $.post('/list/readMail', {
            params
        }, function(data, status){
            const obj = JSON.parse(data);
            if (obj.code == 1){
                swal.close();
                document.getElementById("mailTitle").innerHTML = obj.data['title'];
                document.getElementById("mailContent").innerHTML = obj.data['content'];
                if (obj.data['read'] == false){
                    $.post('/list/editMail', {
                        params
                    }, function(data, status){
                        const obj = JSON.parse(data);
                        console.log(obj)
                    }
                    ).done(function(){

                    })
                    .fail(function(){

                    });
                }
            }
            else{

            }
        })
        .done(function(){

        })
        .fail(function(){

        });
    }
}
</script>