<?php

namespace app\modules\product\models;

use Yii;
use yii\web\Cookie;
use yii\web\NotFoundHttpException;
use yii\web\Response;

/**
 * @property integer $id
 * @property string $title
 * @property string $description
 * @property string $picture
 * @property string $status
 * @property string $created_at
 * @property string $update_at
 * @property string $deleted
 */
class Cart
{

    public function addInCart()
    {
        $idPost = Yii::$app->request->post('id');
        $cookies = Yii::$app->request->cookies;
        $products = $cookies->getValue('order', []);
        if(in_array($this->findModel($idPost)->id, $products )) {
            $test = 0;
        } else {
            array_push($products, $this->findModel($idPost)->id);
            $test = 1;
            Yii::$app->getSession()->setFlash('success', Yii::t('product', 'Product added in your cart.'));
        }

        $cookies = Yii::$app->response->cookies;
        $cookies->add(new Cookie([
            'name' => 'order',
            'value' => $products,
        ]));

        Yii::$app->response->format = Response::FORMAT_JSON;
        $items = ['data' => $test, 'products' =>$products];
        return $items;
    }

    public function deleteProduct()
    {
        $idPost = Yii::$app->request->post('id');
        $cookies = Yii::$app->request->cookies;
        $products = $cookies->getValue('order', []);
        $productsDeleted = array_flip($products);
        unset($productsDeleted[$idPost]);
        $products = array_flip($productsDeleted);

        $cookies = Yii::$app->response->cookies;
        $cookies->add(new Cookie([
            'name' => 'order',
            'value' => $products,
        ]));
        $query = Product::find();
        $query->select(['products.id', 'products.title', 'products.description', 'products.picture'])
            ->from('products')->where([ 'products.id' => $products]);
        $order = $query->all();
        return $order;
    }

    protected function findModel($id)
    {
        $model = Product::findOne($id);
        if (null === $model) {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
        return $model;
    }
}