@extends('layouts.app')

@section('content')
<div class="ss-main">
    <div class="ss-page-header" style="text-align:center;margin-top:40px;">
        <p style="margin-bottom:8px;"><small>{{ $setting->name ?? config('app.name') }}</small></p>
        <div class="ss-alert ss-alert-danger" style="display:inline-block;text-align:left;max-width:520px;">
            <h2 style="margin:0;font-size:1.35rem;">{{ $exception->getMessage() }}</h2>
        </div>
        <div style="margin-top:18px;">
            <a href="{{ route('dashboard.index') }}" class="ss-btn ss-btn-primary">{{ __('ui.return_home') }}</a>
        </div>
    </div>
</div>
@endsection
