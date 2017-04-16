<?php
namespace App\Mappers\ApiResponseMappers;

use App\Mappers\IMapper;

class PortfoliosResponseMapper implements IMapper
{

    /**
     * {@inheritDoc}
     * @see \App\Mappers\IMapper::map()
     */
    public function map($in)
    {
        $out = [ ];
        $portfolioImageMapper = new PortfolioImagesResponseMapper();
        $portfolioAudioMapper = new PortfolioAudiosResponseMapper();
        $portfolioVideoMapper = new PortfolioVideosResponseMapper();
        $portfolioCreditMapper = new PortfolioCreditsResponseMapper();

        $out ['images'] = $portfolioImageMapper->map(array_get($in, 'images', [ ]));
        $out ['videos'] = $portfolioVideoMapper->map(array_get($in, 'videos', [ ]));
        $out ['audios'] = $portfolioAudioMapper->map(array_get($in, 'audios', [ ]));
        $out ['credits'] = $portfolioCreditMapper->map(array_get($in, 'credits', [ ]));

        return $out;
    }
}
