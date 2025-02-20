<?php

namespace SitemapGenerator;

use SitemapGenerator\Generators\GeneratorInterface;
use SitemapGenerator\Generators\XmlGenerator;
use SitemapGenerator\Generators\JsonGenerator;
use SitemapGenerator\Generators\CsvGenerator;
use SitemapGenerator\Exceptions\WrongFormatException;
use SitemapGenerator\Validator\Exception\ValidatorException;
use SitemapGenerator\Validator\Validator;

class SitemapGenerator
{
    private array $pages;
    private string $fileType;
    private string $filePath;

    public function __construct(
        array $pages, 
        string $fileType, 
        string $filePath
    ) {
        $this->validatePages($pages);
        $this->pages = $pages;
        $this->fileType = strtolower($fileType);
        $this->filePath = $filePath;
    }

    public function generate(): void
    {
        $generator = $this->getGenerator();
        $generator->generate($this->pages, $this->filePath);
    }

    private function getGenerator(): GeneratorInterface
    {
        return match ($this->fileType) {
            'xml' => new XmlGenerator(),
            'csv' => new CsvGenerator(),
            'json' => new JsonGenerator(),
            default => throw new WrongFormatException(
                "Wrong file type: $this->fileType"
            ),
        };
    }

    private function validatePages(array $pages): void
    {
        foreach ($pages as $page) {
            try {
                Validator::validate($page, 
                [
                    'loc' => 'required|string',
                    'lastmod' => 'required|date',
                    'priority' => 'required|number|max:1|min:0',
                    'changefreq' => 'required|string'
                ]);
            } catch (ValidatorException $e) {
                echo $e->getErrors();
            }
        }
    }

}