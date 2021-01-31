<?php

namespace App\Components\RssReaderService;


use Exception;
use SimpleXMLElement;

/**
 * RssReaderService class
 */
interface RssReaderServiceInterface
{
    /**
     * Read data
     *
     * @param string $rssURI
     * @return SimpleXMLElement|string
     * @throws Exception
     */
    public function read(string $rssURI);
}