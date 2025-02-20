<?php

namespace SitemapGenerator\Formats;

use SitemapGenerator\Exceptions\FileWriteException;

class JsonGenerator implements GeneratorInterface
{
    public function generate(array $pages, string $filePath): void
    {
        $json = json_encode($pages, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);
        if ($json === false) {
            throw new FileWriteException("JSON encoding error: " . json_last_error_msg());
        }

        if (file_put_contents($filePath, $json, LOCK_EX) === false) {
            throw new FileWriteException("Unable to write JSON file: " . $filePath);
        }
    }
}