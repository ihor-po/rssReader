<?php

namespace App\Task;

use App\Components\FileService\FileService;
use App\Components\RssReaderService\RssReaderService;
use App\Components\XmlService\XmlService;
use Exception;
use SimpleXMLElement;

class FeedReader
{
    /** @var string $uri */
    private $uri;

    /** @var RssReaderService $rssReader*/
    private $rssReader;

    /** @var XmlService $xmlService */
    private $xmlService;

    /** @var FileService $imageService */
    private $imageService;


    public function __construct()
    {
        $this->rssReader = new RssReaderService();
        $this->xmlService = new XmlService();
        $this->imageService = new FileService();
    }

    /**
     * @param string $value
     * @throws Exception
     */
    public function setURI(string $value)
    {
        if (!$this->checkURI($value)) {
            throw new Exception('The URI is empty');
        }

        $this->uri = $value;
    }

    /**
     * @return mixed
     * @throws Exception
     */
    public function load()
    {
        $rssData = $this->rssReader->read($this->uri);
        $items = $this->xmlService->searchChildrenValueByKey($rssData, 'item');

        if ($items === null) {
            throw new Exception('The xml data not contain searched items!');
        }

        return $items;
    }

    /**
     * @param SimpleXMLElement $items
     * @return false|string
     * @throws Exception
     */
    public function getResult(SimpleXMLElement $items)
    {
        $response = [];

        foreach ($items as $item) {
            $childrenValues = $this->xmlService->searchChildrenValueByKeys($item, ['title', 'enclosure']);
            $attributeUrlValue = $this->xmlService->searchAttributeValueByKey($childrenValues['enclosure'], 'url');
            $image = $this->imageService->saveImage($attributeUrlValue);

            $response[] = [
                'title' => $childrenValues['title'],
                'image' => $image
            ];
        }

        return json_encode($response);
    }

    /**
     * Check if URI not empty
     *
     * @param string $uri
     * @return boolean
     */
    private function checkURI(string $uri): bool
    {
        if (empty($uri)) {
            return false;
        }

        return true;
    }
}