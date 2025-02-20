<?php

namespace SitemapGenerator\Validator\Rules;

use SitemapGenerator\Validator\RuleInterface;

class RuleMin implements RuleInterface
{

    protected int $min;

    public function __construct($min)
    {
        $this->min = $min;
    }

    public function passes($value): bool
    {
        if (is_string($value)) {
            return mb_strlen($value) >= $this->min;
        } elseif (is_numeric($value)) {
            return $value >= $this->min;
        } 
        return false;
    }

    public function message($attribute): string
    {
        return "$attribute must be at least $this->min characters or value";
    }
}