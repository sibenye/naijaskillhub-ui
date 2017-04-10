<?php
namespace App\Utilities;

use Dropbox\Client;

class DropboxClientWrapper extends Client
{

    public function __construct()
    {
        $accessToken = env('DROPBOX_APP_TOKEN');
        $clientIdentifier = env('DROPBOX_APP_SECRET');

        parent::__construct($accessToken, $clientIdentifier);
    }

    public function getFileSource($filePath)
    {
        if (!starts_with($filePath, '/')) {
            $filePath = '/' . $filePath;
        }

        $sharableLink = $this->createShareableLink($filePath);

        $fileSource = str_replace('www.dropbox.com', env('STATIC_FILES_LOCATION_URL'),
                $sharableLink);

        return $fileSource;
    }
}

