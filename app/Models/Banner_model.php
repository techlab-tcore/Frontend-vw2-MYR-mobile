<?php namespace App\Models;

use CodeIgniter\Model;

class Banner_model extends Model
{
    protected $bannerList = 'http://10.148.0.10:8961/banner/getbannerlist';

    public function __construct()
	{
		$this->db = db_connect();
	}

    public function selectAllBanners($where)
	{
        $data = array_merge(['lang'=>$_SESSION['lang'], 'agentid'=>$_ENV['host']], $where);
		$payload = json_encode($data);
        
        $ch = curl_init($this->bannerList);
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