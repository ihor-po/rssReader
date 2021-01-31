<?php

namespace App\Task;

use Exception;
use SimpleXMLElement;

interface FeedReaderInterface
{
    /**
     * @param string $value
     * @throws Exception
     */
    public function setURI(string $value);

    /**
     * @return mixed
     * @throws Exception
     */
    public function load();

    /**
     * @param SimpleXMLElement $items
     * @return false|string
     * @throws Exception
     */
    public function getResult(SimpleXMLElement $items);
}