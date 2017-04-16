<?php
namespace App\Mappers\ApiResponseMappers;

use App\Mappers\IMapper;

class UserResponseMapper implements IMapper
{

    /**
     * {@inheritDoc}
     * @see \App\Mappers\IMapper::map()
     */
    public function map($in)
    {
        $out = [
                'id' => array_get($in, 'userId', NULL),
                'isActive' => array_get($in, 'isActive', NULL),
                'email' => array_get($in, 'email', NULL),
                'credentialTypes' => array_get($in, 'credentialTypes', NULL),
                'accountTypes' => array_get($in, 'accountTypes', NULL),
                'categories' => array_get($in, 'categories', NULL)
        ];

        return $out;
    }
}