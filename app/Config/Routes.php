<?php

namespace Config;

// Create a new instance of our RouteCollection class.
$routes = Services::routes();

// Load the system's routing file first, so that the app and ENVIRONMENT
// can override as needed.
if (is_file(SYSTEMPATH . 'Config/Routes.php')) {
    require SYSTEMPATH . 'Config/Routes.php';
}

/*
 * --------------------------------------------------------------------
 * Router Setup
 * --------------------------------------------------------------------
 */
$routes->setDefaultNamespace('App\Controllers');
$routes->setDefaultController('General_control');
$routes->setDefaultMethod('index');
$routes->setTranslateURIDashes(false);
$routes->set404Override();
// The Auto Routing (Legacy) is very dangerous. It is easy to create vulnerable apps
// where controller filters or CSRF protection are bypassed.
// If you don't want to define all routes, please use the Auto Routing (Improved).
// Set `$autoRoutesImproved` to true in `app/Config/Feature.php` and set the following to true.
//$routes->setAutoRoute(false);

/*
 * --------------------------------------------------------------------
 * Route Definitions
 * --------------------------------------------------------------------
 */

// We get a performance increase by specifying the default
// route since we don't have to scan directories.
$routes->get('/translate/{locale}', 'Lang_control::translate');
$routes->get('device/check', 'General_control::checkDevice');

$routes->resource('Sms_control');
$routes->get('secondpassword/sms/send', 'Sms_control::sendSecondPassSMS');
$routes->post('sms/send', 'Sms_control::sendSMS');
$routes->post('whatsapp/send-tac', 'Sms_control::sendWhatsapp');

$routes->resource('Support_control');
$routes->get('list/whatsapp/register', 'Support_control::wsRegisterList');
$routes->get('list/support', 'Support_control::wsList');
$routes->get('support/live-chat', 'Support_control::getLiveChat');

$routes->resource('Announcement_control');
$routes->get('list/announcement/all', 'Announcement_control::announcementList', ['filter' => 'auth']);
$routes->get('list/announcement/pop/all', 'Announcement_control::announcementPopList', ['filter' => 'auth']);

$routes->get('/', 'General_control::index');
$routes->get('login/(:any)/(:any)/(:any)', 'General_control::index_login/$1/$2/$3');
$routes->get('RA2/(:any)', 'General_control::index_wsaffiliateRegister/$1'); //whatsapp-register
$routes->get('RA/(:any)', 'General_control::index_affiliateRegister/$1');
$routes->get('user/initial/bank-account', 'General_control::index_setupFirstBankCard', ['filter' => 'preauth']);
// $routes->get('create-account', 'General_control::index_registration');
$routes->get('forgot-password', 'General_control::index_forgotPassword');
$routes->get('user-account/ewallet', 'General_control::index_ewallet', ['filter' => 'preauth']);
$routes->get('user-account/deposit', 'General_control::index_deposit', ['filter' => 'preauth']);
$routes->get('user-account/withdrawal', 'General_control::index_withdrawal', ['filter' => 'preauth']);
$routes->get('user-balance-transfer', 'General_control::index_userTransfer', ['filter' => 'preauth']);
$routes->get('history/user-balance-transfer', 'General_control::index_userTransferHistory', ['filter' => 'preauth']);
$routes->get('user-vault', 'General_control::index_vault', ['filter' => 'preauth']);
$routes->get('transaction/mindex', 'General_control::index_mIndex', ['filter' => 'preauth']);
$routes->get('transaction/history', 'General_control::index_transactionHistory', ['filter' => 'preauth']);
$routes->get('score-log', 'General_control::index_scoreLog', ['filter' => 'preauth']);
$routes->get('bet-log', 'General_control::index_betLog', ['filter' => 'preauth']);
$routes->get('realtime-bet-log', 'General_control::index_refBetLog', ['filter' => 'preauth']);
$routes->get('user/bank-account', 'General_control::index_bankCard', ['filter' => 'preauth']);
$routes->get('user/mbank-account', 'General_control::index_mbankCard', ['filter' => 'preauth']);
$routes->get('user/abank-account', 'General_control::index_abankCard', ['filter' => 'preauth']);
$routes->get('user-password', 'General_control::index_password', ['filter' => 'preauth']);
$routes->get('user-rstpassword', 'General_control::index_rst2ndpassword', ['filter' => 'preauth']);
$routes->get('user/account', 'General_control::index_mobileAccount', ['filter' => 'preauth']);
$routes->get('settings', 'General_control::index_settings', ['filter' => 'preauth']);
$routes->get('message', 'General_control::index_mailbox', ['filter' => 'preauth']);
$routes->get('promotions', 'General_control::index_promotion');
$routes->get('slots', 'General_control::index_slot');
$routes->get('live-casino', 'General_control::index_casino');
$routes->get('sports', 'General_control::index_sport');
$routes->get('lottery', 'General_control::index_lottery');
$routes->get('fortune-wheel', 'General_control::index_fortuneWheel');
$routes->get('affiliate-log', 'General_control::index_affiliateLog', ['filter' => 'preauth']);
$routes->get('affiliate-loss-rebate-log', 'General_control::index_affLossRebateLog', ['filter' => 'preauth']);

$routes->resource('User_control');
$routes->get('user-company-link', 'User_control::getAdminLink');
$routes->post('tac/set', 'User_control::tac');
$routes->get('user/upline/contact', 'User_control::userUplineContact');
$routes->post('user/login', 'User_control::login');
$routes->post('user/registration', 'User_control::userRegistration');
$routes->post('user/forgot-password', 'User_control::forgotPassword');
$routes->get('user/logout', 'User_control::logout', ['filter' => 'auth']);
$routes->get('user-profile', 'User_control::getProfile', ['filter' => 'auth']);
$routes->get('user/balance', 'User_control::getSelfBalance', ['filter' => 'auth']);
$routes->post('user/login-password/modify', 'User_control::modifyPassword', ['filter' => 'auth']);
$routes->post('user/secondary-password/modify', 'User_control::modify2ndPassword', ['filter' => 'auth']);
$routes->post('user/secondary-password/reset', 'User_control::reset2ndPassword', ['filter' => 'auth']);
$routes->get('user/secondary-password/exist', 'User_control::checkSecondaryPassword', ['filter' => 'auth']);
$routes->post('user/secondary-password/verify', 'User_control::compareSecondaryPassword', ['filter' => 'auth']);

$routes->resource('Balance_control');
$routes->get('user/creditwithdraw/trigger', 'Balance_control::triggerCreditTransfer', ['filter' => 'auth']); //membertransfer
$routes->post('list/transaction/history', 'Balance_control::transactionHistoryList', ['filter' => 'auth']);
$routes->post('list/user-balance-transfer/history', 'Balance_control::userTransferHistory', ['filter' => 'auth']);
//$routes->post('balance/user/transfer', 'Balance_control::userTransfer', ['filter' => 'auth']);
$routes->post('payment/deposit/add', 'Balance_control::bankTransfer', ['filter' => 'auth']);
$routes->post('payment/payment-gateway/deposit/add', 'Balance_control::expressDeposit', ['filter' => 'auth']);
$routes->post('payment/withdrawal/add', 'Balance_control::withdrawal', ['filter' => 'auth']);
$routes->post('payment/promotion-claim', 'Balance_control::claimPromotion', ['filter' => 'auth']);
$routes->post('transaction/permission', 'Balance_control::approvalPermission', ['filter' => 'auth']);

$routes->resource('Bankcard_control');
$routes->get('list/bank-account/company', 'Bankcard_control::companyBankCard', ['filter' => 'auth']);
$routes->get('list/bank-account/user', 'Bankcard_control::userBankCard', ['filter' => 'auth']);
$routes->get('list/raw/bank-account/user', 'Bankcard_control::userBankCardRawList', ['filter' => 'auth']);
$routes->post('user/bank-account/add', 'Bankcard_control::addBankCard', ['filter' => 'auth']);
$routes->post('user/bank-account/set-default', 'Bankcard_control::defaultBankCard', ['filter' => 'auth']);

$routes->resource('Bank_control');
$routes->get('list/bank', 'Bank_control::bankList', ['filter' => 'auth']);

$routes->resource('Pgateway_control');
$routes->get('list/payment-gateway/company', 'Pgateway_control::paymentGatewayList', ['filter' => 'auth']);
$routes->post('list/payment-channel/company', 'Pgateway_control::paymentGatewayChannelList', ['filter' => 'auth']);

$routes->resource('Vault_control');
$routes->get('user/vault-pin/check', 'Vault_control::checkVaultPin', ['filter' => 'auth']);
$routes->post('user/vault-pin/modify', 'Vault_control::modifyVaultPin', ['filter' => 'auth']);
$routes->post('user/vault/balance/transfer', 'Vault_control::transferVaultBalance', ['filter' => 'auth']);

$routes->resource('Mail_control');
$routes->get('list/mail/user', 'Mail_control::mailList', ['filter' => 'auth']);

$routes->resource('Promotion_control');
$routes->post('list/promotion/all-raw', 'Promotion_control::promotionRawList');
$routes->post('list/promotion/all', 'Promotion_control::promotionList');
$routes->post('list/user-promotion/all', 'Promotion_control::userPromotionList');
$routes->post('promotion/get', 'Promotion_control::getPromotion');
$routes->post('DIY-promotion/transfer', 'Promotion_control::triggerDIYOpenGame', ['filter' => 'auth']);

$routes->resource('Gameprovider_control');
$routes->post('list/game-provider/agent', 'Gameprovider_control::gameProviderAgentList', ['filter' => 'auth']);
$routes->get('list/game-provider', 'Gameprovider_control::gameProviderList', ['filter' => 'auth']);

$routes->resource('Game_control');
$routes->post('list/game-credit/log', 'Game_control::gameCreditLog', ['filter' => 'auth']);
$routes->post('list/game/bet-log', 'Game_control::gameBetLog', ['filter' => 'auth']);
$routes->post('list/game/reference-bet-log', 'Game_control::gameRefBetLog', ['filter' => 'auth']);
$routes->post('game/lobby/get', 'Game_control::getGameLobbyInfo', ['filter' => 'auth']);
$routes->post('game/lobby/open', 'Game_control::openLobby', ['filter' => 'auth']);
$routes->post('game/lobby/openlotto', 'Game_control::openLobbylotto', ['filter' => 'auth']); //lotto block credit-in
$routes->post('game/lobby/openlottochip', 'Game_control::openLobbychip', ['filter' => 'auth']); //lotto chip
$routes->post('game/lobby/close', 'Game_control::closeLobby', ['filter' => 'auth']);
$routes->post('game/credit/transfer', 'Game_control::transferGameCredit', ['filter' => 'auth']);
$routes->post('game/balance/check', 'Game_control::getGameBalance', ['filter' => 'auth']);
$routes->post('list/slot/games', 'Game_control::slotList');
$routes->post('list/live-casino/games', 'Game_control::casinoList');
$routes->post('list/sportbook/games', 'Game_control::sportList');
$routes->post('list/lottery/games', 'Game_control::lotteryList');
$routes->post('list/keno/games', 'Game_control::kenoList');
$routes->post('list/esport/games', 'Game_control::eSportList');
$routes->post('list/racing/games', 'Game_control::racingList');
$routes->post('list/app/games', 'Game_control::appGameList');
$routes->post('list/cate-ex-slots/games', 'Game_control::exslotGamesList');
$routes->post('list/cate-slots/games', 'Game_control::slotGamesList');
$routes->post('single-game/open', 'Game_control::openSlotGame', ['filter' => 'auth']);
$routes->get('refresh-credit/all', 'Game_control::withdrawLatestGame', ['filter' => 'auth']);

$routes->resource('Affiliate_control');
$routes->post('list/affiliate/history', 'Affiliate_control::affiliateHistory', ['filter' => 'auth']);
$routes->get('affiliate-downline', 'Affiliate_control::getAffiliateList', ['filter' => 'auth']);
$routes->get('list/affiliate/downline', 'Affiliate_control::getAffiliateDownlineList', ['filter' => 'auth']);

$routes->resource('Fortunewheel_control');
$routes->get('fortune-wheel/top-20', 'Fortunewheel_control::fortuneWheelTopList', ['filter' => 'auth']);
$routes->get('fortune-wheel/get', 'Fortunewheel_control::fortuneWheel', ['filter' => 'auth']);
$routes->get('fortune-wheel/spin', 'Fortunewheel_control::spinFortuneWheel', ['filter' => 'auth']);

$routes->resource('Jackpot_control');
$routes->get('user/jackpot/trigger', 'Jackpot_control::triggerJackpot', ['filter' => 'auth']);
$routes->get('user/jackpot/running-count', 'Jackpot_control::checkingJackpot', ['filter' => 'auth']);
$routes->get('user/jackpot/running-big-prize', 'Jackpot_control::runningBigPrizeJackpot', ['filter' => 'auth']);

$routes->resource('Lossrebate_control');
$routes->get('loss-rebate/request', 'Lossrebate_control::approveLossRebate', ['filter' => 'auth']);

$routes->resource('Content_control');
$routes->get('list/news', 'Content_control::contentNews');
$routes->post('news/read-only/get', 'Content_control::getNewsContent');
$routes->get('list/promotion/read-only', 'Content_control::getPromoContentList');
$routes->post('promotion/read-only/get', 'Content_control::getPromoContent');
$routes->get('content/affiliate', 'Content_control::contentAffiliate');
$routes->get('content/daily-free-reward', 'Content_control::contentDailyFreeReward');
$routes->get('content/affiliate-share-reward', 'Content_control::contentAffiliateShareReward');
$routes->get('content/affiliate-loss-rebate', 'Content_control::contentAffiliateLossRebate');
$routes->get('content/seo', 'Content_control::contentSeo');

$routes->resource('Afflossrebate_control');
$routes->post('list/affiliate/loss-rebate/history', 'Afflossrebate_control::affLossRebateHistory', ['filter' => 'auth']);
$routes->get('affiliate/loss-rebate/listing', 'Afflossrebate_control::affLossRebateList', ['filter' => 'auth']);
$routes->get('user/affiliate/loss-rebate/settlement', 'Afflossrebate_control::proceedAffLossRebateSettlement', ['filter' => 'auth']);

/*
 * --------------------------------------------------------------------
 * Additional Routing
 * --------------------------------------------------------------------
 *
 * There will often be times that you need additional routing and you
 * need it to be able to override any defaults in this file. Environment
 * based routes is one such time. require() additional route files here
 * to make that happen.
 *
 * You will have access to the $routes object within that file without
 * needing to reload it.
 */
if (is_file(APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php')) {
    require APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php';
}
