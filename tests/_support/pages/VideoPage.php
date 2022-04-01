<?php

namespace pages;

class VideoPage extends BasePage
{
    public const URL = "/video";

    public $searchInput = "span.input input";
    public $searchButton = "button[type='submit']";
    public $searchResultItem = ".content__left .serp-item";
    public $fadeSpinner = ".fade_progress_yes";

    public function searchVideos(string $text): array
    {
        $this->I->fillField($this->searchInput, $text);
        $this->I->click($this->searchButton);
        $this->I->waitForElementNotVisible($this->fadeSpinner);
        return array_map(function ($val) {
            return "[id='" . $val . "']";
        }, $this->I->grabMultiple($this->searchResultItem, "id"));
    }
}