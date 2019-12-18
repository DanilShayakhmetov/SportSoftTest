<?php

namespace backend\controllers;
use frontend\models\ContactForm;
use Yii;
use yii\data\ArrayDataProvider;
use yii\db\Query;


class FeedbackController extends \yii\web\Controller
{
    public function actionAll()
    {

        $feedbackMessages = (new Query())
            ->select(['id',
                'name',
                'sur_name',
                'phone_number',
                'email',
                'text_message'])
            ->from('contact')
            ->all();
        $dataProvider = new ArrayDataProvider([
            'allModels' => $feedbackMessages,
            'sort'=>['attributes'=>['id','name','sur_name','email','text_message','phone_number']]]);

        return $this->render('index', [
            'dataProvider' => $dataProvider
        ]);
    }


    public function actionUserdata()
    {
        if (!Yii::$app->user->isGuest) {
            $feedbackMessages = (new Query())
                ->select(['id',
                    'name',
                    'sur_name',
                    'phone_number',
                    'email',
                    'text_message',
                    'user_id'])
                ->from('contact')
                ->where(['user_id' =>Yii::$app->user->getId()])
                ->all();

            $dataProvider = new ArrayDataProvider([
                'allModels' => $feedbackMessages,
                'sort'=>['attributes'=>['id','name','sur_name','email','text_message','phone_number']]]);

            return $this->render('index', [
                'dataProvider' => $dataProvider
            ]);
        }
    }

}
