<?php

namespace app\modules\product\models;

use Yii;
use yii\web\Cookie;
use yii\web\NotFoundHttpException;


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

    public function addInCart($idPost)
    {
        $cookies = Yii::$app->request->cookies;
        $products = $cookies->getValue('order', []);
        if(in_array($idPost, $products )) {
            $checkForAdd = 0;
        } else {
            array_push($products, $idPost);
            $checkForAdd = 1;
        }
        Cart::createCookie($products);

        return $checkForAdd;

    }

    public function deleteProduct($idPost)
    {
        $cookies = Yii::$app->request->cookies;
        $products = $cookies->getValue('order', []);
        $productsDeleted = array_flip($products);
        unset($productsDeleted[$idPost]);
        $products = array_flip($productsDeleted);

        Cart::createCookie($products);
        $order = Product::getInfoProductForOrder($products);
        return $order;
    }

    public function createCookie($products =[])
    {
        $cookies = Yii::$app->response->cookies;
        $cookies->add(new Cookie([
            'name' => 'order',
            'value' => $products,
        ]));
        return $cookies;
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