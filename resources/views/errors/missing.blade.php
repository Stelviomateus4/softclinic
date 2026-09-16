@extends('layouts.app')

@section('content')
<div class="ss-main">
    <div class="ss-page-header" style="text-align:center;margin-top:40px;">
        <h1>404</h1>
        <p>{{ __('ui.page_not_found') }}</p>
        <a href="{{ url('/') }}" class="ss-btn ss-btn-primary" style="margin-top:12px;">{{ __('ui.return_home') }}</a>
    </div>
</div>
@endsection
