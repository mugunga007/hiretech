<?php
/**
 * Created by PhpStorm.
 * User: shema
 * Date: 2019/05/09
 * Time: 23:05
 */

use common\models\User;
?>
<?php
$user = new User();
?>
<div class="notifications">
<h4><b> <i class="fa fa-envelope-open-text"></i> :</b> <?=ucfirst($model->message)?></h4>
<p><b> <i class="fa fa-user"></i> From:</b> <?=$user->getUserByEmail($model->from_email)->provider->names?></p>
<small class=""> <b><i class="fa fa-check-circle"></i> time:</b> <?=$model->time?></small>
</div>
