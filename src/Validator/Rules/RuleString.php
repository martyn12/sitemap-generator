<?php

namespace SitemapGenerator\Validator\Rules;

use SitemapGenerator\Validator\RuleInterface;

class RuleString implements RuleInterface
{
    public function passes($value): bool
    {
        return is_string($value);
    }

    public function message($attribute): string
    {
        return "$attribute must be a valid string!";
    }
}