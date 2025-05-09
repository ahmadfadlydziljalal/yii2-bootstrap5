<?php

declare(strict_types=1);

namespace yiiunit\extensions\bootstrap5;

use yii\bootstrap5\Progress;

/**
 * @group bootstrap5
 */
class ProgressTest extends TestCase
{
    public function testSimpleRender()
    {
        Progress::$counter = 0;
        $out = Progress::widget([
            'label' => 'Progress',
            'percent' => 25,
            'barOptions' => [
                'class' => 'bg-warning',
            ],
        ]);

        $expected = <<<HTML
<div id="w0" class="progress">
<div class="bg-warning progress-bar" role="progressbar" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100" style="width: 25%;">Progress</div>
</div>
HTML;

        $this->assertEqualsWithoutLE($expected, $out);
    }

    public function testRender()
    {
        Progress::$counter = 0;
        $out = Progress::widget([
            'bars' => [
                [
                    'label' => 'Progress',
                    'percent' => 25,
                ],
            ],
        ]);

        $expected = <<<HTML
<div id="w0" class="progress">
<div class="progress-bar" role="progressbar" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100" style="width: 25%;">Progress</div>
</div>
HTML;

        $this->assertEqualsWithoutLE($expected, $out);
    }


    public function testMultiple()
    {
        Progress::$counter = 0;
        $out = Progress::widget([
            'bars' => [
                [
                    'label' => '',
                    'percent' => 15,
                ],
                [
                    'label' => '',
                    'percent' => 30,
                    'options' => [
                        'class' => ['bg-success'],
                    ],
                ],
                [
                    'label' => '',
                    'percent' => 20,
                    'options' => [
                        'class' => ['bg-info'],
                    ],
                ],
            ],
        ]);

        $expected = <<<HTML
<div id="w0" class="progress">
<div class="progress-bar" role="progressbar" aria-valuenow="15" aria-valuemin="0" aria-valuemax="100" style="width: 15%;"></div>
<div class="bg-success progress-bar" role="progressbar" aria-valuenow="30" aria-valuemin="0" aria-valuemax="100" style="width: 30%;"></div>
<div class="bg-info progress-bar" role="progressbar" aria-valuenow="20" aria-valuemin="0" aria-valuemax="100" style="width: 20%;"></div>
</div>
HTML;

        $this->assertEqualsWithoutLE($expected, $out);
    }

    /**
     * @see https://github.com/yiisoft/yii2-bootstrap5/issues/121
     */
    public function testRussianLocaleRendering()
    {
        $this->mockWebApplication([
            'language' => 'ru-RU',
            'sourceLanguage' => 'en-US',
        ]);

        Progress::$counter = 0;
        $out = Progress::widget([
            'bars' => [
                [
                    'label' => 'Progress',
                    'percent' => 25,
                ],
            ],
        ]);

        $expected = <<<HTML
<div id="w0" class="progress">
<div class="progress-bar" role="progressbar" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100" style="width: 25%;">Progress</div>
</div>
HTML;

        $this->assertEqualsWithoutLE($expected, $out);
    }
}
