<?php
namespace Tests\Unit\Mappers\ApiResponseMappers;

use App\Mappers\ApiResponseMappers\PortfolioAudiosResponseMapper;
use Tests\TestCase;

class PortfolioAudiosResponseMapperTest extends TestCase
{
    /**
     *
     * @var PortfolioAudiosResponseMapper
     */
    private $mapper;

    /**
     *
     * {@inheritDoc}
     * @see \Illuminate\Foundation\Testing\TestCase::setUp()
     */
    public function setUp()
    {
        $this->mapper = new PortfolioAudiosResponseMapper();
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
                        "audioId" => 1,
                        "fileName" => "test fileName",
                        "filePath" => "test filePath",
                        "caption" => "test caption"
                ],
                [
                        "audioId" => 2,
                        "fileName" => "test fileName 2",
                        "filePath" => "test filePath 2",
                        "caption" => "test caption 2"
                ]
        ];

        $expectedOut = [
                [
                        "audioId" => 1,
                        "fileName" => "test fileName",
                        "filePath" => "test filePath",
                        "caption" => "test caption"
                ],
                [
                        "audioId" => 2,
                        "fileName" => "test fileName 2",
                        "filePath" => "test filePath 2",
                        "caption" => "test caption 2"
                ]
        ];

        $out = $this->mapper->map($in);

        $this->assertEquals($expectedOut, $out);
    }
}