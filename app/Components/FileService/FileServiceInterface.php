<?php

namespace App\Components\FileService;


/**
 * Class ImageService
 * @package App\Components\FileService
 */
interface FileServiceInterface
{
    /**
     * @param string $url
     * @return string
     */
    public function saveImage(string $url): string;
}