<?php
namespace Tests\Unit\Mappers\ApiResponseMappers;

use App\Mappers\ApiResponseMappers\LoginResponseMapper;
use Tests\TestCase;

class LoginResponseMapperTest extends TestCase
{
    /**
     *
     * @var LoginResonseMapper
     */
    private $mapper;

    /**
     *
     * {@inheritDoc}
     * @see \Illuminate\Foundation\Testing\TestCase::setUp()
     */
    public function setUp()
    {
        $this->mapper = new LoginResponseMapper();
    }

    /**
     * Test Mapping.
     *
     * @return void
     */
    public function testMapping()
    {
        $in = [
                "userId" => '1234',
                'authToken' => 'efheikjfio'
        ];

        $expectedOut = [
                "userId" => '1234',
                'authToken' => 'efheikjfio'
        ];

        $out = $this->mapper->map($in);

        $this->assertEquals($expectedOut, $out);
    }
}
