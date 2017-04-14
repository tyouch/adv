<?php
use yii\helpers\Html;
use yii\helpers\Url;

/**
 * Created by PhpStorm.
 * User: zhaoyao
 * Date: 2017/4/13
 * Time: 15:58
 */

$this->title = 'Pie';
$this->params['breadcrumbs'][] = $this->title;
?>


<?= Html::style('#main { height: 800px; }') ?>

<div class="acid-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <div id="main"></div>

</div>

<?= Html::jsFile('@web/assets/95a712d5/jquery.min.js') ?>
<?= Html::jsFile('@web/echarts/echarts.min.js') ?>
<script>

    // 1
    var myChart = echarts.init(document.getElementById('main'));

    // 2
    $(function () {
        $(window).on('resize',function(){
            // 调用相关echarts的resize方法. ** 放在echart声明之后
            myChart.resize();
        })
    });

    // 3
    option = {
        title : {
            text: '<?= Html::encode($title1) ?>',
            subtext: '纯属虚构',
            x:'center'
        },
        tooltip : {
            trigger: 'item',
            formatter: "{a} <br/>{b} : {c} ({d}%)"
        },
        legend: {
            //orient: 'vertical',
            //left: 'left',
            //data: ['直接访问','邮件营销','联盟广告','视频广告','搜索引擎']
        },
        //color:['#9bcb62','#f3a43b','#60c0de','#974da9','#b6c434','#ff8463'],
        //backgroundColor: '#323c48',
        series : [
            {
                name: '访问来源',
                type: 'pie',
                selectedMode: 'single',
                radius : '55%',
                center: ['50%', '60%'],
                data:<?= $data?>,
                /*data:[
                    {value:335, name:'直接访问'},
                    {value:310, name:'邮件营销'},
                    {value:234, name:'联盟广告'},
                    {value:135, name:'视频广告'},
                    {value:1548, name:'搜索引擎'}
                ],*/
                itemStyle: {
                    emphasis: {
                        shadowBlur: 10,
                        shadowOffsetX: 0,
                        shadowColor: 'rgba(0, 0, 0, 0.5)'
                    }
                }
            }
        ]
    };

    // 4
    myChart.setOption(option);
</script>
