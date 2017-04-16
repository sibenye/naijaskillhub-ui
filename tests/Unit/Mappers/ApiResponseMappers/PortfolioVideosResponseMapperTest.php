<?php
namespace Tests\Unit\Mappers\ApiResponseMappers;

use App\Mappers\ApiResponseMappers\PortfolioVideosResponseMapper;
use Tests\TestCase;

class PortfolioVideosResponseMapperTest extends TestCase
{
    /**
     *
     * @var PortfolioVideosResponseMapper
     */
    private $mapper;

    /**
     *
     * {@inheritDoc}
     * @see \Illuminate\Foundation\Testing\TestCase::setUp()
     */
    public function setUp()
    {
        $this->mapper = new PortfolioVideosResponseMapper();
    }

    /**
     * Test Mapping.
     *
     * @return void
     */
    public function testMapping()
    {
        $in = [
                [
                        "videoId" => 1,
                        "videoUrl" => "test url",
                        "caption" => "test caption"
                ],
                [
                        "videoId" => 2,
                        "videoUrl" => "test url 2",
                        "caption" => "test caption 2"
                ]
        ];

        $expectedOut = [
                [
                        "videoId" => 1,
                        "videoUrl" => "test url",
                        "caption" => "test caption"
                ],
                [
                        "videoId" => 2,
                        "videoUrl" => "test url 2",
                        "caption" => "test caption 2"
                ]
        ];

        $out = $this->mapper->map($in);

        $this->assertEquals($expectedOut, $out);
    }
}
