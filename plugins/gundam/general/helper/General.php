<?php

namespace Gundam\General\Helper;

use Media\Classes\MediaLibrary;

class General
{
    const LIMIT_DEFAULT = 10;
    const LIMIT_DEFAULT_ALL = 10000;
    const PAGE_DEFAULT = 1;

    /**
     * @return UrlGenerator|Application|string
     */
    public static function getBaseUrl($path)
    {
        $mediaPrefix = MediaLibrary::url($path);
        return $mediaPrefix;
    }

    public static function generateRandomString($length = 10, $type = 0)
    {
        if ($type == 1) {
            $characters = '0123456789';
        } elseif ($type == 2) {
            $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        } elseif ($type == 3) {
            $characters = '0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ';
        } else {
            $characters = '0123456789abcdefghijklmnopqrstuvwxyz';
        }

        $charactersLength = strlen($characters);
        $randomString = '';
        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[rand(0, $charactersLength - 1)];
        }
        return $randomString;
    }


}
