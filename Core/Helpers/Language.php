<?php

use Core\Service\Localization\I18n;


/**
 * @param string $key
 * @param array $data
 */
function echo_lang(string $key, array $data = [])
{
    echo I18n::instance()->get($key, $data);
}

/**
 * @param string $key
 * @param array $data
 * @return string
 */
function lang(string $key, array $data = []): string
{
    return I18n::instance()->get($key, $data);
}