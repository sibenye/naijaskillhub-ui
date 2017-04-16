<?php
namespace Tests\Unit\Mappers\ApiResponseMappers;

use App\Mappers\ApiResponseMappers\PortfolioImagesResponseMapper;
use Tests\TestCase;

class PortfolioImagesResponseMapperTest extends TestCase
{
    /**
     *
     * @var PortfolioImagesResponseMapper
     */
    private $mapper;

    /**
     *
     * {@inheritDoc}
     * @see \Illuminate\Foundation\Testing\TestCase::setUp()
     */
    public function setUp()
    {
        $this->mapper = new PortfolioImagesResponseMapper();
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
                        "imageId" => 1,
                        "fileName" => "test fileName",
                        "filePath" => "test filePath",
                        "caption" => "test caption"
                ],
                [
                        "imageId" => 2,
                        "fileName" => "test fileName 2",
                        "filePath" => "test filePath 2",
                        "caption" => "test caption 2"
                ]
        ];

        $expectedOut = [
                [
                        "imageId" => 1,
                        "fileName" => "test fileName",
                        "filePath" => "test filePath",
                        "caption" => "test caption"
                ],
                [
                        "imageId" => 2,
                        "fileName" => "test fileName 2",
                        "filePath" => "test filePath 2",
                        "caption" => "test caption 2"
                ]
        ];

        $out = $this->mapper->map($in);

        $this->assertEquals($expectedOut, $out);
    }
}
