<section class="menu-promo pb-3">
    <div class="container">

        <div class="home-navBox mb-3">
            <nav class="promo-menu rounded-0" role="tablist">
                <a class="nav-link text-uppercase rounded-0" data-bs-toggle="tab" data-bs-target="#promo-readonly" href="#"><?=lang('Nav.special');?></a>
                <a class="nav-link text-uppercase rounded-0 active" data-bs-toggle="tab" data-bs-target="#promo-all" href="#"><?=lang('Nav.showall');?></a>
                <a class="nav-link text-uppercase rounded-0" data-bs-toggle="tab" data-bs-target="#promo-newmember" href="#"><?=lang('Nav.newmember');?></a>
                <!-- <a class="nav-link text-uppercase rounded-0" data-bs-toggle="tab" data-bs-target="#promo-games" href="#"><?//=lang('Nav.games');?></a> -->
                <a class="nav-link text-uppercase rounded-0" data-bs-toggle="tab" data-bs-target="#promo-sport" href="#"><?=lang('Label.sport');?></a>
                <a class="nav-link text-uppercase rounded-0" data-bs-toggle="tab" data-bs-target="#promo-slot" href="#"><?=lang('Label.slot');?></a>
                <a class="nav-link text-uppercase rounded-0" data-bs-toggle="tab" data-bs-target="#promo-casino" href="#"><?=lang('Label.casino');?></a>
            </nav>
        </div>
        <div class="tab-content promo-listing">
            <div class="tab-pane fade" id="promo-readonly" role="tabpanel" aria-labelledby="promo-readonly-tab">
                <ul class="list-unstyled row gy-3" id="grid-promo-readonly"><?=$promotionReadOnly;?></ul>
            </div>
            <div class="tab-pane fade show active" id="promo-all" role="tabpanel" aria-labelledby="promo-all-tab">
                <ul class="list-unstyled row gy-3" id="grid-promo-all"><?=$allPromo;?></ul>
            </div>
            <div class="tab-pane fade" id="promo-newmember" role="tabpanel" aria-labelledby="promo-newmember-tab">
                <ul class="list-unstyled row gy-3" id="grid-promo-newmember"><?=$promoNewMember;?></ul>
            </div>
            <!--
            <div class="tab-pane fade" id="promo-games" role="tabpanel" aria-labelledby="promo-games-tab">
                <ul class="list-unstyled row gy-3" id="grid-promo-games"><?//=$promoGP;?></ul>
            </div>
            -->
            <div class="tab-pane fade" id="promo-sport" role="tabpanel" aria-labelledby="promo-sport-tab">
                <ul class="list-unstyled row gy-3" id="grid-promo-sport"><?=$promoSport;?></ul>
            </div>
            <div class="tab-pane fade" id="promo-slot" role="tabpanel" aria-labelledby="promo-slot-tab">
                <ul class="list-unstyled row gy-3" id="grid-promo-slot"><?=$promoSlot;?></ul>
            </div>
            <div class="tab-pane fade" id="promo-casino" role="tabpanel" aria-labelledby="promo-casino-tab">
                <ul class="list-unstyled row gy-3" id="grid-promo-casino"><?=$promoCasino;?></ul>
            </div>
        </div>

    </div>
</section>

<script>
document.addEventListener('DOMContentLoaded', (event) => {
    $('.sideMainNav [data-page=promos]').addClass("active");
    $('.mobile-footer [data-page=promotion] a').addClass("active");

    const promoBoxEvent = document.getElementById('modal-promoBox');
    promoBoxEvent.addEventListener('hidden.bs.modal', function (event) {
        $('.modal').find('form').removeClass('was-validated');
        $('.modal').find('form').trigger('reset');

        document.getElementsByClassName('promo-title')[0].innerHTML = '';
        document.getElementsByClassName('promo-desc')[0].innerHTML = '';
        document.getElementsByClassName('promo-banner')[0].setAttribute("src", '');
    });
});

function promo()
{
    var params = {};
    params['category'] = 1;
    params['type'] = 1;

    $.post('/list/promotion/all', {
        params
    }, function(data, status) {
        
    })
    .done(function() {
    })
    .fail(function() {
        swal.fire("Error!", "Oopss! There are something wrong. Please try again later.", "error").then(()=>{
        });
    });
}
</script>