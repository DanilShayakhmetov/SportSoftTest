<?php

use yii\grid\GridView;
use yii\helpers\Html;
use yii\widgets\ActiveForm;
?>

<?= GridView::widget([
    'dataProvider' => $dataProvider,
    'columns' => [
            'id',
            'name',
            'sur_name',
            'phone_number',
            'email',
            'text_message'
    ],
]); ?>
