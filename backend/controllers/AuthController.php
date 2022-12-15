<?php

namespace backend\controllers;

use common\models\LoginForm;
use common\models\User;
use frontend\models\SignupForm;
use yii\web\Response;

class AuthController extends Controller
{
    protected $noAuthActions = [
        'login',
        'register'
    ];

    protected $optionalAuthActions = [];

    public function actionLogin()
    {
        $request = \Yii::$app->request->post();
        $user = User::findByUsername($request['username']);
        if ($user && $user->validatePassword($request['password'])) {
            return ['success' => true, 'auth_key' => $user->getAuthKey()];
        }
        return ['success' => false];
    }

    public function actionRegister()
    {
        $model = new SignupForm();
        $model->attributes = \Yii::$app->request->post();
        if ($model->signup()) {
            return ['success' => true];
        }
        return ['success' => false, 'errors' => $model->errors];
    }

    /**
     * Logout action.
     *
     * @return Response
     */
    public function actionLogout()
    {
        \Yii::$app->user->logout();

        return $this->goHome();
    }
}