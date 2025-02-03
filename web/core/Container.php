<?php

namespace core;

class Container
{
    use TSingleton;

    protected static array $props = [];

    public static function setProp(int|string $key, $value): void
    {
        self::$props[$key] = $value;
    }

    public static function getProp(int|string $key)
    {
        return self::$props[$key] ?? null;
    }

    public static function getProps(): array
    {
        return self::$props;
    }
}
