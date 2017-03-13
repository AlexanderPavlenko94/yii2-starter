<?php

namespace app\modules\product\controllers;

use app\modules\product\models\forms\AddProductForm;
use app\modules\product\models\Product;
use yii\base\Exception;
use yii\filters\AccessControl;
use yii\rest\Controller;
use yii\web\NotFoundHttpException;
use Yii;
use yii\web\Response;

/**
 * Class SwaggerController
 *
 * @package app\modules\product\controllers
 */
class SwaggerController extends Controller
{
    public $modelClass = 'app\modules\product\models\Product';

    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'rules' => [
                    [
                        'allow' => true,
                        'actions' => ['get','create', 'update'],
                        'roles' => ['@'],
                    ],
                ]
            ],
        ];
    }

    /**
     * @SWG\Get(
     *     path="/get/{id}",
     *     summary="Find product by ID",
     *     description="Returns information about single product",
     *     operationId="getProductById",
     *     tags={"product"},
     *     produces={"application/xml", "application/json"},
     *     @SWG\Parameter(
     *         description="ID of product to return",
     *         in="path",
     *         name="id",
     *         required=true,
     *         type="integer",
     *         format="int64"
     *     ),
     *     @SWG\Response(
     *         response=200,
     *         description="successful operation",
     *         @SWG\Schema(
     *                    @SWG\Property(
     *                      property="id",
     *                      type="integer"
     *                  ),
     *                  @SWG\Property(
     *                      property="title",
     *                      type="string"
     *                  ),
     *                  @SWG\Property(
     *                      property="description",
     *                      type="string"
     *                  ),
     * )
     *     ),
     *     @SWG\Response(
     *         response="400",
     *         description="Invalid ID supplied"
     *     ),
     *     @SWG\Response(
     *         response="404",
     *         description="Product not found"
     *     ),
     *     security={
     *       {"api_key": {}}
     *     }
     * )
     */
    public function actionGet($id)
    {
        $model = Product::findOne($id);
        if (null === $model) {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
        Yii::$app->response->format = Response::FORMAT_JSON;
        $items = ['data' => $model];
        return $items;
    }

    /**
     * @SWG\Post(
     *     path="/create",
     *     tags={"product"},
     *     operationId="addProduct",
     *     summary="Add a new product ",
     *     description="",
     *     consumes={"application/json", "application/xml"},
     *     produces={"application/xml", "application/json"},
     *     @SWG\Parameter(
     *         name="title",
     *         in="formData",
     *         description="Title product",
     *         required=true,
     *         type="string"
     *     ),
     *      @SWG\Parameter(
     *         name="description",
     *         in="formData",
     *         description="Description product",
     *         required=true,
     *         type="string"
     *     ),
     *     @SWG\Response(
     *         response=405,
     *         description="Invalid input",
     *     ),
     *      security={
     *       {"api_key": {}}
     *     }
     * )
     */
    public function actionCreate()
    {
        $addForm = new AddProductForm();
        $date['AddProductForm'] = Yii::$app->request->post();

        if ($addForm->load($date) && $addForm->validate()) {
            $product = new Product();

            if (!$product = $product->create($addForm)) {
                throw new Exception('Product could not be created.');
            }
        }

        Yii::$app->response->format = Response::FORMAT_JSON;
        $items = ['data' => $addForm];
        return $items;
    }


    /**
     * @SWG\Post(
     *   path="/update/{id}",
     *   tags={"product"},
     *   summary="Updates a product in the store with form data",
     *   description="",
     *   operationId="updateProductWithForm",
     *   consumes={"application/x-www-form-urlencoded"},
     *   produces={"application/xml", "application/json"},
     *   @SWG\Parameter(
     *     name="Id",
     *     in="path",
     *     description="ID of product that needs to be updated",
     *     required=true,
     *     type="integer",
     *     format="int64"
     *   ),
     *   @SWG\Parameter(
     *     name="title",
     *     in="formData",
     *     description="Updated title of the product",
     *     required=false,
     *     type="string"
     *   ),
     *   @SWG\Parameter(
     *     name="description",
     *     in="formData",
     *     description="Updated description of the product",
     *     required=false,
     *     type="string"
     *   ),
     *   @SWG\Response(response="405",description="Invalid input"),
     * )
     */
    public function actionUpdate($id)
    {
        $product = $this->findModel($id);
        $addForm = new AddProductForm();
        $date['AddProductForm'] = Yii::$app->request->post();

        if ($addForm->load($date) && $addForm->validate()) {
            $product->setAttributes($addForm->attributes);
            $product->update(false);

            if (!$product = $product->create($addForm)) {
                throw new Exception('Product could not be created.');
            }
        }

        Yii::$app->response->format = Response::FORMAT_JSON;
        $items = ['data' => $addForm];
        return $items;
    }

    /**
     * Finds the Product model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     *
     * @param integer $id
     * @return Product the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        $model = Product::findOne($id);
        if (null === $model) {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
        return $model;
    }

}
