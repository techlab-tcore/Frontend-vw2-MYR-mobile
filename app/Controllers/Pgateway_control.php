<?php

namespace App\Controllers;

class Pgateway_control extends BaseController
{
    /*
    Protected
    */

    protected function bankList()
    {
        $payload = [
            'userid' => $_SESSION['token'],
            'paymentmethod' => 2,
            'status' => 1
        ];
        $res = $this->bank_model->bankList($payload);
        return $res;
    }

    /*
    Public
    */

    public function paymentGatewayChannelList()
    {
        if( !session()->get('logged_in') ): return false; endif;

        $payload = [
            'userid' => $_SESSION['token'],
            'bankid' => base64_decode($this->request->getPost('params')['bankid']),
            'merchantcode' => $this->request->getPost('params')['merchant'],
        ];

        $res = $this->pgateway_model->pGatewayChannelList($payload);
        echo json_encode($res);
    }

    public function paymentGatewayList()
    {
        if( !session()->get('logged_in') ): return false; endif;

        $lng = strtoupper($_SESSION['lang']);

        $currency = $this->bankList();

        $payload = [
            'userid' => $_SESSION['token']
        ];

        $res = $this->pgateway_model->pGatewayList($payload);
        // echo json_encode($res);

        // Ordering
        $keys = array_column($res['data'], 'order');
        array_multisort($keys, SORT_ASC, $res['data']);

        $data = [];
        if( $res['code']==1 && $res['data']!=[] ):
            foreach($res['data'] as $bc):
                $code = '';
                if( $bc['status']==1 && ($bc['bankId']!='654dc5339e104dbd4093d158') ):
                    foreach( $currency['data'] as $cd ):
                        if( $cd['bankId']==$bc['bankId'] ):
                            $code = $cd['currencyCode'][0];
                        endif;
                    endforeach;

                    $row = [];
                    $row['bank'] = $bc['bankId'];
                    $row['currency'] = $code;
                    $row['name'] = $bc['bankName'][$lng];
                    $row['merchant'] = $bc['merchantCode'];
                    $row['status'] = $bc['status'];
                    $row['order'] = $bc['order'];
                    $data[] = $row;
                endif;
            endforeach;
            echo json_encode(['data'=>$data, 'code'=>$res['code'], 'message'=>$res['message']]);
        else:
            echo json_encode(['data'=>$data, 'code'=>$res['code'], 'message'=>$res['message']]);
        endif;
    }
}