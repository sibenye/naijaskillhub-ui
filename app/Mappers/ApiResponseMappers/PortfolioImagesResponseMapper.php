<?php
namespace App\Mappers\ApiResponseMappers;

use App\Mappers\IMapper;

class PortfolioImagesResponseMapper implements IMapper
{

    /**
     * {@inheritDoc}
     * @see \App\Mappers\IMapper::map()
     */
    public function map($in)
    {
        $out = [ ];

        foreach ($in as $key => $attr) {
            $portfolioImageDictionary = [ ];
            $portfolioImageDictionary ['imageId'] = array_get($attr, 'imageId', NULL);
            $portfolioImageDictionary ['filePath'] = array_get($attr, 'filePath', NULL);
            $portfolioImageDictionary ['fileName'] = array_get($attr, 'fileName', NULL);
            $portfolioImageDictionary ['caption'] = array_get($attr, 'caption', NULL);

            $out [$key] = $portfolioImageDictionary;
        }

        return $out;
    }
}