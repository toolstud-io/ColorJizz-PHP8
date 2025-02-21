<?php

/*
 * This file is part of the ColorJizz package.
 *
 * (c) Mikee Franklin <mikee@mischiefcollective.com>
 *
 */

namespace MischiefCollective\ColorJizz;

/**
 * Autoloader is used to autoload the library files.
 *
 *
 * @author Mikee Franklin <mikee@mischiefcollective.com>
 */
class Autoloader
{
    public static function register(): void
    {
        spl_autoload_register([new self, 'autoload']);
    }

    public static function autoload($class): void
    {
        if (!str_starts_with($class, 'MischiefCollective\\ColorJizz')) {
            return;
        }

        if (is_file(
            $file = dirname(__FILE__) . '/../../' . str_replace(['\\', "\0"], ['/', ''], $class) . '.php'
        )
        ) {
            require $file;
        }
    }
}
