<?php

use \app\modules\product\models\Cart;

class CartTest extends \Codeception\Test\Unit
{
    /**
     * @var \UnitTester
     */
    protected $tester;

    public function testAddContent()
    {
        $product = new Cart();
        $idPost = 2;
        $product->add($idPost);
        $this->assertNotEmpty($product);
    }
}