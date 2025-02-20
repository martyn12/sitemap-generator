<?php

namespace SitemapGenerator\Formats;

use SitemapGenerator\Exceptions\FileWriteException;

class CsvGenerator implements GeneratorInterface
{
    public function generate(array $pages, string $filePath): void
    {
        $file = fopen($filePath, 'wb');
        if (!$file) {
            throw new FileWriteException("Unable to write CSV file: " . $filePath);
        }

        try {
            $headers = ['loc', 'lastmod', 'priority', 'changefreq'];
            fputcsv($file, $headers, ';');

            foreach ($pages as $page) {
                fputcsv($file, [
                    $page['loc'],
                    $page['lastmod'],
                    $page['priority'],
                    $page['changefreq']
                ], ';');
            }
        } finally {
            fclose($file);
        }
    }
}