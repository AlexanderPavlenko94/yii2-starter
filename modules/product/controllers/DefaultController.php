<?php

namespace app\modules\product\controllers;

use app\modules\product\models\Cart;
use app\modules\product\models\CategorySearch;
use app\modules\product\models\forms\SearchForm;
use app\modules\product\models\Product;
use yii\data\Pagination;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\Cookie;
use yii\web\NotFoundHttpException;
use Yii;
use yii\web\Response;

/**
 * Class DefaultController
 *
 * @package app\modules\product\controllers
 */
class DefaultController extends Controller
{
    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'rules' => [
                    [
                        'allow' => true,
                        'actions' => ['update', 'view', 'index', 'cart', 'add', 'delete'],
                        'roles' => ['@'],
                    ],
                ]
            ],
        ];
    }

    /**
     * Lists all Products models.
     *
     * @return mixed
     */
    public function actionIndex()
    {

        $categoriesObjectsParams = CategorySearch::getCategoriesObjectsParams();
        $filterParams = $categoriesObjectsParams;

        $formModel =  new SearchForm();
        $searchParams = [];
        if ($formModel->load(Yii::$app->request->post()) && $formModel->validate()) {
            $searchParams = Yii::$app->request->post('SearchForm');
            $filterParams = $searchParams['items'];
        }

        $productQuery = Product::getProductCategoriesQuery($searchParams);
        $categoriesQuery = CategorySearch::find();

        $pagination = new Pagination(['totalCount' =>$productQuery->count(), 'PageSize' => Yii::$app->params['userView']['productsPrePage']]);
        $pagination->pageSizeParam = false;
        $modelsProduct = $productQuery->offset($pagination->offset)
            ->limit($pagination->limit)
            ->all();
        $modelsCategory =$categoriesQuery->all();

        $cookies = Yii::$app->request->cookies;
        $products = $cookies->getValue('order', []);

        return $this->render('index', [
            'formModel' => $formModel,
            'searchModels' => $modelsProduct,
            'pagination' => $pagination,
            'categoriesModels' => $modelsCategory,
            'filterParams' => $filterParams,
            'products' => $products,
        ]);
    }

    /**
     * View an existing Product model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * View an existing userCart with added products.
     * @return mixed
     */

    public function actionAdd()
    {
        $cookies = new Cart();
        return $cookies->addInCart();

    }

    public function actionDelete()
    {
       $cookies = new Cart();
        return $this->render('cart', [
            'model' => $cookies->deleteProduct(),
        ]);
    }

    public function actionCart()
    {

        $cookies = Yii::$app->request->cookies;
        $products = $cookies->getValue('order', []);
        $query = Product::find();
        $query->select(['products.id', 'products.title', 'products.description', 'products.picture'])
            ->from('products')->where([ 'products.id' => $products]);
        $order = $query->all();
        return $this->render('cart', [
            'model' => $order,
        ]);
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
