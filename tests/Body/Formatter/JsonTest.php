<?php

namespace Upscale\HttpServerMock\Tests\Body\Formatter;

use PHPUnit_Framework_TestCase as TestCase;
use Upscale\HttpServerMock\Body\Formatter;

class JsonTest extends TestCase
{
    /**
     * @var Formatter\Json
     */
    private $subject;

    protected function setUp()
    {
        $this->subject = new Formatter\Json();
    }

    /**
     * @dataProvider normalizeDataProvider
     */
    public function testNormalize($value, $expectedResult)
    {
        $actualResult = $this->subject->normalize($value);

        $this->assertSame($expectedResult, $actualResult);
    }

    public function normalizeDataProvider()
    {
        return [
            'empty' => ['', ''],
            'valid' => [
                file_get_contents(__DIR__ . '/_files/source.json'),
                file_get_contents(__DIR__ . '/_files/normalized.json'),
            ],
            'invalid' => [
                ' { "field" : "value", } ',
                '{ "field" : "value", }'
            ],
        ];
    }
}
