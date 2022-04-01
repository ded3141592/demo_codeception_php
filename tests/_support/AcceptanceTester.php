<?php


/**
 * Inherited Methods
 * @method void wantToTest($text)
 * @method void wantTo($text)
 * @method void execute($callable)
 * @method void expectTo($prediction)
 * @method void expect($prediction)
 * @method void amGoingTo($argumentation)
 * @method void am($role)
 * @method void lookForwardTo($achieveValue)
 * @method void comment($description)
 * @method void pause()
 *
 * @SuppressWarnings(PHPMD)
 */
class AcceptanceTester extends \Codeception\Actor
{
    use _generated\AcceptanceTesterActions;

    /**
     * Define custom actions here
     */

    public function compareImages(string $firstImage, string $secondImage): int
    {
        $firstScreen = new Imagick(getcwd() . "\\tests\\_output\\debug\\" . $firstImage . ".png");
        $secondScreen = new Imagick(getcwd() . "\\tests\\_output\\debug\\" . $secondImage . ".png");
        return $firstScreen->compareImages($secondScreen, 1)[1];
    }

    public function waitForElementDisplayingChanged(string $referenceImageName, string $locator, int $timeout = 10): bool
    {
        for ($i = 0; $i < $timeout; $i++) {
            $actualScreenshotName = str_replace(' ', '', microtime());
            $this->makeElementScreenshot($locator, $actualScreenshotName);
            $compareResult = $this->compareImages($referenceImageName, $actualScreenshotName);
            if ($compareResult > 0) {
                return true;
            }
            sleep(1);
        }
        return false;
    }

}
