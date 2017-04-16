<?php
namespace App\Mappers\ApiResponseMappers;

use App\Mappers\IMapper;

class PortfolioAudiosResponseMapper implements IMapper
{

    /**
     * {@inheritDoc}
     * @see \App\Mappers\IMapper::map()
     */
    public function map($in)
    {
        $out = [ ];

        foreach ($in as $key => $attr) {
            $portfolioAudioDictionary = [ ];
            $portfolioAudioDictionary ['audioId'] = array_get($attr, 'audioId', NULL);
            $portfolioAudioDictionary ['filePath'] = array_get($attr, 'filePath', NULL);
            $portfolioAudioDictionary ['fileName'] = array_get($attr, 'fileName', NULL);
            $portfolioAudioDictionary ['caption'] = array_get($attr, 'caption', NULL);

            $out [$key] = $portfolioAudioDictionary;
        }

        return $out;
    }
}
