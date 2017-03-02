<?php

namespace app\modules\product\controllers;

use app\modules\product\models\forms\AddProductForm;
use app\modules\product\models\forms\EnteredForm;
use app\modules\product\models\forms\ProductForm;
use app\modules\product\models\InfoSearch;
use app\modules\product\models\Product;
use app\modules\product\models\ProductSearch;
use app\modules\product\models\ProductsStorages;
use app\modules\user\models\User;
use yii\base\Exception;
use yii\filters\AccessControl;
use Yii;
use yii\helpers\Url;
use yii\web\Controller;
use yii\web\NotFoundHttpException;


class ManagementController extends Controller
{
    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['index', 'view', 'add', 'update', 'products', 'entered'],
                'rules' => [
                    [
                        'actions' => ['index', 'view', 'add', 'update', 'products', 'entered'],
                        'allow' => true,
                        'roles' => [User::ROLE_ADMIN],
                    ],
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
            'upload-avatar' => [
                'class' => 'app\widgets\crop\actions\CropAction',
                'url' => '/uploads/avatars',
                'path' => '@app/web/uploads/avatars',
            ],
        ];
    }

    /**
     * Lists all Products with mainInfo models.
     *
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new InfoSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Lists all Products models.
     *
     * @return mixed
     */
    public function actionProducts()
    {
        $searchModel = new ProductSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('products', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
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
     * Add new Product.
     * @return mixed
     * @throws Exception
     */
    public function actionAdd()
    {
        $addForm = new AddProductForm();

        if ($addForm->load(Yii::$app->request->post()) && $addForm->validate()) {
            $product = new Product();

            if (!$product = $product->create($addForm)) {
                throw new Exception('Product could not be created.');
            }
            return $this->redirect(Url::to(['products']));
        }

        return $this->render('add', [
            'model' => $addForm,
        ]);
    }

    /**
     * Add new entered products in storage.
     * @return mixed
     * @throws Exception
     */
    public function actionEntered()
    {
        $addForm = new EnteredForm();

        if ($addForm->load(Yii::$app->request->post()) && $addForm->validate()) {
            $productstorages = new ProductsStorages();

            if (!$productstorages = $productstorages->create($addForm)) {
                throw new Exception('Entered could not be created.');
            }
            return $this->redirect('index');
        }

        return $this->render('entered', [
            'model' => $addForm,
        ]);
    }

    /**
     * Update Product model.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $product = $this->findModel($id);
        $productForm = new ProductForm();
        $productForm->setAttributes($product->attributes);

        if ($productForm->load(Yii::$app->request->post()) && $productForm->validate()) {
            $product->setAttributes($productForm->attributes);
            $product->update(false);


            Yii::$app->getSession()->setFlash('success', Yii::t('product', 'Information saved.'));
            return $this->redirect(['view', 'id' => $product->id]);
        }

        return $this->render('update', [
            'productForm' => $productForm,
            'id' => $product->id,
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
