<?php
/**
 * Created by PhpStorm.
 * User: zhaoyao
 * Date: 2017/4/5
 * Time: 17:46
 */
use yii\helpers\Html;
use yii\widgets\LinkPager;
use yii\grid\GridView;
//use yii\jui\DatePicker;

$this->title = Html::encode($title);
$this->params['breadcrumbs'][] = $this->title;
?>
    <h1><?= Html::encode($title) ?></h1>
    <table class="table">
        <tr>
            <th>用户名</th>
            <th>合氏币</th>
            <th>积分</th>
            <th>操作</th>
        </tr>
        <?php foreach ($mydb as $item): ?>
            <tr>
                <td><?= Html::encode("{$item->username}") ?></td>
                <td><?= $item->credit1 ?></td>
                <td><?= $item->credit2 ?></td>
                <td>
                    <?= Html::a('', ['edit', 'uid' => $item->uid], ['class' => 'glyphicon glyphicon-pencil'])?> |
                    <?= Html::a('', ['delete', 'uid' => $item->uid], ['class' => 'glyphicon glyphicon-trash'])?>

                </td>
            </tr>
        <?php endforeach; ?>
    </table>
    <p>
        <?= Html::a('Add Member', ['add'], ['class' => 'btn btn-info']) ?>
    </p>
    <p>
        <?= ''//DatePicker::widget(['name' => 'date']) ?>
    </p>
    <script src="/basic/web/assets/d2a16f93/jquery.js"></script>
    <?php ?>
    <script>
        //alert(1);
        $(function () {
            //alert(2);
        })
    </script>

<?= ''//LinkPager::widget(['pagination' => $pagination]) ?>