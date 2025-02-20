<?php

namespace SitemapGenerator\Validator\Rules;

use SitemapGenerator\Validator\RuleInterface;

class RuleDate implements RuleInterface
{
    public function passes($value): bool
    {
        return preg_match('/^\d{4}-\d{2}-\d{2}$/', $value) === 1;
    }

    public function message($attribute): string
    {
        return "$attribute must be a valid date string format YYYY-MM-DD";
    }
}