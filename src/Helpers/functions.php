<?php

use Flowcms\Flowcms\Models\Setting;

if (!function_exists('setting')) {
    function setting($key, $default = null)
    {
        if (is_null($key)) {
            return new Setting;
        }

        if (is_array($key)) {
            return Setting::set($key[0], $key[1]);
        }

        $value = Setting::get($key);

        return is_null($value) ? value($default) : $value;
    }
}

if (!function_exists('isFileSvg')) {
    function isFileSvg($imageUrl)
    {
        if (pathinfo($imageUrl, PATHINFO_EXTENSION) === 'svg') {
            return $imageUrl;
        }
        return '';
    }
}

if (!function_exists('responsive_image')) {
    function responsive_image($imageUrl)
    {
        if (is_null($imageUrl)) {
            return '';
        }

        if (pathinfo($imageUrl, PATHINFO_EXTENSION) === 'svg') {
            return [];
        }

        $parsesUrl = parse_url($imageUrl);

        $storageFolderPath = explode('/', $parsesUrl['path'])[1];

        $imageSavedUrl = $parsesUrl['scheme'] . '://' . $parsesUrl['host'];
        $imageSavedSecureUrl = $parsesUrl['scheme'] . 's://' . $parsesUrl['host'];

        if (collect([$imageSavedUrl, $imageSavedSecureUrl])->contains(request()->root()) && $storageFolderPath != 'cms') {
            $imageUrl = explode(config('app.url') . '/storage/', $imageUrl);

            return [
                'small' => url('/img/' . $imageUrl[1] . '?w=320'),
                'medium' => url('/img/' . $imageUrl[1] . '?w=640'),
                'large' => url('/img/' . $imageUrl[1] . '?w=1024'),
                // 'xlarge' => url('/img/' . $imageUrl[1] .'?w=1200'),
            ];
        }

        return [];
    }
}

function textToLinks($html)
{
    // Check for http/ftp/email and convert to links
    $reg_exUrl = "/(http|https|ftp|ftps)\:\/\/[a-zA-Z0-9\-\.]+\.[a-zA-Z]{2,3}(\/\S*)?/";

    if (preg_match($reg_exUrl, $html, $url)) {
        return preg_replace($reg_exUrl, '<a target="_blank" rel="noopener" class="text-indigo-500 border-b border-indigo-200 hover:text-indigo-700 transition duration-300 ease-out" href="' . $url[0] . '"> ' . $url[0] . '</a> ', $html);
    }

    return $html;
}

function markdownLinkParser($html)
{
    $reg_ex = "/\\[([^\\[]+)\\]\\(([^\\(]+)\\)/";

    if (preg_match($reg_ex, $html, $url)) {
        // dd($url);
        return preg_replace($reg_ex, '<a target="_blank" rel="noopener" class="ml-1 text-indigo-500 hover:underline hover:text-indigo-500 transition duration-300 ease-out" href="' . $url[2] . '"> ' . $url[1] . '</a>', $html);
    }

    return $html;
}
