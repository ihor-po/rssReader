<?php

namespace App\Components\XmlService;


use Exception;
use SimpleXMLElement;

/**
 * Class XmlService
 *
 * @package App\Components\XmlService
 */
interface XmlServiceInterface
{
    /**
     * Get key values
     *
     * @param SimpleXMLElement $children
     * @param string $key
     * @return mixed
     * @throws Exception
     */
    public function searchChildrenValueByKey(SimpleXMLElement $children, string $key);

    /**
     * @param SimpleXMLElement $children
     * @param array $keys
     * @return array
     * @throws Exception
     */
    public function searchChildrenValueByKeys(SimpleXMLElement $children, array $keys): array;

    /**
     * @param SimpleXMLElement $attribute
     * @param string $key
     * @return SimpleXMLElement|null
     */
    public function searchAttributeValueByKey(SimpleXMLElement $attribute, string $key): ?SimpleXMLElement;
}