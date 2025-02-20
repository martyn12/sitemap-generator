<?php

namespace SitemapGenerator\Formats;

interface GeneratorInterface
{
    public function generate(array $pages, string $filePath): void;
}