<?php

namespace app\modules\product\models;

use Yii;
use yii\web\Cookie;


class Cart
{
    /**
     * Checks for such content in the cart.
     * @param integer $idPost
     * @return bool
     */
    public function add($idPost)
    {
        $content = Cart::getContentsRepository();

        $checkForAdd = 0;
        if (!in_array($idPost, $content )) {
            array_push($content, $idPost);
            $checkForAdd = 1;
        }
        Cart::createRepository($content);

        return $checkForAdd;

    }

    /**
     * Delete content from the repository.
     * @param integer $idPost
     * @return mixed
     */
    public function delete($idPost)
    {
        $content = Cart::getContentsRepository();

        $contentDeleted = array_flip($content);
        unset($contentDeleted[$idPost]);
        $content = array_flip($contentDeleted);

        Cart::createRepository($content);
        $order = Product::getInfoProductForOrder($content);
        return $order;
    }

    /**
     * Create repository for data storage.
     * @param array $content
     * @return mixed
     */
    private static function createRepository($content =[])
    {
        $repository = Yii::$app->response->cookies;
        $repository->add(new Cookie([
            'name' => 'order',
            'value' => $content,
        ]));
        return $repository;
    }

    /**
     * Get content from the repository.
     *
     */
    public static function getContentsRepository()
    {
        $cookies = Yii::$app->request->cookies;
        $content = $cookies->getValue('order', []);
        return $content;
    }
}