<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="theme-color" content="#0A3D3B">
    <title>{{ $setting->name ?? config('app.name', 'SoftClinic') }}</title>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Fraunces:opsz,wght@9..144,500;9..144,600;9..144,700&family=Outfit:wght@400;500;600;700&display=swap" rel="stylesheet">

    <link href="{{ asset('css/bootstrap.min.css') }}" rel="stylesheet" crossorigin="anonymous">
    <link href="{{ asset('css/datepicker3.css') }}" rel="stylesheet">
    <link href="{{ asset('css/bootstrap-table.css') }}" rel="stylesheet">
    <link href="{{ asset('css/styles.css') }}" rel="stylesheet">
    <link href="{{ asset('css/fontawesome/css/all.css') }}" rel="stylesheet">
    <link href="{{ asset('css/datatable.css') }}" rel="stylesheet">
    <link href="{{ asset('css/buttons.dataTables.css') }}" rel="stylesheet">
    <link href="{{ asset('css/select2.min.css') }}" rel="stylesheet">
    <link href="{{ asset('css/timepicker.min.css') }}" rel="stylesheet">
    <link href="{{ asset('css/numpad.css') }}" rel="stylesheet">
    <link href="{{ asset('css/softsales.css') }}" rel="stylesheet">

    <link rel="icon" type="image/png" href="/favicon.png">
    <link rel="manifest" href="/manifest.json">
</head>
<script>
    window.Laravel = {!! json_encode([
        'csrfToken' => csrf_token(),
    ]) !!};
</script>
<script src="{{ asset('js/lumino.glyphs.js') }}"></script>
<script src="{{ asset('js/jquery-1.11.1.min.js') }}"></script>
<script src="{{ asset('js/bootstrap.min.js') }}"></script>
<script src="{{ asset('js/bootstrap-datepicker.js') }}"></script>
<script src="{{ asset('js/easypiechart.js') }}"></script>
<script src="{{ asset('js/easypiechart-data.js') }}"></script>
<script src="{{ asset('js/bootstrap-table.js') }}"></script>
<script src="{{ asset('js/nepali.datepicker.min.js') }}"></script>
<script src="{{ asset('js/datatable.js') }}"></script>
<script src="{{ asset('js/dataTables.buttons.min.js') }}"></script>
<script src="{{ asset('js/buttonPrint.js') }}"></script>
<script src="{{ asset('js/select2.min.js') }}"></script>
<script src="{{ asset('js/timepicker.min.js') }}"></script>
<script src="{{ asset('js/numpad.js') }}"></script>
<script src="//cdn.datatables.net/buttons/1.3.1/js/buttons.flash.min.js"></script>

<script type="text/javascript">
$(document).ready(function () {
    $('#example').DataTable();
    $('.example').DataTable();
    $('.datepicker').datepicker();
    $('.datepicker1').datepicker({
        format: "mm/dd/yyyy",
        todayHighlight: true,
        autoclose: true,
    });
    $('.datepicker').change(function () {
        $(".datepicker").datepicker('hide');
    });
    $('.datepicker1').change(function () {
        $(".datepicker1").datepicker('hide');
    });
});
</script>
<script>
$(document).ready(function () {
    $('input.timepicker').timepicker({ dropdown: true, scrollbar: true });

    $('#nepaliDateD').nepaliDatePicker({
        disableBefore: '12/08/2073',
        disableAfter: '12/20/2073'
    });
    $('#nepaliDateD1').nepaliDatePicker({
        disableDaysBefore: '10',
        disableDaysAfter: '10'
    });
    $('#nepaliDate5').nepaliDatePicker({ npdMonth: true, npdYear: true });
    $('#nepaliDate').nepaliDatePicker({
        onFocus: false,
        npdMonth: true,
        npdYear: true,
        ndpEnglishInput: 'englishDate',
        ndpTriggerButtonText: 'Date',
        ndpTriggerButtonClass: 'btn btn-primary btn-sm'
    });
    $('#nepaliDate1').nepaliDatePicker({
        onChange: function () {
            alert($('#nepaliDate1').val());
        }
    });
    $('#nepaliDate2').nepaliDatePicker();
    $('#nepaliDate3').nepaliDatePicker({
        onFocus: false,
        npdMonth: true,
        npdYear: true,
        ndpTriggerButton: true,
        ndpTriggerButtonText: 'Date',
        ndpTriggerButtonClass: 'btn btn-primary btn-sm'
    });

    $('#englishDate').change(function () {
        $('#nepaliDate').val(AD2BS($('#englishDate').val()));
    });
    $('#englishDate9').change(function () {
        $('#nepaliDate9').val(AD2BS($('#englishDate9').val()));
    });
    $('#nepaliDate9').change(function () {
        $('#englishDate9').val(BS2AD($('#nepaliDate9').val()));
    });
});
</script>
<script type="text/javascript">
$(document).ready(function () {
    $(".select2").select2();
    $(".select").select2();
});
</script>

@yield('script')

<body class="ss-app">

<nav class="navbar ss-nav">
  <div class="container-fluid">
    <div class="navbar-header">
      <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#ss-navbar" aria-expanded="false">
        <span class="sr-only">Menu</span>
        <span class="icon-bar" style="background:#0A3D3B"></span>
        <span class="icon-bar" style="background:#0A3D3B"></span>
        <span class="icon-bar" style="background:#0A3D3B"></span>
      </button>
      <a class="navbar-brand" href="{{ route('dashboard.index') }}">
        <i class="fas fa-clinic-medical"></i>
        {{ $setting->name ?? config('app.name', 'SoftClinic') }}
      </a>
    </div>

    <div class="collapse navbar-collapse" id="ss-navbar">
    <ul class="nav navbar-nav">
      <li class="{{ request()->is('/') ? 'active' : '' }}">
        <a href="{{ route('dashboard.index') }}"><i class="fas fa-home"></i> {{ __('ui.dashboard') }}</a>
      </li>

      @permission('department.index')
      <li class="dropdown {{ request()->is('department*') || request()->is('service*') || request()->is('package') || request()->is('employee*') || request()->is('doctor*') || request()->is('invoice/report') ? 'active' : '' }}">
        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
          <i class="fas fa-users-cog"></i> {{ __('ui.admin') }} <span class="caret"></span>
        </a>
        <ul class="dropdown-menu">
          <li><a href="{{ route('department.index') }}">{{ __('ui.departments') }}</a></li>
          <li><a href="{{ route('service.index') }}">{{ __('ui.services') }}</a></li>
          <li><a href="{{ route('package.index') }}">{{ __('ui.package') }}</a></li>
          <li><a href="{{ route('employee.index') }}">{{ __('ui.employees') }}</a></li>
          <li><a href="{{ route('doctor.index') }}">{{ __('ui.doctor_opd') }}</a></li>
          <li><a href="{{ route('invoice.report') }}">{{ __('ui.invoice_report') }}</a></li>
        </ul>
      </li>
      @endpermission

      @permission('patient.index')
      <li class="dropdown {{ request()->is('patient*') || request()->is('appointment*') ? 'active' : '' }}">
        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
          <i class="fas fa-hospital-user"></i> {{ __('ui.patient') }} <span class="caret"></span>
        </a>
        <ul class="dropdown-menu">
          <li><a href="{{ route('patient.index') }}">{{ __('ui.patient') }}</a></li>
          <li><a href="{{ route('appointment.index') }}">{{ __('ui.appointment') }}</a></li>
        </ul>
      </li>
      @endpermission

      @permission('invoice.report')
      <li class="dropdown {{ request()->is('account/*') ? 'active' : '' }}">
        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
          <i class="fas fa-file-medical-alt"></i> {{ __('ui.report') }} <span class="caret"></span>
        </a>
        <ul class="dropdown-menu">
          <li><a href="{{ route('account.service') }}">{{ __('ui.service_sale_report') }}</a></li>
          <li><a href="{{ route('account.opd') }}">{{ __('ui.opd_sale_report') }}</a></li>
          <li><a href="{{ route('account.package') }}">{{ __('ui.package_sale_report') }}</a></li>
        </ul>
      </li>
      @endpermission

      <li class="dropdown {{ request()->is('invoice*') || request()->is('opd*') || request()->is('package/sale') || request()->is('search/invoice') ? 'active' : '' }}">
        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
          <i class="fas fa-receipt"></i> {{ __('ui.invoice_bill') }} <span class="caret"></span>
        </a>
        <ul class="dropdown-menu">
          <li><a href="{{ route('invoice.index') }}">{{ __('ui.service_bill') }}</a></li>
          <li><a href="{{ route('opd.index') }}">{{ __('ui.opd_bill') }}</a></li>
          <li><a href="{{ url('package/sale') }}">{{ __('ui.package_bill') }}</a></li>
          @permission('search.invoice')
          <li><a href="{{ route('search.invoice') }}">{{ __('ui.invoice_report') }}</a></li>
          @endpermission
        </ul>
      </li>

      @permission('test.index')
      <li class="dropdown {{ request()->is('test') || request()->is('reference') || request()->is('haematology') || request()->is('biochemistry') || request()->is('immunology') || request()->is('microbiology') || request()->is('examination') || request()->is('stain') || request()->is('report') ? 'active' : '' }}">
        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
          <i class="fas fa-flask"></i> {{ __('ui.lab_test') }} <span class="caret"></span>
        </a>
        <ul class="dropdown-menu">
          <li><a href="{{ route('test.index') }}">{{ __('ui.manage_test') }}</a></li>
          <li><a href="{{ route('reference.index') }}">{{ __('ui.test_references') }}</a></li>
          <li><a href="{{ route('haematology.index') }}">{{ __('ui.haematology_report') }}</a></li>
          <li><a href="{{ route('biochemistry.index') }}">{{ __('ui.biochemistry_report') }}</a></li>
          <li><a href="{{ route('immunology.index') }}">{{ __('ui.immunology_report') }}</a></li>
          <li><a href="{{ route('microbiology.index') }}">{{ __('ui.microbiology_report') }}</a></li>
          <li><a href="{{ route('examination.index') }}">{{ __('ui.examination_report') }}</a></li>
          <li><a href="{{ route('stain.index') }}">{{ __('ui.stain_report') }}</a></li>
          <li><a href="{{ route('report.index') }}">{{ __('ui.report') }}</a></li>
        </ul>
      </li>
      @endpermission

      @permission('hospital.setting')
      <li class="dropdown {{ request()->is('user*') || request()->is('role*') || request()->is('setting') || request()->is('backup') ? 'active' : '' }}">
        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
          <i class="fas fa-tools"></i> {{ __('ui.setting') }} <span class="caret"></span>
        </a>
        <ul class="dropdown-menu">
          @permission('user.index')
          <li><a href="{{ route('user.index') }}">{{ __('ui.users') }}</a></li>
          @permission('role.index')
          <li><a href="{{ route('role.index') }}">{{ __('ui.roles') }}</a></li>
          @endpermission
          <li><a href="{{ route('hospital.setting') }}">{{ __('ui.settings') }}</a></li>
          <li><a href="{{ route('hospital.backup') }}">{{ __('ui.backup') }}</a></li>
          @endpermission
        </ul>
      </li>
      @endpermission
    </ul>

    <ul class="nav navbar-nav navbar-right">
      <li class="ss-lang-item">
        @include('partials.lang-switcher')
      </li>
      <li class="dropdown">
        <a href="#" class="dropdown-toggle" data-toggle="dropdown">
          {{ Auth::user()->name }} <span class="caret"></span>
        </a>
        <ul class="dropdown-menu">
          <li><a id="password_change">{{ __('ui.change_password') }}</a></li>
          <li>
            <a href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">{{ __('ui.logout') }}</a>
            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
              @csrf
            </form>
          </li>
        </ul>
      </li>
    </ul>
    </div>
  </div>
</nav>

@if (count($errors))
<div class="ss-main">
  <div class="ss-alert ss-alert-danger">
    @foreach ($errors->all() as $error)
      <div><strong>{{ $error }}</strong></div>
    @endforeach
  </div>
</div>
@endif

@include('change')

@yield('content')

<footer class="ss-footer">
  <div>{{ __('ui.developed_by') }} <strong>Milton Manjate</strong> · SoftSales Solutions</div>
  <div>
    <a href="https://github.com/miltonmanjate" target="_blank" rel="noopener">github.com/miltonmanjate</a>
  </div>
</footer>

</body>
</html>
