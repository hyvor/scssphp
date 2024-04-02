<?php

/**
 * SCSSPHP
 *
 * @copyright 2012-2020 Leaf Corcoran
 *
 * @license http://opensource.org/licenses/MIT MIT
 *
 * @link http://scssphp.github.io/scssphp
 */

namespace ScssPhp\ScssPhp\Function;

use ScssPhp\ScssPhp\SassCallable\BuiltInCallable;
use ScssPhp\ScssPhp\Value\Value;

/**
 * @internal
 */
class FunctionRegistry
{
    /**
     * @var array<string, array{overloads: array<string, callable(list<Value>): Value>, url: string}>
     */
    private const BUILTIN_FUNCTIONS = [
        // sass:meta
        'feature-exists' => ['overloads' => ['$feature' => [MetaFunctions::class, 'featureExists']], 'url' => 'sass:meta'],
        'inspect' => ['overloads' => ['$value' => [MetaFunctions::class, 'inspect']], 'url' => 'sass:meta'],
        'type-of' => ['overloads' => ['$value' => [MetaFunctions::class, 'typeof']], 'url' => 'sass:meta'],
        // sass:selector
        'is-superselector' => ['overloads' => ['$super, $sub' => [SelectorFunctions::class, 'isSuperselector']], 'url' => 'sass:selector'],
        'simple-selectors' => ['overloads' => ['$selector' => [SelectorFunctions::class, 'simpleSelectors']], 'url' => 'sass:selector'],
        'selector-parse' => ['overloads' => ['$selector' => [SelectorFunctions::class, 'parse']], 'url' => 'sass:selector'],
        'selector-nest' => ['overloads' => ['$selectors...' => [SelectorFunctions::class, 'nest']], 'url' => 'sass:selector'],
        'selector-append' => ['overloads' => ['$selectors...' => [SelectorFunctions::class, 'append']], 'url' => 'sass:selector'],
        'selector-extend' => ['overloads' => ['$selector, $extendee, $extender' => [SelectorFunctions::class, 'extend']], 'url' => 'sass:selector'],
        'selector-replace' => ['overloads' => ['$selector, $original, $replacement' => [SelectorFunctions::class, 'replace']], 'url' => 'sass:selector'],
        'selector-unify' => ['overloads' => ['$selector1, $selector2' => [SelectorFunctions::class, 'unify']], 'url' => 'sass:selector'],
        // sass:string
        'unquote' => ['overloads' => ['$string' => [StringFunctions::class, 'unquote']], 'url' => 'sass:string'],
        'quote' => ['overloads' => ['$string' => [StringFunctions::class, 'quote']], 'url' => 'sass:string'],
        'to-upper-case' => ['overloads' => ['$string' => [StringFunctions::class, 'toUpperCase']], 'url' => 'sass:string'],
        'to-lower-case' => ['overloads' => ['$string' => [StringFunctions::class, 'toLowerCase']], 'url' => 'sass:string'],
        'uniqueId' => ['overloads' => ['' => [StringFunctions::class, 'uniqueId']], 'url' => 'sass:string'],
        'str-length' => ['overloads' => ['$string' => [StringFunctions::class, 'length']], 'url' => 'sass:string'],
        'str-insert' => ['overloads' => ['$string, $insert, $index' => [StringFunctions::class, 'insert']], 'url' => 'sass:string'],
        'str-index' => ['overloads' => ['$string, $substring' => [StringFunctions::class, 'index']], 'url' => 'sass:string'],
        'str-slice' => ['overloads' => ['$string, $start-at, $end-at: -1' => [StringFunctions::class, 'slice']], 'url' => 'sass:string'],
    ];

    public static function has(string $name): bool
    {
        return isset(self::BUILTIN_FUNCTIONS[$name]);
    }

    public static function get(string $name): BuiltInCallable
    {
        if (!isset(self::BUILTIN_FUNCTIONS[$name])) {
            throw new \InvalidArgumentException("There is no builtin function named $name.");
        }

        return BuiltInCallable::overloadedFunction($name, self::BUILTIN_FUNCTIONS[$name]['overloads'], self::BUILTIN_FUNCTIONS[$name]['url']);
    }
}
