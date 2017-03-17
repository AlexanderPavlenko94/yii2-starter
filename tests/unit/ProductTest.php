<?php

use \app\modules\product\models\Product;
use \app\modules\product\models\forms\AddProductForm;

class ProductTest extends \Codeception\Test\Unit
{
    /**
     * @var \UnitTester
     */
    protected $tester;

    public function testAddProduct()
    {
        $product = new Product();
        $form = new AddProductForm();
        $form->title = 'Some';
        $form->description = 'Test';

        $product = $product->create($form);
        $this->assertNotEmpty($product);
    }
}