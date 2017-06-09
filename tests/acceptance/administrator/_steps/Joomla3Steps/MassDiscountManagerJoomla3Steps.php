<?php
/**
 * Created by PhpStorm.
 * User: nhung nguyen
 * Date: 6/8/2017
 * Time: 2:00 PM
 */

namespace AcceptanceTester;


class MassDiscountManagerJoomla3Steps extends AdminManagerJoomla3Steps
{

    public function addMassDiscount($massDiscountName, $amountValue, $discountStart, $discountEnd, $nameCategory, $nameProduct)
    {
        $I = $this;
        $I->amOnPage(\MassDiscountManagerPage::$URL);
        $I->click('New');
        $I->verifyNotices(false, $this->checkForNotices(), 'product mass discount new');
        $I->checkForPhpNoticesOrWarnings();
        $I->fillField(\MassDiscountManagerPage::$name, $massDiscountName);
        $I->fillField(\MassDiscountManagerPage::$valueAmount, $amountValue);
        $I->fillField(\MassDiscountManagerPage::$dayStart, $discountStart);
        $I->fillField(\MassDiscountManagerPage::$dayEnd, $discountEnd);

//        $I->click(['xpath' => "//div[@id='s2id_jform_manufacturer_id']//ul/li"]);
//        $I->fillField(['xpath' => "//div[@id='s2id_jform_manufacturer_id']//ul/li//input"], $nameManufacture);
//        $I->waitForElement(['xpath' => "//span[contains(text(), '" . $nameManufacture . "')]"]);
//        $I->click(['xpath' => "//span[contains(text(), '" . $nameManufacture . "')]"]);

        $I->click(['xpath' => "//div[@id='s2id_jform_category_id']//ul/li"]);
        $I->fillField(['xpath' => "//div[@id='s2id_jform_category_id']//ul/li//input"], $nameCategory);
        $I->waitForElement(['xpath' => "//span[contains(text(), '" . $nameCategory . "')]"]);
        $I->click(['xpath' => "//span[contains(text(), '" . $nameCategory . "')]"]);


        $I->click(['xpath' => "//div[@id='s2id_jform_discount_product']//ul/li"]);
        $I->fillField(['xpath' => "//div[@id='s2id_jform_discount_product']//ul/li//input"], $nameProduct);
        $I->waitForElement(['xpath' => "//span[contains(text(), '" . $nameProduct . "')]"]);
        $I->click(['xpath' => "//span[contains(text(), '" . $nameProduct . "')]"]);

        $I->click('Save');
        $I->see("Item successfully saved.", '.alert-success');
    }

    public function addMassDiscountSaveClose($massDiscountName, $amountValue, $discountStart, $discountEnd, $nameCategory, $nameProduct)
    {
        $I = $this;
        $I->amOnPage(\MassDiscountManagerPage::$URL);
        $I->click('New');
        $I->verifyNotices(false, $this->checkForNotices(), 'product mass discount new');
        $I->checkForPhpNoticesOrWarnings();
        $I->fillField(\MassDiscountManagerPage::$name, $massDiscountName);
        $I->fillField(\MassDiscountManagerPage::$valueAmount, $amountValue);
        $I->fillField(\MassDiscountManagerPage::$dayStart, $discountStart);
        $I->fillField(\MassDiscountManagerPage::$dayEnd, $discountEnd);

//        $I->click(['xpath' => "//div[@id='s2id_jform_manufacturer_id']//ul/li"]);
//        $I->fillField(['xpath' => "//div[@id='s2id_jform_manufacturer_id']//ul/li//input"], $nameManufacture);
//        $I->waitForElement(['xpath' => "//span[contains(text(), '" . $nameManufacture . "')]"]);
//        $I->click(['xpath' => "//span[contains(text(), '" . $nameManufacture . "')]"]);

        $I->click(['xpath' => "//div[@id='s2id_jform_category_id']//ul/li"]);
        $I->fillField(['xpath' => "//div[@id='s2id_jform_category_id']//ul/li//input"], $nameCategory);
        $I->waitForElement(['xpath' => "//span[contains(text(), '" . $nameCategory . "')]"]);
        $I->click(['xpath' => "//span[contains(text(), '" . $nameCategory . "')]"]);

        $I->click(['xpath' => "//div[@id='s2id_jform_discount_product']//ul/li"]);
        $I->fillField(['xpath' => "//div[@id='s2id_jform_discount_product']//ul/li//input"], $nameProduct);
        $I->waitForElement(['xpath' => "//span[contains(text(), '" . $nameProduct . "')]"]);
        $I->click(['xpath' => "//span[contains(text(), '" . $nameProduct . "')]"]);
        $I->click('Save & Close');
        $I->waitForText('Item successfully saved.', 30, ['class' => 'alert-success']);

        $I->waitForElement(\MassDiscountManagerPage::$MassDiscountFilter, 30);
    }

    public function addMassDiscountStartThanEnd($massDiscountName, $amountValue, $discountStart, $discountEnd, $nameCategory, $nameProduct)
    {
        $I = $this;
        $I->amOnPage(\MassDiscountManagerPage::$URL);
        $I->click('New');
        $I->verifyNotices(false, $this->checkForNotices(), 'product mass discount new');
        $I->checkForPhpNoticesOrWarnings();
        $I->fillField(\MassDiscountManagerPage::$name, $massDiscountName);
        $I->fillField(\MassDiscountManagerPage::$valueAmount, $amountValue);
        $I->fillField(\MassDiscountManagerPage::$dayStart, $discountEnd);
        $I->fillField(\MassDiscountManagerPage::$dayEnd, $discountStart);

//        $I->click(['xpath' => "//div[@id='s2id_jform_manufacturer_id']//ul/li"]);
//        $I->fillField(['xpath' => "//div[@id='s2id_jform_manufacturer_id']//ul/li//input"], $nameManufacture);
//        $I->waitForElement(['xpath' => "//span[contains(text(), '" . $nameManufacture . "')]"]);
//        $I->click(['xpath' => "//span[contains(text(), '" . $nameManufacture . "')]"]);


        $I->click(['xpath' => "//div[@id='s2id_jform_category_id']//ul/li"]);
        $I->fillField(['xpath' => "//div[@id='s2id_jform_category_id']//ul/li//input"], $nameCategory);
        $I->waitForElement(['xpath' => "//span[contains(text(), '" . $nameCategory . "')]"]);
        $I->click(['xpath' => "//span[contains(text(), '" . $nameCategory . "')]"]);


        $I->click(['xpath' => "//div[@id='s2id_jform_discount_product']//ul/li"]);
        $I->fillField(['xpath' => "//div[@id='s2id_jform_discount_product']//ul/li//input"], $nameProduct);
        $I->waitForElement(['xpath' => "//span[contains(text(), '" . $nameProduct . "')]"]);
        $I->click(['xpath' => "//span[contains(text(), '" . $nameProduct . "')]"]);

        $I->click('Save');
        $I->waitForText('Error.', 30, ['class' => 'alert-danger']);
    }

    public function addMassDiscountMissingAllFields()
    {
        $I = $this;
        $I->amOnPage(\MassDiscountManagerPage::$URL);
        $I->click('New');
        $I->verifyNotices(false, $this->checkForNotices(), 'product mass discount new');
        $I->checkForPhpNoticesOrWarnings();
        $I->click('Save');
        $I->waitForText('Field required: Name', 30, ['class' => 'alert-danger']);
    }

    public function addMassDiscountMissingName($amountValue, $discountStart, $discountEnd, $nameCategory, $nameProduct)
    {
        $I = $this;
        $I->amOnPage(\MassDiscountManagerPage::$URL);
        $I->click('New');
        $I->verifyNotices(false, $this->checkForNotices(), 'product mass discount new');
        $I->checkForPhpNoticesOrWarnings();
        $I->fillField(\MassDiscountManagerPage::$valueAmount, $amountValue);
        $I->fillField(\MassDiscountManagerPage::$dayStart, $discountEnd);
        $I->fillField(\MassDiscountManagerPage::$dayEnd, $discountStart);

        $I->click(['xpath' => "//div[@id='s2id_jform_category_id']//ul/li"]);
        $I->fillField(['xpath' => "//div[@id='s2id_jform_category_id']//ul/li//input"], $nameCategory);
        $I->waitForElement(['xpath' => "//span[contains(text(), '" . $nameCategory . "')]"]);
        $I->click(['xpath' => "//span[contains(text(), '" . $nameCategory . "')]"]);


        $I->click(['xpath' => "//div[@id='s2id_jform_discount_product']//ul/li"]);
        $I->fillField(['xpath' => "//div[@id='s2id_jform_discount_product']//ul/li//input"], $nameProduct);
        $I->waitForElement(['xpath' => "//span[contains(text(), '" . $nameProduct . "')]"]);
        $I->click(['xpath' => "//span[contains(text(), '" . $nameProduct . "')]"]);

        $I->click('Save');
        $I->waitForText('Field required: Name', 30, ['class' => 'alert-danger']);
    }

    public function addMassDiscountMissingAmount($massDiscountName, $discountStart, $discountEnd, $nameCategory, $nameProduct)
    {
        $I = $this;
        $I->amOnPage(\MassDiscountManagerPage::$URL);
        $I->click('New');
        $I->verifyNotices(false, $this->checkForNotices(), 'product mass discount new');
        $I->checkForPhpNoticesOrWarnings();
        $I->fillField(\MassDiscountManagerPage::$name, $massDiscountName);
        $I->fillField(\MassDiscountManagerPage::$dayStart, $discountStart);
        $I->fillField(\MassDiscountManagerPage::$dayEnd, $discountEnd);

        $I->click(['xpath' => "//div[@id='s2id_jform_category_id']//ul/li"]);
        $I->fillField(['xpath' => "//div[@id='s2id_jform_category_id']//ul/li//input"], $nameCategory);
        $I->waitForElement(['xpath' => "//span[contains(text(), '" . $nameCategory . "')]"]);
        $I->click(['xpath' => "//span[contains(text(), '" . $nameCategory . "')]"]);

        $I->click(['xpath' => "//div[@id='s2id_jform_discount_product']//ul/li"]);
        $I->fillField(['xpath' => "//div[@id='s2id_jform_discount_product']//ul/li//input"], $nameProduct);
        $I->waitForElement(['xpath' => "//span[contains(text(), '" . $nameProduct . "')]"]);
        $I->click(['xpath' => "//span[contains(text(), '" . $nameProduct . "')]"]);
        $I->click('Save');

        $I->waitForText('Error', 30, ['class' => 'alert-danger']);
    }

    public function addMassDiscountMissingProducts($massDiscountName, $amountValue, $discountStart, $discountEnd)
    {
        $I = $this;
        $I->amOnPage(\MassDiscountManagerPage::$URL);
        $I->click('New');
        $I->verifyNotices(false, $this->checkForNotices(), 'product mass discount new');
        $I->checkForPhpNoticesOrWarnings();
        $I->fillField(\MassDiscountManagerPage::$name, $massDiscountName);
        $I->fillField(\MassDiscountManagerPage::$valueAmount, $amountValue);
        $I->fillField(\MassDiscountManagerPage::$dayStart, $discountStart);
        $I->fillField(\MassDiscountManagerPage::$dayEnd, $discountEnd);
        $I->click('Save');
        $I->waitForText('Save failed with the following error', 30, ['class' => 'alert-danger']);
    }

    public function editMassDiscount($massDiscountName, $massDiscountNameEdit)
    {
        $I = $this;
        $I->amOnPage(\MassDiscountManagerPage::$URL);
        $I->searchMassDiscount($massDiscountName);
        $I->wait(3);
        $I->click(['link' => $massDiscountName]);
        $I->waitForElement(\MassDiscountManagerPage::$name, 30);
        $I->verifyNotices(false, $this->checkForNotices(), 'Mass Discount  Edit');
        $I->fillField(\MassDiscountManagerPage::$name, $massDiscountNameEdit);
        $I->click("Save & Close");
        $I->waitForElement(\MassDiscountManagerPage::$MassDiscountFilter, 30);
    }

    public function editMassDiscountSave($massDiscountName, $massDiscountNameEdit)
    {
        $I = $this;
        $I->amOnPage(\MassDiscountManagerPage::$URL);
        $I->searchMassDiscount($massDiscountName);
        $I->wait(3);
        $I->click(['link' => $massDiscountName]);
        $I->waitForElement(\MassDiscountManagerPage::$name, 30);
        $I->verifyNotices(false, $this->checkForNotices(), 'Mass Discount  Edit');
        $I->fillField(\MassDiscountManagerPage::$name, $massDiscountNameEdit);
        $I->click("Save & Close");
        $I->waitForElement(\MassDiscountManagerPage::$MassDiscountFilter, 30);
    }

    public function editButtonMassDiscountSave($massDiscountName, $massDiscountNameEdit)
    {
        $I = $this;
        $I->amOnPage(\MassDiscountManagerPage::$URL);
        $I->searchMassDiscount($massDiscountName);
        $I->wait(3);
        $I->click(\MassDiscountManagerPage::$checkFirstItems);
        $I->click('Edit');
        $I->waitForElement(\MassDiscountManagerPage::$name, 30);
        $I->verifyNotices(false, $this->checkForNotices(), 'Mass Discount  Edit');
        $I->fillField(\MassDiscountManagerPage::$name, $massDiscountNameEdit);
        $I->click("Save & Close");
        $I->waitForElement(\MassDiscountManagerPage::$MassDiscountFilter, 30);
    }

    public function checkCloseButton($massDiscountName)
    {
        $I = $this;
        $I->amOnPage(\MassDiscountManagerPage::$URL);
        $I->searchMassDiscount($massDiscountName);
        $I->wait(3);
        $I->click(['link' => $massDiscountName]);
        $I->waitForElement(\MassDiscountManagerPage::$name, 30);
        $I->verifyNotices(false, $this->checkForNotices(), 'Mass Discount  Edit');

        $I->click("Close");
        $I->waitForElement(\MassDiscountManagerPage::$MassDiscountFilter, 30);
    }


    public function checkCancelButton()
    {
        $I = $this;
        $I->amOnPage(\MassDiscountManagerPage::$URL);
        $I->click('New');
        $I->verifyNotices(false, $this->checkForNotices(), 'product mass discount new');
        $I->checkForPhpNoticesOrWarnings();
        $I->click('Cancel');
        $I->waitForElement(\MassDiscountManagerPage::$MassDiscountFilter, 30);

    }


    public function searchMassDiscount($massDiscountName)
    {
        $I = $this;
        $I->wantTo('Search the Mass Discount');
        $I->amOnPage(\MassDiscountManagerPage::$URL);
        $I->waitForElement(\MassDiscountManagerPage::$MassDiscountFilter, 30);
        $I->filterListBySearching($massDiscountName);
    }
}