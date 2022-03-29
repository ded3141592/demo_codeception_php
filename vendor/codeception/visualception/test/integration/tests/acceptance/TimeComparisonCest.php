<?php

class TimeComparisonCest
{

    /**
     * Comparing a div that renders the current time
     */
    public function seeVisualChanges (WebGuy $I, $scenario)
    {
        $I->amOnPage("/staticTimeChanged.html");
        $I->seeVisualChanges("block", "#theblock");
    }

    public function dontSeeVisualChanges (WebGuy $I, $scenario)
    {
        $I->amOnPage("/staticTime.html");
        $I->dontSeeVisualChanges("block2", "#theblock");
    }

    public function seeVisualChangesAndHideElement (WebGuy $I, $scenario)
    {
        $I->amOnPage("/staticTimeChanged.html");
        $I->seeVisualChanges("hideTheIntro", "body", array("#intro"));
    }

    public function dontSeeVisualChangesAndHideElement (WebGuy $I, $scenario)
    {
        $I->amOnPage("/staticTimeChanged.html");
        $I->dontSeeVisualChanges("hideTheBlock", "body", array("#theblock"));
    }
}
