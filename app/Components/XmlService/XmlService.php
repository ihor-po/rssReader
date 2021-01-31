<?php


namespace App\Components\XmlService;


use Exception;
use SimpleXMLElement;

/**
 * Class XmlService
 *
 * @package App\Components\XmlService
 */
class XmlService
{
    /**
     * Get key values
     *
     * @param SimpleXMLElement $children
     * @param string $key
     * @return mixed
     * @throws Exception
     */
    public function searchChildrenValueByKey(SimpleXMLElement $children, string $key)
    {
        while ($children->count()) {
            if ($children->$key->count()) {
                return $children->$key;
            }

            $children = $children->children();
        }

        return null;
    }

    /**
     * @param SimpleXMLElement $children
     * @param array $keys
     * @return array
     * @throws Exception
     */
    public function searchChildrenValueByKeys(SimpleXMLElement $children, array $keys): array
    {
        $values = [];

        foreach ($keys as $key) {
            $keyValue = $this->searchChildrenValueByKey($children, $key);
            $values[$key] = $keyValue;
        }

        return $values;
    }

    /**
     * @param SimpleXMLElement $attribute
     * @param string $key
     * @return SimpleXMLElement|null
     */
    public function searchAttributeValueByKey(SimpleXMLElement $attribute, string $key): ?SimpleXMLElement
    {
        if (!$this->isKeyValueAttribute($attribute)) {
            return null;
        }

        $attribute = $attribute->attributes();

        foreach ($attribute as $itemKey => $item) {
            if (strcasecmp($itemKey, $key) === 0) {
                return $item;
            }
        }
        return null;
    }

    /**
     * Check if key value is attribute
     *
     * @param SimpleXMLElement $keyValue
     * @return bool
     */
    private function isKeyValueAttribute(SimpleXMLElement $keyValue): bool
    {
        if ($keyValue->attributes()->count()) {
            return true;
        }

        return false;
    }
}