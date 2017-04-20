<?php
namespace App\Mappers\ApiResponseMappers;

use App\Mappers\IMapper;

class PortfolioVideosResponseMapper implements IMapper
{

    /**
     * {@inheritDoc}
     * @see \App\Mappers\IMapper::map()
     */
    public function map($in)
    {
        $out = [ ];

        foreach ($in as $key => $attr) {
            $portfolioVideoDictionary = [ ];
            $portfolioVideoDictionary ['videoId'] = array_get($attr, 'videoId', NULL);
            $portfolioVideoDictionary ['videoUrl'] = array_get($attr, 'videoUrl', NULL);
            $portfolioVideoDictionary ['videoScreenUrl'] = array_get($attr, 'videoScreenUrl', NULL);
            $portfolioVideoDictionary ['caption'] = array_get($attr, 'caption', NULL);

            $out [$key] = $portfolioVideoDictionary;
        }

        return $out;
    }
}
