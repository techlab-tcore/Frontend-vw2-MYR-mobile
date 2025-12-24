<?php

namespace App\Controllers;

use CodeIgniter\I18n\Time;

class Game_control extends BaseController
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
                if( !empty($g['displayType']) ):
                foreach( $g['displayType'] as $gtype ):
                    if( $gtype==$category ):
                        if( $gtype==3 ):
                            if( $type['type']==3 ):
                                $row = [];
                                $row['status'] = $g['status'];
                                $row['code'] = $g['code'];
                                $row['name'] = $g['name'][$lng];
                                $row['order'] = $g['order'];
                                $row['category'] = $gtype;
                                $data[] = $row;
                            elseif( $type['type']==33 ):
                                $row = [];
                                $row['status'] = $g['status'];
                                $row['code'] = $g['code'];
                                $row['name'] = $g['name'][$lng];
                                $row['order'] = $g['order'];
                                // $row['category'] = $gtype['type'];
                                $row['category'] = $type['type'];
                                $data[] = $row;
                            endif;
                        else:
                            $row = [];
                            $row['status'] = $g['status'];
                            $row['code'] = $g['code'];
                            $row['name'] = $g['name'][$lng];
                            $row['order'] = $g['order'];
                            $row['category'] = $gtype;
                            $data[] = $row;
                        endif;
                    endif;
                endforeach;
                endif;
            endforeach;
            $games['data'] = $data;
            $result = array_merge(['code'=>$res['code'], 'message'=>$res['message']],$games);
        else:
            $result = ['code'=>$res['code'], 'message'=>$res['message']];
        endif;
        return $result;
    }

    protected function checkLatestSecoreLog()
    {
        $earlier = date('Y-m-d 00:00:00', strtotime('-7 days'));
        $from = date('c', strtotime(date('Y-m-d 00:00:00', strtotime($earlier))));
        $to = date('c', strtotime(date('Y-m-d 23:59:59')));

        $payload = [
            'userid' => $_SESSION['token'],
            'fromdate' => $from,
            'todate' => $to,
            'pageindex' => 1,
            'rowperpage' => 1,
            'desc' => true
        ];
        $res = $this->game_model->selectAllGameCreditLog($payload);
        return $res;
    }

    protected function userProfile()
    {
        $payload = [
            'userid' => $_SESSION['token']
        ];
        $res = $this->user_model->selectUser($payload);
        return $res;
    }

    /*
    Public
    */

    public function getGameBalance()
    {
        $payload = [
            'userid' => $_SESSION['token'],
            'gameprovidercode' => $this->request->getPost('params')['provider']
        ];
        $res = $this->game_model->selectGameBalance($payload);
        echo json_encode($res);
    }

    public function closeLobby()
    {
        if( !session()->get('logged_in') ): return false; endif;

        $payload = [
            'userid' => $_SESSION['token'],
            'gameprovidercode' => $this->request->getPost('params')['provider']
        ];
        $res = $this->game_model->selectGameBalance($payload);
        // echo json_encode($res);
        if( $res['code']==1 ):
            // if( $res['balance']>0 ):
                $payload2 = [
                    'userid' => $_SESSION['token'],
                    'gameprovidercode' => $this->request->getPost('params')['provider'],
                    'transfertype' => (int)$this->request->getPost('params')['type'],
                    'amount' => (float)$res['balance']
                ];
                $res2 = $this->game_model->updateGameCredit($payload2);
                echo json_encode($res2);
            // else:
            //     echo json_encode($res);
            // endif;
        else:
            echo json_encode($res);
        endif;
    }

    public function withdrawLatestGame()
    {
        if( !session()->get('logged_in') ): return false; endif;

        $res = $this->checkLatestSecoreLog();
        if( $res['code']==1 && $res['data']!=[] ):
            $payloadGetBalance = [
                'userid' => $_SESSION['token'],
                'gameprovidercode' => $res['data'][0]['gameProviderCode']
            ];
            $resGetBalance = $this->game_model->selectGameBalance($payloadGetBalance);
            // Recall all the balance & update after-amount
            if( $resGetBalance['code']==1 || $resGetBalance['code']==71 ):
                $payloadTransfer = [
                    'userid' => $_SESSION['token'],
                    'gameprovidercode' => $resGetBalance['gameProviderCode'],
                    'transfertype' => 2,
                    'amount' => (float)$resGetBalance['balance']
                ];
                $resTransfer = $this->game_model->updateGameCredit($payloadTransfer);
                echo json_encode($resTransfer);
            endif;
        else:
            echo json_encode($res);
        endif;
    }

    public function openSlotGame()
    {
        if( !session()->get('logged_in') ): return false; endif;

        $payload = [
            'userid' => $_SESSION['token'],
            'gameprovidercode' => $this->request->getPost('params')['provider'],
            'gamecode' => $this->request->getPost('params')['gcode'],
            'ismobile' => (int)$this->request->getPost('params')['isMobile']
        ];
        $res = $this->game_model->selectGameSlot($payload);
        // echo json_encode($res);
        if( $res['code']==1 ):
            // Check latest 7 days score log
            $payloadScoreLog = $this->checkLatestSecoreLog();
            if( $payloadScoreLog['code']==1 ):
                // Get leftover balance
                if( $payloadScoreLog['data']!=[] ):
                    $payloadGetBalance = [
                        'userid' => $_SESSION['token'],
                        'gameprovidercode' => $payloadScoreLog['data'][0]['gameProviderCode']
                    ];
                    $resGetBalance = $this->game_model->selectGameBalance($payloadGetBalance);
                    // Recall all the balance & update after-amount
                    if( $resGetBalance['code']==1 || $resGetBalance['code']==71 ):
                        if( $payloadScoreLog['data'][0]['gameProviderCode']!=$this->request->getPost('params')['provider'] ):
                            // If not same as previous game
                            if( $resGetBalance['code']!=71 ):
                                // DIY Lottery Exceptional
                                if( $resGetBalance['gameProviderCode']!='GD' || $resGetBalance['gameProviderCode']!='GDS' ):
                                    // Lottery credit below 1
                                    if( 
                                        ($resGetBalance['gameProviderCode']=='GD2' || $resGetBalance['gameProviderCode']=='GD8') && 
                                        $resGetBalance['balance']<1
                                    ):
                                        $resTransfer = [
                                            'code' => 1,
                                        ];
                                    else:
                                        $payloadTransfer = [
                                            'userid' => $_SESSION['token'],
                                            'gameprovidercode' => $resGetBalance['gameProviderCode'],
                                            'transfertype' => 2,
                                            'amount' => (float)$resGetBalance['balance']
                                        ];
                                        $resTransfer = $this->game_model->updateGameCredit($payloadTransfer);
                                    endif;
                                    // End Lottery credit below 1
                                else:
                                    $resTransfer = [
                                        'code' => 1,
                                    ];
                                endif;
                                // End DIY Lottery Exceptional
                            else:
                                $resTransfer = [
                                    'code' => 1,
                                ];
                            endif;

                            // Transfer-in to game
                            if( $resTransfer['code']==1 ):
                                // $credit = $this->request->getPost('params')['credit']>=1 ? $this->request->getPost('params')['credit'] : $resGetBalance['balance'];
                                $credit = $this->request->getPost('params')['credit'] + $resGetBalance['balance'];

                                $payloadTransferIn = [
                                    'userid' => $_SESSION['token'],
                                    'gameprovidercode' => $this->request->getPost('params')['provider'],
                                    'transfertype' => (int)$this->request->getPost('params')['type'],
                                    'amount' => (float)$credit
                                ];
                                $resTransferIn = $this->game_model->updateGameCredit($payloadTransferIn);
                                $result = array_merge($resTransferIn, ['url'=>$res['url']]);
                                echo json_encode($result);
                            else:
                                echo json_encode($resTransfer);
                            endif;
                            // End If not same as previous game
                        else:
                            // If same as previous game
                            if( $this->request->getPost('params')['credit']>0 ):
                                $credit = $this->request->getPost('params')['credit']>0 ? $this->request->getPost('params')['credit'] : $resGetBalance['balance'];

                                $payloadTransferIn = [
                                    'userid' => $_SESSION['token'],
                                    'gameprovidercode' => $this->request->getPost('params')['provider'],
                                    'transfertype' => (int)$this->request->getPost('params')['type'],
                                    'amount' => (float)$credit
                                ];
                                $resTransferIn = $this->game_model->updateGameCredit($payloadTransferIn);
                                $result = array_merge($resTransferIn, ['url'=>$res['url']]);
                                echo json_encode($result);
                            else:
                                echo json_encode([
                                    'code' => $resGetBalance['code'],
                                    'message' => $resGetBalance['message'],
                                    'url' => $res['url']
                                ]);
                            endif;
                            // End If same as previous game
                        endif;
                    else:
                        echo json_encode($resGetBalance);
                    endif;
                else:
                    $credit = $this->request->getPost('params')['credit']>0 ? $this->request->getPost('params')['credit'] : $resGetBalance['balance'];
                    $payloadTransferIn = [
                        'userid' => $_SESSION['token'],
                        'gameprovidercode' => $this->request->getPost('params')['provider'],
                        'transfertype' => (int)$this->request->getPost('params')['type'],
                        'amount' => (float)$credit
                    ];
                    $resTransferIn = $this->game_model->updateGameCredit($payloadTransferIn);
                    $result = array_merge($resTransferIn, ['url'=>$res['url']]);
                    echo json_encode($result);
                endif;
            else:
                echo json_encode($payloadScoreLog);
            endif;
        else:
            echo json_encode($res);
        endif;
    }

    public function openLobby()
    {
        if( !session()->get('logged_in') ): return false; endif;

        $inputLottoChip = isset($this->request->getPost('params')['lotto']) ? $this->request->getPost('params')['lotto'] : 0;

        $payload = [
            'userid' => $_SESSION['token'],
            'gameprovidercode' => $this->request->getPost('params')['provider'],
            'ismobile' => (int)$this->request->getPost('params')['isMobile']
        ];

        $reslobby = $this->game_model->selectGameLobby($payload);
        // echo json_encode($res);
        if( $reslobby['code']==1 ):
            // Check latest 7 days score log
            $payloadScoreLog = $this->checkLatestSecoreLog();
            if( $payloadScoreLog['code']==1 ):
                // Get leftover balance
                if( $payloadScoreLog['data']!=[] ):
                    $payloadGetBalance = [
                        'userid' => $_SESSION['token'],
                        'gameprovidercode' => $payloadScoreLog['data'][0]['gameProviderCode']
                    ];
                    $resGetBalance = $this->game_model->selectGameBalance($payloadGetBalance);

                    // Recall all the balance & update after-amount
                    if( $resGetBalance['code']==1 || $resGetBalance['code']==71 ):
                        if( $payloadScoreLog['data'][0]['gameProviderCode']!=$this->request->getPost('params')['provider'] ):
                            // If not same as previous game
                            if( $resGetBalance['code']!=71 ):
                                // DIY Lottery Exceptional
                                if( $resGetBalance['gameProviderCode']!='GD' || $resGetBalance['gameProviderCode']!='GDS' ):
                                    // Lottery credit below 1
                                    if( 
                                        ($resGetBalance['gameProviderCode']=='GD2' || $resGetBalance['gameProviderCode']=='GD8') && 
                                        $resGetBalance['balance']<1
                                    ):
                                        $resTransfer = [
                                            'code' => 1,
                                        ];
                                    else:
                                        $payloadTransfer = [
                                            'userid' => $_SESSION['token'],
                                            'gameprovidercode' => $resGetBalance['gameProviderCode'],
                                            'transfertype' => 2,
                                            'amount' => (float)$resGetBalance['balance'],
                                            // 'chipamount' => (float)abs($inputLottoChip)
                                        ];
                                        $resTransfer = $this->game_model->updateGameCredit($payloadTransfer);
                                    endif;
                                    // End Lottery credit below 1
                                else:
                                    $resTransfer = [
                                        'code' => 1,
                                    ];
                                endif;
                                // End DIY Lottery Exceptional
                            else:
                                $resTransfer = [
                                    'code' => 1,
                                ];
                            endif;

                            // Transfer-in to game
                            if( $resTransfer['code']==1 ):
                                // $credit = $this->request->getPost('params')['credit']>=1 ? $this->request->getPost('params')['credit'] : $resGetBalance['balance'];
                                $credit = $this->request->getPost('params')['credit'] + $resGetBalance['balance'];

                                $payloadTransferIn = [
                                    'userid' => $_SESSION['token'],
                                    'gameprovidercode' => $this->request->getPost('params')['provider'],
                                    'transfertype' => (int)$this->request->getPost('params')['type'],
                                    'amount' => (float)$credit,
                                    // 'chipamount' => (float)abs($inputLottoChip)
                                ];
                                $resTransferIn = $this->game_model->updateGameCredit($payloadTransferIn);
                                $res = $this->game_model->selectGameLobby($payload);
                                $result = array_merge($resTransferIn, ['url'=>$res['url']]);
                                echo json_encode($result);
                            else:
                                echo json_encode($resTransfer);
                            endif;
                            // End If not same as previous game
                        else:
                            // If same as previous game
                            if( $this->request->getPost('params')['credit']>0 ):
                                $credit = $this->request->getPost('params')['credit']>0 ? $this->request->getPost('params')['credit'] : $resGetBalance['balance'];

                                $payloadTransferIn = [
                                    'userid' => $_SESSION['token'],
                                    'gameprovidercode' => $this->request->getPost('params')['provider'],
                                    'transfertype' => (int)$this->request->getPost('params')['type'],
                                    'amount' => (float)$credit,
                                    // 'chipamount' => (float)abs($inputLottoChip)
                                ];
                                $resTransferIn = $this->game_model->updateGameCredit($payloadTransferIn);
                                $res = $this->game_model->selectGameLobby($payload);
                                $result = array_merge($resTransferIn, ['url'=>$res['url']]);
                                echo json_encode($result);
                            else:
                                $res = $this->game_model->selectGameLobby($payload);
                                echo json_encode([
                                    'code' => $resGetBalance['code'],
                                    'message' => $resGetBalance['message'],
                                    'url' => $res['url']
                                ]);
                            endif;
                            // End If same as previous game
                        endif;
                    else:
                        echo json_encode($resGetBalance);
                    endif;
                else:
                    $credit = $this->request->getPost('params')['credit']>0 ? $this->request->getPost('params')['credit'] : $resGetBalance['balance'];
                    $payloadTransferIn = [
                        'userid' => $_SESSION['token'],
                        'gameprovidercode' => $this->request->getPost('params')['provider'],
                        'transfertype' => (int)$this->request->getPost('params')['type'],
                        'amount' => (float)$credit,
                        // 'chipamount' => (float)abs($inputLottoChip)
                    ];
                    $resTransferIn = $this->game_model->updateGameCredit($payloadTransferIn);
                    $res = $this->game_model->selectGameLobby($payload);
                    $result = array_merge($resTransferIn, ['url'=>$res['url']]);
                    echo json_encode($result);
                endif;
            else:
                echo json_encode($payloadScoreLog);
            endif;
        else:
            echo json_encode($reslobby);
        endif;
    }

    public function openLobbychip()
    {
        if( !session()->get('logged_in') ): return false; endif;

        $inputLottoChip = isset($this->request->getPost('params')['lotto']) ? $this->request->getPost('params')['lotto'] : 0;
        $inputGameId = isset($this->request->getPost('params')['gameuserid']) ? $this->request->getPost('params')['gameuserid'] : ''; //chipssss

        $payload = [
            'userid' => $_SESSION['token'],
            'gameprovidercode' => $this->request->getPost('params')['provider'],
            'ismobile' => (int)$this->request->getPost('params')['isMobile']
        ];

        $res = $this->game_model->selectGameLobby($payload);
        // echo json_encode($res);
        if( $res['code']==1 ):
            // Check latest 7 days score log
            $payloadScoreLog = $this->checkLatestSecoreLog();
            if( $payloadScoreLog['code']==1 ):
                // Get leftover balance
                if( $payloadScoreLog['data']!=[] ):
                    $payloadGetBalance = [
                        'userid' => $_SESSION['token'],
                        'gameprovidercode' => $payloadScoreLog['data'][0]['gameProviderCode'],
                        'gpuserid' => $payloadScoreLog['data'][0]['gpUserId'] //chipssss
                    ];
                    $resGetBalance = $this->game_model->selectGameBalance($payloadGetBalance);

                    // Recall all the balance & update after-amount
                    if( $resGetBalance['code']==1 || $resGetBalance['code']==71 ):
                        if( $payloadScoreLog['data'][0]['gameProviderCode']!=$this->request->getPost('params')['provider'] ):
                            // If not same as previous game
                            if( $resGetBalance['code']!=71 ):
                                // DIY Lottery Exceptional
                                if( $resGetBalance['gameProviderCode']!='GD' || $resGetBalance['gameProviderCode']!='GDS' ):
                                    // Lottery credit below 1
                                    if( 
                                        ($resGetBalance['gameProviderCode']=='GD2' || $resGetBalance['gameProviderCode']=='GD8') && 
                                        $resGetBalance['balance']<1
                                    ):
                                        $resTransfer = [
                                            'code' => 1,
                                        ];
                                    else:
                                        $payloadTransfer = [
                                            'userid' => $_SESSION['token'],
                                            'gameprovidercode' => $resGetBalance['gameProviderCode'],
                                            'gpuserid' => $payloadScoreLog['data'][0]['gpUserId'], //chipssss
                                            'transfertype' => 2,
                                            'amount' => (float)$resGetBalance['balance'],
                                            // 'chipamount' => (float)abs($inputLottoChip)
                                            'chipamount' => (float)abs($inputLottoChip) //chipssss
                                        ];
                                        $resTransfer = $this->game_model->updateGameCredit($payloadTransfer);
                                    endif;
                                    // End Lottery credit below 1
                                else:
                                    $resTransfer = [
                                        'code' => 1,
                                    ];
                                endif;
                                // End DIY Lottery Exceptional
                            else:
                                $resTransfer = [
                                    'code' => 1,
                                ];
                            endif;

                            // Transfer-in to game
                            if( $resTransfer['code']==1 ):
                                // $credit = $this->request->getPost('params')['credit']>=1 ? $this->request->getPost('params')['credit'] : $resGetBalance['balance'];
                                $credit = $this->request->getPost('params')['credit'] + $resGetBalance['balance'];

                                $payloadTransferIn = [
                                    'userid' => $_SESSION['token'],
                                    'gameprovidercode' => $this->request->getPost('params')['provider'],
                                    'gpuserid' => $inputGameId, //chipssss
                                    'transfertype' => (int)$this->request->getPost('params')['type'],
                                    'amount' => (float)$credit,
                                    'chipamount' => (float)abs($inputLottoChip) //chipssss
                                ];
                                $resTransferIn = $this->game_model->updateGameCredit($payloadTransferIn);
                                $result = array_merge($resTransferIn, ['url'=>$res['url']]);
                                echo json_encode($result);
                            else:
                                echo json_encode($resTransfer);
                            endif;
                            // End If not same as previous game
                        else:
                            // If same as previous game
                            if( $this->request->getPost('params')['credit']>0 ):
                                $credit = $this->request->getPost('params')['credit']>0 ? $this->request->getPost('params')['credit'] : $resGetBalance['balance'];

                                $payloadTransferIn = [
                                    'userid' => $_SESSION['token'],
                                    'gameprovidercode' => $this->request->getPost('params')['provider'],
                                    'gpuserid' => $inputGameId, //chipssss
                                    'transfertype' => (int)$this->request->getPost('params')['type'],
                                    'amount' => (float)$credit,
                                    'chipamount' => (float)abs($inputLottoChip) //chipssss
                                ];
                                $resTransferIn = $this->game_model->updateGameCredit($payloadTransferIn);
                                $result = array_merge($resTransferIn, ['url'=>$res['url']]);
                                echo json_encode($result);
                            else:
                                echo json_encode([
                                    'code' => $resGetBalance['code'],
                                    'message' => $resGetBalance['message'],
                                    'url' => $res['url']
                                ]);
                            endif;
                            // End If same as previous game
                        endif;
                    else:
                        echo json_encode($resGetBalance);
                    endif;
                else:
                    //$credit = $this->request->getPost('params')['credit']>0 ? $this->request->getPost('params')['credit'] : $resGetBalance['balance'];
                    $credit = $this->request->getPost('params')['credit'];
                    $payloadTransferIn = [
                        'userid' => $_SESSION['token'],
                        'gameprovidercode' => $this->request->getPost('params')['provider'],
                        'gpuserid' => $payloadScoreLog['data'][0]['gpUserId'], //chipssss
                        'transfertype' => (int)$this->request->getPost('params')['type'],
                        'amount' => (float)$credit,
                        'chipamount' => (float)abs($inputLottoChip) //chipssss
                    ];
                    $resTransferIn = $this->game_model->updateGameCredit($payloadTransferIn);
                    $result = array_merge($resTransferIn, ['url'=>$res['url']]);
                    echo json_encode($result);
                endif;
            else:
                echo json_encode($payloadScoreLog);
            endif;
        else:
            echo json_encode($res);
        endif;
    }

    //block lotto credit-in
    public function openLobbylotto()
    {
        if( !session()->get('logged_in') ): return false; endif;

        $inputLottoChip = isset($this->request->getPost('params')['lotto']) ? $this->request->getPost('params')['lotto'] : 0;

        $payload = [
            'userid' => $_SESSION['token'],
            'gameprovidercode' => $this->request->getPost('params')['provider'],
            'ismobile' => (int)$this->request->getPost('params')['isMobile']
        ];

        $res = $this->game_model->selectGameLobby($payload);
        // echo json_encode($res);
        if( $res['code']==1 ):
            // Check latest 7 days score log
            $payloadScoreLog = $this->checkLatestSecoreLog();
            if( $payloadScoreLog['code']==1 ):
                // Get leftover balance
                if( $payloadScoreLog['data']!=[] ):
                    $payloadGetBalance = [
                        'userid' => $_SESSION['token'],
                        'gameprovidercode' => $payloadScoreLog['data'][0]['gameProviderCode']
                    ];
                    $resGetBalance = $this->game_model->selectGameBalance($payloadGetBalance);

                    // Recall all the balance & update after-amount
                    if( $resGetBalance['code']==1 || $resGetBalance['code']==71 ):
                        if( $payloadScoreLog['data'][0]['gameProviderCode']!=$this->request->getPost('params')['provider'] ):
                            // If not same as previous game
                            if( $resGetBalance['code']!=71 ):
                                // DIY Lottery Exceptional
                                if( $resGetBalance['gameProviderCode']!='GD' || $resGetBalance['gameProviderCode']!='GDS' ):
                                    // Lottery credit below 1
                                    if( 
                                        ($resGetBalance['gameProviderCode']=='GD2' || $resGetBalance['gameProviderCode']=='GD8') && 
                                        $resGetBalance['balance']<1
                                    ):
                                        $resTransfer = [
                                            'code' => 1,
                                        ];
                                    else:
                                        $payloadTransfer = [
                                            'userid' => $_SESSION['token'],
                                            'gameprovidercode' => $resGetBalance['gameProviderCode'],
                                            'transfertype' => 2,
                                            'amount' => 0,
                                            //'amount' => (float)$resGetBalance['balance'],
                                            // 'chipamount' => (float)abs($inputLottoChip)
                                        ];
                                        $resTransfer = $this->game_model->updateGameCredit($payloadTransfer);
                                    endif;
                                    // End Lottery credit below 1
                                else:
                                    $resTransfer = [
                                        'code' => 1,
                                    ];
                                endif;
                                // End DIY Lottery Exceptional
                            else:
                                $resTransfer = [
                                    'code' => 1,
                                ];
                            endif;

                            // Transfer-in to game
                            if( $resTransfer['code']==1 ):
                                // $credit = $this->request->getPost('params')['credit']>=1 ? $this->request->getPost('params')['credit'] : $resGetBalance['balance'];
                                $credit = $this->request->getPost('params')['credit'] + $resGetBalance['balance'];

                                $payloadTransferIn = [
                                    'userid' => $_SESSION['token'],
                                    'gameprovidercode' => $this->request->getPost('params')['provider'],
                                    'transfertype' => (int)$this->request->getPost('params')['type'],
                                    'amount' => 0,
                                    //'amount' => (float)$credit,
                                    // 'chipamount' => (float)abs($inputLottoChip)
                                ];
                                $resTransferIn = $this->game_model->updateGameCredit($payloadTransferIn);
                                $result = array_merge($resTransferIn, ['url'=>$res['url']]);
                                echo json_encode($result);
                            else:
                                echo json_encode($resTransfer);
                            endif;
                            // End If not same as previous game
                        else:
                            // If same as previous game
                            if( $this->request->getPost('params')['credit']>0 ):
                                $credit = $this->request->getPost('params')['credit']>0 ? $this->request->getPost('params')['credit'] : $resGetBalance['balance'];

                                $payloadTransferIn = [
                                    'userid' => $_SESSION['token'],
                                    'gameprovidercode' => $this->request->getPost('params')['provider'],
                                    'transfertype' => (int)$this->request->getPost('params')['type'],
                                    'amount' => 0,
                                    //'amount' => (float)$credit,
                                    // 'chipamount' => (float)abs($inputLottoChip)
                                ];
                                $resTransferIn = $this->game_model->updateGameCredit($payloadTransferIn);
                                $result = array_merge($resTransferIn, ['url'=>$res['url']]);
                                echo json_encode($result);
                            else:
                                echo json_encode([
                                    'code' => $resGetBalance['code'],
                                    'message' => $resGetBalance['message'],
                                    'url' => $res['url']
                                ]);
                            endif;
                            // End If same as previous game
                        endif;
                    else:
                        echo json_encode($resGetBalance);
                    endif;
                else:
                    $credit = $this->request->getPost('params')['credit']>0 ? $this->request->getPost('params')['credit'] : $resGetBalance['balance'];
                    $payloadTransferIn = [
                        'userid' => $_SESSION['token'],
                        'gameprovidercode' => $this->request->getPost('params')['provider'],
                        'transfertype' => (int)$this->request->getPost('params')['type'],
                        'amount' => 0,
                        //'amount' => (float)$credit,
                        // 'chipamount' => (float)abs($inputLottoChip)
                    ];
                    $resTransferIn = $this->game_model->updateGameCredit($payloadTransferIn);
                    $result = array_merge($resTransferIn, ['url'=>$res['url']]);
                    echo json_encode($result);
                endif;
            else:
                echo json_encode($payloadScoreLog);
            endif;
        else:
            echo json_encode($res);
        endif;
    }

    public function transferGameCredit()
    {
        if( !session()->get('logged_in') ): return false; endif;

        $payload = [
            'userid' => $_SESSION['token'],
            'gameprovidercode' => $this->request->getPost('params')['provider'],
            'transfertype' => (int)$this->request->getPost('params')['type'],
            'amount' => (float)$this->request->getPost('params')['credit']
        ];
        $res = $this->game_model->updateGameCredit($payload);
        echo json_encode($res);
    }

    public function getGameLobbyInfo()
    {
        if( !session()->get('logged_in') ): return false; endif;

        $payload = [
            'userid' => $_SESSION['token'],
            'gameprovidercode' => $this->request->getPost('params')['provider'],
            'ismobile' => (int)$this->request->getPost('params')['isMobile']
        ];

        $res = $this->game_model->selectGameLobby($payload);
        echo json_encode($res);
    }

    /*
    Game Credit Log & Bet Log
    */

    public function gameRefBetLog()
    {
        if( !session()->get('logged_in') ): return false; endif;

        $raw = json_decode(file_get_contents('php://input'),1);

        if( !empty($raw['start']) && !empty($raw['end']) ):
            $from = date('c', strtotime(date('Y-m-d 00:00:00', strtotime($raw['start']))));
            $to = date('c', strtotime(date('Y-m-d 23:59:59', strtotime($raw['end']))));
        else:
            $from = date('c', strtotime(date('Y-m-d 00:00:00')));
            $to = date('c', strtotime(date('Y-m-d 23:59:59')));
        endif;

        $payload = $this->game_model->selectAllGameRefBetLog([
            'pageindex' => $raw['pageindex'],
            'rowperpage' => $raw['rowperpage'],
            'userid' => base64_decode($raw['parent']),
            'fromdate' => $from,
            'todate'=>$to,
            'desc' => true
        ]);
        // echo json_encode($payload);

        if( $payload['code'] == 1 && $payload['data'] != [] ):
            $data = [];
            foreach( $payload['data'] as $ph ):
                $date = Time::parse(date('Y-m-d H:i:s', strtotime($ph['settleDate'])));
                $created = $date->toDateTimeString();

                $game = !empty($ph['gameName']) ? $ph['gameName'] : $ph['gameCode'];

                if( $raw['provider']!='ALL' && $raw['provider']==$ph['gameProviderCode'] ):
                    $row = [];
                    $row[] = $created;
                    // $row[] = $ph['loginId'];
                    // $row[] = $ph['gameProviderCode'];
                    $row[] = '<small class="badge bg-primary fw-normal me-1">'.$ph['gameProviderName'].'</small>'.$game;
                    $row[] = $ph['roundId'];
                    $row[] = $ph['bet'];
                    // $row[] = $ph['turnover'];
                    $row[] = $ph['win'];
                    $row[] = $ph['winlose'];
                    // $row[] = $ph['jpWin'];
                    // $row[] = $ph['jpShare'];
                    $data[] = $row;
                elseif( $raw['provider']=='ALL' ):
                    $row = [];
                    $row[] = $created;
                    // $row[] = $ph['loginId'];
                    // $row[] = $ph['gameProviderCode'];
                    $row[] = '<small class="badge bg-primary fw-normal me-1">'.$ph['gameProviderName'].'</small>'.$game;
                    $row[] = $ph['roundId'];
                    $row[] = $ph['bet'];
                    // $row[] = $ph['turnover'];
                    $row[] = $ph['win'];
                    $row[] = $ph['winlose'];
                    // $row[] = $ph['jpWin'];
                    // $row[] = $ph['jpShare'];
                    $data[] = $row;
                endif;
            endforeach;
            echo json_encode(['data'=>$data, 'code'=>1, 'pageIndex'=>$payload['pageIndex'], 'rowPerPage'=>$payload['rowPerPage'], 'totalPage'=>$payload['totalPage'], 'totalRecord'=>$payload['totalRecord']]);
        else:
            echo json_encode(['no data']);
        endif;
    }

    public function gameBetLog()
    {
        if( !session()->get('logged_in') ): return false; endif;

        $raw = json_decode(file_get_contents('php://input'),1);

        if( !empty($raw['start']) && !empty($raw['end']) ):
            $from = date('c', strtotime(date('Y-m-d 00:00:00', strtotime($raw['start']))));
            $to = date('c', strtotime(date('Y-m-d 23:59:59', strtotime($raw['end']))));
        else:
            $from = date('c', strtotime(date('Y-m-d 00:00:00')));
            $to = date('c', strtotime(date('Y-m-d 23:59:59')));
        endif;

        $payload = $this->game_model->selectAllGameBetLog([
            'userid' => $_SESSION['token'],
            'fromdate' => $from,
            'todate' => $to,
            'pageindex' => $raw['pageindex'],
            'rowperpage' => $raw['rowperpage'],
            'desc' => true
        ]);
        // echo json_encode($payload);
        if( $payload['code'] == 1 && $payload['data'] != [] ):
            $data = [];
            foreach( $payload['data'] as $ph ):
                $date = Time::parse(date('Y-m-d H:i:s', strtotime($ph['settleDate'])));
                $created = $date->toDateTimeString();

                $game = !empty($ph['gameName']) ? $ph['gameName'] : $ph['gameCode'];

                if( $raw['provider']!='ALL' && $raw['provider']==$ph['gameProviderCode'] ):
                    $row = [];
                    $row[] = $created;
                    // $row[] = $ph['loginId'];
                    // $row[] = $ph['gameProviderCode'];
                    $row[] = '<small class="badge bg-primary fw-normal me-1">'.$ph['gameProviderName'].'</small>'.$game;
                    $row[] = $ph['roundId'];
                    $row[] = $ph['bet'];
                    // $row[] = $ph['turnover'];
                    $row[] = $ph['win'];
                    $row[] = $ph['winlose'];
                    // $row[] = $ph['jpWin'];
                    // $row[] = $ph['jpShare'];
                    $data[] = $row;
                elseif( $raw['provider']=='ALL' ):
                    $row = [];
                    $row[] = $created;
                    // $row[] = $ph['loginId'];
                    // $row[] = $ph['gameProviderCode'];
                    $row[] = '<small class="badge bg-primary fw-normal me-1">'.$ph['gameProviderName'].'</small>'.$game;
                    $row[] = $ph['roundId'];
                    $row[] = $ph['bet'];
                    // $row[] = $ph['turnover'];
                    $row[] = $ph['win'];
                    $row[] = $ph['winlose'];
                    // $row[] = $ph['jpWin'];
                    // $row[] = $ph['jpShare'];
                    $data[] = $row;
                endif;
            endforeach;
            echo json_encode(['data'=>$data, 'code'=>1, 'pageIndex'=>$payload['pageIndex'], 'rowPerPage'=>$payload['rowPerPage'], 'totalPage'=>$payload['totalPage'], 'totalRecord'=>$payload['totalRecord']]);
        else:
            echo json_encode(['no data']);
        endif;
    }

    public function gameCreditLog()
    {
        if( !session()->get('logged_in') ): return false; endif;

        $raw = json_decode(file_get_contents('php://input'),1);

        if( !empty($raw['start']) && !empty($raw['end']) ):
            $from = date('c', strtotime(date('Y-m-d 00:00:00', strtotime($raw['start']))));
            $to = date('c', strtotime(date('Y-m-d 23:59:59', strtotime($raw['end']))));
        else:
            $from = date('c', strtotime(date('Y-m-d 00:00:00')));
            $to = date('c', strtotime(date('Y-m-d 23:59:59')));
        endif;

        $payload = $this->game_model->selectAllGameCreditLog([
            'userid' => $_SESSION['token'],
            'fromdate' => $from,
            'todate' => $to,
            'pageindex' => $raw['pageindex'],
            'rowperpage' => $raw['rowperpage'],
            'desc' => true
        ]);

        if( $payload['code']==1 && $payload['data']!=[] ):
            $data = [];
            foreach( $payload['data'] as $h ):
                switch($h['status']):
                    case 1: $status = lang('Label.success'); break;
                    case 2: $status = lang('Label.reject'); break;
                    case 3: $status = lang('Label.pending'); break;
                    case 4: $status = lang('Label.check'); break;
                    default: $status = '---';
                endswitch;

                switch($h['type']):
                    case 1: $type = lang('Label.deposit'); break;
                    case 2: $type = lang('Label.withdrawal'); break;
                    case 3: $type = lang('Label.bonus'); break;
                    case 4: $type = lang('Label.rebate'); break;
                    case 5: $type = lang('Label.affiliate'); break;
                    case 6: $type = lang('Label.credittransfer'); break;
                    case 7: $type = lang('Label.wreturn'); break;
                    case 8: $type = lang('Label.jackpot'); break;
                    case 9: $type = lang('Label.fortunetoken'); break;
                    case 10: $type = lang('Label.pgtransfer'); break;
                    case 11: $type = lang('Label.refcomm'); break;
                    case 12: $type = lang('Label.depcomm'); break;
                    case 13: $type = lang('Label.lossrebate'); break;
                    case 14: $type = lang('Label.affsharereward'); break;
                    case 15: $type = lang('Label.dailyfreereward'); break;
                    case 16: $type = lang('Label.affloserebate'); break;
                    case 17: $type = lang('Label.fortunereward'); break;
                    default: $type = '---';
                endswitch;

                $date = Time::parse(date('Y-m-d H:i:s', strtotime($h['createDate'])));
                $created = $date->toDateTimeString(); 

                $row = [];
                $row[] = $created;
                $row[] = $status;
                $row[] = $h['gameProviderName'];
                $row[] = $type;
                $row[] = $h['beforeAmount'];
                $row[] = $h['amount'];
                $row[] = $h['afterAmount'];
                $data[] = $row;
            endforeach;
            echo json_encode(['data'=>$data, 'code'=>1, 'pageIndex'=>$payload['pageIndex'], 'rowPerPage'=>$payload['rowPerPage'], 'totalPage'=>$payload['totalPage'], 'totalRecord'=>$payload['totalRecord']]);
        else:
            echo json_encode(['no data']);
        endif;
    }

    /*
    Slot Game List
    */

    public function slotGamesList()
    {
        $data['session'] = session()->get('logged_in') ? true : false;

        $lng = strtoupper($_SESSION['lang']);

        $provider = $this->request->getPost('params')['provider'];
        $payload = [
            'gameprovidercode' => $this->request->getPost('params')['provider']
        ];

        $res = $this->game_model->selectAllGames($payload);
		$keys = array_column($res['data'], 'order');
		array_multisort($keys, SORT_ASC, $res['data']);
        // echo json_encode($res);

        //Exclusive game
        $ex_provider = $_ENV['exclusiveGames'];
        $ex_payload = [
            'gameprovidercode' => $_ENV['exclusiveGames']
        ];

        //Exclusive game
        $ex_res = $this->game_model->selectAllGames($ex_payload);
		$ex_keys = array_column($ex_res['data'], 'order');
		array_multisort($ex_keys, SORT_ASC, $ex_res['data']);
        // echo json_encode($res);

        //Exclusive game
        $game = '';
        if( $ex_res['code']==1 && $ex_res['data']!=[] ):
			foreach( $ex_res['data'] as $e ):
                if( $e['code'] == 'legend-slot-musashi' || $e['code'] == 'legend-slot-onimaru' || $e['code'] == 'legend-slot-wukong' ){
                    if( $e['status']==1 ):
                        if( $data['session']==true ):
                            $game .= '<li class="col-xl-2 col-lg-2 col-md-2 col-4">';

                            // Original
                            // $game .= '<a class="d-block text-decoration-none overflow-hidden rounded-3" href="javascript:void(0);" onclick="singleGame(\''.$g['name'][$lng].'\',\''.$g['code'].'\',\''.$provider.'\');">';

                            // Instant Float Lobby
                            //$game .= '<a class="d-block text-decoration-none" href="javascript:void(0);" onclick="singleGameLandingExpress(\'2\', \''.$e['name'][$lng].'\', \''.$ex_provider.'\',\''.$e['code'].'\');">';
                            $game .= '<a class="d-block text-decoration-none" href="javascript:void(0);" onclick="singlegameRules(\'2\', \''.$e['name'][$lng].'\', \''.$ex_provider.'\',\''.$e['code'].'\');">';
                            $game .= '<img class="w-100 rounded-4" src="'.$_ENV['gamecard'].'/'.$ex_provider.'/'.$e['code'].'.png">';
                            $game .= '</a>';
                            $game .= '</li>';
                        else:
                            $game .= '<li class="col-xl-2 col-lg-2 col-md-2 col-4">';
                            $game .= '<a class="d-block text-decoration-none overflow-hidden" href="javascript:void(0);" onclick="alertToast(\'bg-light\', \''.lang('Validation.loginaccount').'\');">';
                            $game .= '<img class="w-100 rounded-4" src="'.$_ENV['gamecard'].'/'.$ex_provider.'/'.$e['code'].'.png">';
                            $game .= '</a>';
                            $game .= '</li>';
                        endif;
                    elseif( $e['status']==2 ):
                        $game .= '<li class="col-xl-2 col-lg-2 col-md-2 col-4 maintenance">';
                        $game .= '<a class="d-block text-decoration-none overflow-hidden" href="javascript:void(0);">';
                        $game .= '<img class="w-100 rounded-4" src="'.$_ENV['gamecard'].'/'.$ex_provider.'/'.$e['code'].'.png">';
                        $game .= '</a>';
                        $game .= '</li>';
                    endif;
                }
			endforeach;
		endif;

		if( $res['code']==1 && $res['data']!=[] ):
			foreach( $res['data'] as $g ):
                if( $g['status']==1 ):
                    if( $data['session']==true ):
                        $game .= '<li class="col-xl-2 col-lg-2 col-md-2 col-4">';

                        // Original
                        // $game .= '<a class="d-block text-decoration-none overflow-hidden rounded-3" href="javascript:void(0);" onclick="singleGame(\''.$g['name'][$lng].'\',\''.$g['code'].'\',\''.$provider.'\');">';

                        // Instant Float Lobby
                        //$game .= '<a class="d-block text-decoration-none" href="javascript:void(0);" onclick="singleGameLandingExpress(\'2\', \''.$g['name'][$lng].'\', \''.$provider.'\',\''.$g['code'].'\');">';
                        $game .= '<a class="d-block text-decoration-none" href="javascript:void(0);" onclick="singlegameRules(\'2\', \''.$g['name'][$lng].'\', \''.$provider.'\',\''.$g['code'].'\');">';
                        $game .= '<img class="w-100 rounded-4" src="'.$_ENV['gamecard'].'/'.$provider.'/'.$g['code'].'.png">';
                        $game .= '</a>';
                        $game .= '</li>';
                    else:
                        $game .= '<li class="col-xl-2 col-lg-2 col-md-2 col-4">';
                        $game .= '<a class="d-block text-decoration-none overflow-hidden" href="javascript:void(0);" onclick="alertToast(\'bg-light\', \''.lang('Validation.loginaccount').'\');">';
                        $game .= '<img class="w-100 rounded-4" src="'.$_ENV['gamecard'].'/'.$provider.'/'.$g['code'].'.png">';
                        $game .= '</a>';
                        $game .= '</li>';
                    endif;
                elseif( $g['status']==2 ):
                    $game .= '<li class="col-xl-2 col-lg-2 col-md-2 col-4 maintenance">';
                    $game .= '<a class="d-block text-decoration-none overflow-hidden" href="javascript:void(0);">';
                    $game .= '<img class="w-100 rounded-4" src="'.$_ENV['gamecard'].'/'.$provider.'/'.$g['code'].'.png">';
                    $game .= '</a>';
                    $game .= '</li>';
                endif;
			endforeach;
		endif;
		echo $game;
    }

    /*
    Exclisive Slot Game List
    */

    public function exslotGamesList()
    {
        $data['session'] = session()->get('logged_in') ? true : false;

        $lng = strtoupper($_SESSION['lang']);

        $provider = $this->request->getPost('params')['provider'];
        $payload = [
            'gameprovidercode' => $this->request->getPost('params')['provider']
        ];

        $res = $this->game_model->selectAllGames($payload);
		$keys = array_column($res['data'], 'order');
		array_multisort($keys, SORT_ASC, $res['data']);
        // echo json_encode($res);

        $peg_game = '';
        $game = '';

        //PEG BONUS
        if( $data['session']==true ):
            //MCLP
            $peg_game .= '<li class="col-12">';
            $peg_game .= '<a class="d-block text-decoration-none" href="javascript:void(0);" onclick="expressgameRules(\'2\', \'Legends Slot Free Credit\', \'MCLP\');">';
            $peg_game .= '<img class="d-block w-100 rounded-4" src="'.$_ENV['exGameRules'].'/MCLP_'.$lng.'.png" title="Legends Slot Free Credit" alt="Legends Slot Free Credit">';
            $peg_game .= '</a>';
            $peg_game .= '</li>';
            //MAVT
            $peg_game .= '<li class="col-12">';
            $peg_game .= '<a class="d-block text-decoration-none" href="javascript:void(0);" onclick="expressgameRules(\'2\', \'Avatar Free Credit\', \'MAVT\');">';
            $peg_game .= '<img class="d-block w-100 rounded-4" src="'.$_ENV['exGameRules'].'/MAVT_'.$lng.'.png" title="Avatar Free Credit" alt="Avatar Free Credit">';
            $peg_game .= '</a>';
            $peg_game .= '</li>';
            //MVP
            $peg_game .= '<li class="col-12">';
            $peg_game .= '<a class="d-block text-decoration-none" href="javascript:void(0);" onclick="expressgameRules(\'2\', \'Vpower Free Credit\', \'MVP\');">';
            $peg_game .= '<img class="d-block w-100 rounded-4" src="'.$_ENV['exGameRules'].'/MVP_'.$lng.'.png" title="Vpower Free Credit" alt="Vpower Free Credit">';
            $peg_game .= '</a>';
            $peg_game .= '</li>';
            //PEG Tournament
            //$peg_game .= '<li class="col-12">';
            ///$peg_game .= '<a class="d-block text-decoration-none" href="javascript:void(0);" onclick="gameLandingExpress(\'2\', \'Pegasus Slot\', \'PEG\');">';
            //$peg_game .= '<a class="d-block text-decoration-none" href="javascript:void(0);" onclick="expressgameRules(\'2\', \'Pegasus Slot\', \'PEG\');">';
            //$peg_game .= '<img class="d-block w-100 rounded-4" src="'.$_ENV['exGameRules'].'/PEG_'.$lng.'.png" title="Pegasus Slot" alt="Pegasus Slot">';
            //$peg_game .= '</a>';
            //$peg_game .= '</li>';
        else:
            //MCLP
            $peg_game .= '<li class="col-12">';
            $peg_game .= '<a class="d-block text-decoration-none overflow-hidden" href="javascript:void(0);" onclick="alertToast(\'bg-light\', \''.lang('Validation.loginaccount').'\');">';
            $peg_game .= '<img class="d-block w-100 rounded-4" src="'.$_ENV['exGameRules'].'/MCLP_'.$lng.'.png" title="Legends Slot Free Credit" alt="Legends Slot Free Credit">';
            $peg_game .= '</a>';
            $peg_game .= '</li>';
            //MAVT
            $peg_game .= '<li class="col-12">';
            $peg_game .= '<a class="d-block text-decoration-none overflow-hidden" href="javascript:void(0);" onclick="alertToast(\'bg-light\', \''.lang('Validation.loginaccount').'\');">';
            $peg_game .= '<img class="d-block w-100 rounded-4" src="'.$_ENV['exGameRules'].'/MAVT_'.$lng.'.png" title="Avatar Free Credit" alt="Avatar Free Credit">';
            $peg_game .= '</a>';
            $peg_game .= '</li>';
            //MVP
            $peg_game .= '<li class="col-12">';
            $peg_game .= '<a class="d-block text-decoration-none overflow-hidden" href="javascript:void(0);" onclick="alertToast(\'bg-light\', \''.lang('Validation.loginaccount').'\');">';
            $peg_game .= '<img class="d-block w-100 rounded-4" src="'.$_ENV['exGameRules'].'/MVP_'.$lng.'.png" title="Vpower Free Credit" alt="Vpower Free Credit">';
            $peg_game .= '</a>';
            $peg_game .= '</li>';
            //PEG Tourament
            //$peg_game .= '<li class="col-12">';
            //$peg_game .= '<a class="d-block text-decoration-none overflow-hidden" href="javascript:void(0);" onclick="alertToast(\'bg-light\', \''.lang('Validation.loginaccount').'\');">';
            //$peg_game .= '<img class="d-block w-100 rounded-4" src="'.$_ENV['exGameRules'].'/PEG_'.$lng.'.png">';
            //$peg_game .= '</a>';
            //$peg_game .= '</li>';
        endif;

		if( $res['code']==1 && $res['data']!=[] ):
			foreach( $res['data'] as $g ):
                if( $g['code'] == 'legend-slot-musashi' || $g['code'] == 'legend-slot-onimaru' ){
                    if( $g['status']==1 ):
                        if( $data['session']==true ):
                            $game .= '<li class="col-xl-2 col-lg-2 col-md-3 col-6">';

                            // Original
                            // $game .= '<a class="d-block text-decoration-none overflow-hidden rounded-3" href="javascript:void(0);" onclick="singleGame(\''.$g['name'][$lng].'\',\''.$g['code'].'\',\''.$provider.'\');">';

                            // Instant Float Lobby
                            //$game .= '<a class="d-block text-decoration-none" href="javascript:void(0);" onclick="exclusiveLanding(\'2\', \''.$g['name'][$lng].'\', \''.$provider.'\',\''.$g['code'].'\', \''.$lng.'\');">';
                            $game .= '<a class="d-block text-decoration-none" href="javascript:void(0);" onclick="exclusivegameRules(\'2\', \''.$g['name'][$lng].'\', \''.$provider.'\',\''.$g['code'].'\', \''.$lng.'\');">';
                            $game .= '<img class="w-100 rounded-4" src="'.$_ENV['gamecard'].'/'.$provider.'/'.$g['code'].'.png">';
                            $game .= '</a>';
                            $game .= '</li>';
                        else:
                            $game .= '<li class="col-xl-2 col-lg-2 col-md-3 col-6">';
                            $game .= '<a class="d-block text-decoration-none overflow-hidden" href="javascript:void(0);" onclick="alertToast(\'bg-light\', \''.lang('Validation.loginaccount').'\');">';
                            $game .= '<img class="w-100 rounded-4" src="'.$_ENV['gamecard'].'/'.$provider.'/'.$g['code'].'.png">';
                            $game .= '</a>';
                            $game .= '</li>';
                        endif;
                    elseif( $g['status']==2 ):
                        $game .= '<li class="col-xl-2 col-lg-2 col-md-3 col-6 maintenance">';
                        $game .= '<a class="d-block text-decoration-none overflow-hidden" href="javascript:void(0);">';
                        $game .= '<img class="w-100 rounded-4" src="'.$_ENV['gamecard'].'/'.$provider.'/'.$g['code'].'.png">';
                        $game .= '</a>';
                        $game .= '</li>';
                    endif;
                }
			endforeach;
		endif;

        $peg_game .= $game;
		echo $peg_game;
    }

    /*
    Game List
    */

    public function slotList()
    {
        $data['session'] = session()->get('logged_in') ? true : false;

        $lng = strtoupper($_SESSION['lang']);
		$gameType = $this->request->getPost('params')['type'];

        if( $data['session']==true ):
			$provider = $this->reorderGameProviderAgentList(['type'=>$gameType]);
			$keys = array_column($provider['data'], 'order');
			array_multisort($keys, SORT_ASC, $provider['data']);
		else:
			$provider = $this->gameprovider_model->selectAllGameProviders([]);
            $keys = array_column($provider['data'], 'order');
			array_multisort($keys, SORT_ASC, $provider['data']);
		endif;

        $game = '';
		if( $provider['code']==1 && $provider['data']!=[] ):
			foreach( $provider['data'] as $s ):
				if( $data['session']==true ):
                    if( $s['code']!='MG8' && $s['code']!='PU8' && $s['code']!='PB' && $s['code']!='EV8' && $s['code']!='K9' && $s['code']!='GW' && $s['code']!='CSC' && $s['code']!='K9K' ):
                        if( $s['category']==$gameType && $s['status']==1 ):
                            $game .= '<li class="col-xl-2 col-lg-2 col-md-3 col-3">';

                            // Original
                            // $game .= '<a class="d-block text-decoration-none" href="javascript:void(0);" onclick="gameLanding(\'2\', \''.$s['name'].'\', \''.$s['code'].'\');">';

                            // Instant Lobby
                            // $game .= '<a class="d-block text-decoration-none" href="javascript:void(0);" onclick="expressLobby(\''.$s['name'].'\', \''.$s['code'].'\');">';

                            // Instant Float Lobby
                            //$game .= '<a class="d-block text-decoration-none" href="javascript:void(0);" onclick="gameLandingExpress(\'2\', \''.$s['name'].'\', \''.$s['code'].'\');">';
                            $game .= '<a class="d-block text-decoration-none" href="javascript:void(0);" onclick="expressgameRules(\'2\', \''.$s['name'].'\', \''.$s['code'].'\');">';

                            $game .= '<img class="d-block w-100" src="'.$_ENV['gameProviderCard'].'/slot/'.$s['code'].'.png" title="'.$s['name'].'" alt="'.$s['name'].'">';
                            $game .= '</a>';
                            $game .= '</li>';
                            
                        elseif( $s['category']==$gameType && $s['status']==2 ):
                            $game .= '<li class="col-xl-2 col-lg-2 col-md-3 col-3 maintenance">';
                            $game .= '<a class="d-block text-decoration-none" href="javascript:void(0)">';
                            $game .= '<img class="d-block w-100" src="'.$_ENV['gameProviderCard'].'/slot/'.$s['code'].'.png" title="'.$s['name'].'" alt="'.$s['name'].'">';
                            $game .= '</a>';
                            $game .= '</li>';
                        endif;
                    else:
                        if( $s['category']==$gameType ):
                            if( $s['status']==1 && ($s['code']=='MG8' || $s['code']=='PU8' || $s['code']=='PB' || $s['code']=='EV8' || $s['code']=='K9' || $s['code']=='GW' || $s['code']=='CSC' || $s['code']=='K9K') ):
                                $game .= '<li class="col-xl-2 col-lg-2 col-md-3 col-3">';
                                //$game .= '<a class="d-block text-decoration-none" href="javascript:void(0);" onclick="appLanding(\'3\', \''.$s['name'].'\', \''.$s['code'].'\');">';
                                $game .= '<a class="d-block text-decoration-none" href="javascript:void(0);" onclick="appgameRules(\'3\', \''.$s['name'].'\', \''.$s['code'].'\');">';
                                $game .= '<img class="d-block w-100" src="'.$_ENV['gameProviderCard'].'/slot/'.$s['code'].'.png" title="'.$s['name'].'" alt="'.$s['name'].'">';
                                $game .= '</a>';
                                $game .= '</li>';
                            //elseif( $s['status']==1 && $s['code']=='K9K' ):
                                //$game .= '<li class="col-xl-2 col-lg-2 col-md-3 col-3">';
                                ////$game .= '<a class="d-block text-decoration-none" href="javascript:void(0);" onclick="appUrlLanding(\'4\', \''.$s['name'].'\', \''.$s['code'].'\');">';
                                //$game .= '<a class="d-block text-decoration-none" href="javascript:void(0);" onclick="appUrlgameRules(\'4\', \''.$s['name'].'\', \''.$s['code'].'\');">';
                                //$game .= '<img class="d-block w-100" src="'.$_ENV['gameProviderCard'].'/slot/'.$s['code'].'.png" title="'.$s['name'].'" alt="'.$s['name'].'">';
                                //$game .= '</a>';
                                //$game .= '</li>';
                            elseif( $s['status']==2 && ($s['code']=='MG8' || $s['code']=='PU8' || $s['code']=='PB' || $s['code']=='EV8' || $s['code']=='K9' || $s['code']=='GW' || $s['code']=='CSC' || $s['code']=='K9K') ):
                                $game .= '<li class="col-xl-2 col-lg-2 col-md-3 col-3 maintenance">';
                                $game .= '<a class="d-block text-decoration-none" href="javascript:void(0)">';
                                $game .= '<img class="d-block w-100" src="'.$_ENV['gameProviderCard'].'/slot/'.$s['code'].'.png" title="'.$s['name'].'" alt="'.$s['name'].'">';
                                $game .= '</a>';
                                $game .= '</li>';
                            endif;
                        endif;
                    endif;
				else:
                    if( !empty($s['displayType']) ):
					foreach( $s['displayType'] as $stype ):
                        // if( $s['code']!='MG8' && $s['code']!='PU8' && $s['code']!='PB' && $s['code']!='EV8' && $s['code']!='K9' && $s['code']!='GW' && $s['code']!='CSC' && $s['code']!='K9K' ):
                            if( $stype==$gameType && $s['status']==1 ):
                                $game .= '<li class="col-xl-2 col-lg-2 col-md-3 col-3">';
                                $game .= '<a class="d-block text-decoration-none" href="javascript:void(0);" onclick="alertToast(\'bg-light\', \''.lang('Validation.loginaccount').'\');">';
                                $game .= '<img class="d-block w-100" src="'.$_ENV['gameProviderCard'].'/slot/'.$s['code'].'.png" title="'.$s['name'][$lng].'" alt="'.$s['name'][$lng].'">';
                                $game .= '</a>';
                                $game .= '</li>';
                            elseif( $stype==$gameType && $s['status']==2 ):
                                $game .= '<li class="col-xl-2 col-lg-2 col-md-3 col-3 maintenance">';
                                $game .= '<a class="d-block text-decoration-none" href="javascript:void(0)">';
                                $game .= '<img class="d-block w-100" src="'.$_ENV['gameProviderCard'].'/slot/'.$s['code'].'.png" title="'.$s['name'][$lng].'" alt="'.$s['name'][$lng].'">';
                                $game .= '</a>';
                                $game .= '</li>';
                            endif;
                        // endif;
					endforeach;
                    endif;
				endif;
			endforeach;
		endif;
		echo $game;
    }

    public function casinoList()
    {
        $data['session'] = session()->get('logged_in') ? true : false;
        
        $lng = strtoupper($_SESSION['lang']);
		$gameType = $this->request->getPost('params')['type'];

        if( $data['session']==true ):
			$provider = $this->reorderGameProviderAgentList(['type'=>$gameType]);
			$keys = array_column($provider['data'], 'order');
			array_multisort($keys, SORT_ASC, $provider['data']);
		else:
			$provider = $this->gameprovider_model->selectAllGameProviders([]);
		endif;

        $game = '';
		if( $provider['code']==1 && $provider['data']!=[] ):
			foreach( $provider['data'] as $s ):
				if( $data['session']==true ):
					if( $s['category']==$gameType && $s['status']==1 ):
						$game .= '<li class="col-xl-2 col-lg-2 col-md-3 col-3">';

						// Original
						// $game .= '<a class="d-block text-decoration-none" href="javascript:void(0);" onclick="gameLanding(\'1\', \''.$s['name'].'\', \''.$s['code'].'\');">';

                        // Instant Lobby
                        // $game .= '<a class="d-block text-decoration-none" href="javascript:void(0);" onclick="expressLobby(\''.$s['name'].'\', \''.$s['code'].'\');">';

                        // Instant Float Lobby
                        if( $s['code']=='PT2' || $s['code']=='PRG2' ):
                            //$game .= '<a class="d-block text-decoration-none" href="javascript:void(0);" onclick="gameLandingExpress(\'2\', \''.$s['name'].'\', \''.$s['code'].'\');">';
                            $game .= '<a class="d-block text-decoration-none" href="javascript:void(0);" onclick="expressgameRules(\'2\', \''.$s['name'].'\', \''.$s['code'].'\');">';
                        else:
                            //$game .= '<a class="d-block text-decoration-none" href="javascript:void(0);" onclick="gameLandingExpress(\'1\', \''.$s['name'].'\', \''.$s['code'].'\');">';
                            $game .= '<a class="d-block text-decoration-none" href="javascript:void(0);" onclick="expressgameRules(\'1\', \''.$s['name'].'\', \''.$s['code'].'\');">';
                        endif;

						$game .= '<img class="d-block w-100" src="'.$_ENV['gameProviderCard'].'/casino/'.$s['code'].'.png" title="'.$s['name'].'" alt="'.$s['name'].'">';
						$game .= '</a>';
						$game .= '</li>';
					elseif( $s['category']==$gameType && $s['status']==2 ):
						$game .= '<li class="col-xl-2 col-lg-2 col-md-3 col-3 maintenance">';
						$game .= '<a class="d-block text-decoration-none" href="javascript:void(0)">';
						$game .= '<img class="d-block w-100" src="'.$_ENV['gameProviderCard'].'/casino/'.$s['code'].'.png" title="'.$s['name'].'" alt="'.$s['name'].'">';
						$game .= '</a>';
						$game .= '</li>';
					endif;
				else:
                    if( !empty($s['displayType']) ):
					foreach( $s['displayType'] as $stype ):
						if( $stype==$gameType && $s['status']==1 ):
							$game .= '<li class="col-xl-2 col-lg-2 col-md-3 col-3">';
							$game .= '<a class="d-block text-decoration-none" href="javascript:void(0);" onclick="alertToast(\'bg-light\', \'Please login account\');">';
							$game .= '<img class="d-block w-100" src="'.$_ENV['gameProviderCard'].'/casino/'.$s['code'].'.png" title="'.$s['name'][$lng].'" alt="'.$s['name'][$lng].'">';
							$game .= '</a>';
							$game .= '</li>';
						elseif( $stype==$gameType && $s['status']==2 ):
							$game .= '<li class="col-xl-2 col-lg-2 col-md-3 col-3 maintenance">';
							$game .= '<a class="d-block text-decoration-none" href="javascript:void(0)">';
							$game .= '<img class="d-block w-100" src="'.$_ENV['gameProviderCard'].'/casino/'.$s['code'].'.png" title="'.$s['name'][$lng].'" alt="'.$s['name'][$lng].'">';
							$game .= '</a>';
							$game .= '</li>';
						endif;
					endforeach;
                    endif;
				endif;
			endforeach;
		endif;
		echo $game;
    }

    public function sportList()
    {
        $data['session'] = session()->get('logged_in') ? true : false;
        
        $lng = strtoupper($_SESSION['lang']);
		$gameType = $this->request->getPost('params')['type'];

        if( $data['session']==true ):
			$provider = $this->reorderGameProviderAgentList(['type'=>$gameType]);
			$keys = array_column($provider['data'], 'order');
			array_multisort($keys, SORT_ASC, $provider['data']);
		else:
			$provider = $this->gameprovider_model->selectAllGameProviders([]);
		endif;

        $game = '';
		if( $provider['code']==1 && $provider['data']!=[] ):
			foreach( $provider['data'] as $s ):
				if( $data['session']==true ):
					if( $s['category']==$gameType && $s['status']==1 ):
						$game .= '<li class="col-xl-2 col-lg-2 col-md-3 col-3">';

						// Original
						// $game .= '<a class="d-block text-decoration-none" href="javascript:void(0);" onclick="gameLanding(\'1\', \''.$s['name'].'\', \''.$s['code'].'\');">';

                        // Instant Lobby
                        // $game .= '<a class="d-block text-decoration-none" href="javascript:void(0);" onclick="expressLobby(\''.$s['name'].'\', \''.$s['code'].'\');">';

                        // Instant Float Lobby

                        if( $s['code']=='OB3C' ):
                            //$game .= '<a class="d-block text-decoration-none" href="javascript:void(0);" onclick="expressLobby(\''.$s['name'].'\', \''.$s['code'].'\');">';
                            $game .= '<a class="d-block text-decoration-none" href="javascript:void(0);" onclick="expressLobbySportgameRules(\''.$s['name'].'\', \''.$s['code'].'\');">';
                        elseif( $s['code']=='RCB' ):
                            $game .= '<a class="d-block text-decoration-none" href="javascript:void(0);" onclick="exclusiveLanding(\'1\', \''.$s['name'].'\', \''.$s['code'].'\', \'0\', \''.$lng.'\');">';
                        elseif( $s['code']=='SV3' ):
                            //$game .= '<a class="d-block text-decoration-none" href="javascript:void(0);" onclick="gameLandingExpress(\'1\', \''.$s['name'].'\', \''.$s['code'].'\');">';
                            $game .= '<a class="d-block text-decoration-none" href="javascript:void(0);" onclick="expressgameRules(\'1\', \''.$s['name'].'\', \''.$s['code'].'\');">';
                        else:
                            $game .= '<a class="d-block text-decoration-none" href="javascript:void(0);" onclick="expressSportRules(\'1\', \''.$s['name'].'\', \''.$s['code'].'\');">';
                        endif;

                        //filter RCB
                        //if( $s['code']=='RCB' ):
                            //$game .= '<a class="d-block text-decoration-none" href="javascript:void(0);" onclick="exclusiveLanding(\'1\', \''.$s['name'].'\', \''.$s['code'].'\', \'0\', \''.$lng.'\');">';
                        //else:
                            //$game .= '<a class="d-block text-decoration-none" href="javascript:void(0);" onclick="gameLandingExpress(\'1\', \''.$s['name'].'\', \''.$s['code'].'\');">';
                        //endif;

                        //$game .= '<a class="d-block text-decoration-none" href="javascript:void(0);" onclick="gameLandingExpress(\'1\', \''.$s['name'].'\', \''.$s['code'].'\');">';

						$game .= '<img class="d-block w-100" src="'.$_ENV['gameProviderCard'].'/sport/'.$s['code'].'.png" title="'.$s['name'].'" alt="'.$s['name'].'">';
						$game .= '</a>';
						$game .= '</li>';
					elseif( $s['category']==$gameType && $s['status']==2 ):
						$game .= '<li class="col-xl-2 col-lg-2 col-md-3 col-3 maintenance">';
						$game .= '<a class="d-block text-decoration-none" href="javascript:void(0)">';
						$game .= '<img class="d-block w-100" src="'.$_ENV['gameProviderCard'].'/sport/'.$s['code'].'.png" title="'.$s['name'].'" alt="'.$s['name'].'">';
						$game .= '</a>';
						$game .= '</li>';
					endif;
				else:
                    if( !empty($s['displayType']) ):
					foreach( $s['displayType'] as $stype ):
                        if( $stype==3 && $s['status']==1 ):
                            if( $gameType==3 ):
                                $game .= '<li class="col-xl-2 col-lg-2 col-md-3 col-3">';
                                $game .= '<a class="d-block text-decoration-none" href="javascript:void(0);" onclick="alertToast(\'bg-light\', \''.lang('Validation.loginaccount').'\');">';
                                $game .= '<img class="d-block w-100" src="'.$_ENV['gameProviderCard'].'/sport/'.$s['code'].'.png" title="'.$s['name'][$lng].'" alt="'.$s['name'][$lng].'">';
                                $game .= '</a>';
                                $game .= '</li>';
                            elseif( $gameType==33 ):
                                $game .= '<li class="col-xl-2 col-lg-2 col-md-3 col-3">';
                                $game .= '<a class="d-block text-decoration-none" href="javascript:void(0);" onclick="alertToast(\'bg-light\', \''.lang('Validation.loginaccount').'\');">';
                                $game .= '<img class="d-block w-100" src="'.$_ENV['gameProviderCard'].'/sport/'.$s['code'].'.png" title="'.$s['name'][$lng].'" alt="'.$s['name'][$lng].'">';
                                $game .= '</a>';
                                $game .= '</li>';
                            endif;
                        else:
                            if( $stype==$gameType && $s['status']==1 ):
                                $game .= '<li class="col-xl-2 col-lg-2 col-md-3 col-3">';
                                $game .= '<a class="d-block text-decoration-none" href="javascript:void(0);" onclick="alertToast(\'bg-light\', \''.lang('Validation.loginaccount').'\');">';
                                $game .= '<img class="d-block w-100" src="'.$_ENV['gameProviderCard'].'/sport/'.$s['code'].'.png" title="'.$s['name'][$lng].'" alt="'.$s['name'][$lng].'">';
                                $game .= '</a>';
                                $game .= '</li>';
                            elseif( $stype==$gameType && $s['status']==2 ):
                                $game .= '<li class="col-xl-2 col-lg-2 col-md-3 col-3 maintenance">';
                                $game .= '<a class="d-block text-decoration-none" href="javascript:void(0)">';
                                $game .= '<img class="d-block w-100" src="'.$_ENV['gameProviderCard'].'/sport/'.$s['code'].'.png" title="'.$s['name'][$lng].'" alt="'.$s['name'][$lng].'">';
                                $game .= '</a>';
                                $game .= '</li>';
                            endif;
                        endif;
					endforeach;
                    endif;
				endif;
			endforeach;
		endif;
		echo $game;
    }

    public function eSportList()
    {
        $data['session'] = session()->get('logged_in') ? true : false;
        
        $lng = strtoupper($_SESSION['lang']);
		$gameType = $this->request->getPost('params')['type'];

        if( $data['session']==true ):
			$provider = $this->reorderGameProviderAgentList(['type'=>$gameType]);
			$keys = array_column($provider['data'], 'order');
			array_multisort($keys, SORT_ASC, $provider['data']);
		else:
			$provider = $this->gameprovider_model->selectAllGameProviders([]);
		endif;

        $game = '';
		if( $provider['code']==1 && $provider['data']!=[] ):
			foreach( $provider['data'] as $s ):
				if( $data['session']==true ):
					if( $s['category']==$gameType && $s['status']==1 ):
						$game .= '<li class="col-xl-2 col-lg-2 col-md-3 col-3">';

						// Original
						// $game .= '<a class="d-block text-decoration-none" href="javascript:void(0);" onclick="gameLanding(\'1\', \''.$s['name'].'\', \''.$s['code'].'\');">';

                        // Instant Lobby
                        // $game .= '<a class="d-block text-decoration-none" href="javascript:void(0);" onclick="expressLobby(\''.$s['name'].'\', \''.$s['code'].'\');">';

                        // Instant Float Lobby
                        $game .= '<a class="d-block text-decoration-none" href="javascript:void(0);" onclick="gameLandingExpress(\'1\', \''.$s['name'].'\', \''.$s['code'].'\');">';

						$game .= '<img class="d-block w-100" src="'.$_ENV['gameProviderCard'].'/esport/'.$s['code'].'.png" title="'.$s['name'].'" alt="'.$s['name'].'">';
						$game .= '</a>';
						$game .= '</li>';
					elseif( $s['category']==$gameType && $s['status']==2 ):
						$game .= '<li class="col-xl-2 col-lg-2 col-md-3 col-3 maintenance">';
						$game .= '<a class="d-block text-decoration-none" href="javascript:void(0)">';
						$game .= '<img class="d-block w-100" src="'.$_ENV['gameProviderCard'].'/esport/'.$s['code'].'.png" title="'.$s['name'].'" alt="'.$s['name'].'">';
						$game .= '</a>';
						$game .= '</li>';
					endif;
				else:
                    if( !empty($s['displayType']) ):
					foreach( $s['displayType'] as $stype ):
						if( $stype==$gameType && $s['status']==1 ):
							$game .= '<li class="col-xl-2 col-lg-2 col-md-3 col-3">';
							$game .= '<a class="d-block text-decoration-none" href="javascript:void(0);" onclick="alertToast(\'bg-light\', \'Please login account\');">';
							$game .= '<img class="d-block w-100" src="'.$_ENV['gameProviderCard'].'/esport/'.$s['code'].'.png" title="'.$s['name'][$lng].'" alt="'.$s['name'][$lng].'">';
							$game .= '</a>';
							$game .= '</li>';
						elseif( $stype==$gameType && $s['status']==2 ):
							$game .= '<li class="col-xl-2 col-lg-2 col-md-3 col-3 maintenance">';
							$game .= '<a class="d-block text-decoration-none" href="javascript:void(0)">';
							$game .= '<img class="d-block w-100" src="'.$_ENV['gameProviderCard'].'/esport/'.$s['code'].'.png" title="'.$s['name'][$lng].'" alt="'.$s['name'][$lng].'">';
							$game .= '</a>';
							$game .= '</li>';
						endif;
					endforeach;
                    endif;
				endif;
			endforeach;
		endif;
		echo $game;
    }

    public function kenoList()
    {
        $data['session'] = session()->get('logged_in') ? true : false;
        
        $lng = strtoupper($_SESSION['lang']);
		$gameType = $this->request->getPost('params')['type'];

        if( $data['session']==true ):
			$provider = $this->reorderGameProviderAgentList(['type'=>$gameType]);
			$keys = array_column($provider['data'], 'order');
			array_multisort($keys, SORT_ASC, $provider['data']);
		else:
			$provider = $this->gameprovider_model->selectAllGameProviders([]);
		endif;

        $game = '';
		if( $provider['code']==1 && $provider['data']!=[] ):
			foreach( $provider['data'] as $s ):
				if( $data['session']==true ):
					if( $s['category']==$gameType && $s['status']==1 ):
						$game .= '<li class="col-xl-2 col-lg-2 col-md-3 col-3">';

						// Original
						// $game .= '<a class="d-block text-decoration-none" href="javascript:void(0);" onclick="gameLanding(\'1\', \''.$s['name'].'\', \''.$s['code'].'\');">';

                        // Instant Lobby
                        // $game .= '<a class="d-block text-decoration-none" href="javascript:void(0);" onclick="expressLobby(\''.$s['name'].'\', \''.$s['code'].'\');">';

                        // Instant Float Lobby
                        if( $s['code']=='PT2' || $s['code']=='PRG2' ):
                            $game .= '<a class="d-block text-decoration-none" href="javascript:void(0);" onclick="gameLandingExpress(\'2\', \''.$s['name'].'\', \''.$s['code'].'\');">';
                        else:
                            $game .= '<a class="d-block text-decoration-none" href="javascript:void(0);" onclick="gameLandingExpress(\'1\', \''.$s['name'].'\', \''.$s['code'].'\');">';
                        endif;

						$game .= '<img class="d-block w-100" src="'.$_ENV['gameProviderCard'].'/keno/'.$s['code'].'.png" title="'.$s['name'].'" alt="'.$s['name'].'">';
						$game .= '</a>';
						$game .= '</li>';
					elseif( $s['category']==$gameType && $s['status']==2 ):
						$game .= '<li class="col-xl-2 col-lg-2 col-md-3 col-3 maintenance">';
						$game .= '<a class="d-block text-decoration-none" href="javascript:void(0)">';
						$game .= '<img class="d-block w-100" src="'.$_ENV['gameProviderCard'].'/keno/'.$s['code'].'.png" title="'.$s['name'].'" alt="'.$s['name'].'">';
						$game .= '</a>';
						$game .= '</li>';
					endif;
				else:
                    if( !empty($s['displayType']) ):
					foreach( $s['displayType'] as $stype ):
						if( $stype==$gameType && $s['status']==1 ):
							$game .= '<li class="col-xl-2 col-lg-2 col-md-3 col-3">';
							$game .= '<a class="d-block text-decoration-none" href="javascript:void(0);" onclick="alertToast(\'bg-light\', \'Please login account\');">';
							$game .= '<img class="d-block w-100" src="'.$_ENV['gameProviderCard'].'/keno/'.$s['code'].'.png" title="'.$s['name'][$lng].'" alt="'.$s['name'][$lng].'">';
							$game .= '</a>';
							$game .= '</li>';
						elseif( $stype==$gameType && $s['status']==2 ):
							$game .= '<li class="col-xl-2 col-lg-2 col-md-3 col-3 maintenance">';
							$game .= '<a class="d-block text-decoration-none" href="javascript:void(0)">';
							$game .= '<img class="d-block w-100" src="'.$_ENV['gameProviderCard'].'/keno/'.$s['code'].'.png" title="'.$s['name'][$lng].'" alt="'.$s['name'][$lng].'">';
							$game .= '</a>';
							$game .= '</li>';
						endif;
					endforeach;
                    endif;
				endif;
			endforeach;
		endif;
		echo $game;
    }

    public function lotteryList()
    {
        $data['session'] = session()->get('logged_in') ? true : false;
        
        $lng = strtoupper($_SESSION['lang']);
		$gameType = $this->request->getPost('params')['type'];

        if( $data['session']==true ):
			$provider = $this->reorderGameProviderAgentList(['type'=>$gameType]);
			$keys = array_column($provider['data'], 'order');
			array_multisort($keys, SORT_ASC, $provider['data']);
		else:
			$provider = $this->gameprovider_model->selectAllGameProviders([]);
		endif;

        $game = '';
		if( $provider['code']==1 && $provider['data']!=[] ):
			foreach( $provider['data'] as $s ):
				if( $data['session']==true ):
					if( $s['category']==$gameType && $s['status']==1 ):
						// if( $s['code']=='GD8' || $s['code']=='MN8' || $s['code']=='GD2' ):
							$game .= '<li class="col-xl-2 col-lg-2 col-md-3 col-3">';
							$game .= '<a class="d-block text-decoration-none" href="javascript:void(0);" onclick="lottoLanding(\'5\', \''.$s['name'].'\', \''.$s['code'].'\', \''.$lng.'\');">';
							$game .= '<img class="d-block w-100" src="'.$_ENV['gameProviderCard'].'/lottery/'.$s['code'].'.png" title="'.$s['name'].'" alt="'.$s['name'].'">';
							$game .= '</a>';
							$game .= '</li>';
						// elseif( $s['code']=='GD' || $s['code']=='GDS' ):
						// 	$game .= '<li class="col-xl-2 col-lg-2 col-md-3 col-4">';
						// 	$game .= '<a class="d-block text-decoration-none" href="javascript:void(0);" onclick="lottoBonusLanding(\'6\', \''.$s['name'].'\', \''.$s['code'].'\');">';
						// 	$game .= '<img class="d-block w-100" src="'.$_ENV['gameProviderCard'].'/lottery/'.$s['code'].'.png" title="'.$s['name'].'" alt="'.$s['name'].'">';
						// 	$game .= '</a>';
						// 	$game .= '</li>';
						// endif;
					elseif( $s['category']==$gameType && $s['status']==2 ):
						$game .= '<li class="col-xl-2 col-lg-2 col-md-3 col-3 maintenance">';
						$game .= '<a class="d-block text-decoration-none" href="javascript:void(0)">';
						$game .= '<img class="d-block w-100" src="'.$_ENV['gameProviderCard'].'/lottery/'.$s['code'].'.png" title="'.$s['name'].'" alt="'.$s['name'].'">';
						$game .= '</a>';
						$game .= '</li>';
					endif;
				else:
                    if( !empty($s['displayType']) ):
					foreach( $s['displayType'] as $stype ):
						if( $stype==$gameType && $s['status']==1 ):
							$game .= '<li class="col-xl-2 col-lg-2 col-md-3 col-3">';
							$game .= '<a class="d-block text-decoration-none" href="javascript:void(0);" onclick="alertToast(\'bg-light\', \''.lang('Validation.loginaccount').'\');">';
							$game .= '<img class="d-block w-100" src="'.$_ENV['gameProviderCard'].'/lottery/'.$s['code'].'.png" title="'.$s['name'][$lng].'" alt="'.$s['name'][$lng].'">';
							$game .= '</a>';
							$game .= '</li>';
						elseif( $stype==$gameType && $s['status']==2 ):
							$game .= '<li class="col-xl-2 col-lg-2 col-md-3 col-3 maintenance">';
							$game .= '<a class="d-block text-decoration-none" href="javascript:void(0)">';
							$game .= '<img class="d-block w-100" src="'.$_ENV['gameProviderCard'].'/lottery/'.$s['code'].'.png" title="'.$s['name'][$lng].'" alt="'.$s['name'][$lng].'">';
							$game .= '</a>';
							$game .= '</li>';
						endif;
					endforeach;
                    endif;
				endif;
			endforeach;
		endif;
		echo $game;
    }

    public function appGameList()
    {
        $data['session'] = session()->get('logged_in') ? true : false;

        $lng = strtoupper($_SESSION['lang']);
		$gameType = $this->request->getPost('params')['type'];

        if( $data['session']==true ):
			$provider = $this->reorderGameProviderAgentList(['type'=>$gameType]);
			$keys = array_column($provider['data'], 'order');
			array_multisort($keys, SORT_ASC, $provider['data']);
		else:
			$provider = $this->gameprovider_model->selectAllGameProviders([]);
		endif;

        $game = '';
		if( $provider['code']==1 && $provider['data']!=[] ):
			foreach( $provider['data'] as $s ):
				if( $data['session']==true ):
					if( $s['category']==$gameType ):
                        if( $s['status']==1 && ($s['code']=='MG8' || $s['code']=='PU8' || $s['code']=='PB' || $s['code']=='EV8' || $s['code']=='K9' || $s['code']=='GW' || $s['code']=='CSC') ):
                            $game .= '<li class="col-xl-2 col-lg-2 col-md-3 col-3">';
                            $game .= '<a class="d-block text-decoration-none" href="javascript:void(0);" onclick="appLanding(\'3\', \''.$s['name'].'\', \''.$s['code'].'\');">';
                            $game .= '<img class="d-block w-100" src="'.$_ENV['gameProviderCard'].'/slot/'.$s['code'].'.png" title="'.$s['name'].'" alt="'.$s['name'].'">';
                            $game .= '</a>';
                            $game .= '</li>';
                        elseif( $s['status']==1 && $s['code']=='K9K' ):
                            $game .= '<li class="col-xl-2 col-lg-2 col-md-3 col-3">';
                            $game .= '<a class="d-block text-decoration-none" href="javascript:void(0);" onclick="appUrlLanding(\'4\', \''.$s['name'].'\', \''.$s['code'].'\');">';
                            $game .= '<img class="d-block w-100" src="'.$_ENV['gameProviderCard'].'/slot/'.$s['code'].'.png" title="'.$s['name'].'" alt="'.$s['name'].'">';
                            $game .= '</a>';
                            $game .= '</li>';
                        elseif( $s['status']==2 && ($s['code']=='MG8' || $s['code']=='PU8' || $s['code']=='PB' || $s['code']=='EV8' || $s['code']=='K9' || $s['code']=='GW' || $s['code']=='CSC' || $s['code']=='K9K') ):
                            $game .= '<li class="col-xl-2 col-lg-2 col-md-3 col-3 maintenance">';
                            $game .= '<a class="d-block text-decoration-none" href="javascript:void(0)">';
                            $game .= '<img class="d-block w-100" src="'.$_ENV['gameProviderCard'].'/slot/'.$s['code'].'.png" title="'.$s['name'].'" alt="'.$s['name'].'">';
                            $game .= '</a>';
                            $game .= '</li>';
                        endif;
                    endif;
				else:
                    if( !empty($s['displayType']) ):
					foreach( $s['displayType'] as $stype ):
                        if( $stype==$gameType ):
                            if( $s['code']=='MG8' || $s['code']=='PU8' || $s['code']=='PB' || $s['code']=='EV8' || $s['code']=='K9' || $s['code']=='GW' || $s['code']=='CSC' || $s['code']=='K9K' ):
                                if( $s['status']==1 ):
                                    $game .= '<li class="col-xl-2 col-lg-2 col-md-3 col-3">';
                                    $game .= '<a class="d-block text-decoration-none" href="javascript:void(0);" onclick="alertToast(\'bg-light\', \''.lang('Validation.loginaccount').'\');">';
                                    $game .= '<img class="d-block w-100" src="'.$_ENV['gameProviderCard'].'/slot/'.$s['code'].'.png" title="'.$s['name'][$lng].'" alt="'.$s['name'][$lng].'">';
                                    $game .= '</a>';
                                    $game .= '</li>';
                                elseif( $s['status']==2 ):
                                    $game .= '<li class="col-xl-2 col-lg-2 col-md-3 col-3 maintenance">';
                                    $game .= '<a class="d-block text-decoration-none" href="javascript:void(0)">';
                                    $game .= '<img class="d-block w-100" src="'.$_ENV['gameProviderCard'].'/slot/'.$s['code'].'.png" title="'.$s['name'][$lng].'" alt="'.$s['name'][$lng].'">';
                                    $game .= '</a>';
                                    $game .= '</li>';
                                endif;
                            endif;
                        endif;
					endforeach;
                    endif;
				endif;
			endforeach;
		endif;
		echo $game;
    }
}