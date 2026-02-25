<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DemoBladeController;
use App\Http\Controllers\XSSLabController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\TicketController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\SecurityTestController;
use App\Http\Controllers\ValidationLabController; 
use App\Http\Controllers\CsrfLabController; 

Route::get('/api/status', function () {
    return response()->json([
        'status' => 'OK',
        'message' => 'Server berjalan dengan baik',
        'time' => now()->toDateTimeString(),
    ]);
});

Route::prefix('demo-blade')->name('demo-blade.')->group(function () {
    Route::get('/', [DemoBladeController::class, 'index'])->name('index');
    Route::get('/directives', [DemoBladeController::class, 'directives'])->name('directives');
    Route::get('/components', [DemoBladeController::class, 'components'])->name('components');
    Route::get('/includes', [DemoBladeController::class, 'includes'])->name('includes');
    Route::get('/stacks', [DemoBladeController::class, 'stacks'])->name('stacks');
});

Route::prefix('xss-lab')->name('xss-lab.')->group(function () {
    Route::get('/', [XSSLabController::class, 'index'])->name('index');
    Route::post('/reset-comments', [XSSLabController::class, 'resetComments'])->name('reset-comments');

    Route::get('/reflected/vulnerable', [XSSLabController::class, 'reflectedVulnerable'])->name('reflected.vulnerable');
    Route::get('/reflected/secure', [XSSLabController::class, 'reflectedSecure'])->name('reflected.secure');

    Route::get('/stored/vulnerable', [XSSLabController::class, 'storedVulnerable'])->name('stored.vulnerable');
    Route::post('/stored/vulnerable', [XSSLabController::class, 'storedVulnerableStore'])->name('stored.vulnerable.store');
    Route::get('/stored/secure', [XSSLabController::class, 'storedSecure'])->name('stored.secure');
    Route::post('/stored/secure', [XSSLabController::class, 'storedSecureStore'])->name('stored.secure.store');

    Route::get('/dom/vulnerable', [XSSLabController::class, 'domVulnerable'])->name('dom.vulnerable');
    Route::get('/dom/secure', [XSSLabController::class, 'domSecure'])->name('dom.secure');
});

Route::prefix('validation-lab')->name('validation-lab.')->group(function () {
    Route::get('/', [ValidationLabController::class, 'index'])->name('index');
    Route::get('/vulnerable', [ValidationLabController::class, 'vulnerableForm'])->name('vulnerable');
    Route::post('/vulnerable', [ValidationLabController::class, 'vulnerableSubmit'])->name('vulnerable.submit');
    Route::post('/vulnerable/clear', [ValidationLabController::class, 'vulnerableClear'])->name('vulnerable.clear');
    Route::get('/secure', [ValidationLabController::class, 'secureForm'])->name('secure');
    Route::post('/secure', [ValidationLabController::class, 'secureSubmit'])->name('secure.submit');
    Route::post('/secure/clear', [ValidationLabController::class, 'secureClear'])->name('secure.clear');
});

Route::prefix('csrf-lab')->name('csrf-lab.')->group(function () {

    Route::get('/', [CsrfLabController::class, 'index'])->name('index');
    Route::get('/how-it-works', [CsrfLabController::class, 'howItWorks'])->name('how-it-works');
    Route::get('/attack-demo', [CsrfLabController::class, 'attackDemo'])->name('attack-demo');
    Route::get('/protection-demo', [CsrfLabController::class, 'protectionDemo'])->name('protection-demo');
    Route::get('/ajax-demo', [CsrfLabController::class, 'ajaxDemo'])->name('ajax-demo');
    
    Route::post('/secure-transfer', [CsrfLabController::class, 'secureTransfer'])->name('secure-transfer');
    Route::post('/protected-action', [CsrfLabController::class, 'protectedAction'])->name('protected-action');
    Route::post('/ajax-action', [CsrfLabController::class, 'ajaxAction'])->name('ajax-action');
    Route::post('/reset', [CsrfLabController::class, 'resetDemo'])->name('reset');
    
    Route::post('/vulnerable-transfer', [CsrfLabController::class, 'vulnerableTransfer'])
        ->name('vulnerable-transfer')
        ->withoutMiddleware([\Illuminate\Foundation\Http\Middleware\VerifyCsrfToken::class]);

    Route::post('/protected-transfer', [CsrfLabController::class, 'protectedTransfer'])
        ->name('protected-transfer');
});

Route::middleware('guest')->group(function () {
    Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
    Route::post('/login', [LoginController::class, 'login']);
});

Route::middleware('auth')->group(function () {
    Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

    Route::get('/', function () {
        return redirect()->route('tickets.index');
    });

    Route::resource('tickets', TicketController::class);

    Route::post('/tickets/{ticket}/comments', [CommentController::class, 'store'])->name('comments.store');
    Route::delete('/comments/{comment}', [CommentController::class, 'destroy'])->name('comments.destroy');
});

Route::prefix('security-testing')->name('security-testing.')->group(function () {
    Route::get('/', [SecurityTestController::class, 'index'])->name('index');
    Route::get('/xss', [SecurityTestController::class, 'xssTest'])->name('xss');
    Route::get('/csrf', [SecurityTestController::class, 'csrfTest'])->name('csrf');
    Route::post('/csrf', [SecurityTestController::class, 'csrfTestPost'])->name('csrf.post');
    Route::get('/headers', [SecurityTestController::class, 'headersTest'])->name('headers');
    Route::get('/audit-checklist', [SecurityTestController::class, 'auditChecklist'])->name('audit');
});