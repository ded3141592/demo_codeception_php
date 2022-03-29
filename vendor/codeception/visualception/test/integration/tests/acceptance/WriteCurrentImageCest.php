<?php

use Codeception\Module\ImageDeviationException;

class WriteCurrentImageCest
{

    /**
     * fail the test. lookup is current image is written
     */
    public function writeCurrentImageFile(WebGuy $I, $scenario)
    {
        // expect failing the test
        $I->amOnPage("/staticTimeChanged.html");
        try {
            $I->dontSeeVisualChanges("currentImageIdentifier", "#theblock");
        } catch (ImageDeviationException $exception) {
            $currentImagePath = $exception->getCurrentImage();

            if (!is_file($exception->getCurrentImage())) {
                throw new \PHPUnit_Framework_ExpectationFailedException("The screenshot was not saved successfully.");
            }
        }
    }
}
