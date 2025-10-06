<!-- Mobile -->
 <div class="container">
 <section class="d-xl-none d-lg-none d-md-none col-xl-12 col-lg-12 col-md-12 col-12">

    <h5 class="text-uppercase d-xl-none d-lg-none d-md-none d-block m-0"><?=lang('Label.history');?></h5>
    <div class="card shadow border-0">
    <div class="card-body">
        <div class="list-group list-group-flush">

        <!-- Transaction log -->
        <a href="<?=base_url('transaction/history');?>" class="list-group-item list-group-item-action d-flex align-items-center border-bottom">
            <img class="me-2" src="<?=base_url('assets/img/icon/transaction.png');?>">
            <?=lang('Nav.history');?>
            <i class="bx bx-chevron-right ms-auto"></i>
        </a>

        <!-- Bet log-->
        <a href="<?=base_url('bet-log');?>" class="list-group-item list-group-item-action d-flex align-items-center border-bottom">
            <img class="me-2" src="<?=base_url('assets/img/icon/bet_log.png');?>">
            <?=lang('Nav.betlog');?>
            <i class="bx bx-chevron-right ms-auto"></i>
        </a>

        <!-- Ref Bet log -->
        <a href="<?=base_url('realtime-bet-log');?>" class="list-group-item list-group-item-action d-flex align-items-center border-bottom">
            <img class="me-2" src="<?=base_url('assets/img/icon/realtime_log.png');?>">
            <?=lang('Nav.refbetlog');?>
            <i class="bx bx-chevron-right ms-auto"></i>
        </a>

        <!-- Gamescore Log -->
        <a href="<?=base_url('score-log');?>" class="list-group-item list-group-item-action d-flex align-items-center border-bottom">
            <img class="me-2" src="<?=base_url('assets/img/icon/game_log.png');?>">
            <?=lang('Nav.scorelog');?>
            <i class="bx bx-chevron-right ms-auto"></i>
        </a>

        <!-- Affiliate Log -->
        <a href="<?=base_url('affiliate-log');?>" class="list-group-item list-group-item-action d-flex align-items-center">
            <img class="me-2" src="<?=base_url('assets/img/icon/affiliate.png');?>">
            <?=lang('Nav.afflog');?>
            <i class="bx bx-chevron-right ms-auto"></i>
        </a>

    </div>
  </div>
</div>
</section>
</div>

<script>
document.addEventListener('DOMContentLoaded', (event) => {
    $('.mobile-footer [data-page=history] a').addClass("active");
});


</script>