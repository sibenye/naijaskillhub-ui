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
                'isActive' => array_get($in, 'isActive', false),
                'email' => array_get($in, 'emailAddress', NULL),
                'credentialTypes' => array_get($in, 'credentialTypes', [ ]),
                'accountTypes' => array_get($in, 'accountTypes', [ ]),
                'categories' => array_get($in, 'categories', [ ]),
                'portfolio' => array_get($in, 'portfolio', [ ])
        ];

        return $out;
    }
}
