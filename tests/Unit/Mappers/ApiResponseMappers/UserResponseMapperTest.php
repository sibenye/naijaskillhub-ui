<?php
namespace Tests\Unit\Mappers\ApiResponseMappers;

use Tests\TestCase;
use App\Mappers\ApiResponseMappers\UserResponseMapper;

class UserResponseMapperTest extends TestCase
{
    /**
     *
     * @var UserMapper
     */
    private $mapper;

    /**
     *
     * {@inheritDoc}
     * @see \Illuminate\Foundation\Testing\TestCase::setUp()
     */
    public function setUp()
    {
        $this->mapper = new UserResponseMapper();
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
                'isActive' => true,
                'email' => 'testemail',
                'credentialTypes' => [
                        'standard'
                ],
                'accountTypes' => [
                        'talent'
                ],
                'categories' => [ ]
        ];

        $expectedOut = [
                "id" => '1234',
                'isActive' => true,
                'email' => 'testemail',
                'credentialTypes' => [
                        'standard'
                ],
                'accountTypes' => [
                        'talent'
                ],
                'categories' => [ ]
        ];

        $out = $this->mapper->map($in);

        $this->assertEquals($expectedOut, $out);
    }
}