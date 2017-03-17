<?php

use \app\tests\functional\BaseFunctionalCest;
use yii\helpers\Url;

class ManagementProductCest extends BaseFunctionalCest
{
    /**
     * @before loginAsAdmin
     * @after logout
     */
    public function seeProductsGrid(FunctionalTester $I)
    {
        $I->amOnPage(Url::toRoute('/product/management/products'));
        $I->seeResponseCodeIs(200);
        $I->see('Products');
        $I->expectTo('See products greed');
        $I->see('Title');
        $I->see('Description');
        $I->see('Status');
        $I->see('Added time');
        $I->see('Last update in');
        $I->see('TV', 'tbody td');
        $I->see('Testing GridProducts', 'tbody td');
        $I->see('in_stock', 'tbody td');
    }

    /**
     * @before loginAsAdmin
     * @after logout
     */
    public function seeProductDescription(FunctionalTester $I)
    {
        $I->amOnPage(Url::toRoute('/product/management/view?id=1'));
        $I->seeResponseCodeIs(200);
        $I->expectTo('see information about product');
        $I->see('TV', 'td');
        $I->see('Testing GridProducts', 'td');
        $I->see('in_stock', 'td');
    }

    /**
     * @before loginAsAdmin
     * @after logout
     */
    public function seeUpdateButton(FunctionalTester $I)
    {
        $I->amOnPage(Url::toRoute('/product/management/view?id=1'));
        $I->seeResponseCodeIs(200);
        $I->see('Update', 'a');
    }

    /**
     * @before loginAsAdmin
     * @after logout
     */
    public function updateProductInfoSuccess(FunctionalTester $I)
    {
        $I->amOnPage(Url::toRoute('/product/management/update?id=3'));
        $I->seeResponseCodeIs(200);
        $I->see('Update', 'button');
        $I->submitForm('#productForm', [
            'ProductForm[title]' => 'Test',
            'ProductForm[description]' => '213',
            'ProductForm[status]' => 'absent',
        ]);
        $I->expectTo('see that product info updated successful');
        $I->see('Test');
        $I->see('213');
        $I->see('absent');
    }

    /**
     * @before loginAsAdmin
     * @after logout
     */
    public function updateProductWithWrongData(FunctionalTester $I)
    {
        $I->amOnPage(Url::toRoute('/product/management/update?id=3'));
        $I->seeResponseCodeIs(200);
        $I->see('Update', 'button');
        $I->submitForm('#productForm', [
            'ProductForm[title]' => '',
            'ProductForm[description]' => '',
            'ProductForm[status]' => 'absent',
        ]);
        $I->expectTo('see validation errors');
        $I->see('Title cannot be blank.');
        $I->see('Description cannot be blank.');
    }

    /**
     * @before loginAsAdmin
     * @after logout
     */
    public function updateProductWithWrongStatus(FunctionalTester $I)
    {
        $I->amOnPage(Url::toRoute('/product/management/update?id=1'));
        $I->seeResponseCodeIs(200);
        $I->see('Update', 'button');
        $I->submitForm('#productForm', [
            'ProductForm[title]' => 'test name',
            'ProductForm[description]' => 'test',
            'ProductForm[status]' => 'active',
        ]);
        $I->expectTo('see validation errors');
        $I->see('Status is invalid.');
    }

    /**
     * @before loginAsAdmin
     */
    public function tryUpdateNotExistingProduct(FunctionalTester $I)
    {
        $I->amOnPage(Url::toRoute('/product/management/update?id=1000'));
        $I->seeResponseCodeIs(404);
    }
}

