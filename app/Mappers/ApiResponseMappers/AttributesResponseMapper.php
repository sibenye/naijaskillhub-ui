<?php
namespace App\Mappers\ApiResponseMappers;

use App\Mappers\IMapper;

class AttributesResponseMapper implements IMapper
{

    /**
     * {@inheritDoc}
     * @see \App\Mappers\IMapper::map()
     */
    public function map($in)
    {
        $out = [ ];

        foreach ($in as $key => $attr) {
            $attributeDictionary = [ ];
            $attributeDictionary ['attributeId'] = array_get($attr, 'attributeId', NULL);
            $attributeDictionary ['attributeType'] = array_get($attr, 'attributeType', NULL);
            $attributeDictionary ['attributeName'] = array_get($attr, 'attributeName', NULL);
            $attributeDictionary ['displayName'] = array_get($attr, 'displayName', NULL);
            $attributeDictionary ['attributeValue'] = array_get($attr, 'attributeValue', NULL);

            $out [$key] = $attributeDictionary;
        }

        return $out;
    }
}
