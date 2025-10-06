<?php namespace App\Models;

use CodeIgniter\Model;

class Sms_model extends Model
{
    protected $sms = 'http://10.148.0.10:8961/sms/sendsms';

    protected $whatsapp = 'https://verifyme.asia/api/create-message';

    public function __construct()
	{
		$this->db = db_connect();
	}

    public function insertWhatsapp($where)
	{       
        $ch = curl_init();
        curl_setopt_array($ch, array(
            CURLOPT_URL => $this->whatsapp,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'POST',
            CURLOPT_POSTFIELDS => array(
                'appkey' => '3e70d255-adcf-453a-b8ff-adfe1215fd98',
                'authkey' => 'k4dSND94XOt4CvqcETRkaum8LaVPd5upmRWMp6hkQK3pblbcOk',
                'to' => $where['to'],
                'message' => $where['message'],
                'sandbox' => 'false'
            ),
          ));

        $response = curl_exec($ch);
        $err = curl_error($ch);
        curl_close($ch);

        return json_decode($response, true);
    }

    public function insertSms($where)
	{
		$data = array_merge(['lang'=>$_SESSION['lang'], 'agentid'=>$_ENV['host']], $where);
		$payload = json_encode($data);
        
        $ch = curl_init($this->sms);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 30);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $payload);
        curl_setopt($ch, CURLINFO_HEADER_OUT, 1);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array(
            'Content-Type: application/json',
            'Content-Length: ' . strlen($payload))
        );
        $response = curl_exec($ch);
        $err = curl_error($ch);
        curl_close($ch);

        return json_decode($response, true);
    }
}