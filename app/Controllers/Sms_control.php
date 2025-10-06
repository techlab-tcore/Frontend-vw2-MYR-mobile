<?php

namespace App\Controllers;

class Sms_control extends BaseController
{
    public function sendWhatsapp()
    {
        $length = strlen($this->request->getpost('params')['contact']);

        if ( $this->request->getpost('params')['mobilecode'] == 'MYR') {
            $regionCode = 6;
        } else {
            $regionCode = 65;
        }

        // Checking Mobile Number
        $firstChar = substr($this->request->getpost('params')['contact'], 0, $_ENV['SGnumMobileCode']);
        if( $firstChar==$_ENV['SGmobileCode'] ):
            //$str = ltrim($this->request->getPost('params')['mobile'], '6');
            echo json_encode([
                'code' => -1,
                'message' => lang('Validation.sgmobile')
            ]);
        else:
            // Valid Mobile Number
            if( $length==8 || $length==9 ):
                $payload = [
                    'to' => $regionCode.$this->request->getpost('params')['contact'],
                    'message' => $this->request->getpost('params')['message']
                ];
                $res = $this->sms_model->insertWhatsapp($payload);
                // echo json_encode($res);

                if( $res['message_status']=='Success' ):
                    $session = session();
                    $session->set('taccode', $this->request->getpost('params')['veritac']);
                endif;

                echo json_encode([
                    'code' => 1,
                    'message' => $res['message_status']
                ]);
            else:
                echo json_encode([
                    'code' => -1,
                    'message' => lang('Validation.sgmobile'),
                ]);
            endif;
        endif;
    }
    
    public function sendSMS()
    {
        $length = strlen($this->request->getpost('params')['contact']);

        $length_of_string = 6;
        // $str_result = '0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz';
        $str_result = '0123456789';
        $veritac = substr(str_shuffle($str_result), 0, $length_of_string);

        //$msg = '['.$_ENV['SMScompany'].']--'.$veritac.'--';
        //$msg .= 'Code to be used once for login security verification. Do not share Code with others. Disregard this SMS if you did not intend to log in.';

        $msg = '*'.$veritac.'*';
        $msg .= ' is your verification code. For your security, do not share this code.';
        
        // Checking Mobile Number
        // $firstChar = substr($this->request->getpost('params')['contact'], 0, 1);
        // if( $firstChar=='6' ):
        //     // $str = ltrim($this->request->getPost('params')['mobile'], '6');
        //     echo json_encode([
        //         'code' => -1,
        //         'message' => lang('Validation.mymobile')
        //     ]);
        // else:
            // Valid Mobile Number
            // if( $length==10 || $length==11 ):
                $payload = [
                    'type' => "2",
                    'regioncode' => $this->request->getpost('params')['regioncode'],
                    'contactno' => $this->request->getpost('params')['contact'],
                    'text' => $msg
                    // 'text' => $this->request->getpost('params')['message']
                ];
                $res = $this->sms_model->insertSms($payload);
                // echo json_encode($res);

                if( $res['code']==1 ):
                    $session = session();
                    // $session->set('taccode', $this->request->getpost('params')['veritac']);
                    $session->set('taccode', $veritac);
                endif;
                echo json_encode($res);
            // else:
            //     echo json_encode([
            //         'code' => -1,
            //         'message' => lang('Validation.mymobile'),
            //     ]);
            // endif;
        // endif;
    }

    public function sendSecondPassSMS()
    {
        $length_of_string = 6;
        $str_result = '0123456789';
        $veritac = substr(str_shuffle($str_result), 0, $length_of_string);

        $msg = '*'.$veritac.'*';
        $msg .= ' is your verification code. For your security, do not share this code.';

        $payload = [
            'type' => "2",
            'regioncode' => $_SESSION['regioncode'],
            'contactno' => $_SESSION['contact'],
            'text' => $msg
            // 'text' => $this->request->getpost('params')['message']
        ];
        $res = $this->sms_model->insertSms($payload);
        echo json_encode($res);

        if( $res['code']==1 ):
            $session = session();
            // $session->set('taccode', $this->request->getpost('params')['veritac']);
            $session->set('taccode', $veritac);
        endif;
    }
}