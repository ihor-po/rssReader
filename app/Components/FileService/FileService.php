<?php


namespace App\Components\FileService;

/**
 * Class ImageService
 * @package App\Components\FileService
 */
class FileService
{
    /** @var string  */
    private const IMAGE_FOLDER = 'images';

    /** @var string  */
    private const TEMPORARY_FILE_NAME = 'temp';

    public function __construct()
    {
        if (!file_exists(static::IMAGE_FOLDER)) {
            mkdir(static::IMAGE_FOLDER, 0766, true);
        }
    }

    /**
     * @param string $url
     * @return string
     */
    public function saveImage(string $url): string
    {
        $fileTmp = $this->createTemporaryFileFromUrl($url);
        $fileName = hash_file('sha256', $fileTmp);
        $fileName = static::IMAGE_FOLDER . '/' . $fileName;

        if (!$this->imageExist($fileName)) {
            $this->renameFile($fileTmp, $fileName);
        }

        $this->removeTemporaryFile($fileTmp);

        return $fileName;
    }

    /**
     * @param string $url
     * @return string
     */
    private function createTemporaryFileFromUrl(string $url): string
    {
        $fileName = static::IMAGE_FOLDER . '/' . static::TEMPORARY_FILE_NAME;
        file_put_contents($fileName, file_get_contents($url));

        return $fileName;
    }

    /**
     * @param string $fileName
     * @return bool
     */
    private function imageExist(string $fileName): bool
    {
        return file_exists($fileName);
    }

    /**
     * @param string $oldFileName
     * @param string $newFileName
     * @return bool
     */
    private function renameFile(string $oldFileName, string $newFileName)
    {
        return rename($oldFileName, $newFileName);
    }

    /**
     * @param string $temporaryFilePath
     */
    private function removeTemporaryFile(string $temporaryFilePath)
    {
        if (file_exists($temporaryFilePath)) {
            unlink($temporaryFilePath);
        }
    }

}