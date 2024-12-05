<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\StudentResultsController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\KafaClassController;
use App\Http\Controllers\TimetableController;
// manage student results use



/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('auth/login');
});

Route::get('/ParentsHome', function () {
    return view('parents');
})->name('parentHome');

Route::get('/AdminHome', function () {
    return view('admin');
})->name('adminHome');

Route::get('/TeacherHome', function () {
    return view('teacher');
})->name('teacherHome');


Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

route::get('/home', [HomeController::class, 'index']);

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});


// route for manage student results

Route::get('ListStudent/{ClassName}', [App\Http\Controllers\StudentResultsController::class, 'index'])->name('listStudent');
Route::get('/showresttest/{id}', [StudentResultsController::class, 'showresultform'])->name('resultform');
Route::post('ListStudent/create', [App\Http\Controllers\StudentResultsController::class, 'store'])->name('resultform.store');
Route::get('ListStudent/{stdid}/edit', [App\Http\Controllers\StudentResultsController::class, 'edit'])->name('resultform.update');
Route::put('ListStudent/{id}/edit', [App\Http\Controllers\StudentResultsController::class, 'update'])->name('update.result');
Route::get('ListStudent/{id}/delete', [App\Http\Controllers\StudentResultsController::class, 'destroy'])->name('destroy.data');

// route to list class
Route::get('ListClass', [App\Http\Controllers\StudentResultsController::class, 'showListClass'])->name('listClass.view');

// route for KAFA admin manage student results

Route::get('AdminListClass', [App\Http\Controllers\StudentResultsController::class, 'showAdminListClass'])->name('AdminlistClass.view');
Route::get('AdminListStudent/{ClassName}', [App\Http\Controllers\StudentResultsController::class, 'showAdminListStudent'])->name('AdminlistStudent');
Route::get('/showAddSubjectForm/{ClassName}', [App\Http\Controllers\StudentResultsController::class, 'showAddSubject'])->name('AddSubject');

// Route::get('/showAddSubjectForm', [App\Http\Controllers\StudentResultsController::class, 'showAddSubject'])->name('AddSubject');
Route::post('/showAddSubjectForm/create', [App\Http\Controllers\StudentResultsController::class, 'Subjectstore'])->name('Subject.store');
Route::get('AdminListStudent/{id}/delete', [App\Http\Controllers\StudentResultsController::class, 'destroySubject'])->name('destroySubject.data');

// ROUTE FOR PARENTS STUDENT RESULTS
Route::get('/ParentStudent', [App\Http\Controllers\StudentResultsController::class, 'showParentStudent'])->name('ParentStudent.View');
Route::get('/DisplayResults/{Student}', [App\Http\Controllers\StudentResultsController::class, 'showResults'])->name('StudentResults.View');

//register student
Route::get('/Register-Student', function () {
    return view('manage-profile/registerstud');
})->middleware(['auth', 'verified', 'parentauth'])->name('register.stud');

// ROute Manage time table

Route::get('/View', function () {
    return view('manage-yearly-timetable.test');
});

use App\Http\Controllers\StudentActivityController;


//Manage Payment route
use App\Http\Controllers\PaymentController;

Route::get('/payment-history', [PaymentController::class, 'receivePayment'])->middleware(['auth', 'verified', 'parentauth'])->name('payment.history');
Route::get('/parent-payment', [PaymentController::class, 'showPaymentForm'])->middleware(['auth', 'verified', 'parentauth'])->name('parent.payment.form');
Route::post('/session', [PaymentController::class, 'processPayment'])->middleware(['auth', 'verified', 'parentauth'])->name('session.store');
Route::get('/payment/success', [PaymentController::class, 'paymentSuccess'])->middleware(['auth', 'verified', 'parentauth'])->name('payment.success');
Route::get('/payment/cancel', [PaymentController::class, 'paymentCancel'])->middleware(['auth', 'verified', 'parentauth'])->name('payment.cancel');
Route::get('/payment.dashboard', [PaymentController::class, 'adminPaymentDashboard'])->middleware(['auth', 'verified', 'adminauth'])->name('payment.dashboard');

Route::get('/payment/report', [PaymentController::class, 'showReport'])->middleware(['auth', 'verified', 'adminauth'])->name('payment.report');
Route::put('/admin/update-payment', [PaymentController::class, 'updatePayment'])->middleware(['auth', 'verified', 'adminauth'])->name('admin.updatePayment');

Route::get('/admin/getChildren/{userId}', [PaymentController::class, 'getChildren'])->name('admin.getChildren');

Route::post('/admin/storePayment', [PaymentController::class, 'storePayment'])->name('admin.storePayment');


/** routes for manage timetable */
//routes to display the timetable index page
Route::get('/timetable', [TimetableController::class, 'index'])->name('timetable.index')->middleware('auth');

//route to display the timetable form
Route::get('/timetable/create-timetable', [TimetableController::class, 'showCreateTimetable'])->name('timetable.create')->middleware('auth');

//route to submit the timetable form data
Route::post('/timetable/create-timetable', [TimetableController::class, 'createTimetable'])->middleware('auth');

//route to display the view timetable
Route::get('timetable/{id}/view-timetable', [TimetableController::class, 'viewTimetable'])->name('timetable.view')->middleware('auth');

//route to edit the timetable
Route::get('/timetable/{id}/update-timetable', [TimetableController::class, 'editTimetable'])->name('timetable.edit')->middleware('auth');

//route to update the timetable
Route::put('/timetable/{id}/update-timetable', [TimetableController::class, 'updateTimetable'])->middleware('auth');

//route to delete the timetable
Route::get('/timetable/{id}/delete-timetable', [TimetableController::class, 'deleteTimetable'])->middleware('auth');

Route::resources([
    'kafa-class' => KafaClassController::class,
    'student-activity' => StudentActivityController::class,
]);

require __DIR__ . '/auth.php';
