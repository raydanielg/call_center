<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProfileController;

Route::get('/', function () {
    return view('landing.pages.index');
});

Auth::routes(['reset' => false]);

// Custom password reset with activation code
Route::get('password/reset', [App\Http\Controllers\Auth\PasswordResetController::class, 'showLinkRequestForm'])->name('password.request');
Route::post('password/email', [App\Http\Controllers\Auth\PasswordResetController::class, 'sendResetCode'])->name('password.email');
Route::get('password/code', [App\Http\Controllers\Auth\PasswordResetController::class, 'showCodeForm'])->name('password.code');
Route::post('password/code', [App\Http\Controllers\Auth\PasswordResetController::class, 'verifyCode'])->name('password.code.verify');
Route::post('password/resend', [App\Http\Controllers\Auth\PasswordResetController::class, 'resendCode'])->name('password.resend');
Route::get('password/reset/{token}', [App\Http\Controllers\Auth\PasswordResetController::class, 'showResetForm'])->name('password.reset');
Route::post('password/reset', [App\Http\Controllers\Auth\PasswordResetController::class, 'resetPassword'])->name('password.update');

Route::get('/register/success', [App\Http\Controllers\Auth\RegisterController::class, 'showSuccess'])->name('register.success');

Route::get('/home', [HomeController::class, 'index'])->name('home');

// Profile (all authenticated users)
Route::middleware(['auth'])->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::put('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::put('/profile/password', [ProfileController::class, 'updatePassword'])->name('profile.password');
});

// Dialer Widget (Agent, Supervisor, Company Admin)
Route::middleware(['auth', 'role:agent,supervisor,company_admin'])->prefix('dialer')->name('dialer.')->group(function () {
    Route::get('/phone-status', [App\Http\Controllers\DialerController::class, 'phoneStatus'])->name('phone-status');
    Route::post('/connect-phone', [App\Http\Controllers\DialerController::class, 'connectPhone'])->name('connect-phone');
    Route::post('/disconnect-phone', [App\Http\Controllers\DialerController::class, 'disconnectPhone'])->name('disconnect-phone');
    Route::get('/contacts', [App\Http\Controllers\DialerController::class, 'contacts'])->name('contacts');
    Route::get('/dispositions', [App\Http\Controllers\DialerController::class, 'dispositions'])->name('dispositions');
    Route::post('/log-call', [App\Http\Controllers\DialerController::class, 'logCall'])->name('log-call');
});

// Super Admin Routes
Route::middleware(['auth', 'role:super_admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/dashboard', [App\Http\Controllers\Admin\DashboardController::class, 'index'])->name('dashboard');

    Route::get('/companies', [App\Http\Controllers\Admin\CompanyController::class, 'index'])->name('companies.index');
    Route::get('/companies/{tenant}', [App\Http\Controllers\Admin\CompanyController::class, 'show'])->name('companies.show');
    Route::put('/companies/{tenant}/status', [App\Http\Controllers\Admin\CompanyController::class, 'updateStatus'])->name('companies.status');
    Route::delete('/companies/{tenant}', [App\Http\Controllers\Admin\CompanyController::class, 'destroy'])->name('companies.destroy');

    Route::get('/plans', [App\Http\Controllers\Admin\PlanController::class, 'index'])->name('plans.index');
    Route::get('/plans/create', [App\Http\Controllers\Admin\PlanController::class, 'create'])->name('plans.create');
    Route::post('/plans', [App\Http\Controllers\Admin\PlanController::class, 'store'])->name('plans.store');
    Route::get('/plans/{plan}/edit', [App\Http\Controllers\Admin\PlanController::class, 'edit'])->name('plans.edit');
    Route::put('/plans/{plan}', [App\Http\Controllers\Admin\PlanController::class, 'update'])->name('plans.update');
    Route::delete('/plans/{plan}', [App\Http\Controllers\Admin\PlanController::class, 'destroy'])->name('plans.destroy');

    Route::get('/subscriptions', [App\Http\Controllers\Admin\SubscriptionController::class, 'index'])->name('subscriptions.index');

    Route::get('/payments', [App\Http\Controllers\Admin\PaymentController::class, 'index'])->name('payments.index');

    Route::get('/reports', [App\Http\Controllers\Admin\ReportController::class, 'index'])->name('reports.index');

    Route::get('/settings', [App\Http\Controllers\Admin\SettingController::class, 'index'])->name('settings.index');
    Route::put('/settings', [App\Http\Controllers\Admin\SettingController::class, 'update'])->name('settings.update');
});

// Company Admin Routes
Route::middleware(['auth', 'role:company_admin', 'subscription', 'tenant.active'])->prefix('company')->name('company.')->group(function () {
    Route::get('/dashboard', [App\Http\Controllers\Company\DashboardController::class, 'index'])->name('dashboard');

    Route::get('/staff', [App\Http\Controllers\Company\StaffController::class, 'index'])->name('staff.index');
    Route::get('/staff/create', [App\Http\Controllers\Company\StaffController::class, 'create'])->name('staff.create');
    Route::post('/staff', [App\Http\Controllers\Company\StaffController::class, 'store'])->name('staff.store');
    Route::get('/staff/{user}/edit', [App\Http\Controllers\Company\StaffController::class, 'edit'])->name('staff.edit');
    Route::put('/staff/{user}', [App\Http\Controllers\Company\StaffController::class, 'update'])->name('staff.update');
    Route::delete('/staff/{user}', [App\Http\Controllers\Company\StaffController::class, 'destroy'])->name('staff.destroy');

    Route::get('/calls', [App\Http\Controllers\Company\CallController::class, 'index'])->name('calls.index');
    Route::get('/calls/create', [App\Http\Controllers\Company\CallController::class, 'create'])->name('calls.create');
    Route::post('/calls', [App\Http\Controllers\Company\CallController::class, 'store'])->name('calls.store');
    Route::get('/calls/{call}', [App\Http\Controllers\Company\CallController::class, 'show'])->name('calls.show');
    Route::get('/calls/{call}/edit', [App\Http\Controllers\Company\CallController::class, 'edit'])->name('calls.edit');
    Route::put('/calls/{call}', [App\Http\Controllers\Company\CallController::class, 'update'])->name('calls.update');
    Route::delete('/calls/{call}', [App\Http\Controllers\Company\CallController::class, 'destroy'])->name('calls.destroy');

    Route::get('/tickets', [App\Http\Controllers\Company\TicketController::class, 'index'])->name('tickets.index');
    Route::get('/tickets/create', [App\Http\Controllers\Company\TicketController::class, 'create'])->name('tickets.create');
    Route::post('/tickets', [App\Http\Controllers\Company\TicketController::class, 'store'])->name('tickets.store');
    Route::get('/tickets/{ticket}', [App\Http\Controllers\Company\TicketController::class, 'show'])->name('tickets.show');
    Route::put('/tickets/{ticket}/status', [App\Http\Controllers\Company\TicketController::class, 'updateStatus'])->name('tickets.status');

    Route::get('/contacts', [App\Http\Controllers\Company\ContactController::class, 'index'])->name('contacts.index');
    Route::get('/contacts/create', [App\Http\Controllers\Company\ContactController::class, 'create'])->name('contacts.create');
    Route::post('/contacts', [App\Http\Controllers\Company\ContactController::class, 'store'])->name('contacts.store');
    Route::get('/contacts/{contact}/edit', [App\Http\Controllers\Company\ContactController::class, 'edit'])->name('contacts.edit');
    Route::put('/contacts/{contact}', [App\Http\Controllers\Company\ContactController::class, 'update'])->name('contacts.update');
    Route::delete('/contacts/{contact}', [App\Http\Controllers\Company\ContactController::class, 'destroy'])->name('contacts.destroy');

    Route::get('/campaigns', [App\Http\Controllers\Company\CampaignController::class, 'index'])->name('campaigns.index');
    Route::get('/campaigns/create', [App\Http\Controllers\Company\CampaignController::class, 'create'])->name('campaigns.create');
    Route::post('/campaigns', [App\Http\Controllers\Company\CampaignController::class, 'store'])->name('campaigns.store');
    Route::get('/campaigns/{campaign}', [App\Http\Controllers\Company\CampaignController::class, 'show'])->name('campaigns.show');
    Route::put('/campaigns/{campaign}/status', [App\Http\Controllers\Company\CampaignController::class, 'updateStatus'])->name('campaigns.status');
    Route::delete('/campaigns/{campaign}', [App\Http\Controllers\Company\CampaignController::class, 'destroy'])->name('campaigns.destroy');

    Route::get('/queues', [App\Http\Controllers\Company\QueueController::class, 'index'])->name('queues.index');
    Route::get('/queues/create', [App\Http\Controllers\Company\QueueController::class, 'create'])->name('queues.create');
    Route::post('/queues', [App\Http\Controllers\Company\QueueController::class, 'store'])->name('queues.store');
    Route::get('/queues/{queue}/edit', [App\Http\Controllers\Company\QueueController::class, 'edit'])->name('queues.edit');
    Route::put('/queues/{queue}', [App\Http\Controllers\Company\QueueController::class, 'update'])->name('queues.update');
    Route::delete('/queues/{queue}', [App\Http\Controllers\Company\QueueController::class, 'destroy'])->name('queues.destroy');

    Route::get('/reports', [App\Http\Controllers\Company\ReportController::class, 'index'])->name('reports.index');

    Route::get('/billing', [App\Http\Controllers\Company\BillingController::class, 'index'])->name('billing.index');
    Route::get('/billing/expired', [App\Http\Controllers\Company\BillingController::class, 'expired'])->name('billing.expired');
    Route::get('/billing/suspended', [App\Http\Controllers\Company\BillingController::class, 'suspended'])->name('billing.suspended');

    Route::get('/settings', [App\Http\Controllers\Company\SettingController::class, 'index'])->name('settings.index');
    Route::put('/settings', [App\Http\Controllers\Company\SettingController::class, 'update'])->name('settings.update');
    Route::post('/settings/dispositions', [App\Http\Controllers\Company\SettingController::class, 'storeDisposition'])->name('settings.dispositions.store');
    Route::delete('/settings/dispositions/{disposition}', [App\Http\Controllers\Company\SettingController::class, 'destroyDisposition'])->name('settings.dispositions.destroy');
});

// Billing routes outside subscription guard (accessible when expired)
Route::middleware(['auth', 'role:company_admin'])->prefix('billing')->name('billing.')->group(function () {
    Route::get('/expired', [App\Http\Controllers\Company\BillingController::class, 'expired'])->name('expired');
    Route::get('/suspended', [App\Http\Controllers\Company\BillingController::class, 'suspended'])->name('suspended');
});

// Supervisor Routes
Route::middleware(['auth', 'role:supervisor', 'subscription', 'tenant.active'])->prefix('supervisor')->name('supervisor.')->group(function () {
    Route::get('/dashboard', [App\Http\Controllers\Supervisor\DashboardController::class, 'index'])->name('dashboard');

    Route::get('/live-monitor', [App\Http\Controllers\Supervisor\LiveMonitorController::class, 'index'])->name('live-monitor.index');

    Route::get('/agents', [App\Http\Controllers\Supervisor\AgentController::class, 'index'])->name('agents.index');
    Route::get('/agents/{user}', [App\Http\Controllers\Supervisor\AgentController::class, 'show'])->name('agents.show');

    Route::get('/calls', [App\Http\Controllers\Supervisor\CallController::class, 'index'])->name('calls.index');

    Route::get('/tickets', [App\Http\Controllers\Supervisor\TicketController::class, 'index'])->name('tickets.index');
    Route::put('/tickets/{ticket}/assign', [App\Http\Controllers\Supervisor\TicketController::class, 'assign'])->name('tickets.assign');

    Route::get('/campaigns', [App\Http\Controllers\Supervisor\CampaignController::class, 'index'])->name('campaigns.index');
    Route::get('/campaigns/{campaign}', [App\Http\Controllers\Supervisor\CampaignController::class, 'show'])->name('campaigns.show');

    Route::get('/reports', [App\Http\Controllers\Supervisor\ReportController::class, 'index'])->name('reports.index');
});

// Agent Routes
Route::middleware(['auth', 'role:agent', 'subscription', 'tenant.active'])->prefix('agent')->name('agent.')->group(function () {
    Route::get('/dashboard', [App\Http\Controllers\Agent\DashboardController::class, 'index'])->name('dashboard');

    Route::get('/calls', [App\Http\Controllers\Agent\CallController::class, 'index'])->name('calls.index');
    Route::post('/calls', [App\Http\Controllers\Agent\CallController::class, 'store'])->name('calls.store');
    Route::get('/calls/{call}', [App\Http\Controllers\Agent\CallController::class, 'show'])->name('calls.show');
    Route::get('/calls/{call}/edit', [App\Http\Controllers\Agent\CallController::class, 'edit'])->name('calls.edit');
    Route::put('/calls/{call}', [App\Http\Controllers\Agent\CallController::class, 'update'])->name('calls.update');
    Route::delete('/calls/{call}', [App\Http\Controllers\Agent\CallController::class, 'destroy'])->name('calls.destroy');

    Route::get('/dialer/contacts', [App\Http\Controllers\Agent\CallController::class, 'dialerContacts'])->name('dialer.contacts');

    Route::get('/tickets', [App\Http\Controllers\Agent\TicketController::class, 'index'])->name('tickets.index');
    Route::get('/tickets/{ticket}', [App\Http\Controllers\Agent\TicketController::class, 'show'])->name('tickets.show');
    Route::post('/tickets/{ticket}/reply', [App\Http\Controllers\Agent\TicketController::class, 'reply'])->name('tickets.reply');
    Route::put('/tickets/{ticket}/status', [App\Http\Controllers\Agent\TicketController::class, 'updateStatus'])->name('tickets.status');

    Route::get('/contacts', [App\Http\Controllers\Agent\ContactController::class, 'index'])->name('contacts.index');
    Route::get('/contacts/search', [App\Http\Controllers\Agent\ContactController::class, 'search'])->name('contacts.search');

    Route::get('/callbacks', [App\Http\Controllers\Agent\CallbackController::class, 'index'])->name('callbacks.index');
    Route::put('/callbacks/{callback}/status', [App\Http\Controllers\Agent\CallbackController::class, 'updateStatus'])->name('callbacks.status');

    Route::get('/performance', [App\Http\Controllers\Agent\PerformanceController::class, 'index'])->name('performance.index');
});

// QA Analyst Routes
Route::middleware(['auth', 'role:qa_analyst', 'subscription', 'tenant.active'])->prefix('qa')->name('qa.')->group(function () {
    Route::get('/dashboard', [App\Http\Controllers\Qa\DashboardController::class, 'index'])->name('dashboard');

    Route::get('/recordings', [App\Http\Controllers\Qa\RecordingController::class, 'index'])->name('recordings.index');
    Route::get('/recordings/{call}', [App\Http\Controllers\Qa\RecordingController::class, 'show'])->name('recordings.show');

    Route::get('/evaluations', [App\Http\Controllers\Qa\EvaluationController::class, 'index'])->name('evaluations.index');
    Route::get('/evaluations/create', [App\Http\Controllers\Qa\EvaluationController::class, 'create'])->name('evaluations.create');
    Route::post('/evaluations', [App\Http\Controllers\Qa\EvaluationController::class, 'store'])->name('evaluations.store');
    Route::get('/evaluations/{evaluation}', [App\Http\Controllers\Qa\EvaluationController::class, 'show'])->name('evaluations.show');

    Route::get('/reports', [App\Http\Controllers\Qa\ReportController::class, 'index'])->name('reports.index');
});
