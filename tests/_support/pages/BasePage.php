<?php

namespace pages;

class BasePage
{
    protected $I;

    function __construct(\AcceptanceTester $I)
    {
        $this->I = $I;
    }

}