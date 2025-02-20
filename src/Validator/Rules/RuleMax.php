<?php

namespace SitemapGenerator\Validator\Rules;

use SitemapGenerator\Validator\RuleInterface;

class RuleMax implements RuleInterface
{

    protected int $max;

    public function __construct($max)
    {
        $this->max = $max;
    }

    public function passes($value): bool
    {
        if (is_string($value)) {
            return mb_strlen($value) <= $this->max;
        } elseif (is_numeric($value)) {
            return $value <= $this->max;
        } 
        return false;
    }

    public function message($attribute): string
    {
        return "$attribute must not be greater than $this->max characters or value";
    }
}