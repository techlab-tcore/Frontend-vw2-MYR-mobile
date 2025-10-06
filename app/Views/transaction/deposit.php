<div class="container">

    <dl class="row gy-2 gx-3">
        <dd class="col-xl-12 col-lg-12 col-md-12 col-12">
            <section class="card border-0">
                <div class="card-header profileWallet border-0 p-3 bg-dark rounded-4 text-light">
                    <?=view('profile-wallet');?>
                </div>
                <div class="card-body">
                    <div class="row mb-3">
                        <label class="col-xl-4 col-lg-4 col-md-4 col-12 col-form-label color-55vp3"><?=lang('Input.depoption');?> <span class="text-danger">*</span></label>
                        <div class="col-xl-8 col-lg-8 col-md-8 col-12">
                            <div class="p-2 rounded bg-55vp4">
                                <nav class="nav nav-pills" id="nav-tab">
                                    <button class="nav-link active" id="nav-instant-tab" data-bs-toggle="tab" data-bs-target="#nav-instant" type="button" role="tab" aria-controls="nav-instant" aria-selected="true"><?=lang('Nav.instanttransfer');?></button>
                                    <button class="nav-link" id="nav-bank-tab" data-bs-toggle="tab" data-bs-target="#nav-bank" type="button" role="tab" aria-controls="nav-bank" aria-selected="false"><?=lang('Nav.banktransfer');?></button>
                                </nav>
                            </div>
                        </div>
                    </div>

                    <dl class="tab-content" id="nav-tabContent">
                        <dd class="tab-pane fade show active" id="nav-instant" role="tabpanel" aria-labelledby="nav-instant-tab" tabindex="0">
                            <?=form_open('',['class'=>'form-validation pgatewayForm','novalidate'=>'novalidate'],['channel'=>'','currency'=>'']);?>
                            <div class="row mb-3">
                                <label class="col-xl-4 col-lg-4 col-md-4 col-12 col-form-label color-55vp3"><?=lang('Input.pgateway');?> <span class="text-danger">*</span></label>
                                <div class="col-xl-8 col-lg-8 col-md-8 col-12">
                                    <div class="p-2 rounded bg-secondary deposit-channel">
                                        <div class="row gap-1 px-2" id="depositChannel-list" role="group"></div>
                                    </div>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label class="col-xl-4 col-lg-4 col-md-4 col-12 col-form-label color-55vp3"><?=lang('Input.depchannel');?> <span class="text-danger">*</span></label>
                                <div class="col-xl-8 col-lg-8 col-md-8 col-12">
                                    <div class="p-2 rounded bg-secondary deposit-bank">
                                        <div class="btn-group" id="depositPayGatewayBank-list" role="group"></div>
                                    </div>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label class="col-xl-4 col-lg-4 col-md-4 col-12 col-form-label color-55vp3"><?=lang('Input.depamount');?> <span class="text-danger">*</span></label>
                                <div class="col-xl-8 col-lg-8 col-md-8 col-12">
                                    <!-- <input type="number" step="any" class="form-control" name="amount" min="<?=$_ENV['minPgDeposit'];?>" max="<?=$_ENV['maxPgDeposit'];?>" placeholder="<?=lang('Validation.deposit',[$_ENV['minPgDeposit'],$_ENV['maxPgDeposit']]);?>" required> -->

                                    <input type="number" step="any" class="form-control" name="amount" required>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label class="col-xl-4 col-lg-4 col-md-4 col-12 col-form-label color-55vp3"><?=lang('Label.promotion');?></label>
                                <div class="col-xl-8 col-lg-8 col-md-8 col-12">
                                    <select class="form-select" name="promotion" id="promo-list"></select>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <div class="col-xl-8 col-lg-8 col-md-8 col-12 ms-auto">
                                    <button type="submit" class="btn btn-primary"><?=lang('Nav.submit');?></button>
                                </div>
                            </div>
                            <?=form_close();?>

                            <article class="p-4 bg-light text-dark rounded fw-light finance-condition">
                                <h5 class="text-uppercase color-55vp"><?=lang('Label.depositpolicy');?></h5>
                                <!--<span class="d-block"><?=lang('Validation.insdep');?></span>-->
                                <ol>
                                    <li><?=lang('Validation.insdep1');?></li>
                                    <li><?=lang('Validation.insdep2');?></li>
                                    <li><?=lang('Validation.insdep3',[10]);?></li>
                                    <li><?=lang('Validation.insdep4');?></li>
                                </ol>
                                <!--<p class="pt-3"><?=lang('Validation.insdep2');?></p>-->
                            </article>
                        </dd>
                        <dd class="tab-pane fade" id="nav-bank" role="tabpanel" aria-labelledby="nav-bank-tab" tabindex="0">
                            <?=form_open('',['class'=>'form-validation bankTransferForm','novalidate'=>'novalidate'],['card'=>'','currency'=>'']);?>
                            <div class="row mb-3">
                                <label class="col-xl-4 col-lg-4 col-md-4 col-12 col-form-label color-55vp3"><?=lang('Input.bankoption');?> <span class="text-danger">*</span></label>
                                <div class="col-xl-8 col-lg-8 col-md-8 col-12">
                                    <select class="form-select" name="bank" id="bankOption-list" required></select>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label class="col-xl-4 col-lg-4 col-md-4 col-12 col-form-label color-55vp3"><?=lang('Input.bankacc');?> <span class="text-danger">*</span></label>
                                <div class="col-xl-8 col-lg-8 col-md-8 col-12">
                                    <div class="input-group mb-1">
                                        <input type="text" class="form-control" name="accholder" readonly>
                                        <button class="btn btn-dark btn-copy-holder" type="button"><?=lang('Nav.copy');?></button>
                                    </div>
                                    <div class="input-group">
                                        <input type="text" class="form-control" name="accno" readonly>
                                        <button class="btn btn-dark btn-copy-accno" type="button"><?=lang('Nav.copy');?></button>
                                    </div>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label class="col-xl-4 col-lg-4 col-md-4 col-12 col-form-label color-55vp3"><?=lang('Input.depamount');?> <span class="text-danger">*</span></label>
                                <div class="col-xl-8 col-lg-8 col-md-8 col-12">
                                    <!-- <input type="number" step="any" class="form-control" name="amount" min="<?=$_ENV['minBankDeposit'];?>" max="<?=$_ENV['maxBankDeposit'];?>" placeholder="<?=lang('Validation.deposit',[$_ENV['minBankDeposit'],$_ENV['maxBankDeposit']]);?>" required> -->

                                    <input type="number" step="any" class="form-control" name="amount" required>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label class="col-xl-4 col-lg-4 col-md-4 col-12 col-form-label color-55vp3"><?=lang('Input.uploadreceipt');?> <span class="text-danger">*</span></label>
                                <div class="col-xl-8 col-lg-8 col-md-8 col-12">
                                    <input class="form-control" type="file" id="receipt" name="receipt" required>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label class="col-xl-4 col-lg-4 col-md-4 col-12 col-form-label color-55vp3"><?=lang('Label.promotion');?></label>
                                <div class="col-xl-8 col-lg-8 col-md-8 col-12">
                                    <select class="form-select" name="promotion" id="bankPromo-list"></select>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <div class="col-xl-8 col-lg-8 col-md-8 col-12 ms-auto">
                                    <button type="submit" class="btn btn-primary"><?=lang('Nav.submit');?></button>
                                </div>
                            </div>
                            <?=form_close();?>

                            <article class="p-4 bg-light text-dark rounded fw-light finance-condition">
                                <h5 class="text-uppercase color-55vp pb-3"><?=lang('Label.depositpolicy');?></h5>
                                <p><?=lang('Validation.deppolicy');?></p>
                                <p><?=lang('Validation.deppolicy1',[10]);?></p>
                                <p><?=lang('Validation.deppolicy2');?></p>
                                <p><?=lang('Validation.deppolicy3');?><br><?=lang('Validation.deppolicy4');?></p>
                            </article>
                        </dd>
                    </dl>
                </div>
            </section>
        </dd>
    </dl>

</div>

<section class="modal fade modal-depositFrame" id="modal-depositFrame" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="modal-depositFrame" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-fullscreen modal-dialog-scrollable">
        <div class="modal-content">
            <div class="modal-header border-light bg-55vp4">
                <h1 class="modal-title fs-5"><?=lang('Nav.instanttransfer');?></h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body p-0">
                <article class="depositScreen" id="depositScreen"></article>
            </div>
            <div class="modal-footer border-light bg-55vp4">
                <button type="button" class="btn btn-55vp" data-bs-dismiss="modal"><?=lang('Nav.close');?></button>
            </div>
        </div>
    </div>
</section>

<script>
document.addEventListener('DOMContentLoaded', (event) => {
    $('.sideNav-profile [data-page=deposit]').addClass('active');
    $('.sideMainNav [data-page=deposit]').addClass("active");

    getRadioPGatewayList('depositChannel-list');
    getCompanyCDM('bankOption-list');

    let checkChannel = $('#depositChannel-list input:radio[name=bankid]:checked').val();
    if( typeof checkChannel!='undefined' )
    {
        $('.pgatewayForm [name=amount]').prop('disabled',false);
        $('.pgatewayForm [type=submit]').prop('disabled', false);
    } else {
        $('.pgatewayForm [name=amount]').prop('disabled',true);
        $('.pgatewayForm [type=submit]').prop('disabled', true);
    }

    $('.bankTransferForm .btn-copy-holder').on('click', function() {
        const copytext = $('.bankTransferForm [name=accholder]');
        if( copytext!='' || copytext!=null ) {
            copytext.select();
            document.execCommand('copy');

            $('.bankTransferForm .btn-copy-holder').html('Copied');
            setInterval(function(){ 
                $('.bankTransferForm .btn-copy-holder').html('Copy');
            }, 1500);
        }
    });

    $('.bankTransferForm .btn-copy-accno').on('click', function() {
        const copytext = $('.bankTransferForm [name=accno]');
        if( copytext!='' || copytext!=null ) {
            copytext.select();
            document.execCommand('copy');

            $('.bankTransferForm .btn-copy-accno').html('Copied');
            setInterval(function(){ 
                $('.bankTransferForm .btn-copy-accno').html('Copy');
            }, 1500);
        }
    });

    $('#bankOption-list').on('change', function() {
        const idx = this.options.selectedIndex;
        const currency = this.options[idx].dataset.currency;
        const card = this.options[idx].dataset.cardno;
        const accno = this.options[idx].dataset.accno;
        const holder = this.options[idx].dataset.holder;
        const remark = this.options[idx].dataset.remark;
        const minDep = this.options[idx].dataset.mindep;
        const maxDep = this.options[idx].dataset.maxdep;

        $('.bankTransferForm [name=currency]').val(currency);
        $('.bankTransferForm [name=accholder]').val(holder);
        $('.bankTransferForm [name=accno]').val(accno);
        $('.bankTransferForm [name=card]').val(card);
        $('.bankTransferForm [name=currency]').val(currency);
        $('.bankTransferForm .bank-remark').html(remark);

        // $('.bankTransferForm [name=amount]').val(minDep);
        $('.bankTransferForm [name=amount]').attr('min', minDep);
        $('.bankTransferForm [name=amount]').attr('max', maxDep);
        $('.bankTransferForm [name=amount]').attr('placeholder', "Min: "+minDep+" / "+"Max: "+maxDep);
        $('.bankMinDeposit').html(minDep);
        $('.bankMaxDeposit').html(maxDep);
    });

    $('#depositChannel-list').off().on('change', function(e) {
        generalLoading();
        $('#depositPayGatewayBank-list').html('');

        const pgid = $('#depositChannel-list input:radio[name=bankid]:checked').val();
        const currency = $('#depositChannel-list input:radio[name=bankid]:checked').data('currency');
        const merchant = $('#depositChannel-list input:radio[name=bankid]:checked').data('merchant');

        let checkChannel = $('#depositChannel-list input:radio[name=bankid]:checked').val();
        if( typeof checkChannel!='undefined' )
        {
            $('.pgatewayForm [name=amount]').prop('disabled',false);
            $('.pgatewayForm [type=submit]').prop('disabled', false);
        } else {
            $('.pgatewayForm [name=amount]').prop('disabled',true);
            $('.pgatewayForm [type=submit]').prop('disabled', true);
        }

        getPgChannel('depositPayGatewayBank-list',pgid,merchant,currency);
    });

    const tabInstantEvent = document.querySelector('[data-bs-target="#nav-instant"]');
    tabInstantEvent.addEventListener('hidden.bs.tab', function (event) {
        $('#nav-instant').find('form').trigger('reset');
        $('#nav-instant #promo-list').html(' ');
    });
    tabInstantEvent.addEventListener('shown.bs.tab', function (event) {
        event.target // newly activated tab
        event.relatedTarget // previous active tab
        getPromoList('promo-list');
    });

    const tabBankEvent = document.querySelector('[data-bs-target="#nav-bank"]');
    tabBankEvent.addEventListener('hidden.bs.tab', function (event) {
        $('#nav-bank').find('form').trigger('reset');
        $('#nav-bank #bankPromo-list').html(' ');
    });
    tabBankEvent.addEventListener('shown.bs.tab', function (event) {
        event.target // newly activated tab
        event.relatedTarget // previous active tab
        getPromoList('bankPromo-list');
    });

    $('.pgatewayForm').on('submit', function(e) {
        e.preventDefault();

        if (this.checkValidity() !== false) {
            generalLoading();
            $('.pgatewayForm [type=submit]').prop('disabled', true);

            const bankid = $('.pgatewayForm [name=bankid]:checked').val();
            const merchant = $('.pgatewayForm [name=bankid]:checked').data('merchant');

            var params = {};
            var formObj = $(this).closest("form");
            $.each($(formObj).serializeArray(), function (index, value) {
                params[value.name] = value.value;
                params['bankid'] = bankid;
                params['merchant'] = merchant;
            });

            const channelExist = $('#depositChannel-list').html();
            let checkChannel = $('#depositChannel-list input:radio[name=bankid]:checked').val();
            if( channelExist=='' || typeof checkChannel=='undefined' ) 
            {
                $('.pgatewayForm [type=submit]').prop('disabled', true);
                return false;
            }

            const promoExist = $('.pgatewayForm #promo-list').html();
            // alert(promoExist.length);
            if( promoExist.length>0 )
            {
                if( params['promotion']=='' )
                {
                    swal.fire({
                        backdrop: true,
                        allowOutsideClick: false,
                        allowEscapeKey: false,
                        title: '<?=lang('Validation.rusure');?>',
                        text: '<?=lang('Validation.nopromotion');?>',
                        showDenyButton: true,
                        confirmButtonText: '<?=lang('Nav.submit');?>',
                        denyButtonText: `<?=lang('Nav.thinkagain');?>`,
                    }).then( (result) => {
                        if( result.isConfirmed ) {
                            beforePGDeposit(params);
                            //submitPGatetway(params);
                            // submitBankTransfer(params, imgSource);
                        } else if ( result.isDenied ) {
                            swal.close();
                            $('.pgatewayForm [type=submit]').prop('disabled', false);
                        }
                    });
                    return false;
                } else {
                    beforePGDeposit(params);
                    //submitPGatetway(params);
                }
            } else {
                beforePGDeposit(params);
                //submitPGatetway(params);
            }
        }
    });

    $('.bankTransferForm').off().on('submit', function(e) {
        e.preventDefault();

        if (this.checkValidity() !== false) {
            generalLoading();
            $('.bankTransferForm [type=submit]').prop('disabled', true);

            const imgSource = $('.bankTransferForm [name=receipt]')[0].files[0];
            const img = $('.bankTransferForm [name=receipt]')[0].files[0]['name'];
            const ext = img.substr( (img.lastIndexOf('.') +1) );

            let timestamp = Math.floor(Date.now() / 1000);
            const userstamp = '<?=isset($_SESSION['username'])?$_SESSION['username']:'';?>';
            const filename = userstamp + timestamp + '.' + ext;

            var params = {};
            var formObj = $('.bankTransferForm').closest("form");
            $.each($(formObj).serializeArray(), function (index, value) {
                params[value.name] = value.value;
                params['slip'] = filename;
            });

            const bankOptionExist = $('#bankOption-list').html();
            if( bankOptionExist=='' ) 
            {
                $('.bankTransferForm [type=submit]').prop('disabled', true);
                return false;
            }
            
            const promoExist = $('.bankTransferForm #bankPromo-list').html();
            if( promoExist.length>0 )
            {
                if( params['promotion']=='' )
                {
                    swal.fire({
                        title: '<?=lang('Validation.rusure');?>',
                        text: '<?=lang('Validation.nopromotion');?>',
                        showDenyButton: true,
                        confirmButtonText: '<?=lang('Nav.submit');?>',
                        denyButtonText: `<?=lang('Nav.thinkagain');?>`,
                    }).then( (result) => {
                        if( result.isConfirmed ) {
                            beforeBTDeposit(params, imgSource);
                            //submitBankTransfer(params, imgSource);
                        } else if ( result.isDenied ) {
                            swal.close();
                            $('.bankTransferForm [type=submit]').prop('disabled', false);
                        }
                    });
                } else {
                    beforeBTDeposit(params, imgSource);
                    //submitBankTransfer(params, imgSource);
                }
            } else {
                beforeBTDeposit(params, imgSource);
                //submitBankTransfer(params, imgSource);
            }
        }
    });
});

function submitBankTransfer(params, imgSource)
{
    $.post('/payment/deposit/add', {
        params
    }, function(data, status) {
        const obj = JSON.parse(data);
        if( obj.code==1 ) {
            uploadslip(obj.agentid, obj.sessionid, obj.userid, obj.slipname, imgSource);
            swal.fire("Updated!", obj.message , "success").then(() => {
                getProfile();
                $('form').removeClass('was-validated');
                $('form').trigger('reset');
                $('.bankTransferForm [type=submit]').prop('disabled', false);
            });
        } else {
            swal.fire("<?=lang('Label.error');?>!", obj.message + " (Code: "+obj.code+")", "error");
        }
    })
    .done(function() {
        $('.bankTransferForm [type=submit]').prop('disabled', false);
    })
    .fail(function() {
        swal.fire("<?=lang('Label.error');?>!", "Oopss! There are something wrong. Please try again later.", "error").then(() => {
            $('.bankTransferForm [type=submit]').prop('disabled', false);
        });
    });
}

function submitPGatetway(params)
{
    $.post('/payment/payment-gateway/deposit/add', {
        params
    }, function(data, status) {
        const obj = JSON.parse(data);
        if( obj.code==1 ) {
            $('form').removeClass('was-validated');
            $('form').trigger('reset');

            var launchPG = new FormData();
            launchPG.append('type', obj.paymentGatewayParams.type);
            launchPG.append('userid', obj.paymentGatewayParams.userid);
            launchPG.append('merchantcode', obj.paymentGatewayParams.merchantcode);
            launchPG.append('apikey', obj.paymentGatewayParams.apikey);
            launchPG.append('payurl', obj.paymentGatewayParams.payurl);
            launchPG.append('successurl', obj.paymentGatewayParams.successurl);
            launchPG.append('failureurl', obj.paymentGatewayParams.failureurl);
            launchPG.append('callbackurl', obj.paymentGatewayParams.callbackurl);
            launchPG.append('amount', obj.paymentGatewayParams.amount);
            launchPG.append('systemamount', obj.paymentGatewayParams.systemamount);
            launchPG.append('currency', obj.paymentGatewayParams.currency);
            launchPG.append('item_id', obj.paymentGatewayParams.item_id);
            launchPG.append('item_description', obj.paymentGatewayParams.item_description);
            launchPG.append('name', obj.paymentGatewayParams.name);
            launchPG.append('email', obj.paymentGatewayParams.email);
            launchPG.append('telephone', obj.paymentGatewayParams.telephone);
            launchPG.append('accountid', obj.paymentGatewayParams.accountid);
            launchPG.append('bankcode', obj.paymentGatewayParams.bankcode);
            launchPG.append('channelcode', obj.paymentGatewayParams.channelcode);
            launchPG.append('channelremark', obj.paymentGatewayParams.channelremark);
            launchPG.append('charges', obj.paymentGatewayParams.charges);
            launchPG.append('ip', obj.paymentGatewayParams.ip);
            launchPG.append('remark', obj.paymentGatewayParams.remark);

            var myJSON = JSON.stringify(obj.paymentGatewayParams);
            const ss = btoa(myJSON);

            $.ajax({
                type: 'GET',
                url: obj.paymentGatewayUrl + '?verify=' + ss, 
                success: function (data) {
                    // var win = window.open(data, '_blank');
                    // win.document.write(data);
                    // win.document.close();

                    if( obj.paymentGatewayParams.channelcode!='USDT' && params['bankid']!=btoa('<?=$_ENV['payessence'];?>') && params['bankid']!=btoa('<?=$_ENV['peEwallet'];?>') && params['bankid']!=btoa('<?=$_ENV['bigpay'];?>') )
                    {
                        $('.modal-depositFrame').modal('show');
                        var node = document.createElement('iframe');
                        node.setAttribute('allowfullscreen','allowfullscreen');
                        node.setAttribute('frameborder','0');
                        node.setAttribute('loading','lazy');
                        node.setAttribute('width','100%');
                        node.setAttribute('height','100%');
                        node.src = obj.paymentGatewayUrl + '?verify=' + ss;
                        node.seamless;
                        document.getElementById("depositScreen").appendChild(node);
                    } else {
                        // var win = window.open(obj.paymentGatewayUrl + '?verify=' + ss, '_blank');
                        // win.document.write(data);
                        // win.document.close();

                        byPassBlockPopUp(obj.paymentGatewayUrl + '?verify=' + ss);
                    }
                },
                error: function(xhr, type, exception){},
                beforeSend: function() {}
            }).done(function() {
                swal.close();
            });
            // e.stopImmediatePropagation();
            return false;


            // swal.fire("Success!", obj.message, "success").then(() => {
            //     $('form').removeClass('was-validated');
            //     $('form').trigger('reset');
            // });
        } else {
            swal.fire("Error!", obj.message + " (Code: "+obj.code+")", "error").then(() => {
                $('.pgatewayForm [type=submit]').prop('disabled', false);
            });
        }
    })
    .done(function() {
        $('.pgatewayForm [type=submit]').prop('disabled', false);
    })
    .fail(function() {
        swal.fire("Error!", "Oopss! There are something wrong. Please try again later.", "error").then(()=>{
            $('.pgatewayForm [type=submit]').prop('disabled', false);
        });
    });
}

async function getPromoList(element)
{
    var params = {};
    params['category'] = 0;
    params['type'] = 1;

    $.post('/list/user-promotion/all', {
        params
    }, function(data, status) {
        const obj = JSON.parse(data);
        if( obj.code==1 ) {
            // swal.fire("Success!", obj.message, "success").then(() => {
            //     $('form').removeClass('was-validated');
            //     $('form').trigger('reset');
            // });
            var nodeAll = document.createElement("option");
            var textNodeAll = document.createTextNode('---<?=lang('Label.promotion');?>---');
            nodeAll.setAttribute("value", '');
            nodeAll.appendChild(textNodeAll);
            document.getElementById(element).appendChild(nodeAll);

            const promo = obj.data;
            promo.forEach(function(item, index) {
                var node = document.createElement("option");
                var textNode = document.createTextNode(item.title);
                node.setAttribute("value", item.id);
                node.appendChild(textNode);
                document.getElementById(element).appendChild(node);
            });
        } else {
            swal.fire("Error!", obj.message + " (Code: "+obj.code+")", "error").then(() => {
                
            });
        }
    })
    .done(function() {
        swal.close();
    })
    .fail(function() {
        swal.fire("Error!", "Oopss! There are something wrong. Please try again later.", "error").then(()=>{
            
        });
    });
}

function getPgChannel(element,pgid,merchant,currency)
{
    var params = {};
    params['bankid'] = pgid;
    params['merchant'] = merchant;

    $.post('/list/payment-channel/company', {
        params
    }, function(data, status) {
        const obj = JSON.parse(data);
        if( obj.code==1 ) {
            swal.close();

            //$('.pgatewayForm [name=currency]').val(currency);
            //$('.pgatewayForm [name=channel]').val(obj.data[0].code);
            //$('.pgatewayForm [name=amount]').val(obj.data[0].minDeposit);
            //$('.pgatewayForm [name=amount]').attr('min', obj.data[0].minDeposit);
            //$('.pgatewayForm [name=amount]').attr('max', obj.data[0].maxDeposit);
            //$('.pgatewayForm [name=amount]').attr('placeholder', "Min: "+obj.data[0].minDeposit+" / "+"Max: "+obj.data[0].maxDeposit);

            //$('.pgMinDeposit').html(obj.data[0].minDeposit);
            //$('.pgMaxDeposit').html(obj.data[0].maxDeposit);

            // Gateway Channel
            let defaultBank = 0;
            const channel = obj.data;
            if( channel!='' )
            {
                channel.forEach(function(item, index) {
                    if( item.isDeposit == 1 )
                    {
                        var node = document.createElement("input");
                        var nodeLabel = document.createElement("label");
                        var textNodeLabel = document.createTextNode(item.channelName.EN);

                        node.setAttribute("type", 'radio');
                        node.setAttribute("name", 'channel');
                        node.setAttribute("id", 'pgchannel-'+index);
                        node.setAttribute("autocomplete", 'off');
                        node.setAttribute("value", item.code);
                        node.classList.add('btn-check');

                        nodeLabel.setAttribute("for", 'pgchannel-'+index);
                        nodeLabel.classList.add('btn','btn-outline-success');

                        nodeLabel.appendChild(textNodeLabel);
                        document.getElementById(element).appendChild(node);
                        document.getElementById(element).appendChild(nodeLabel);

                        if ( defaultBank == 0 )
                        {
                            $('.pgatewayForm [name=currency]').val(currency);
                            $('.pgatewayForm [name=channel]').val(obj.data[index].code);
                            $('.pgatewayForm [name=amount]').val(obj.data[index].minDeposit);
                            $('.pgatewayForm [name=amount]').attr('min', obj.data[index].minDeposit);
                            $('.pgatewayForm [name=amount]').attr('max', obj.data[index].maxDeposit);
                            $('.pgatewayForm [name=amount]').attr('placeholder', "Min: "+obj.data[index].minDeposit+" / "+"Max: "+obj.data[0].maxDeposit);

                            $('.pgMinDeposit').html(obj.data[index].minDeposit);
                            $('.pgMaxDeposit').html(obj.data[index].maxDeposit);

                            defaultBank++;
                        }
                    }
                });
            } else {
                swal.close();
                $('.pgatewayForm [type=submit]').prop('disabled', true);
            }
            // End Gateway Channel
        } else {
            swal.fire("", obj.message + " (Code: "+obj.code+")", "error");
        }
    })
    .done(function() {
    })
    .fail(function() {
        swal.fire("", "Please try again later.", "error");
    });
}

async function getRadioPGatewayList(element)
{
    generalLoading();

    $.get('/list/payment-gateway/company', function(data, status) {
        const obj = JSON.parse(data);
        if( obj.code==1 ) {
            // swal.close();
            const pg = obj.data;

            if( pg!='' )
            {
                    //DGPAY filter
                    pg.forEach(function(item, index) {
                        let oderNo = index + 1;
                    // <input type="radio" class="btn-check" name="btnradio" id="btnradio1" autocomplete="off" checked>
                    // <label class="btn btn-outline-primary" for="btnradio1">Radio 1</label>
                    //if( item.status==1 && item.name == 'PayEssence')
                    //{
                        var node = document.createElement("input");
                        var nodeLabel = document.createElement("label");
                        //var textNodeLabel = document.createTextNode(item.name);
                        if (item.bank == '6555fe133b4ec7d4620de8dd') {
                            var textNodeLabel = document.createTextNode(oderNo+') <?=lang('Input.gatduitnow');?> ('+item.currency+')');
                        } else if (item.bank == '6465e84e51613c192ccbcdc2') {
                            var textNodeLabel = document.createTextNode(oderNo+') <?=lang('Input.gatewallet');?> ('+item.currency+')');
                        } else {
                            var textNodeLabel = document.createTextNode(oderNo+') <?=lang('Input.gatchannel');?> ('+item.currency+')');
                        }

                        node.setAttribute("type", 'radio');
                        node.setAttribute("name", 'bankid');
                        node.setAttribute("id", 'channel-'+index);
                        node.setAttribute("autocomplete", 'off');
                        node.setAttribute("value", btoa(item.bank));
                        node.setAttribute("data-currency", item.currency);
                        node.setAttribute("data-merchant", item.merchant);
                        node.classList.add('btn-check');

                        if( index==0 )
                        {
                            // node.setAttribute("checked", 'checked');
                        }

                        nodeLabel.setAttribute("for", 'channel-'+index);
                        nodeLabel.classList.add('btn','btn-outline-success','col-5');

                        nodeLabel.appendChild(textNodeLabel);
                        document.getElementById(element).appendChild(node);
                        document.getElementById(element).appendChild(nodeLabel);
                    //}
                });

                //DGPAY filter
                /*pg.forEach(function(item, index) {
                    // <input type="radio" class="btn-check" name="btnradio" id="btnradio1" autocomplete="off" checked>
                    // <label class="btn btn-outline-primary" for="btnradio1">Radio 1</label>
                    if( item.status==1 && item.name == 'DGPay')
                    {
                        var node = document.createElement("input");
                        var nodeLabel = document.createElement("label");
                        var textNodeLabel = document.createTextNode(item.name);

                        node.setAttribute("type", 'radio');
                        node.setAttribute("name", 'bankid');
                        node.setAttribute("id", 'channel-'+index);
                        node.setAttribute("autocomplete", 'off');
                        node.setAttribute("value", btoa(item.bank));
                        node.setAttribute("data-currency", item.currency);
                        node.setAttribute("data-merchant", item.merchant);
                        node.classList.add('btn-check');

                        if( index==0 )
                        {
                            // node.setAttribute("checked", 'checked');
                        }

                        nodeLabel.setAttribute("for", 'channel-'+index);
                        nodeLabel.classList.add('btn','btn-outline-success','col-5');

                        nodeLabel.appendChild(textNodeLabel);
                        document.getElementById(element).appendChild(node);
                        document.getElementById(element).appendChild(nodeLabel);
                    }
                });

                pg.forEach(function(item, index) {
                    // <input type="radio" class="btn-check" name="btnradio" id="btnradio1" autocomplete="off" checked>
                    // <label class="btn btn-outline-primary" for="btnradio1">Radio 1</label>
                    if( item.status==1 && item.name != 'DGPay' && item.name != 'PayEssence')
                    {
                        var node = document.createElement("input");
                        var nodeLabel = document.createElement("label");
                        var textNodeLabel = document.createTextNode(item.name);

                        node.setAttribute("type", 'radio');
                        node.setAttribute("name", 'bankid');
                        node.setAttribute("id", 'channel-'+index);
                        node.setAttribute("autocomplete", 'off');
                        node.setAttribute("value", btoa(item.bank));
                        node.setAttribute("data-currency", item.currency);
                        node.setAttribute("data-merchant", item.merchant);
                        node.classList.add('btn-check');

                        if( index==0 )
                        {
                            // node.setAttribute("checked", 'checked');
                        }

                        nodeLabel.setAttribute("for", 'channel-'+index);
                        nodeLabel.classList.add('btn','btn-outline-success','col-5');

                        nodeLabel.appendChild(textNodeLabel);
                        document.getElementById(element).appendChild(node);
                        document.getElementById(element).appendChild(nodeLabel);
                    }
                });*/
                
                getPromoList('promo-list');
            } else {
                swal.close();
                $('.pgatewayForm [type=submit]').prop('disabled', true);
            }
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

function uploadslip(agid, sid, uid, slipname, imgSource)
{
    var fd = new FormData();
    fd.append('agentid', agid);
    fd.append('sessionid', sid);
    fd.append('userid', uid);
    fd.append('filename', slipname);
    fd.append('image', imgSource, slipname);

    $.ajax({
        type: 'POST',
        url: '<?=$_ENV['uploadurl']?>', 
        data: fd,
        contentType: false,
        processData: false,
        cache: false,
        success: function (obj) {},
        error: function(err){},
        beforeSend: function() {}
    }).done(function() {});
}

function beforePGDeposit(params)
{
    $.get('/refresh-credit/all', function(data, status) {
        const obj = JSON.parse(data);
        if( obj.code==1 ) {
            submitPGatetway(params);
        } else {
            swal.fire("", obj.message + " (Code: "+obj.code+")", "error");
        }
    })
    .done(function() {
        
    })
    .fail(function() {
        swal.fire("", "Please try again later.", "error").then(() => {
            $('.pgatewayForm [type=submit]').prop('disabled', false);
        });
    });
}

function beforeBTDeposit(params, imgSource)
{
    generalLoading();
    
    $.get('/refresh-credit/all', function(data, status) {
        const obj = JSON.parse(data);
        if( obj.code==1 ) {
            submitBankTransfer(params, imgSource);
        } else {
            swal.fire("", obj.message + " (Code: "+obj.code+")", "error");
        }
    })
    .done(function() {
        
    })
    .fail(function() {
        swal.fire("", "Please try again later.", "error").then(() => {
            $('.bankTransferForm [type=submit]').prop('disabled', false);
        });
    });
}
</script>