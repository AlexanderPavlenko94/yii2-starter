<?php

namespace app\modules\product\controllers;

use app\modules\product\models\CategorySearch;
use app\modules\product\models\forms\SearchForm;
use app\modules\product\models\Product;
use yii\data\Pagination;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use Yii;

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
                        'actions' => ['update', 'view', 'index', 'cart',],
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

        return $this->render('index', [
            'formModel' => $formModel,
            'searchModels' => $modelsProduct,
            'pagination' => $pagination,
            'categoriesModels' => $modelsCategory,
            'filterParams' => $filterParams,
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
     * @param integer $id
     * @return mixed
     */
    public function actionCart($id)
    {

        $session = Yii::$app->session;
        if ($session->get('product') === null) {
            $products = [];
        } else {
            $data = $session->get('product');
            $products = $data;
        }
        array_push($products, $this->findModel($id));
        $session->set('product', $products);
        $order = $session->get('product');



        return $this->render('cart', [
            'model' =>$order,
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
