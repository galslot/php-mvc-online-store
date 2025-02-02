<?php

    namespace core;

    class Container
    {
        use TSingleton;

        protected static array $props = [];

        public static function setProp(string $key, $value): void
        {
            self::$props[$key] = $value;
        }

        public static function getProp(string $key)
        {
            return self::$props[$key] ?? null;
        }

        public static function getProps(): array
        {
            return self::$props;
        }

    }