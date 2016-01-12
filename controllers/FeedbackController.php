<?php

namespace app\controllers;

use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\filters\VerbFilter;
use app\models\LoginForm;
use app\models\FeedbackForm;
use app\models\Feedback;
use yii\web\NotFoundHttpException;
use yii\web\UploadedFile;

class FeedbackController extends Controller
{
    public $defaultAction = 'form';

    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
            'captcha' => [
                'class' => 'yii\captcha\CaptchaAction',
                'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : null,
            ],
        ];
    }

    public function actionForm()
    {
        if (!\Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        $model = new FeedbackForm();
        if (Yii::$app->request->isPost) {
            $model->load(Yii::$app->request->post());
            $model->file = UploadedFile::getInstance($model, 'file');

            if ($model->file && $model->validate()) {
                $file_data = $model->upload();

                $feedback = new Feedback();
                $feedback->fileData = $file_data;
                $feedback->subject = $model->subject;
                $feedback->body = $model->body;

                if ($feedback->save()) {
                    Yii::$app->session->setFlash('contactFormSubmitted');
                    return $this->redirect(['feedback/view', 'id' => $feedback->id]);
                }
            }
        }

        return $this->render('form', [
            'model' => $model,
        ]);
    }

    public function actionView($id)
    {
        $feedback = Feedback::find()
                            ->where(['id' => $id])
                            ->one();
        if (!$feedback) {
            throw new NotFoundHttpException('Feedback not found');
        }
        return $this->render('view', [
            'feedback' => $feedback,
        ]);
    }
//
//    public function actionContact()
//    {
//        $model = new ContactForm();
//        if ($model->load(Yii::$app->request->post()) && $model->contact(Yii::$app->params['adminEmail'])) {
//            Yii::$app->session->setFlash('contactFormSubmitted');
//
//            return $this->refresh();
//        }
//        return $this->render('contact', [
//            'model' => $model,
//        ]);
//    }
//
//    public function actionAbout()
//    {
//        return $this->render('about');
//    }
}
