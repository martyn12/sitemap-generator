<?php

namespace SitemapGenerator\Validator\Rules;

use SitemapGenerator\Validator\RuleInterface;

class RuleNumber implements RuleInterface
{
    public function passes($value): bool
    {
        return is_numeric($value);
    }

    public function message($attribute): string
    {
        return "$attribute must be a valid number!";
    }
}