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

        return $this->render('index', [
            'title' => 'ACID列表',
            'mydb'  => $acid,
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