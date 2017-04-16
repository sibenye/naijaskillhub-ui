<?php
namespace App\Mappers\ApiResponseMappers;

use App\Mappers\IMapper;

class PortfolioCreditsResponseMapper implements IMapper
{

    /**
     * {@inheritDoc}
     * @see \App\Mappers\IMapper::map()
     */
    public function map($in)
    {
        $out = [ ];

        foreach ($in as $key => $attr) {
            $portfolioCreditDictionary = [ ];
            $portfolioCreditDictionary ['creditId'] = array_get($attr, 'creditId', NULL);
            $portfolioCreditDictionary ['creditType'] = array_get($attr, 'creditType', NULL);
            $portfolioCreditDictionary ['creditTypeId'] = array_get($attr, 'creditTypeId', NULL);
            $portfolioCreditDictionary ['year'] = array_get($attr, 'year', NULL);
            $portfolioCreditDictionary ['caption'] = array_get($attr, 'caption', NULL);

            $out [$key] = $portfolioCreditDictionary;
        }

        return $out;
    }
}