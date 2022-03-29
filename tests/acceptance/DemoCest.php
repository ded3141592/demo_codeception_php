<?php

use function PHPUnit\Framework\assertNotEquals;
use function PHPUnit\Framework\assertStringContainsString;

class DemoCest
{

    public
    function _before(AcceptanceTester $I)
    {
    }

// tests

    public
    function videoPreviewTest(AcceptanceTester $I)
    {
        $videoPage = new \app\page\video\VideoPage;
        $expectedClassOnHover = "thumb-preview__target_playing";

        $I->amOnPage('/video');
        $I->fillField($videoPage::$searchInput, "ураган");
        $I->click($videoPage::$searchButton);
        $I->waitForElementNotVisible($videoPage::$fadeSpinner);
        $I->makeElementScreenshot($videoPage::$firstVideo, "first");
        $I->moveMouseOver($videoPage::$firstVideo);
        sleep(2);
        $actualClassOnHover = $I->grabAttributeFrom($videoPage::$firstVideo, 'class');
        $I->makeElementScreenshot($videoPage::$firstVideo, "second");
        $firstScreen = new Imagick(getcwd() . "\\tests\\_output\\debug\\first.png");
        $secondScreen = new Imagick(getcwd() . "\\tests\\_output\\debug\\second.png");
        $compareImagesResult = $firstScreen->compareImages($secondScreen, 1);

        assertStringContainsString($expectedClassOnHover, $actualClassOnHover);
        assertNotEquals(0, $compareImagesResult[1]);

    }

}