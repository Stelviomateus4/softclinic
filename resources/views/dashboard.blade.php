@extends('layouts.app')

@section('content')
<div class="ss-main ss-animate-in">
    <div class="ss-page-header">
        <h1>{{ __('ui.dashboard') }}</h1>
        <p>{{ __('ui.today_summary') }} · {{ $setting->name ?? 'SoftClinic' }}</p>
    </div>

    @if ($message = Session::get('success'))
        <div class="ss-alert ss-alert-success">
            <strong>{{ $message }}</strong>
        </div>
    @endif

    <div class="ss-stats">
        <div class="ss-stat">
            <div class="ss-stat-icon is-amber"><i class="fas fa-notes-medical"></i></div>
            <div>
                <div class="ss-stat-value">{{ $pending['appointment'] }}</div>
                <div class="ss-stat-label">{{ __('ui.pending_appointments') }}</div>
            </div>
        </div>
        <div class="ss-stat">
            <div class="ss-stat-icon"><i class="fas fa-users"></i></div>
            <div>
                <div class="ss-stat-value">{{ $patients->count() }}</div>
                <div class="ss-stat-label">{{ __('ui.total_patients') }}</div>
            </div>
        </div>
        <div class="ss-stat">
            <div class="ss-stat-icon is-ink"><i class="fas fa-vial"></i></div>
            <div>
                <div class="ss-stat-value">{{ $total_test }}</div>
                <div class="ss-stat-label">{{ __('ui.total_tests') }}</div>
            </div>
        </div>
        <div class="ss-stat">
            <div class="ss-stat-icon is-danger"><i class="fas fa-user-md"></i></div>
            <div>
                <div class="ss-stat-value">{{ $total_doctor }}</div>
                <div class="ss-stat-label">{{ __('ui.total_doctors') }}</div>
            </div>
        </div>
    </div>

    <div class="ss-panel-stack">
        <div class="panel panel-default">
            <div class="panel-heading">{{ __('ui.todays_appointments') }}</div>
            <div class="panel-body">
                <table id="table1" class="display table table-bordered table-condensed table-hover" cellspacing="0" width="100%">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>{{ __('ui.name') }}</th>
                            <th>{{ __('ui.patient') }}</th>
                            <th>{{ __('ui.doctor') }}</th>
                            <th>{{ __('ui.description') }}</th>
                            <th>{{ __('ui.time') }}</th>
                            <th>{{ __('ui.status') }}</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $i = 1; ?>
                        @foreach ($appointments as $appointment)
                        <tr>
                            <td>{{ $i++ }}</td>
                            <td>{{ $appointment->name }}</td>
                            <td>{{ $appointment->patient->first_name }} {{ $appointment->patient->last_name }}</td>
                            <td>{{ $appointment->doctor->employee->first_name }} {{ $appointment->doctor->employee->middle_name }} {{ $appointment->doctor->employee->last_name }}</td>
                            <td>{{ $appointment->description }}</td>
                            <td>{{ $appointment->time }}</td>
                            <td>
                                @if ($appointment->status)
                                    <a class="btn-sm btn-success" href="{{ route('appointment.edit', $appointment->id) }}">
                                        <span class="glyphicon glyphicon-ok"></span> {{ __('ui.complete') }}
                                    </a>
                                @else
                                    <a class="btn-sm btn-warning" href="{{ route('appointment.edit', $appointment->id) }}">
                                        <span class="glyphicon glyphicon-refresh"></span> {{ __('ui.pending') }}
                                    </a>
                                @endif
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>

        <div class="panel panel-default">
            <div class="panel-heading">{{ __('ui.todays_collection') }}</div>
            <div class="panel-body">
                <table id="table" class="display table table-bordered table-condensed" cellspacing="0" width="100%">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>{{ __('ui.invoice_no') }}</th>
                            <th>{{ __('ui.payment') }}</th>
                            <th>{{ __('ui.sub_total') }}</th>
                            <th>{{ __('ui.discount') }}</th>
                            <th>{{ __('ui.tax') }}</th>
                            <th>{{ __('ui.total_amount') }}</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $i = 1; ?>
                        @foreach ($invoices as $invoice)
                        <tr>
                            <td>{{ $i++ }}</td>
                            <td>{{ $invoice->invoice_no }}</td>
                            <td>{{ $invoice->payment_type }}</td>
                            <td>${{ number_format($invoice->sub_total, 2) }}</td>
                            <td>${{ $invoice->discount }}</td>
                            <td>${{ number_format($invoice->tax_amount, 2) }}</td>
                            <td>${{ number_format($invoice->total_amount) }}</td>
                        </tr>
                        @endforeach
                    </tbody>
                    <tr>
                        <th></th>
                        <th>{{ __('ui.total') }}:</th>
                        <th></th>
                        <th>${{ number_format($total['sub_total'], 2) }}</th>
                        <th>${{ $total['discount'] }}</th>
                        <th>${{ number_format($total['tax_amount'], 2) }}</th>
                        <th>${{ number_format($total['total_amount']) }}</th>
                    </tr>
                </table>
            </div>
        </div>

        <div class="panel panel-default">
            <div class="panel-heading">{{ __('ui.todays_opd') }}</div>
            <div class="panel-body">
                <table id="example" class="display table table-bordered table-condensed table-hover" cellspacing="0" width="100%">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>{{ __('ui.patient') }}</th>
                            <th>{{ __('ui.doctor') }}</th>
                            <th>{{ __('ui.register_at') }}</th>
                            <th>{{ __('ui.status') }}</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $i = 1; ?>
                        @foreach ($opds as $opd)
                        <tr>
                            <td>{{ $i++ }}</td>
                            <td>{{ $opd->invoice->patient->first_name }} {{ $opd->invoice->patient->last_name }}</td>
                            <td>{{ $opd->doctor->employee->first_name }} {{ $opd->doctor->employee->middle_name }} {{ $opd->doctor->employee->last_name }}</td>
                            <td>{{ $opd->created_at }}</td>
                            @if ($opd->status == 1)
                                <td><span class="btn-sm btn-success glyphicon glyphicon-ok"> {{ __('ui.complete') }}</span></td>
                            @else
                                <td>
                                    <a class="btn-sm btn-warning" href="{{ route('doctor.edit', $opd->id) }}">
                                        <span class="glyphicon glyphicon-refresh"> {{ __('ui.pending') }}</span>
                                    </a>
                                </td>
                            @endif
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<script type="text/javascript">
    $(document).ready(function () {
        $('#table').DataTable();
        $('#table1').DataTable();
    });
</script>
@endsection
