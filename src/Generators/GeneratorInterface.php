<?php

namespace SitemapGenerator\Generators;

interface GeneratorInterface
{
    public function generate(array $pages, string $filePath): void;
}