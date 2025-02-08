<?php

namespace App\Containers\AppSection\Authentication\Classes;

use Illuminate\Support\Arr;

class LoginCustomAttribute
{
    /**
     * Extract the login custom attributes.
     * @param array $data
     * @return array
     */
    public static function extract(array $data): array
    {
        $prefix = config('appSection-authentication.login.prefix', '');
        $allowedLoginAttributes = static::getAllowedLoginAttributes();
        $fields = array_keys($allowedLoginAttributes);
        $loginUsername = null;
        $loginAttribute = null;

        foreach ($fields as $field) {
            $fieldName = $prefix . $field;
            $loginUsername = Arr::get($data, $fieldName);
            $loginAttribute = $field;

            if (!is_null($loginUsername)) {
                break;
            }
        }

        return [
            static::processLoginAttributeCaseSensitivity($loginUsername ?: ''),
            $loginAttribute,
        ];
    }

    private static function getAllowedLoginAttributes(): mixed
    {
        $allowedLoginFields = config('appSection-authentication.login.attributes');
        if (!$allowedLoginFields) {
            $allowedLoginFields = ['email' => []];
        }

        return $allowedLoginFields;
    }

    /**
     * @param string $username
     * @return string
     */
    private static function processLoginAttributeCaseSensitivity(string $username): string
    {
        return config('appSection-authentication.login.case_sensitive') ? $username : strtolower($username);
    }

    public static function mergeValidationRules(array $rules): array
    {
        $prefix = config('appSection-authentication.login.prefix', '');
        $allowedLoginAttributes = config('appSection-authentication.login.attributes', ['email' => []]);

        if (count($allowedLoginAttributes) == 1) {
            $key = array_key_first($allowedLoginAttributes);
            $optionalValidators = $allowedLoginAttributes[$key];
            $validators = implode('|', $optionalValidators);
            $fieldName = $prefix . $key;
            $rules[$fieldName] = "required:$fieldName|$validators";

            return $rules;
        }

        foreach ($allowedLoginAttributes as $key => $optionalValidators) {
            $otherLoginFields = Arr::except($allowedLoginAttributes, $key);
            $otherLoginFields = array_keys($otherLoginFields);
            $otherLoginFields = preg_filter('/^/', $prefix, $otherLoginFields);
            $otherLoginFields = implode(',', $otherLoginFields);
            $validators = implode('|', $optionalValidators);
            $fieldName = $prefix . $key;
            $rules[$fieldName] = "required_without_all:$otherLoginFields|$validators";
        }

        return $rules;
    }
}
