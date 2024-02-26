<?php
if (!function_exists('getFullImageAddress')) {
    function getFullImageAddress($path) {
        // Your logic to return the full image address
        return asset('storage/' . $path);
    }
}

function getFullImageAddressFromAttachmentId($attachmentId) {
    // Your logic to return the full image address
    $attachment = \Orchid\Attachment\Models\Attachment::where('id', '=', $attachmentId)->first();
    // Get the full URL for local storage
    $path = null;
    if ($attachment) {
        $path = $attachment->path.$attachment->name.".".$attachment->extension;
        $path = getFullImageAddress($path);
    }

    return $path;
}

function formatDate($dateTimeString) {
    $formattedDate = date('Y-m-d', strtotime($dateTimeString));
    return $formattedDate; // Output: 2024-02-26
}

function formatDateDD($dateTimeString) {
    $formattedDate = date('d', strtotime($dateTimeString));
    return $formattedDate; // Output: 2024-02-26
}
function formatDateYYYYmm($dateTimeString) {
    $formattedDate = date('Y-m', strtotime($dateTimeString));
    return $formattedDate; // Output: 2024-02-26
}
