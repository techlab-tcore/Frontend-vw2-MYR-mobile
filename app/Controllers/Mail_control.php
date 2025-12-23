<?php

namespace App\Controllers;

use CodeIgniter\I18n\Time;

class Mail_control extends BaseController
{
    public function mailList()
    {
        if( !session()->get('logged_in') ): return false; endif;

        $payload = [
            'userid' => $_SESSION['token']
        ];

        $res = $this->mail_model->selectAllMails($payload);
        // echo json_encode($res);

        if( $res['code'] == 1 && $res['data'] != [] ):
            $data = [];
            foreach( $res['data'] as $m ):
                switch($m['read']):
                    case 1: $read = 'Yes'; break;
                    case 2: $read = 'No'; break;
                    default: $read = '---';
                endswitch;

                if ($read === 'Yes'){
                    $action = '<button type="button" class="btn bg-danger text-white border" data-bs-toggle="modal" data-bs-target=".modal-mailbox" onclick="openMail(\''.$m['id'].'\')">'.lang('Input.readed').'</button>';
                } else {
                    $action = '<button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target=".modal-mailbox" onclick="openMail(\''.$m['id'].'\')">'.lang('Input.read').'</button>';
                }
                $date = Time::parse(date('Y-m-d H:i:s', strtotime($m['createDate'])));
                $created = $date->toDateTimeString();

                $row = [];
                $row[] = $created;
                $row[] = $m['title'];
                $row[] =$action;
                $data[] = $row;
            endforeach;
            echo json_encode(['data'=>$data]);
        else:
            echo json_encode(['no data']);
        endif;
    }

    public function checkMailList()
    {
        if( !session()->get('logged_in') ): return false; endif;

        $payload = [
            'userid' => $_SESSION['token']
        ];

        $res = $this->mail_model->selectAllMails($payload);
        echo json_encode($res);
    }

    public function readMail()
    {
        if( !session()->get('logged_in') ): return false; endif;

        $payload = [
            'userid' => $_SESSION['token'],
            'id' => $this->request->getpost('params')['mailid']
        ];

        $res = $this->mail_model->selectMail($payload);
        echo json_encode($res);
    }

    public function editMail2True()
    {
        if( !session()->get('logged_in') ): return false; endif;

        $payload = [
            'userid' => $_SESSION['token'],
            'mailid' => $this->request->getpost('params')['mailid'],
            'read' => true
        ];

        $res = $this->mail_model->updateMail($payload);
        echo json_encode($res);
    }
}