<?php

namespace SitemapGenerator\Validator;

use SitemapGenerator\Validator\Exception\ValidatorException;
use SitemapGenerator\Validator\Rules\RuleDate;
use SitemapGenerator\Validator\Rules\RuleNumber;
use SitemapGenerator\Validator\Rules\RuleMax;
use SitemapGenerator\Validator\Rules\RuleMin;
use SitemapGenerator\Validator\Rules\RuleRequired;
use SitemapGenerator\Validator\Rules\RuleString;

class Validator
{
    private static $rulesMap = [
        'required' => RuleRequired::class,
        'date' => RuleDate::class,
        'string' => RuleString::class,
        'float' => RuleNumber::class,
        'min' => RuleMin::class,
        'max' => RuleMax::class,

    ];
    public static function validate(array $data, array $rules)
    {
        $errors = [];
        foreach ($rules as $field => $rulesData) {
            $rulesArray = explode('|', $rulesData);
            foreach ($rulesArray as $rule) {
                $ruleParts = explode(':', $rule, 2);
                $ruleName = $ruleParts[0];
                $param = $ruleParts[1] ?? null;

                if (isset(self::$rulesMap[$ruleName])) {
                    $ruleInstance = ($param !== null) ? new self::$rulesMap[$ruleName]($param) : new self::$rulesMap[$ruleName];

                    $value = $data[$field] ?? null;

                    if (!$ruleInstance->passes($value)) {
                        $errors[$field][] = $ruleInstance->message($field);
                    }
                }
            }
        }

        if (!empty($errors)) {
            throw new ValidatorException($errors);
        }
    }
}