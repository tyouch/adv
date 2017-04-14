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

class TestController extends Controller
{
    public function actionIndex()
    {

        $query = Members::find();
        $mydb = $query
            //->orderBy('credit1 desc')
            //->limit(4)
            ->all();

        //var_dump($mydb);exit;

        return $this->render('index', [
            'title' => '成员列表',
            'mydb'  => $mydb,
        ]);
    }

    public function actionAdd()
    {
        $model = new Members();
        //var_dump('add');exit;
        //var_dump(Yii::$app->request->post());exit;



        if ($model->load(Yii::$app->request->post()) && $model->save()) {

            return $this->redirect(['index', 'id' => $model->uid]);

        } else {

            return $this->render('add', [
                'title' => '添加成员',
                'model' => $model,
            ]);
        }
    }

    public function actionEdit($uid)
    {
        //var_dump(1); exit;
        $model = Members::findOne($uid);
        //var_dump($model); exit;

        if ($model->load(Yii::$app->request->post()) && $model->save()) {

            return $this->redirect(['index', 'id' => $model->uid]);

        } else {

            return $this->render('add', [
                'title' => '编辑成员',
                'model' => $model,
            ]);
        }
    }

    public function actionDelete($uid)
    {
        //var_dump(123);exit;
        $model = Members::findOne($uid);
        $model->delete();

        return $this->redirect(['index']);
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