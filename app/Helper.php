<?php
if (!function_exists('getFullImageAddress')) {
    function getFullImageAddress($path) {
        // Your logic to return the full image address
        return asset('storage/' . $path);
    }
}
