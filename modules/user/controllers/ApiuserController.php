<?php

namespace app\modules\user\controllers;


use app\modules\user\models\forms\LoginForm;
use app\modules\user\models\User;
use yii\filters\AccessControl;
use Yii;
use yii\web\Response;
use yii\rest\Controller;

class ApiuserController extends Controller
{
    /**
     * Class ProductController for Swagger
     *
     * @package app\modules\product\controllers
     */
    public $modelClass = 'app\modules\product\models\Product';

    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['LogIn','logout', 'update'],
                'rules' => [
                    [
                        'allow' => true,
                        'actions' => ['LogIn', 'update'],
                        'roles' => ['?'],
                    ],
                    [
                        'actions' => ['logout'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ]
            ],
        ];
    }

    /**
     * @SWG\Post(path="/LogIn",
     *   tags={"user"},
     *   summary="Logs user into the system",
     *   description="",
     *   operationId="loginUser",
     *   produces={"application/xml", "application/json"},
     *   @SWG\Parameter(
     *     name="email",
     *     in="formData",
     *     description="The user email for login",
     *     required=true,
     *     type="string"
     *   ),
     *   @SWG\Parameter(
     *     name="password",
     *     in="formData",
     *     description="The password for login",
     *     required=true,
     *     type="string"
     *   ),
     *   @SWG\Response(
     *     response=200,
     *     description="successful operation",
     *     @SWG\Schema(type="string"),
     *     @SWG\Header(
     *       header="X-Rate-Limit",
     *       type="integer",
     *       format="int32",
     *       description="calls per hour allowed by the user"
     *     ),
     *     @SWG\Header(
     *       header="X-Expires-After",
     *       type="string",
     *       format="date-time",
     *       description="date in UTC when token expires"
     *     )
     *   ),
     *   @SWG\Response(response=400, description="Invalid email/password supplied")
     * )
     */
    public function actionLogin()
    {
        $loginForm = new LoginForm();

        $data['LoginForm'] = Yii::$app->request->post();
        $check = 0;
        if ($loginForm->load($data) && $loginForm->validate()) {

            $user = User::findByEmail($loginForm->email);

            if (!$user || !$user->validatePassword($loginForm->password)) {
                Yii::$app->session->setFlash('danger', Yii::t('user', 'Incorrect email or password.'));
            } else {
                $user->rememberMe = $loginForm->rememberMe;
                $user->login();
                $check = 1;
                Yii::$app->response->format = Response::FORMAT_JSON;
                $items = ['data' => $check];
                return $items;
            }
        }
        Yii::$app->response->format = Response::FORMAT_JSON;
        $items = ['data' => $check];
        return $items;
    }

    /**
     * @SWG\Get(path="/logout",
     *   tags={"user"},
     *   summary="Logs out current logged in user session",
     *   description="",
     *   operationId="logoutUser",
     *   produces={"application/xml", "application/json"},
     *   parameters={},
     *   @SWG\Response(response="default", description="successful operation")
     * )
     */
    public function actionLogout()
    {
        Yii::$app->user->logout();
    }
}