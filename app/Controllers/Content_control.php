<?php namespace App\Controllers;

use CodeIgniter\I18n\Time;

class Content_control extends BaseController
{
    /*
    SEO
    */

    public function contentSeo()
    {
        $lng = strtoupper($_SESSION['lang']);

        $payload = [
            // 'contentid' => $this->request->getpost('params')['contentid'], 
        ];
        $res = $this->content_model->selectAllContents($payload);
        // echo json_encode($res);

        if( $res['code'] == 1 && $res['data'] != [] ):
            $data = [];
            foreach( $res['data'] as $c ):
                $verify = substr($c['contentId'],0,3);
                if( $verify=='SEO' && $c['status']==true ):
                    $row = [];
                    $row['id'] = base64_encode($c['id']);
                    $row['contentId'] = $c['contentId'];
                    $row['title'] = $c['title'][$lng];
                    $row['image'] = $c['thumbnail'][$lng];
                    $row['content'] = $c['content'][$lng];
                    $data[] = $row;
                endif;
            endforeach;
            echo json_encode([
                'code' => $res['code'],
                'message' => $res['message'],
                'data' => $data
            ]);
        else:
            echo json_encode([
                'code' => $res['code'],
                'message' => $res['message'],
                'data' => []
            ]);
        endif;
    }

    /*
    News
    */
    public function contentNews()
    {
        $data['session'] = session()->get('logged_in') ? true : false;
        
        $lng = strtoupper($_SESSION['lang']);

        $payload = [
            // 'contentid' => $this->request->getpost('params')['contentid'], 
        ];
        $res = $this->content_model->selectAllContents($payload);
        // echo json_encode($res);
        $newscard = '';

        //AV content
        $newscard .= '<li class="col-xl-2 col-lg-2 col-md-3 col-6">';
        if( $data['session']==true ):
            $newscard .= '<a class="d-block text-decoration-none" href="javascript:void(0);" data-bs-toggle="modal" data-bs-target=".modal-AVnewsBox">';
        else:
            $newscard .= '<a class="d-block text-decoration-none" href="javascript:void(0);" onclick="alertToast(\'bg-light\', \''.lang('Validation.loginaccount').'\');">';
        endif;
        $newscard .= '<img class="d-block w-100 rounded-4" src="'.$_ENV['exGameRules'].'/av_news.png">';
        $newscard .= '</a>';
        $newscard .= '</li>';

        //Food delivery
        //$newscard .= '<li class="col-xl-2 col-lg-2 col-md-3 col-6">';
        //$newscard .= '<a class="d-block text-decoration-none" target="_blank" href="https://m.2hungry.app?channel=Vworld">';
        //$newscard .= '<img class="d-block w-100 rounded-4" src="'.$_ENV['exGameRules'].'/food_delivery.png">';
        //$newscard .= '</a>';
        //$newscard .= '</li>';

        if( $res['code'] == 1 && $res['data'] != [] ):
            foreach( $res['data'] as $c ):
                $verify = substr($c['contentId'],0,4);
                if( $verify=='NEWS' && $c['status']==true ):
                    $newscard .= '<li class="col-xl-2 col-lg-2 col-md-3 col-6">';
                    $newscard .= '<a class="d-block text-decoration-none" href="javascript:void(0);" onclick="newsReview(\''.base64_encode($c['id']).'\');">';
                    $newscard .= '<img class="d-block w-100 rounded-4" src="'.$c['thumbnail'][$lng].'">';
                    $newscard .= '</a>';
                    $newscard .= '</li>';
                endif;
            endforeach;
        endif;
        echo $newscard;
    }

    public function getNewsContent()
    {
        $lng = strtoupper($_SESSION['lang']);

        $payload = [
            'id' => base64_decode($this->request->getpost('params')['id']), 
        ];
        $res = $this->content_model->selectContent($payload);
        // echo json_encode($res);

        if( $res['code'] == 1 && $res['data'] != [] ):
            foreach( $res['data'] as $c ):
                $row = [];
                $row['contentId'] = $c['contentId'];
                $row['title'] = $c['title'][$lng];
                $row['image'] = $c['thumbnail'][$lng];
                $row['content'] = $c['content'][$lng];
            endforeach;
            echo json_encode([
                'code' => $res['code'],
                'message' => $res['message'],
                'data' => $row
            ]);
        else:
            echo json_encode($res);
        endif;
    }


    /*
    Affiliate LossRebate
    */

    public function contentAffiliateLossRebate()
    {
        $lng = strtoupper($_SESSION['lang']);

        $payload = [
            // 'contentid' => $this->request->getpost('params')['contentid'], 
        ];
        $res = $this->content_model->selectAllContents($payload);
        // echo json_encode($res);

        if( $res['code'] == 1 && $res['data'] != [] ):
            $data = [];
            foreach( $res['data'] as $c ):
                $verify = substr($c['contentId'],0,5);
                if( $verify=='AFFLB' && $c['status']==true ):
                    $row = [];
                    $row['id'] = base64_encode($c['id']);
                    $row['contentId'] = $c['contentId'];
                    $row['title'] = $c['title'][$lng];
                    $row['image'] = $c['thumbnail'][$lng];
                    $row['content'] = $c['content'][$lng];
                    $data[] = $row;
                endif;
            endforeach;
            echo json_encode([
                'code' => $res['code'],
                'message' => $res['message'],
                'data' => $data
            ]);
        else:
            echo json_encode(['no data']);
        endif;
    }

    /*
    Affiliate LossRebate
    */

    public function contentAffiliate()
    {
        $lng = strtoupper($_SESSION['lang']);

        $payload = [
            // 'contentid' => $this->request->getpost('params')['contentid'], 
        ];
        $res = $this->content_model->selectAllContents($payload);
        // echo json_encode($res);

        if( $res['code'] == 1 && $res['data'] != [] ):
            $data = [];
            foreach( $res['data'] as $c ):
                $verify = substr($c['contentId'],0,3);
                if( $verify=='AFF' && $c['status']==true ):
                    $row = [];
                    $row['id'] = base64_encode($c['id']);
                    $row['contentId'] = $c['contentId'];
                    $row['title'] = $c['title'][$lng];
                    $row['image'] = $c['thumbnail'][$lng];
                    $row['content'] = $c['content'][$lng];
                    $data[] = $row;
                endif;
            endforeach;
            echo json_encode([
                'code' => $res['code'],
                'message' => $res['message'],
                'data' => $data
            ]);
        else:
            echo json_encode(['no data']);
        endif;
    }

    /*
    Content
    */

    public function getPromoContent()
    {
        $lng = strtoupper($_SESSION['lang']);

        $payload = [
            'id' => base64_decode($this->request->getpost('params')['id']), 
        ];
        $res = $this->content_model->selectContent($payload);
        // echo json_encode($res);

        if( $res['code'] == 1 && $res['data'] != [] ):
            foreach( $res['data'] as $c ):
                $row = [];
                $row['contentId'] = $c['contentId'];
                $row['title'] = $c['title'][$lng];
                $row['image'] = $c['thumbnail'][$lng];
                $row['content'] = $c['content'][$lng];
            endforeach;
            echo json_encode([
                'code' => $res['code'],
                'message' => $res['message'],
                'data' => $row
            ]);
        else:
            echo json_encode($res);
        endif;
    }

    public function getPromoContentList()
    {
        $lng = strtoupper($_SESSION['lang']);

        $payload = [
            // 'contentid' => $this->request->getpost('params')['contentid'], 
        ];
        $res = $this->content_model->selectAllContents($payload);
        // echo json_encode($res);

        if( $res['code'] == 1 && $res['data'] != [] ):
            $data = [];
            foreach( $res['data'] as $c ):
                $verify = substr($c['contentId'],0,3);
                if( $verify=='PRO' ):
                    $row = [];
                    $row['contentId'] = $c['contentId'];
                    $row['title'] = $c['title'][$lng];
                    $row['image'] = $c['thumbnail'][$lng];
                    $row['content'] = $c['content'][$lng];
                    $data[] = $row;
                endif;
            endforeach;
            echo json_encode([
                'code' => $res['code'],
                'message' => $res['message'],
                'data' => $data
            ]);
        else:
            echo json_encode(['no data']);
        endif;
    }
}