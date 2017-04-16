<?php
namespace Tests\Unit\Mappers\ApiResponseMappers;

use App\Mappers\ApiResponseMappers\PortfolioAudiosResponseMapper;
use Tests\TestCase;
use App\Mappers\ApiResponseMappers\PortfoliosResponseMapper;

class PortfoliosResponseMapperTest extends TestCase
{
    /**
     *
     * @var PortfoliosResponseMapper
     */
    private $mapper;

    /**
     *
     * {@inheritDoc}
     * @see \Illuminate\Foundation\Testing\TestCase::setUp()
     */
    public function setUp()
    {
        $this->mapper = new PortfoliosResponseMapper();
    }

    /**
     * Test Mapping.
     *
     * @return void
     */
    public function testMapping()
    {
        $in = [
                "images" => [
                        [
                                "imageId" => 1,
                                "fileName" => "test fileName",
                                "filePath" => "test filePath",
                                "caption" => "test caption"
                        ]
                ],
                "videos" => [
                        [
                                "videoId" => 1,
                                "videoUrl" => "test url",
                                "caption" => "test caption"
                        ]
                ],
                "audios" => [
                        [
                                "audioId" => 1,
                                "fileName" => "test fileName",
                                "filePath" => "test filePath",
                                "caption" => "test caption"
                        ]
                ],
                "credits" => [
                        [
                                "creditId" => 1,
                                "creditType" => "test creditType",
                                "creditTypeId" => "test creditTypeId",
                                "year" => "test year",
                                "caption" => "test caption"
                        ]
                ]
        ];

        $expectedOut = [
                "images" => [
                        [
                                "imageId" => 1,
                                "fileName" => "test fileName",
                                "filePath" => "test filePath",
                                "caption" => "test caption"
                        ]
                ],
                "videos" => [
                        [
                                "videoId" => 1,
                                "videoUrl" => "test url",
                                "caption" => "test caption"
                        ]
                ],
                "audios" => [
                        [
                                "audioId" => 1,
                                "fileName" => "test fileName",
                                "filePath" => "test filePath",
                                "caption" => "test caption"
                        ]
                ],
                "credits" => [
                        [
                                "creditId" => 1,
                                "creditType" => "test creditType",
                                "creditTypeId" => "test creditTypeId",
                                "year" => "test year",
                                "caption" => "test caption"
                        ]
                ]
        ];

        $out = $this->mapper->map($in);

        $this->assertEquals($expectedOut, $out);
    }
}
