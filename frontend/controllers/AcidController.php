<?php
/**
 * Created by PhpStorm.
 * User: zhaoyao
 * Date: 2017/4/5
 * Time: 17:42
 */
namespace frontend\controllers;

use Yii;
use yii\web\Controller;
use yii\data\Pagination;
use yii\web\NotFoundHttpException;
use frontend\models\Members;
use frontend\models\Acid_event;

use common\helpers\CommonHelper;
use common\helpers\Geoiprecord;
use common\helpers\Geoipdnsrecord;
use common\helpers\Geoipcity;

class AcidController extends Controller
{
    public function actionIndex()
    {

        //var_dump(1);exit;
        $query = Acid_event::find();
        $acid = $query
            //->orderBy('credit1 desc')
            ->where(['plugin_id'=>'1001'])
            //->limit(2)
            ->all();

        //var_dump($acid);exit;
        //$gi = Geoipcity::geoip_open('public/data/asset/geo/GeoIPCity.dat', GEOIP_STANDARD);
        //Geoipcity::GeoIP_record_by_addr($gi, $d['ip_src']);
        //var_dump(geoip_record_by_name('63.149.98.23'));exit;

        $geoCoordMap = ['郑州' => array(113.4668, 34.6234)]; $c = 0;
        foreach ($acid as $ac) {
            //var_dump($ac); exit;
            $res = geoip_record_by_name(@inet_ntop($ac->ip_src));
            //var_dump($res);exit;
            if(isset($res['country_code3'])  && $res['country_code3'] != "CHN"){
                //var_dump($res);
                //$res->city = $res->region=='QC'?'Quebec':$res->city; // 特殊处理 魁北克 Qu�bec
                //$res->city = $res->region=='34'?'Bogota':$res->city; // 特殊处理 圣菲波哥大 Bogot�
                $city = empty($res['city']) ? $res['country_name'] : $res['city'];//'Unknown';//$res->country_name
                $geoCoordMap[$city] = [$res['longitude'], $res['latitude']];
                $zzData[] = [
                    ['name'=>'郑州'],
                    ['name'=>$city, 'value'=>80, 'ip_src'=>@inet_ntop($ac->ip_src), 'ip_dst'=>@inet_ntop($ac->ip_dst), 'classtype'=>'zy'], //$ac->classtype
                ];
                //$tbData[] = $ac;
                if(($c++) >= 9) {
                    //var_dump($c);exit;
                    break;
                }

            }

        }
        //var_dump($geoCoordMap, $zzData); //, json_encode($tbData, true)
        //var_dump(json_encode($geoCoordMap), json_encode($zzData)); //, json_encode($tbData, true)
        //exit;

        return $this->render('index', [
            'title' => 'ACID列表',
            'mydb'  => $acid,
            'geoCoordMap'  => json_encode($geoCoordMap),
            'zzData'  => json_encode($zzData),
        ]);
    }

    public function actionPie()
    {
        $query = Members::find();
        $members = $query->where('credit1<>0')->all();

        /*for($i=0, $data=[]; $i<count($members); $i++) {
            $data[$i]['values'] = $members[$i]->credit1;
            $data[$i]['name'] = $members[$i]->username;
        }*/
        $data = []; $i = 0;
        foreach ($members as $member) {
            $data[$i]['value'] = $member->credit1;
            $data[$i++]['name'] = $member->username;
        }
        //var_dump($data, json_encode($data));exit;
        /*$data = [
            ['value'=>335, 'name'=>'直接访问'],
            ['value'=>310, 'name'=>'邮件营销'],
            ['value'=>234, 'name'=>'联盟广告'],
            ['value'=>135, 'name'=>'视频广告'],
            ['value'=>1548, 'name'=>'搜索引擎'],
        ];*/
        //var_dump(json_encode($data));exit;
        return $this->render('pie', [
            'title1' => '用户合氏币统计',
            'data'  => json_encode($data),
        ]);
    }

    /**
     * test
     */
    public function actionTest()
    {
        CommonHelper::jsonFormat('msg',['a'=>1]);
    }

    public function actionRequest()
    {
        $a = CommonHelper::ihttp_request('http://127.0.0.1/adv/frontend/web/index.php?r=acid%2Ftest');
        var_dump($a['content']);exit;
    }

    /**
     * Finds the xxx model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param string $id
     * @return Country the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {//查找 没找到抛出异常
        if (($model = Country::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}