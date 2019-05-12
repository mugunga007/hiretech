<?php
/**
 * Created by PhpStorm.
 * User: shema
 * Date: 2019/05/09
 * Time: 22:40
 */
use yii\grid\GridView;
use yii\widgets\Pjax;
use yii\helpers\Html;
use yii\widgets\ListView;
?>

<?=$this->render('seekerdashlayout')?>

<div class="row">

    <div class="col-md-2">

    </div>

    <div class="col-md-8">

      <?=ListView::widget([
          'dataProvider'=>$model,
          'itemView'=> '_notifications_list',
         // 'emptyText'=>'No notification to show'
      ])?>

    </div>

    <div class="col-md-2">
    </div>

</div>