<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\modules\admin\models\Language */

$this->title = Yii::t('app', 'Update {modelClass}: ', [
    'modelClass' => 'Language',
]) . ' ' . $model->value;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Languages'), 'url' => ['index']];
//$this->params['breadcrumbs'][] = ['label' => $model->value, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = Yii::t('app', 'Update');
?>
<div class="language-update">

    <h3><?= Html::encode($this->title) ?></h3>

    <?= $this->render('_file', [
        'model' => $model,
        'file'=>$file
    ]) ?>

</div>
