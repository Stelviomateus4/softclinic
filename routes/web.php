<?php

use App\Http\Controllers\AccountController;
use App\Http\Controllers\AppointmentController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\BiochemistryController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\DepartmentController;
use App\Http\Controllers\DoctorApiController;
use App\Http\Controllers\DoctorController;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\ExaminationController;
use App\Http\Controllers\HaematologyController;
use App\Http\Controllers\HospitalController;
use App\Http\Controllers\ImmunologyController;
use App\Http\Controllers\InvoiceController;
use App\Http\Controllers\MicrobiologyController;
use App\Http\Controllers\OpdController;
use App\Http\Controllers\PackageController;
use App\Http\Controllers\PatientController;
use App\Http\Controllers\ReferenceTestController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\ResultController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\ServiceController;
use App\Http\Controllers\StainController;
use App\Http\Controllers\TestController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Session;

Route::get('/locale/{locale}', function (string $locale) {
    if (! in_array($locale, ['en', 'pt'], true)) {
        abort(400);
    }

    Session::put('locale', $locale);

    return redirect()->back(fallback: '/');
})->name('locale.switch');

Route::get('/invoice/calculate/', [InvoiceController::class, 'calculate']);
Route::get('/days/{id}', [DoctorApiController::class, 'getDays']);

Route::middleware('guest')->group(function () {
    Route::get('login', [LoginController::class, 'showLoginForm'])->name('login');
    Route::post('login', [LoginController::class, 'login']);
});

Route::post('logout', [LoginController::class, 'logout'])->name('logout')->middleware('auth');

Route::middleware('auth')->group(function () {
    Route::get('backup', [HospitalController::class, 'backup'])->name('hospital.backup');
    Route::get('/', [DashboardController::class, 'index'])->name('dashboard.index');
    Route::get('setting', [HospitalController::class, 'setting'])->name('hospital.setting');
    Route::post('change/password', [UserController::class, 'changePassword'])->name('change.password');
    Route::post('hospital/update/{id}', [HospitalController::class, 'updateHospital'])->name('hospital.update');
    Route::post('tax/update/{id}', [HospitalController::class, 'updateTax'])->name('tax.update');
    Route::post('config/update/', [HospitalController::class, 'updateConfig'])->name('config.update');

    Route::get('user', [UserController::class, 'index'])->name('user.index');
    Route::post('user', [UserController::class, 'store'])->name('user.store');
    Route::post('user/edit/', [UserController::class, 'edit'])->name('user.edit');
    Route::post('user/delete/', [UserController::class, 'delete'])->name('user.delete');

    Route::get('department/', [DepartmentController::class, 'getIndex'])->name('department.index');
    Route::post('department/add', [DepartmentController::class, 'store'])->name('department.add');
    Route::post('department/edit', [DepartmentController::class, 'edit'])->name('department.edit');
    Route::post('department/delete', [DepartmentController::class, 'delete'])->name('department.delete');

    Route::get('service/', [ServiceController::class, 'getIndex'])->name('service.index');
    Route::post('service/add', [ServiceController::class, 'store'])->name('service.add');
    Route::post('service/edit', [ServiceController::class, 'edit'])->name('service.edit');
    Route::post('service/delete', [ServiceController::class, 'delete'])->name('service.delete');

    Route::resource('employee', EmployeeController::class);
    Route::resource('doctor', DoctorController::class);
    Route::resource('patient', PatientController::class);
    Route::resource('appointment', AppointmentController::class);
    Route::resource('role', RoleController::class);

    Route::get('package', [PackageController::class, 'getIndex'])->name('package.index');
    Route::post('package', [PackageController::class, 'store'])->name('package.store');
    Route::post('package/edit', [PackageController::class, 'edit'])->name('package.edit');
    Route::post('package/test/delete', [PackageController::class, 'packageTestDelete'])->name('package.test.delete');
    Route::post('pacakge/delete', [PackageController::class, 'delete'])->name('package.delete');

    Route::post('appointment/updated', [AppointmentController::class, 'updated'])->name('appointment.updated');

    Route::get('invoice', [InvoiceController::class, 'index'])->name('invoice.index');
    Route::post('invoice', [InvoiceController::class, 'store'])->name('invoice.store');
    Route::get('invoice/patient/{patient_id}', [InvoiceController::class, 'patient'])->name('invoice.patient');
    Route::get('invoice/remove/{id}', [InvoiceController::class, 'remove'])->name('invoice.remove');
    Route::get('invoice/sales/{id}', [InvoiceController::class, 'tempSales'])->name('invoice.sale');
    Route::get('invoice/opd/{id}', [OpdController::class, 'opdSales'])->name('invoice.opd');
    Route::get('invoice/report', [InvoiceController::class, 'report'])->name('invoice.report');
    Route::get('invoice/duplicate/{id}', [InvoiceController::class, 'duplicate'])->name('invoice.duplicate');
    Route::get('search/invoice', [InvoiceController::class, 'searchInvoice'])->name('search.invoice');
    Route::post('invoice/return', [InvoiceController::class, 'invoiceReturn'])->name('invoice.return');

    Route::get('opd', [OpdController::class, 'getindex'])->name('opd.index');
    Route::post('opd', [OpdController::class, 'store'])->name('opd.store');

    Route::post('package/sale', [PackageController::class, 'packageSale'])->name('package.sale');
    Route::get('package/sale', [PackageController::class, 'sale'])->name('package.sale.create');
    Route::get('package/sale/{id}', [PackageController::class, 'packageSales'])->name('package.sales');

    Route::get('test', [TestController::class, 'index'])->name('test.index');
    Route::post('test/{id}/status', [TestController::class, 'statusChange'])->name('test.status');
    Route::post('test/add', [TestController::class, 'store'])->name('test.store');
    Route::post('test/edit', [TestController::class, 'edit'])->name('test.edit');
    Route::post('test/delete', [TestController::class, 'delete'])->name('test.delete');

    Route::get('reference', [ReferenceTestController::class, 'index'])->name('reference.index');
    Route::post('reference', [ReferenceTestController::class, 'store'])->name('reference.store');
    Route::post('reference/update', [ReferenceTestController::class, 'edit'])->name('reference.update');
    Route::post('reference/delete', [ReferenceTestController::class, 'delete'])->name('reference.delete');
    Route::post('antibiotic', [MicrobiologyController::class, 'storeAntibiotic'])->name('antibiotic.store');
    Route::post('antibiotic/edit', [MicrobiologyController::class, 'editAntibiotic'])->name('antibiotic.edit');

    Route::get('haematology', [HaematologyController::class, 'index'])->name('haematology.index');
    Route::post('haematology', [HaematologyController::class, 'store'])->name('haematology.store');
    Route::get('immunology', [ImmunologyController::class, 'index'])->name('immunology.index');
    Route::post('immunology', [ImmunologyController::class, 'store'])->name('immunology.store');
    Route::get('microbiology', [MicrobiologyController::class, 'index'])->name('microbiology.index');
    Route::post('microbiology', [MicrobiologyController::class, 'store'])->name('microbiology.store');
    Route::get('examination', [ExaminationController::class, 'index'])->name('examination.index');
    Route::post('examination', [ExaminationController::class, 'store'])->name('examination.store');
    Route::post('examination/update', [ExaminationController::class, 'update'])->name('examination.update');
    Route::get('biochemistry', [BiochemistryController::class, 'index'])->name('biochemistry.index');
    Route::post('biochemistry', [BiochemistryController::class, 'store'])->name('biochemistry.store');
    Route::get('stain', [StainController::class, 'index'])->name('stain.index');
    Route::post('stain', [StainController::class, 'store'])->name('stain.store');
    Route::post('stain/edit', [StainController::class, 'edit'])->name('stain.edit');

    Route::get('report', [ReportController::class, 'index'])->name('report.index');
    Route::post('report/{id}/status', [ReportController::class, 'statusChange'])->name('report.status');
    Route::get('report/edit/{id}', [ReportController::class, 'edit'])->name('report.edit');
    Route::get('report/patient/{patient_id}', [ReportController::class, 'patient'])->name('report.patient');
    Route::post('report/update', [ReportController::class, 'update'])->name('report.update');
    Route::get('report/print/{id}', [ReportController::class, 'printReport'])->name('report.print');

    Route::get('result/test/{id}', [ResultController::class, 'getTest'])->name('result.test');
    Route::get('result/tests/{id}', [ResultController::class, 'getTests'])->name('result.tests');
    Route::post('result', [ResultController::class, 'store'])->name('result.store');
    Route::post('result/edit', [ResultController::class, 'edit'])->name('result.edit');
    Route::get('generate/report/{report_id}', [ResultController::class, 'generateReport'])->name('report.generate');
    Route::get('result/comment/edit', [ResultController::class, 'editComment'])->name('report.comment');
    Route::get('report/result/edit', [ReportController::class, 'editResult'])->name('report.result');

    Route::get('account/service', [AccountController::class, 'serviceReport'])->name('account.service');
    Route::get('account/opd', [AccountController::class, 'opdReport'])->name('account.opd');
    Route::get('account/package', [AccountController::class, 'packageReport'])->name('account.package');
});
