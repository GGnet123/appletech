<?php

namespace backend\controllers;

use yii\filters\AccessControl;
use yii\filters\auth\CompositeAuth;
use yii\filters\auth\HttpBearerAuth;
use yii\helpers\ArrayHelper;

class Controller extends \yii\web\Controller
{
    protected $optionalAuthActions = [];
    protected $noAuthActions = [];
    public function init()
    {
        $this->enableCsrfValidation = false;
    }

    public function behaviors()
    {
        $behaviors = parent::behaviors();

        $behaviors['authenticator'] = [
            'class' => CompositeAuth::className(),
            'except' => $this->noAuthActions,
            'optional' => $this->optionalAuthActions,
            'authMethods' => [
                HttpBearerAuth::className(),
            ],
        ];

        $behaviors['accesscontrol'] = [
            'class' => AccessControl::className(),
            'except' => ArrayHelper::merge(['error', 'login'], $this->noAuthActions),
            'rules' => [
                [
                    'allow' => true,
                    'roles' => ['@'],
                ],
                [
                    'allow' => true,
                    'roles' => ['?'],
                    'actions' => $this->optionalAuthActions
                ]
            ]
        ];

        return $behaviors;
    }

    /**
     * {@inheritdoc}
     */
    public function actions()
    {
        return [
            'error' => [
                'class' => \yii\web\ErrorAction::class,
            ],
        ];
    }
}