<?php

namespace pages;

use Imagick;
use function PHPUnit\Framework\assertGreaterThan;
use function PHPUnit\Framework\assertNotEquals;
use function PHPUnit\Framework\assertStringContainsString;

class VideoPage
{
    public static $url = "/video";

    public static $searchInput = "span.input input";
    public static $searchButton = "button[type='submit']";
    public static $searchResultItem = ".content__left .serp-item";
    public static $fadeSpinner = ".fade_progress_yes";

    public static function getVideoLocator($position = 1): string
    {
        return ".serp-item:nth-child(" . $position . ") .thumb-image__preview";
    }

    public static function searchVideo(\AcceptanceTester $I, string $text, int $resultCountGreaterThan = 0): int
    {
        $I->fillField(VideoPage::$searchInput, $text);
        $I->click(VideoPage::$searchButton);
        $I->waitForElementNotVisible(VideoPage::$fadeSpinner);
        $previewArray = $I->grabMultiple(VideoPage::$searchResultItem);

        assertGreaterThan($resultCountGreaterThan, count($previewArray));

        return count($previewArray);
    }

    public static function validateVideoTrailer(\AcceptanceTester $I, string $videoLocator, int $pause = 3): void
    {
        $expectedClassPreviewOnHover = "thumb-preview__target_playing";
        $firstScreenName = str_replace(' ', '', microtime());
        $I->makeElementScreenshot($videoLocator, $firstScreenName);
        $I->moveMouseOver($videoLocator);
        sleep($pause);
        $actualClassOnHover = $I->grabAttributeFrom($videoLocator, "class");
        $secondScreenName = str_replace(' ', '', microtime());
        $I->makeElementScreenshot($videoLocator, $secondScreenName);

        $firstScreen = new Imagick(getcwd() . "\\tests\\_output\\debug\\" . $firstScreenName . ".png");
        $secondScreen = new Imagick(getcwd() . "\\tests\\_output\\debug\\" . $secondScreenName . ".png");
        $compareImagesResult = $firstScreen->compareImages($secondScreen, 1);

        assertStringContainsString($expectedClassPreviewOnHover, $actualClassOnHover);
        assertNotEquals(0, $compareImagesResult[1]);
    }

}