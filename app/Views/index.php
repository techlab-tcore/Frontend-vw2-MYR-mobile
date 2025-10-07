<section class="swiper rounded overflow-hidden">
    <div class="swiper-wrapper">
        <?=$banner;?>
    </div>
    <nav class="swiper-pagination"></nav>
    <nav class="swiper-scrollbar"></nav>
</section>

<!-- Mobile -->
<!-- User Account -->
<?php if( isset($_SESSION['logged_in']) ): ?>
<section class="bg-major clientZone wallet-wrapper my-2 <?=$_SESSION['lang'];?> d-xl-none d-lg-none d-md-none">
    <dl class="row m-0">
        <dd class="col-5 m-0 text-truncate border-end">
            <!-- <span class="d-block"><i class='bx bxs-user text-primary me-1'></i><?//=$_SESSION['username'];?></span> -->
            <!-- <i class='bx bxs-coin-stack text-primary me-1'></i><span class="userBalance" onclick="refreshBalance();">---</span> -->
            <!--<span class="d-block"><i class='bx bx-money text-primary me-1' onclick="refreshBalance();"></i><span class="userCash">---</span></span>-->
           <span class="d-block"><small class="me-1"><?=lang('Label.cash');?></small><span class="userCash fw-semibold float-end">---</span><a href="javascript:void(0);" class="ms-1" onclick="refreshBalance()"><i class='bx bx-refresh'></i></a></span>
            <small class="me-1"><?=lang('Label.chip');?></small><span class="userChip fw-semibold float-end">---</span>
            <!--<i class='bx bxs-coin-stack text-primary me-1'></i><span class="userChip">---</span>-->
        </dd>
        <dd class="col-2 m-0 d-flex justify-content-center">
            <a class="btn-wallet" href="<?=base_url('user-account/ewallet');?>"></a>
        </dd>
        <dd class="col-3 m-0 d-flex justify-content-center align-items-center border-start">
             <span><small><?=lang('Label.customerService');?></small></span>
            
        </dd>
        <dd class="col-2 m-0 d-flex justify-content-center">
            <a target="_blank" class="btn-customerservice nav-link liveChat" href="javascript:void(0);"></a>
        </dd>
    </dl>
</section>
<?php endif; ?>
<!-- End User Account -->
<!-- End Mobile -->

<section class="home-navBox d-flex align-items-center">
    <!-- Scroll Left Button -->
    <i class="cursor-left bx bx-chevron-left py-2 d-xl-none d-lg-none d-md-none" onclick="scrollTabs('left')"></i>

    <!-- Scrollable Tab Container -->
    <div class="game-menu btn-gameprovider flex-grow-1 overflow-hidden">
        <nav class="d-flex overflow-auto w-100" id="tabScrollContainer" role="tablist" style="scroll-behavior: smooth; white-space: nowrap;">
            <a class="badge rounded-pill fw-semibold px-3 py-2 d-flex justify-content-center align-items-center" data-bs-toggle="tab" data-bs-target="#news" href="#"><?=lang('Label.news');?></a>
            <a class="badge rounded-pill fw-semibold px-3 py-2 d-flex justify-content-center align-items-center" data-bs-toggle="tab" data-bs-target="#exclusive" href="#"><?=lang('Label.exclusive');?></a>
            <a class="active badge rounded-pill fw-semibold px-3 py-2 d-flex justify-content-center align-items-center" data-bs-toggle="tab" data-bs-target="#slot" href="#"><?=lang('Label.slot');?></a>
            <a class="badge rounded-pill fw-semibold px-3 py-2 d-flex justify-content-center align-items-center" data-bs-toggle="tab" data-bs-target="#casino" href="#"><?=lang('Label.casino');?></a>
            <a class="badge rounded-pill fw-semibold px-3 py-2 d-flex justify-content-center align-items-center" data-bs-toggle="tab" data-bs-target="#sport" href="#"><?=lang('Label.sport');?></a>
            <a class="badge rounded-pill fw-semibold px-3 py-2 d-flex justify-content-center align-items-center" data-bs-toggle="tab" data-bs-target="#keno" href="#"><?=lang('Label.keno');?></a>
            <a class="badge rounded-pill fw-semibold px-3 py-2 d-flex justify-content-center align-items-center" data-bs-toggle="tab" data-bs-target="#lottery" href="#"><?=lang('Label.lottery');?></a>
            <a class="badge rounded-pill fw-semibold px-3 py-2 d-flex justify-content-center align-items-center" data-bs-toggle="tab" data-bs-target="#other" href="#"><?=lang('Label.other');?></a>
        </nav>
    </div>

    <!-- Scroll Right Button -->
    <i class="cursor-right bx bx-chevron-right py-2 d-xl-none d-lg-none d-md-none" onclick="scrollTabs('right')"></i>
</section>

<section class="container">
    <div class="tab-content game-standard">
        <div class="tab-pane fade" id="promotion" role="tabpanel" aria-labelledby="promotion-tab">
            <data class="d-block grid-item">
                <nav class="nav nav-pills nav-fill btn-group rounded-0 promo-menu mb-4">
                    <a class="nav-link text-uppercase rounded-0 active" data-bs-toggle="tab" data-bs-target="#promo-all" href="#">Show All</a>
                    <a class="nav-link text-uppercase rounded-0" data-bs-toggle="tab" data-bs-target="#promo-newmember" href="#">New Member</a>
                    <a class="nav-link text-uppercase rounded-0" data-bs-toggle="tab" data-bs-target="#promo-sport" href="#">Sport</a>
                    <a class="nav-link text-uppercase rounded-0" data-bs-toggle="tab" data-bs-target="#promo-slot" href="#">Slot</a>
                    <a class="nav-link text-uppercase rounded-0" data-bs-toggle="tab" data-bs-target="#promo-casino" href="#">Casino</a>
                </nav>
                <div class="tab-content promo-listing">
                    <div class="tab-pane fade show active" id="promo-all" role="tabpanel" aria-labelledby="all-tab">
                        <ul class="list-unstyled row g-3 justify-content-center" id="grid-promo-all"><?//=$allPromo;?></ul>
                    </div>
                    <div class="tab-pane fade" id="promo-newmember" role="tabpanel" aria-labelledby="newmember-tab">
                        <ul class="list-unstyled row g-3 justify-content-center" id=""></ul>
                    </div>
                </div>
            </data>
        </div>
        <div class="tab-pane fade" id="news" role="tabpanel" aria-labelledby="news-tab">
            <data class="d-block grid-item">
                <ul class="list-unstyled row g-2 justify-content-center" id="grid-news"></ul>
            </data>
        </div>
        <div class="tab-pane fade" id="exclusive" role="tabpanel" aria-labelledby="exclusive-tab">
            <data class="d-block grid-item">
                <ul class="list-unstyled row g-2 justify-content-center" id="grid-exclusive"></ul>
            </data>
        </div>
        <div class="tab-pane fade show active" id="slot" role="tabpanel" aria-labelledby="slot-tab">
            <data class="d-block grid-item">
                <ul class="list-unstyled row g-2 justify-content-center" id="grid-slot"></ul>
            </data>
        </div>
        <div class="tab-pane fade" id="casino" role="tabpanel" aria-labelledby="casino-tab">
            <data class="d-block grid-item">
                <ul class="list-unstyled row g-2 justify-content-center" id="grid-casino"></ul>
            </data>
        </div>
        <div class="tab-pane fade" id="sport" role="tabpanel" aria-labelledby="sport-tab">
            <data class="d-block grid-item">
                <ul class="list-unstyled row g-2 justify-content-center" id="grid-sport"></ul>
            </data>
        </div>
        <div class="tab-pane fade" id="keno" role="tabpanel" aria-labelledby="keno-tab">
            <data class="d-block grid-item">
                <ul class="list-unstyled row g-2 justify-content-center" id="grid-keno"></ul>
            </data>
        </div>
        <!--
        <div class="tab-pane fade" id="esport" role="tabpanel" aria-labelledby="esport-tab">
            <data class="d-block grid-item">
                <ul class="list-unstyled row g-2 justify-content-center" id="grid-esport"></ul>
            </data>
        </div>
        -->
        <div class="tab-pane fade" id="lottery" role="tabpanel" aria-labelledby="lottery-tab">
            <data class="d-block grid-item">
                <!-- <ul class="list-unstyled row g-2 justify-content-center" id="grid-lottery"></ul> -->
                <ul class="list-unstyled row g-2 justify-content-center">
                    <li class="col-xl-2 col-lg-2 col-md-3 col-3">
                        <a class="d-block text-decoration-none" href="javascript:void(0);" onclick="callingPreLotto();">
                            <img class="d-block w-100" src="<?=base_url('assets/img/prelotto.png');?>">
                        </a>
                    </li>
                </ul>
            </data>
        </div>
        <!--
        <div class="tab-pane fade" id="appgame" role="tabpanel" aria-labelledby="appgame-tab">
            <data class="d-block grid-item">
                <ul class="list-unstyled row g-2 justify-content-center" id="grid-appgame"></ul>
            </data>
        </div>
        -->
        <div class="tab-pane fade" id="other" role="tabpanel" aria-labelledby="other-tab">
            <data class="d-block grid-item">
                <ul class="list-unstyled row g-2 justify-content-center" id="grid-other"></ul>
            </data>
        </div>
    </div>
</section>

<!-- Pop-up Announement -->
<section class="modal fade modal-announcement" id="modal-announcement" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="modal-announcement" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered modal-dialog-scrollable">
        <div class="modal-content">
            <div class="modal-header border-light">
                <h5 class="modal-title"><i class="bx bxs-megaphone me-1"></i><?=lang('Label.announcement');?></h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body" id="announcemenet">
            </div>
			<div class="text-center py-3">
				<button type="button" class="btn btn-danger bg-gradient" data-bs-dismiss="modal"><?=lang('Nav.close');?></button>
			</div>
        </div>
    </div>
</section>
<!-- End Pop-up Announement -->

<!--- PreLotto --->
<section class="modal fade modal-prelotto" id="modal-prelotto" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="modal-prelotto" aria-hidden="true">
    <div class="modal-dialog modal-xl modal-dialog-centered modal-dialog-scrollable">
        <div class="modal-content bg-transparent border-0">
            <div class="modal-body">
                <ul class="list-unstyled row g-2 justify-content-center" id="grid-lottery"></ul>
            </div>
            <div class="border-0 text-center">
                <button type="button" class="btn btn-danger" data-bs-dismiss="modal"><?=lang('Nav.close');?></button>
            </div>
        </div>
    </div>
</section>
<!--- End PreLotto --->

<link rel="stylesheet" href="<?=base_url('assets/vendors/swiper/swiper-bundle.min.css');?>" />
<script src="<?=base_url('assets/vendors/swiper/swiper-bundle.min.js');?>"></script>
<script>
document.addEventListener('DOMContentLoaded', (event) => {
    $('.sideMainNav [data-page=home]').addClass("active");
    
    if( logged )
    {
        announcementPopList();
        checkIfEmptyBankAccount(2);
    }

    getSEO();
    callingSlot();
    //hotGamesShowCase('<?=$_ENV['hotGames'];?>','grid-hot');
    //exclusiveGamesShowCase('<?=$_ENV['exclusiveGames'];?>','grid-exclusive');

    // Banner
    const swiper = new Swiper('.swiper', {
		init: true,
		loop: true,
		touchEventsTarget: 'container',
		initialSlide: 0,
		updateOnWindowResize:true,
		edgeSwipeDetection: true,
		edgeSwipeDetection: true,
		setWrapperSize: true,
		setWrapperSize: true,
		preloadImages: true,
		updateOnImagesReady: true,
		effect: 'slide',
		autoplay: {
			delay: 5000,
			disableOnInteraction: false,
			pauseOnMouseEnter: true,
		},
		pagination: {
			el: '.swiper-pagination',
			dynamicBullets: true,
		},
		scrollbar: {
			el: '.swiper-scrollbar',
		},
	});

    // Category
    const tabnewsEvent = document.querySelector('a[data-bs-target="#news"]');
    tabnewsEvent.addEventListener('hidden.bs.tab', function (event) {
        document.getElementById("grid-news").innerHTML = '';
    });
    tabnewsEvent.addEventListener('shown.bs.tab', function (event) {
        event.target // newly activated tab
        event.relatedTarget // previous active tab
        callingNews();
    });

    const tabslotEvent = document.querySelector('a[data-bs-target="#slot"]');
    tabslotEvent.addEventListener('hidden.bs.tab', function (event) {
        document.getElementById("grid-slot").innerHTML = '';
    });
    tabslotEvent.addEventListener('shown.bs.tab', function (event) {
        event.target // newly activated tab
        event.relatedTarget // previous active tab
        callingSlot();
    });

    const tabcasinoEvent = document.querySelector('a[data-bs-target="#casino"]');
    tabcasinoEvent.addEventListener('hidden.bs.tab', function (event) {
        document.getElementById("grid-casino").innerHTML = '';
    });
    tabcasinoEvent.addEventListener('shown.bs.tab', function (event) {
        event.target // newly activated tab
        event.relatedTarget // previous active tab
        callingCasino();
    });

    const tabsportEvent = document.querySelector('a[data-bs-target="#sport"]');
    tabsportEvent.addEventListener('hidden.bs.tab', function (event) {
        document.getElementById("grid-sport").innerHTML = '';
    });
    tabsportEvent.addEventListener('shown.bs.tab', function (event) {
        event.target // newly activated tab
        event.relatedTarget // previous active tab
        callingSport();
    });

    const tabkenoEvent = document.querySelector('a[data-bs-target="#keno"]');
    tabkenoEvent.addEventListener('hidden.bs.tab', function (event) {
        document.getElementById("grid-keno").innerHTML = '';
    });
    tabkenoEvent.addEventListener('shown.bs.tab', function (event) {
        event.target // newly activated tab
        event.relatedTarget // previous active tab
        callingKeno();
    });

    // const tabesportEvent = document.querySelector('a[data-bs-target="#esport"]');
    // tabesportEvent.addEventListener('hidden.bs.tab', function (event) {
    //     document.getElementById("grid-esport").innerHTML = '';
    // });
    // tabesportEvent.addEventListener('shown.bs.tab', function (event) {
    //     event.target // newly activated tab
    //     event.relatedTarget // previous active tab
    //     callingESport();
    // });

    const tablottoEvent = document.querySelector('a[data-bs-target="#lottery"]');
    tablottoEvent.addEventListener('hidden.bs.tab', function (event) {
        document.getElementById("grid-lottery").innerHTML = '';
    });
    tablottoEvent.addEventListener('shown.bs.tab', function (event) {
        event.target // newly activated tab
        event.relatedTarget // previous active tab
        // callingLotto();
    });

    // const tabappgameEvent = document.querySelector('a[data-bs-target="#appgame"]');
    // tabappgameEvent.addEventListener('hidden.bs.tab', function (event) {
    //     document.getElementById("grid-appgame").innerHTML = '';
    // });
    // tabappgameEvent.addEventListener('shown.bs.tab', function (event) {
    //     event.target // newly activated tab
    //     event.relatedTarget // previous active tab
    //     callingAppGames();
    // });

    const tabotherEvent = document.querySelector('a[data-bs-target="#other"]');
    tabotherEvent.addEventListener('hidden.bs.tab', function (event) {
        document.getElementById("grid-other").innerHTML = '';
    });
    tabotherEvent.addEventListener('shown.bs.tab', function (event) {
        event.target // newly activated tab
        event.relatedTarget // previous active tab
        //callingOther();
    });
    // End Category

    // Games
	$('.btn-gameprovider a[data-bs-target="#hot"]').off().on('click', function(e) {
        e.preventDefault();
		hotGamesShowCase('<?=$_ENV['hotGames'];?>','grid-hot');
    });

    $('.btn-gameprovider a[data-bs-target="#exclusive"]').off().on('click', function(e) {
        e.preventDefault();
		exclusiveGamesShowCase('<?=$_ENV['exclusiveGames'];?>','grid-exclusive');
    });
	// End Games

    // Promotion
    // const tabAllEvent = document.querySelector('a[data-bs-target="#promo-all"]');
    // tabAllEvent.addEventListener('hidden.bs.tab', function (event) {
    //     // document.getElementById("grid-promo-all").innerHTML = '';
    // });
    // tabAllEvent.addEventListener('shown.bs.tab', function (event) {
    //     event.target // newly activated tab
    //     event.relatedTarget // previous active tab
    //     // callingSlot();
    // });
    // End Promotion

    const prelottoModel = document.getElementById('modal-prelotto');
    prelottoModel.addEventListener('hidden.bs.tab', function (event) {
        document.getElementById("grid-lottery").innerHTML = '';
    });
    prelottoModel.addEventListener('shown.bs.modal', function (event) {
        callingLotto();
    });
});

function callingPreLotto()
{
    $('.modal-prelotto').modal('show');
}

async function hotGamesShowCase(provider,element)
{
	generalLoading();

	var params = {};
	params['provider'] = provider;

	$.post('/list/cate-slots/games', {
		params
	}, function(data, status) {
		document.getElementById(element).innerHTML = data;
	})
	.done(function() {
		swal.close();
	})
	.fail(function() {
		swal.fire("Error!", "Oopss! There are something wrong. Please try again later.", "error");
	});
}

async function exclusiveGamesShowCase(provider,element)
{
	generalLoading();

	var params = {};
	params['provider'] = provider;

	$.post('/list/cate-ex-slots/games', {
		params
	}, function(data, status) {
		document.getElementById(element).innerHTML = data;
	})
	.done(function() {
		swal.close();
	})
	.fail(function() {
		swal.fire("Error!", "Oopss! There are something wrong. Please try again later.", "error");
	});
}

async function announcementPopList()
{
    $.get('/list/announcement/pop/all', function(res, status) {
        const obj = JSON.parse(res);
        if( obj.code==1 ) {
            if( obj.data!='' ) {
                $('.modal-announcement').modal('show');
                const msg = obj.data;
                msg.forEach( (item, index) => {
                    var node = document.createElement("article");
                    var textnode = item.content;
                    node.classList.add('mb-3');
                    node.innerHTML = textnode;
                    var ele = document.getElementById("announcemenet").appendChild(node);
                });
            }
        } else if( obj.code==39 ) {
            forceUserLogout();
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

function hideWidget(element)
{
    let dom = document.getElementById(element);
    dom.addEventListener("click", function() {
		dom.hidden = true;
	});
}

function scrollTabs(direction) {
    const container = document.getElementById('tabScrollContainer');
    const scrollAmount = 200;

    if (direction === 'right') {
        container.scrollBy({ left: scrollAmount, behavior: 'smooth' });
    } else {
        container.scrollBy({ left: -scrollAmount, behavior: 'smooth' });
    }
}
</script>