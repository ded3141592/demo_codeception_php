<?php

use pages\VideoPage;

class DemoCest
{

    public
    function videoPreviewTest(AcceptanceTester $I)
    {
        $I->amOnPage(VideoPage::$url);
        $searchCountResult = VideoPage::searchVideo($I,"ураган");
        VideoPage::validateVideoTrailer($I, VideoPage::getVideoLocator(rand(1, $searchCountResult)));
    }

}