<?php

namespace SitemapGenerator\Validator\Exception;

class ValidatorException extends \Exception
{
    protected array $errors;

    public function __construct(array $errors, $message = 'Validation failed!')
    {
        parent::__construct($message);
        $this->errors = $errors;
    }

    public function getErrors(): string
    {
        return "Validation error: \n" . json_encode($this->errors, JSON_PRETTY_PRINT) . "\n";
    }
}