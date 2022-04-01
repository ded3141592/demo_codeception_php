<?php

use pages\VideoPage;

class DemoCest
{
    public
    function videoPreviewTest(AcceptanceTester $I)
    {
        $videoPage = new VideoPage($I);

        $I->amOnPage(VideoPage::URL);
        $searchResults = $videoPage->searchVideos("ураган");
        $I->assertGreaterThan(0, count($searchResults));
        $videoLocator = $searchResults[rand(0, count($searchResults) - 1)];
        $screenName = str_replace(' ', '', microtime());
        $I->makeElementScreenshot($videoLocator, $screenName);
        $I->moveMouseOver($videoLocator);
        $trailerIsPlaying = $I->waitForElementDisplayingChanged($screenName, $videoLocator);
        $I->assertTrue($trailerIsPlaying, "Trailer doesn't play");
    }

}