<?php

namespace SitemapGenerator\Validator;

interface RuleInterface
{
    public function passes($value): bool;

    public function message($attribute): string;
}