<?php

namespace App\Controllers;

use CodeIgniter\I18n\Time;

class General_control extends BaseController
{
	/*
	Protected
	*/

	protected function reorderGameProviderAgentList($type)
    {
        $lng = strtoupper($_SESSION['lang']);

        $payload = [
            'userid' => $_SESSION['token']
        ];
        $res = $this->gameprovider_model->selectAllAgentGameProvider($payload);
        if( $res['code']==1 && $res['data']!=[] ):
            switch( $type['type'] ):
                case 33: $category = 3; break;
                default:
                    $category = $type['type'];
            endswitch;

            $data = [];
            foreach( $res['data'] as $g ):
                foreach( $g['type'] as $key=>$gtype ):
                    if( $gtype['type']==$category ):
                        if( $gtype['type']==3 ):
                            if( $g['code']!='RCB' && $type['type']==3 ):
                                $row = [];
                                $row['status'] = $g['status'];
                                $row['code'] = $g['code'];
                                $row['name'] = $g['name'][$lng];
                                $row['order'] = $g['order'];
                                $row['category'] = $gtype['type'];
                                $data[] = $row;
                            elseif( $g['code']=='RCB' && $type['type']==33 ):
                                $row = [];
                                $row['status'] = $g['status'];
                                $row['code'] = $g['code'];
                                $row['name'] = $g['name'][$lng];
                                $row['order'] = $g['order'];
                                $row['category'] = $gtype['type'];
                                $data[] = $row;
                            endif;
                        else:
                            $row = [];
                            $row['status'] = $g['status'];
                            $row['code'] = $g['code'];
                            $row['name'] = $g['name'][$lng];
                            $row['order'] = $g['order'];
                            $row['category'] = $gtype['type'];
                            $data[] = $row;
                        endif;
                    endif;
                endforeach;
            endforeach;
            $games['data'] = $data;
            $result = array_merge(['code'=>$res['code'], 'message'=>$res['message']],$games);
        else:
            $result = ['code'=>$res['code'], 'message'=>$res['message']];
        endif;
        return $result;
    }

	protected function getPromotionRawList($cate,$type)
	{
		$lng = strtoupper($_SESSION['lang']);

        $payload = [
            'userid' => $_ENV['host'],
            'category' => (int)$cate,
            'type' => (int)$type
        ];
        return $this->promotion_model->selectAllPromotions($payload);
	}

	/*
	Public
	*/

    public function checkDevice()
    {
        $device = $this->request->getUserAgent();
        $currentMobile = $device->isMobile();
		$currentPlatform = $device->getPlatform();
		$result = [
			'mobile' => $currentMobile,
			'platform' => $currentPlatform
		];
        echo json_encode($result);
    }

	public function index_setupFirstBankCard()
	{
		if( !session()->get('logged_in') ): return false; endif;
		$data['session'] = session()->get('logged_in') ? true : false;
		$lng = strtoupper($_SESSION['lang']);

		$data['secTitle'] = lang('Nav.bankacc');
		
		// echo view('template/start');
        echo view('personal/initial-bankcard', $data);
		// echo view('template/end', $data);
	}

	public function index_affiliateRegister($affiliate)
	{
		if( session()->get('logged_in') ): return redirect()->to(base_url()); endif;

		$data['secTitle'] = lang('Label.regis3');

		$data['session'] = session()->get('logged_in') ? true : false;

		$uid = base64_decode($affiliate);

		//Get User Login ID
		$payload = [
            'userid' => $uid
        ];
		$resProfile = $this->user_model->selectLoginId($payload);
		if( $resProfile['code']==0):
			$data['loginId'] = $resProfile['loginId'];
        else:
			$data['loginId'] = lang('Label.invalidreferrer');
            //echo json_encode($resProfile['message']);
        endif;

		$data['affiliate'] = $affiliate;

		// echo view('template/start');
		// echo view('template/header');
        echo view('affiliate-register', $data);
		// echo view('template/footer');
		// echo view('template/end', $data);
	}

	//Whatsapp Regis
	public function index_wsaffiliateRegister($affiliate)
	{
		if( session()->get('logged_in') ): return redirect()->to(base_url()); endif;

		$data['secTitle'] = lang('Label.regis3');

		$data['session'] = session()->get('logged_in') ? true : false;

		$uid = base64_decode($affiliate);

		//Get User Login ID
		$payload = [
            'userid' => $uid
        ];
		$resProfile = $this->user_model->selectLoginId($payload);
		if( $resProfile['code']==0):
			$data['loginId'] = $resProfile['loginId'];
        else:
			$data['loginId'] = lang('Label.invalidreferrer');
            //echo json_encode($resProfile['message']);
        endif;

		$data['affiliate'] = $affiliate;

		// echo view('template/start');
		// echo view('template/header');
        echo view('whatsapp-affiliate-register', $data);
		// echo view('template/footer');
		// echo view('template/end', $data);
	}

    public function index()
	{
		$data['session'] = session()->get('logged_in') ? true : false;
		$lng = strtoupper($_SESSION['lang']);

		// Banner
        $resBanner = $this->banner_model->selectAllBanners([]);
		$banner = '';
		if( $resBanner['code']==1 && $resBanner['data']!=[] ):
			foreach( $resBanner['data'] as $indexBanner=>$bn ):
				if( $bn['status'] == 1 ):
					$banner .= '<a class="swiper-slide" href="javascript:void(0);"><img class="d-block w-100" src="'.$bn['imageUrl'][$lng].'" alt="'.$_ENV['company'].'" title="'.$_ENV['company'].'"></a>';
				endif;
			endforeach;
		else:
			$banner .= '<a class="swiper-slide" href="javascript:void(0);"><img class="d-block w-100" src="'.base_url('assets/img/banner/defaultBanner.png').'" alt="'.$_ENV['company'].'" title="'.$_ENV['company'].'"></a>';
		endif;
		$data['banner'] = $banner;
		
		echo view('template/start');
		echo view('template/header');
        echo view('index',$data);
		echo view('template/footer');
		echo view('template/end',$data);
	}

	public function index_registration()
	{
		if( session()->get('logged_in') ): return redirect()->to(base_url()); endif;
		$data['session'] = session()->get('logged_in') ? true : false;

		$data['secTitle'] = lang('Label.regis3');
		
		echo view('template/start');
		echo view('template/header');
        echo view('registration', $data);
		echo view('template/footer', $data);
		echo view('template/end');
	}

	public function index_forgotPassword()
	{
		if( session()->get('logged_in') ): return redirect()->to(base_url()); endif;
		$data['session'] = session()->get('logged_in') ? true : false;

		$data['secTitle'] = lang('Nav.forgotpass');
		
		// echo view('template/start');
		// echo view('template/header');
        echo view('forgot-password', $data);
		// echo view('template/footer', $data);
		// echo view('template/end', $data);
	}

	public function index_login($contact,$pwd,$region)
	{
		if( session()->get('logged_in') ): return redirect()->to(base_url()); endif;
		$data['session'] = session()->get('logged_in') ? true : false;

		$data['secTitle'] = lang('Nav.login');
		$data['mobileno'] = base64_decode($contact);
		$data['pwd'] = base64_decode($pwd);
		$data['region'] = $region;
		
		// echo view('template/start');
		// echo view('template/header');
        echo view('login', $data);
		// echo view('template/footer', $data);
		// echo view('template/end', $data);
	}

	/*
	Transaction
	*/

	public function index_affLossRebateLog()
	{
		if( !session()->get('logged_in') ): return false; endif;
		$data['session'] = session()->get('logged_in') ? true : false;

		$data['secTitle'] = lang('Nav.afflossrebatelog');
		
		echo view('template/start');
		echo view('template/header');
        echo view('transaction/afflossrebate-log', $data);
		echo view('template/footer', $data);
		echo view('template/end');
	}

	public function index_affiliateLog()
	{
		if( !session()->get('logged_in') ): return false; endif;
		$data['session'] = session()->get('logged_in') ? true : false;

		$data['secTitle'] = lang('Nav.afflog');
		
		echo view('template/start');
		echo view('template/header');
        echo view('transaction/aff-log', $data);
		echo view('template/footer', $data);
		echo view('template/end');
	}

	public function index_userTransferHistory()
	{
		if( !session()->get('logged_in') ): return false; endif;
		$data['session'] = session()->get('logged_in') ? true : false;

		$data['secTitle'] = lang('Nav.transferhistory');
		
		echo view('template/start');
		echo view('template/header');
        echo view('transaction/usertransfer-log', $data);
		echo view('template/footer', $data);
		echo view('template/end');
	}

	public function index_userTransfer()
	{
		if( !session()->get('logged_in') ): return false; endif;
		$data['session'] = session()->get('logged_in') ? true : false;

		$data['secTitle'] = lang('Nav.utransfer');
		
		echo view('template/start');
		echo view('template/header');
        echo view('transaction/usertransfer', $data);
		echo view('template/footer', $data);
		echo view('template/end');
	}

	public function index_withdrawal()
	{
		if( !session()->get('logged_in') ): return false; endif;
		$data['session'] = session()->get('logged_in') ? true : false;

		$data['secTitle'] = lang('Nav.withdrawal');

		// Admin Link
		$resAdmin = $this->user_model->selectAdminLink(['userid' => $_SESSION['token']]);
		$data['withdrawalCount'] = $resAdmin['data']['maxDailyWithdrawalCount'];
		$data['exceedWithdrawalCharges'] = $resAdmin['data']['afterDailyWithdrawalCountChargesPercentage'];
		
		echo view('template/start');
		echo view('template/header');
        echo view('transaction/withdrawal', $data);
		echo view('template/footer');
		echo view('template/end', $data);
	}

	public function index_deposit()
	{
		if( !session()->get('logged_in') ): return false; endif;
		$data['session'] = session()->get('logged_in') ? true : false;

		$data['secTitle'] = lang('Nav.deposit');
		
		echo view('template/start');
		echo view('template/header');
        echo view('transaction/deposit', $data);
		echo view('template/footer', $data);
		echo view('template/end');
	}

	public function index_ewallet()
	{
		if( !session()->get('logged_in') ): return false; endif;
		$data['session'] = session()->get('logged_in') ? true : false;

		$data['secTitle'] = lang('Nav.ewallet');
		
		echo view('template/start');
		echo view('template/header');
        echo view('transaction/wallet', $data);
		echo view('template/footer', $data);
		echo view('template/end');
	}


	public function index_mIndex()
	{
		if( !session()->get('logged_in') ): return false; endif;
		$data['session'] = session()->get('logged_in') ? true : false;

		$data['secTitle'] = lang('Nav.history');
		
		echo view('template/start');
		echo view('template/header');
        echo view('transaction/mindex', $data);
		echo view('template/footer', $data);
		echo view('template/end');
	}

	public function index_transactionHistory()
	{
		if( !session()->get('logged_in') ): return false; endif;
		$data['session'] = session()->get('logged_in') ? true : false;

		$data['secTitle'] = lang('Nav.history');
		
		echo view('template/start');
		echo view('template/header');
        echo view('transaction/index', $data);
		echo view('template/footer', $data);
		echo view('template/end');
	}

	public function index_refBetLog($parent=FALSE)
	{
		if( !session()->get('logged_in') ): return false; endif;
		$data['session'] = session()->get('logged_in') ? true : false;

		$data['parent'] = $parent ? $parent : base64_encode($_SESSION['token']);

		$data['secTitle'] = lang('Nav.refbetlog');
		
		echo view('template/start');
		echo view('template/header');
        echo view('transaction/refbet-log', $data);
		echo view('template/footer');
		echo view('template/end', $data);
	}

	public function index_betLog($parent=FALSE)
	{
		if( !session()->get('logged_in') ): return false; endif;
		$data['session'] = session()->get('logged_in') ? true : false;

		$data['parent'] = $parent ? $parent : base64_encode($_SESSION['token']);

		$data['secTitle'] = lang('Nav.betlog');
		
		echo view('template/start');
		echo view('template/header');
        echo view('transaction/bet-log', $data);
		echo view('template/footer');
		echo view('template/end', $data);
	}

	public function index_scoreLog()
	{
		if( !session()->get('logged_in') ): return false; endif;
		$data['session'] = session()->get('logged_in') ? true : false;

		$data['secTitle'] = lang('Nav.scorelog');
		
		echo view('template/start');
		echo view('template/header');
        echo view('transaction/score-log', $data);
		echo view('template/footer', $data);
		echo view('template/end');
	}

	/*
	Vault
	*/

	public function index_vault()
	{
		if( !session()->get('logged_in') ): return false; endif;
		$data['session'] = session()->get('logged_in') ? true : false;

		$data['secTitle'] = lang('Nav.vault');
		
		echo view('template/start');
		echo view('template/header');
        echo view('personal/safetybox', $data);
		echo view('template/footer');
		echo view('template/end', $data);
	}

	/*
	Personal
	*/

	public function index_mailbox()
	{
		if( !session()->get('logged_in') ): return false; endif;
		$data['session'] = session()->get('logged_in') ? true : false;

		$data['secTitle'] = lang('Nav.message');
		
		echo view('template/start');
		echo view('template/header');
        echo view('personal/mailbox', $data);
		echo view('template/footer', $data);
		echo view('template/end');
	}

	public function index_password()
	{
		if( !session()->get('logged_in') ): return false; endif;
		$data['session'] = session()->get('logged_in') ? true : false;

		$data['secTitle'] = lang('Nav.password');
		
		echo view('template/start');
		echo view('template/header');
        echo view('personal/password', $data);
		echo view('template/footer', $data);
		echo view('template/end');
	}

	public function index_rst2ndpassword()
	{
		if( !session()->get('logged_in') ): return false; endif;
		$data['session'] = session()->get('logged_in') ? true : false;

		$data['secTitle'] = lang('Nav.password');
		
		echo view('template/start');
		echo view('template/header');
        echo view('personal/reset2ndpw', $data);
		echo view('template/footer', $data);
		echo view('template/end');
	}

	public function index_bankCard()
	{
		if( !session()->get('logged_in') ): return false; endif;
		$data['session'] = session()->get('logged_in') ? true : false;

		$data['secTitle'] = lang('Nav.bankacc');
		
		echo view('template/start');
		echo view('template/header');
        echo view('personal/bankcard', $data);
		echo view('template/footer', $data);
		echo view('template/end');
	}

	//mobile view of bank card
	public function index_mbankCard()
	{
		if( !session()->get('logged_in') ): return false; endif;
		$data['session'] = session()->get('logged_in') ? true : false;

		$data['secTitle'] = lang('Nav.bankacc');
		
		echo view('template/start');
		echo view('template/header');
        echo view('personal/mbankcard', $data);
		echo view('template/footer', $data);
		echo view('template/end');
	}

	public function index_abankCard()
	{
		if( !session()->get('logged_in') ): return false; endif;
		$data['session'] = session()->get('logged_in') ? true : false;

		$data['secTitle'] = lang('Nav.bankacc');
		
		echo view('template/start');
		echo view('template/header');
        echo view('personal/addbankcard', $data);
		echo view('template/footer', $data);
		echo view('template/end');
	}

	public function index_mobileAccount()
	{
		if( !session()->get('logged_in') ): return false; endif;
		$data['session'] = session()->get('logged_in') ? true : false;

		$data['secTitle'] = '';
		
		echo view('template/start');
		echo view('template/header');
        echo view('personal/maccount', $data);
		echo view('template/footer', $data);
		echo view('template/end');
	}

	public function index_settings()
	{
		if( !session()->get('logged_in') ): return false; endif;
		$data['session'] = session()->get('logged_in') ? true : false;

		$data['secTitle'] = '';
		
		echo view('template/start');
		echo view('template/header');
        echo view('personal/settings', $data);
		echo view('template/footer', $data);
		echo view('template/end');
	}

	/*
	Game
	*/

	public function index_slot()
	{
		$data['session'] = session()->get('logged_in') ? true : false;

		$data['secTitle'] = lang('Nav.slot');
		
		echo view('template/start');
		echo view('template/header');
        echo view('game/index', $data);
		echo view('template/footer');
		echo view('template/end', $data);
	}

	public function index_casino()
	{
		$data['session'] = session()->get('logged_in') ? true : false;

		$data['secTitle'] = lang('Nav.casino');

		echo view('template/start');
		echo view('template/header');
        echo view('game/casino', $data);
		echo view('template/footer');
		echo view('template/end', $data);
	}

	public function index_sport()
	{
		$data['session'] = session()->get('logged_in') ? true : false;

		$data['secTitle'] = lang('Nav.sport');

		echo view('template/start');
		echo view('template/header');
        echo view('game/sport', $data);
		echo view('template/footer');
		echo view('template/end', $data);
	}

	public function index_lottery()
	{
		$data['session'] = session()->get('logged_in') ? true : false;

		$data['secTitle'] = lang('Nav.lottery');

		echo view('template/start');
		echo view('template/header');
        echo view('game/lottery', $data);
		echo view('template/footer');
		echo view('template/end', $data);
	}

	/*
	Promotion
	*/

	public function index_promotion()
	{
		// if( !session()->get('logged_in') ): return false; endif;
		$data['session'] = session()->get('logged_in') ? true : false;

		$lng = strtoupper($_SESSION['lang']);

		$data['secTitle'] = lang('Label.promotion');

		// Promotion
		$promotion = $this->getPromotionRawList(0,1);
		$keys = array_column($promotion['data'], 'order');
        array_multisort($keys, SORT_ASC, $promotion['data']);
		$allPromo = '';
		if( $promotion['code']==1 && $promotion['data']!=[] ):
			foreach( $promotion['data'] as $p ):
				$date = Time::parse(date('Y-m-d H:i:s', strtotime($p['startDate'])));
                $startDate = $date->toDateTimeString();

				$date2 = Time::parse(date('Y-m-d H:i:s', strtotime($p['endDate'])));
                $endDate = $date2->toDateTimeString();

				$allPromo .= '<li class="col-xl-12 col-lg-12 col-md-12 col-12">';
				$allPromo .= '<div class="container">';
				$allPromo .= '<article class="row g-0">';

				$allPromo .= '<div class="col-xl-5 col-lg-5 col-md-5 col-12">';
				$allPromo .= '<img class="w-100" src="'.$p['thumbnail'][$lng].'">';
				$allPromo .= '</div>';

				$allPromo .= '<div class="col-xl-7 col-lg-7 col-md-7 col-12 d-flex align-items-start flex-column p-3">';
				$allPromo .= '<h4 class="m-0 pb-2 promoSubject">'.$p['title'][$lng].'</h4>';
				$allPromo .= '<div class="w-100 mt-auto">';
				$allPromo .= '<button type="button" class="btn btn-primary text-uppercase shadow-sm" onclick="getPromo(\''.base64_encode($p['promotionId']).'\');">'.lang('Nav.rules').'</button>';
				$allPromo .= '</div>';
				$allPromo .= '</div>';

				$allPromo .= '</article>';
				$allPromo .= '</div>';
				$allPromo .= '</li>';
			endforeach;
		endif;
		$data['allPromo'] = $allPromo;

		// Promo - New Member
		$promoNewMember = '';
		if( $promotion['code']==1 && $promotion['data']!=[] ):
			foreach( $promotion['data'] as $p ):
				if( $p['onlyOnce']==1 ):
					$promoNewMember .= '<li class="col-xl-12 col-lg-12 col-md-12 col-12">';
					$promoNewMember .= '<div class="container">';
					$promoNewMember .= '<article class="row g-0">';

					$promoNewMember .= '<div class="col-xl-5 col-lg-5 col-md-5 col-12">';
					$promoNewMember .= '<img class="w-100" src="'.$p['thumbnail'][$lng].'">';
					$promoNewMember .= '</div>';

					$promoNewMember .= '<div class="col-xl-7 col-lg-7 col-md-7 col-12 d-flex align-items-start flex-column p-3">';
					$promoNewMember .= '<h4 class="m-0 pb-2 promoSubject">'.$p['title'][$lng].'</h4>';
					$promoNewMember .= '<div class="w-100 mt-auto">';
					$promoNewMember .= '<button type="button" class="btn btn-primary text-uppercase shadow-sm" onclick="getPromo(\''.base64_encode($p['promotionId']).'\');">'.lang('Nav.rules').'</button>';
					$promoNewMember .= '</div>';
					$promoNewMember .= '</div>';

					$promoNewMember .= '</article>';
					$promoNewMember .= '</div>';
					$promoNewMember .= '</li>';
				endif;
			endforeach;
		endif;
		$data['promoNewMember'] = $promoNewMember;

		// Promo - Games
		// $promoGP = '';
		// if( $promotion['code']==1 && $promotion['data']!=[] ):
		// 	foreach( $promotion['data'] as $p ):
		// 		if( $p['triggerWallet']==1 && $p['triggerType']==1 && !empty($p['gameProviderCode']) ):
		// 			$promoGP .= '<li class="col-xl-12 col-lg-12 col-md-12 col-12">';
		// 			$promoGP .= '<div class="container">';
		// 			$promoGP .= '<article class="row g-0">';

		// 			$promoGP .= '<div class="col-xl-5 col-lg-5 col-md-5 col-12">';
		// 			$promoGP .= '<img class="w-100" src="'.$p['thumbnail'][$lng].'">';
		// 			$promoGP .= '</div>';

		// 			$promoGP .= '<div class="col-xl-7 col-lg-7 col-md-7 col-12 d-flex align-items-start flex-column p-3">';
		// 			$promoGP .= '<h4 class="m-0 pb-2 promoSubject">'.$p['title'][$lng].'</h4>';
		// 			$promoGP .= '<div class="w-100 mt-auto">';
		// 			$promoGP .= '<button type="button" class="btn btn-primary text-uppercase shadow-sm" onclick="getPromo(\''.base64_encode($p['promotionId']).'\');">'.lang('Nav.rules').'</button>';
		// 			$promoGP .= '</div>';
		// 			$promoGP .= '</div>';

		// 			$promoGP .= '</article>';
		// 			$promoGP .= '</div>';
		// 			$promoGP .= '</li>';
		// 		endif;
		// 	endforeach;
		// endif;
		// $data['promoGP'] = $promoGP;

		// Promo - Sport
		$promoSport = '';
		if( $promotion['code']==1 && $promotion['data']!=[] ):
			foreach( $promotion['data'] as $p ):
				if( $p['triggerWallet']==1 && $p['triggerType']==2 && $p['category']==3 ):
					$promoSport .= '<li class="col-xl-12 col-lg-12 col-md-12 col-12">';
					$promoSport .= '<div class="container">';
					$promoSport .= '<article class="row g-0">';

					$promoSport .= '<div class="col-xl-5 col-lg-5 col-md-5 col-12">';
					$promoSport .= '<img class="w-100" src="'.$p['thumbnail'][$lng].'">';
					$promoSport .= '</div>';

					$promoSport .= '<div class="col-xl-7 col-lg-7 col-md-7 col-12 d-flex align-items-start flex-column p-3">';
					$promoSport .= '<h4 class="m-0 pb-2 promoSubject">'.$p['title'][$lng].'</h4>';
					$promoSport .= '<div class="w-100 mt-auto">';
					$promoSport .= '<button type="button" class="btn btn-primary text-uppercase shadow-sm" onclick="getPromo(\''.base64_encode($p['promotionId']).'\');">'.lang('Nav.rules').'</button>';
					$promoSport .= '</div>';
					$promoSport .= '</div>';

					$promoSport .= '</article>';
					$promoSport .= '</div>';
					$promoSport .= '</li>';
				endif;
			endforeach;
		endif;
		$data['promoSport'] = $promoSport;

		// Promo - Slot
		$promoSlot = '';
		if( $promotion['code']==1 && $promotion['data']!=[] ):
			foreach( $promotion['data'] as $p ):
				if( $p['triggerWallet']==1 && $p['triggerType']==2 && $p['category']==1 ):
					$promoSlot .= '<li class="col-xl-12 col-lg-12 col-md-12 col-12">';
					$promoSlot .= '<div class="container">';
					$promoSlot .= '<article class="row g-0">';

					$promoSlot .= '<div class="col-xl-5 col-lg-5 col-md-5 col-12">';
					$promoSlot .= '<img class="w-100" src="'.$p['thumbnail'][$lng].'">';
					$promoSlot .= '</div>';

					$promoSlot .= '<div class="col-xl-7 col-lg-7 col-md-7 col-12 d-flex align-items-start flex-column p-3">';
					$promoSlot .= '<h4 class="m-0 pb-2 promoSubject">'.$p['title'][$lng].'</h4>';
					$promoSlot .= '<div class="w-100 mt-auto">';
					$promoSlot .= '<button type="button" class="btn btn-primary text-uppercase shadow-sm" onclick="getPromo(\''.base64_encode($p['promotionId']).'\');">'.lang('Nav.rules').'</button>';
					$promoSlot .= '</div>';
					$promoSlot .= '</div>';

					$promoSlot .= '</article>';
					$promoSlot .= '</div>';
					$promoSlot .= '</li>';
				endif;
			endforeach;
		endif;
		$data['promoSlot'] = $promoSlot;

		// Promo - Casino
		$promoCasino = '';
		if( $promotion['code']==1 && $promotion['data']!=[] ):
			foreach( $promotion['data'] as $p ):
				if( $p['triggerWallet']==1 && $p['triggerType']==2 && $p['category']==2 ):
					$promoCasino .= '<li class="col-xl-12 col-lg-12 col-md-12 col-12">';
					$promoCasino .= '<div class="container">';
					$promoCasino .= '<article class="row g-0">';

					$promoCasino .= '<div class="col-xl-5 col-lg-5 col-md-5 col-12">';
					$promoCasino .= '<img class="w-100" src="'.$p['thumbnail'][$lng].'">';
					$promoCasino .= '</div>';

					$promoCasino .= '<div class="col-xl-7 col-lg-7 col-md-7 col-12 d-flex align-items-start flex-column p-3">';
					$promoCasino .= '<h4 class="m-0 pb-2 promoSubject">'.$p['title'][$lng].'</h4>';
					$promoCasino .= '<div class="w-100 mt-auto">';
					$promoCasino .= '<button type="button" class="btn btn-primary text-uppercase shadow-sm" onclick="getPromo(\''.base64_encode($p['promotionId']).'\');">'.lang('Nav.rules').'</button>';
					$promoCasino .= '</div>';
					$promoCasino .= '</div>';

					$promoCasino .= '</article>';
					$promoCasino .= '</div>';
					$promoCasino .= '</li>';
				endif;
			endforeach;
		endif;
		$data['promoCasino'] = $promoCasino;

		// Read-Only Promotion
		$resReadOnly = $this->content_model->selectAllContents([]);
		if( $resReadOnly['code'] == 1 && $resReadOnly['data'] != [] ):
			$promoReadOnly = '';
			foreach( $resReadOnly['data'] as $r ):
				$verify = substr($r['contentId'],0,3);
				if( $verify=='PRO' ):
					$promoReadOnly .= '<li class="col-xl-12 col-lg-12 col-md-12 col-12">';
					$promoReadOnly .= '<div class="container">';
					$promoReadOnly .= '<article class="row g-0">';

					$promoReadOnly .= '<div class="col-xl-5 col-lg-5 col-md-5 col-12">';
					$promoReadOnly .= '<img class="w-100" src="'.$r['thumbnail'][$lng].'" alt="'.$_ENV['company'].'" title="'.$_ENV['company'].'">';
					$promoReadOnly .= '</div>';

					$promoReadOnly .= '<div class="col-xl-7 col-lg-7 col-md-7 col-12 d-flex align-items-start flex-column p-3">';
					$promoReadOnly .= '<h4 class="m-0 pb-2 promoSubject">'.$r['title'][$lng].'</h4>';
					$promoReadOnly .= '<div class="w-100 mt-auto">';
					$promoReadOnly .= '<button type="button" class="btn btn-primary" onclick="getPromoReadOnly(\''.base64_encode($r['id']).'\');">'.lang('Nav.rules').'</button>';
					$promoReadOnly .= '</div>';
					$promoReadOnly .= '</div>';

					$promoReadOnly .= '</article>';
					$promoReadOnly .= '</div>';
					$promoReadOnly .= '</li>';
                endif;
			endforeach;
			$data['promotionReadOnly'] = $promoReadOnly;
		else:
			$data['promotionReadOnly'] = '';
		endif;
		
		echo view('template/start');
		echo view('template/header');
        echo view('promotion/index', $data);
		echo view('template/footer', $data);
		echo view('template/end');
	}

	/*
	Fortune Wheel
	*/

	public function index_fortuneWheel()
	{
		if( !session()->get('logged_in') ): return false; endif;
		$data['session'] = session()->get('logged_in') ? true : false;

		$lng = strtoupper($_SESSION['lang']);

		$data['secTitle'] = lang('Nav.fortunewheel');
		
		echo view('template/start');
		echo view('template/header');
        echo view('fortunewheel/index', $data);
		echo view('template/footer', $data);
		echo view('template/end');
	}
}
