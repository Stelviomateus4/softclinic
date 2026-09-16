<?php

namespace App\Support;

use Illuminate\Support\HtmlString;

class HtmlBuilder
{
    public function link($url, $title = null, $attributes = [], $secure = null, $escape = true): HtmlString
    {
        $url = url($url, [], $secure);
        $title = $title ?? $url;
        $text = $escape ? e($title) : $title;
        $attrs = '';
        foreach ($attributes as $key => $value) {
            $attrs .= ' '.e($key).'="'.e($value).'"';
        }

        return new HtmlString('<a href="'.e($url).'"'.$attrs.'>'.$text.'</a>');
    }

    public function image($url, $alt = null, $attributes = [], $secure = null): HtmlString
    {
        $attributes['alt'] = $alt;
        $attrs = '';
        foreach ($attributes as $key => $value) {
            if ($value !== null) {
                $attrs .= ' '.e($key).'="'.e($value).'"';
            }
        }

        return new HtmlString('<img src="'.e(url($url, [], $secure)).'"'.$attrs.'>');
    }

    public function style($url, $attributes = [], $secure = null): HtmlString
    {
        return new HtmlString('<link rel="stylesheet" href="'.e(url($url, [], $secure)).'">');
    }

    public function script($url, $attributes = [], $secure = null): HtmlString
    {
        return new HtmlString('<script src="'.e(url($url, [], $secure)).'"></script>');
    }
}
