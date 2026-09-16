<?php

namespace App\Support;

use Illuminate\Support\Facades\URL;
use Illuminate\Support\HtmlString;
use Illuminate\Support\ViewErrorBag;

/**
 * Minimal LaravelCollective-compatible Form builder for Blade views.
 */
class FormBuilder
{
    protected $model = null;

    public function open(array $options = []): HtmlString
    {
        $method = strtoupper($options['method'] ?? 'POST');
        $spoof = in_array($method, ['PUT', 'PATCH', 'DELETE'], true);
        $htmlMethod = $spoof || $method === 'GET' ? ($method === 'GET' ? 'GET' : 'POST') : $method;

        $action = $this->resolveAction($options);
        $attrs = $this->attributes(array_filter([
            'method' => $htmlMethod,
            'action' => $action,
            'accept-charset' => 'UTF-8',
            'enctype' => ! empty($options['files']) ? 'multipart/form-data' : null,
            'class' => $options['class'] ?? null,
            'id' => $options['id'] ?? null,
            'role' => $options['role'] ?? null,
            'style' => $options['style'] ?? null,
        ]));

        $html = "<form {$attrs}>";
        if ($htmlMethod !== 'GET') {
            $html .= csrf_field();
        }
        if ($spoof) {
            $html .= method_field($method);
        }

        return new HtmlString($html);
    }

    public function model($model, array $options = []): HtmlString
    {
        $this->model = $model;

        return $this->open($options);
    }

    public function close(): HtmlString
    {
        $this->model = null;

        return new HtmlString('</form>');
    }

    public function token(): HtmlString
    {
        return new HtmlString(csrf_field());
    }

    public function label($name, $value = null, $options = [], $escape = true): HtmlString
    {
        $value = $value ?? ucwords(str_replace('_', ' ', $name));
        $for = $options['for'] ?? $name;
        unset($options['for']);
        $attrs = $this->attributes(array_merge(['for' => $for], $options));
        $text = $escape ? e($value) : $value;

        return new HtmlString("<label {$attrs}>{$text}</label>");
    }

    public function input($type, $name, $value = null, $options = []): HtmlString
    {
        $value = $this->getValueAttribute($name, $value);
        $options['type'] = $type;
        $options['name'] = $name;
        if (! array_key_exists('id', $options)) {
            $options['id'] = $this->transformKey($name);
        }
        if ($value !== null && $type !== 'password' && $type !== 'file') {
            $options['value'] = $value;
        }
        $attrs = $this->attributes($options);

        return new HtmlString("<input {$attrs}>");
    }

    public function text($name, $value = null, $options = []): HtmlString
    {
        return $this->input('text', $name, $value, $options);
    }

    public function password($name, $options = []): HtmlString
    {
        return $this->input('password', $name, null, $options);
    }

    public function hidden($name, $value = null, $options = []): HtmlString
    {
        return $this->input('hidden', $name, $value, $options);
    }

    public function email($name, $value = null, $options = []): HtmlString
    {
        return $this->input('email', $name, $value, $options);
    }

    public function number($name, $value = null, $options = []): HtmlString
    {
        return $this->input('number', $name, $value, $options);
    }

    public function date($name, $value = null, $options = []): HtmlString
    {
        return $this->input('date', $name, $value, $options);
    }

    public function file($name, $options = []): HtmlString
    {
        return $this->input('file', $name, null, $options);
    }

    public function textarea($name, $value = null, $options = []): HtmlString
    {
        $value = e((string) ($this->getValueAttribute($name, $value) ?? ''));
        if (! array_key_exists('id', $options)) {
            $options['id'] = $this->transformKey($name);
        }
        $options['name'] = $name;
        $attrs = $this->attributes($options);

        return new HtmlString("<textarea {$attrs}>{$value}</textarea>");
    }

    public function select($name, $list = [], $selected = null, array $selectAttributes = [], array $optionsAttributes = [], array $optgroupsAttributes = []): HtmlString
    {
        $selected = $this->getValueAttribute($name, $selected);
        if (! array_key_exists('id', $selectAttributes)) {
            $selectAttributes['id'] = $this->transformKey($name);
        }
        $selectAttributes['name'] = $name;
        $html = '<select '.$this->attributes($selectAttributes).'>';
        foreach ($list as $value => $display) {
            if (is_array($display)) {
                $html .= '<optgroup label="'.e($value).'">';
                foreach ($display as $optValue => $optLabel) {
                    $html .= $this->option($optValue, $optLabel, $selected);
                }
                $html .= '</optgroup>';
            } else {
                $html .= $this->option($value, $display, $selected);
            }
        }
        $html .= '</select>';

        return new HtmlString($html);
    }

    protected function option($value, $display, $selected): string
    {
        $isSelected = $this->isSelected($value, $selected) ? ' selected' : '';

        return '<option value="'.e($value).'"'.$isSelected.'>'.e($display).'</option>';
    }

    protected function isSelected($value, $selected): bool
    {
        if (is_array($selected)) {
            return in_array((string) $value, array_map('strval', $selected), true);
        }

        return (string) $value === (string) $selected;
    }

    public function checkbox($name, $value = 1, $checked = null, $options = []): HtmlString
    {
        return $this->checkable('checkbox', $name, $value, $checked, $options);
    }

    public function radio($name, $value = null, $checked = null, $options = []): HtmlString
    {
        return $this->checkable('radio', $name, $value, $checked, $options);
    }

    protected function checkable($type, $name, $value, $checked, $options): HtmlString
    {
        if ($checked === null) {
            $current = $this->getValueAttribute($name, null);
            $checked = $current !== null && (string) $current === (string) $value;
        }
        if ($checked) {
            $options['checked'] = 'checked';
        }
        $options['type'] = $type;
        $options['name'] = $name;
        $options['value'] = $value;

        return new HtmlString('<input '.$this->attributes($options).'>');
    }

    public function submit($value = null, $options = []): HtmlString
    {
        $options['type'] = 'submit';
        if ($value !== null) {
            $options['value'] = $value;
        }

        return new HtmlString('<input '.$this->attributes($options).'>');
    }

    public function button($value = null, $options = []): HtmlString
    {
        $type = $options['type'] ?? 'button';
        unset($options['type']);
        $attrs = $this->attributes(array_merge(['type' => $type], $options));

        return new HtmlString("<button {$attrs}>".e($value).'</button>');
    }

    public function selectRange($name, $begin, $end, $selected = null, $options = []): HtmlString
    {
        $range = array_combine($r = range($begin, $end), $r);

        return $this->select($name, $range, $selected, $options);
    }

    protected function resolveAction(array $options): string
    {
        if (isset($options['action'])) {
            return is_array($options['action'])
                ? URL::action($options['action'][0], array_slice($options['action'], 1))
                : $options['action'];
        }
        if (isset($options['url'])) {
            return url($options['url']);
        }
        if (isset($options['route'])) {
            $route = $options['route'];
            if (is_array($route)) {
                return route($route[0], array_slice($route, 1));
            }

            return route($route);
        }

        return url()->current();
    }

    protected function getValueAttribute($name, $value)
    {
        $key = str_replace(['[', ']'], ['.', ''], $name);
        $old = old($key);
        if ($old !== null) {
            return $old;
        }
        if ($value !== null) {
            return $value;
        }
        if ($this->model) {
            return data_get($this->model, $key);
        }

        return null;
    }

    protected function transformKey($key): string
    {
        return str_replace(['.', '[]', '[', ']'], ['_', '', '_', ''], $key);
    }

    protected function attributes(array $attributes): string
    {
        $html = [];
        foreach ($attributes as $key => $value) {
            if ($value === null || $value === false) {
                continue;
            }
            if ($value === true) {
                $html[] = e($key).'="'.e($key).'"';
                continue;
            }
            $html[] = e($key).'="'.e($value).'"';
        }

        return implode(' ', $html);
    }
}
