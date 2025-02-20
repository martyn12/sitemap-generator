<?php

namespace SitemapGenerator\Validator\Rules;

use SitemapGenerator\Validator\RuleInterface;

class RuleRequired implements RuleInterface
{
    public function passes($value): bool
    {
        return !empty($value);
    }

    public function message($attribute): string
    {
        return "$attribute is required!";
    }
}