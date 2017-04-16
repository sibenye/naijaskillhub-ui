<?php
namespace Tests\Unit\Mappers\ApiResponseMappers;

use App\Mappers\ApiResponseMappers\PortfolioCreditsResponseMapper;
use Tests\TestCase;

class PortfolioCreditsResponseMapperTest extends TestCase
{
    /**
     *
     * @var PortfolioCreditsResponseMapper
     */
    private $mapper;

    /**
     *
     * {@inheritDoc}
     * @see \Illuminate\Foundation\Testing\TestCase::setUp()
     */
    public function setUp()
    {
        $this->mapper = new PortfolioCreditsResponseMapper();
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
                        "creditId" => 1,
                        "creditType" => "test creditType",
                        "creditTypeId" => "test creditTypeId",
                        "year" => "test year",
                        "caption" => "test caption"
                ],
                [
                        "creditId" => 2,
                        "creditType" => "test creditType 2",
                        "creditTypeId" => "test creditTypeId 2",
                        "year" => "test year",
                        "caption" => "test caption 2"
                ]
        ];

        $expectedOut = [
                [
                        "creditId" => 1,
                        "creditType" => "test creditType",
                        "creditTypeId" => "test creditTypeId",
                        "year" => "test year",
                        "caption" => "test caption"
                ],
                [
                        "creditId" => 2,
                        "creditType" => "test creditType 2",
                        "creditTypeId" => "test creditTypeId 2",
                        "year" => "test year",
                        "caption" => "test caption 2"
                ]
        ];

        $out = $this->mapper->map($in);

        $this->assertEquals($expectedOut, $out);
    }
}
