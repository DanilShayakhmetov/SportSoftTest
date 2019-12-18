<?php

namespace frontend\models;

use Yii;
use yii\base\Model;

/**
 * ContactForm is the model behind the contact form.
 */
class ContactForm extends Model
{
    public $name;
    public $surName;
    public $email;
    public $phone;
    public $body;
//    public $verifyCode;
    public $reCaptcha;


    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            // name, email, subject and body are required
            [['name','surName', 'email', 'phone', 'body'], 'required'],
            // email has to be a valid email address
            ['email', 'email'],
            [['name','surName'], 'string', 'min'=> 3],
            [['body'],  'string', 'min'=> 100],
            // verifyCode needs to be entered correctly
//            ['verifyCode', 'captcha'],
            [['reCaptcha'], \himiklab\yii2\recaptcha\ReCaptchaValidator2::className(),
                'secret' => '6LdNSMgUAAAAACGag151RJgfWMGDf1lYk3hxhLr5', // unnecessary if reСaptcha is already configured
                'uncheckedMessage' => 'Please confirm that you are not a bot.'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'reCaptcha' => 'reCaptcha',
        ];
    }

    /**
     * Sends an email to the specified email address using the information collected by this model.
     *
     * @param string $email the target email address
     * @return bool whether the email was sent
     */
    public function sendEmail($email)
    {

        return Yii::$app->mailer->compose()
            ->setTo($email)
            ->setFrom([Yii::$app->params['senderEmail'] => Yii::$app->params['senderName']])
            ->setReplyTo([$this->email => $this->name])
            ->setSubject($this->phone)
            ->setTextBody($this->body)
            ->send();
    }
}
