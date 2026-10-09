<?php

if (!function_exists('fileUrl')) {
    function fileUrl(?string $path): ?string
    {
        if (!$path) {
            return null;
        }

        return asset('storage/' . $path);
    }
}