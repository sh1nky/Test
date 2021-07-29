<?php

namespace cases\yandex;

// ./vendor/bin/codecept run cases yandex/PreviewCest:test -d

class PreviewCest
{
    const
        TEST_URL = 'https://yandex.ru/video/',
        INPUT_XPATH = '//input[@class="input__control"]',
        SEARCH_BUTTON_XPATH = '//div[@class="websearch-button__text"]',
        FIRST_OF_LIST_ITEMS_XPATH = '//div[@class="serp-list__items"]/div[contains(@class, "serp-item")][2]/div[contains(@class, "serp-item__preview")]/div[contains(@class, "thumb-image")]/div[contains(@class, "thumb-image__preview")]',
        TARGET_PLAYING_XPATH = '[contains(@class, "target_playing")]',
        NOT_TARGET_PLAYING_XPATH = '[not(contains(@class, "target_playing"))]'
    ;

    public function test(\MyTester $I)
    {
        $I->amOnUrl(self::TEST_URL);
        $I->waitForElementVisible(self::INPUT_XPATH);
        $I->fillField(self::INPUT_XPATH, 'ураган');
        $I->clickWithLeftButton(self::SEARCH_BUTTON_XPATH);
        $I->waitForElementVisible(self::FIRST_OF_LIST_ITEMS_XPATH . self::NOT_TARGET_PLAYING_XPATH);
        $I->moveMouseOver(self::FIRST_OF_LIST_ITEMS_XPATH);
        $I->waitForElementVisible(self::FIRST_OF_LIST_ITEMS_XPATH . self::TARGET_PLAYING_XPATH);
        $I->checkImageChange('previewVideo', '.thumb-image__preview.thumb-preview__target_playing');
    }
}