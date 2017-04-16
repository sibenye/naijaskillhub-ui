<?php
namespace Tests\Unit\Mappers\ApiResponseMappers;

use App\Mappers\ApiResponseMappers\RegisterResponseMapper;
use Tests\TestCase;
use App\Mappers\ApiResponseMappers\AttributesResponseMapper;

class AttributesResponseMapperTest extends TestCase
{
    /**
     *
     * @var AttributesResponseMapper
     */
    private $mapper;

    /**
     *
     * {@inheritDoc}
     * @see \Illuminate\Foundation\Testing\TestCase::setUp()
     */
    public function setUp()
    {
        $this->mapper = new AttributesResponseMapper();
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
                        "attributeId" => 1,
                        "attributeType" => "profile",
                        "attributeName" => "firstName",
                        "displayName" => "First Name",
                        "attributeValue" => "TestP3"
                ],
                [
                        "attributeId" => 2,
                        "attributeType" => "profile",
                        "attributeName" => "lastName",
                        "displayName" => "Last Name",
                        "attributeValue" => "UserTest"
                ]
        ];

        $expectedOut = [
                [
                        "attributeId" => 1,
                        "attributeType" => "profile",
                        "attributeName" => "firstName",
                        "displayName" => "First Name",
                        "attributeValue" => "TestP3"
                ],
                [
                        "attributeId" => 2,
                        "attributeType" => "profile",
                        "attributeName" => "lastName",
                        "displayName" => "Last Name",
                        "attributeValue" => "UserTest"
                ]
        ];

        $out = $this->mapper->map($in);

        $this->assertEquals($expectedOut, $out);
    }
}