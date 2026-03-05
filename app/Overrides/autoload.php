<?php

/**
 * Registers an autoloader to use NumberWithoutIntl when intl extension is not loaded.
 * This allows Filament and Laravel to work without the intl PHP extension.
 */
if (! extension_loaded('intl')) {
    spl_autoload_register(function (string $class): bool {
        if ($class === 'Illuminate\Support\Number') {
            require_once __DIR__ . '/NumberWithoutIntl.php';
            return true;
        }
        return false;
    }, true, true);
}
