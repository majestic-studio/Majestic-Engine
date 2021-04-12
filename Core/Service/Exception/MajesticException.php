<?php

namespace Core\Service\Exception;

class MajesticException
{
    /**
     * @param string $message
     * @return string
     */
    public function data(string $message): string
    {
        return $message;
    }
}