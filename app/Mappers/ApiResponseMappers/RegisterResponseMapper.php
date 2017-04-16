<?php
namespace App\Mappers\ApiResponseMappers;

use App\Mappers\IMapper;

class RegisterResponseMapper implements IMapper
{

    /**
     * {@inheritDoc}
     * @see \App\Mappers\IMapper::map()
     */
    public function map($in)
    {
        $out = [
                'authToken' => array_get($in, 'authToken', NULL),
                'userId' => array_get($in, 'userId', NULL)
        ];

        return $out;
    }
}
