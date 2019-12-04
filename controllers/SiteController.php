<?php

namespace app\controllers;

use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\Response;
use yii\filters\VerbFilter;
use app\models\LoginForm;
use app\models\ContactForm;
use app\models\Task;

class SiteController extends Controller
{
    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['logout'],
                'rules' => [
                    [
                        'actions' => ['logout'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'logout' => ['post'],
                ],
            ],
        ];
    }

    /**
     * @inheritdoc
     */
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

    /**
     * Displays homepage.
     *
     * @return string
     */
    public function actionIndex()
    {
        $tasksClm1 = Task::find()->where(['column_id' => 1])->orderBy('position')->all();
        $tasksClm2 = Task::find()->where(['column_id' => 2])->orderBy('position')->all();
        $tasksClm3 = Task::find()->where(['column_id' => 3])->orderBy('position')->all();

        $taskbyId1 = [];
        foreach ($tasksClm1 as $task) {
            $taskbyId1[$task->id] = [
                'content' => 'ID: ' . $task->id . ' - ' . $task->task_name,
                'options' => [
                    'class' => 'task',
                    'data' => [
                        'task-value' => $task->id,
                    ]
                ]
            ];
        }

        $taskbyId2 = [];
        foreach ($tasksClm2 as $task) {
            $taskbyId2[$task->id] = [
                'content' => 'ID: ' . $task->id . ' - ' . $task->task_name,
                'options' => [
                    'class' => 'task',
                    'data' => [
                        'task-value' => $task->id,
                    ]
                ]
            ];
        }

        $taskbyId3 = [];
        foreach ($tasksClm3 as $task) {
            $taskbyId3[$task->id] = [
                'content' => 'ID: ' . $task->id . ' - ' . $task->task_name,
                'options' => [
                    'class' => 'task',
                    'data' => [
                        'task-value' => $task->id,
                    ]
                ]
            ];
        }
        return $this->render('index', [
            'taskbyId1' => $taskbyId1,
            'taskbyId2' => $taskbyId2,
            'taskbyId3' => $taskbyId3,
        ]);
    }

    /**
     * Login action.
     *
     * @return Response|string
     */
    public function actionLogin()
    {
        if (!Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        $model = new LoginForm();
        if ($model->load(Yii::$app->request->post()) && $model->login()) {
            return $this->goBack();
        }
        return $this->render('login', [
            'model' => $model,
        ]);
    }

    /**
     * Logout action.
     *
     * @return Response
     */
    public function actionLogout()
    {
        Yii::$app->user->logout();

        return $this->goHome();
    }

    /**
     * Displays contact page.
     *
     * @return Response|string
     */
    public function actionContact()
    {
        $model = new ContactForm();
        if ($model->load(Yii::$app->request->post()) && $model->contact(Yii::$app->params['adminEmail'])) {
            Yii::$app->session->setFlash('contactFormSubmitted');

            return $this->refresh();
        }
        return $this->render('contact', [
            'model' => $model,
        ]);
    }

    /**
     * Displays about page.
     *
     * @return string
     */
    public function actionAbout()
    {
        return $this->render('about');
    }
}
