<?php

use App\Http\Controllers\DashboardController;
use App\Http\Livewire\ContactFeeds\Index as ContactFeedsIndex;
use App\Http\Livewire\Dashboard\Index;
use App\Http\Livewire\Leads\Create;
use App\Http\Livewire\Leads\Index as LeadsIndex;
use App\Http\Livewire\Leads\Show;
use App\Http\Livewire\Orders\Index as OrdersIndex;
use App\Http\Livewire\Reports\AbandonedCall;
use App\Http\Livewire\Reports\BreakSummary;
use App\Http\Livewire\Reports\CallDetail;
use App\Http\Livewire\Reports\Index as ReportsIndex;
use App\Http\Livewire\Settings\Extensions\Index as ExtensionsIndex;
use App\Http\Livewire\Settings\Index as SettingsIndex;
use App\Http\Livewire\Settings\Moh\Index as MohIndex;
use App\Http\Livewire\Settings\Queues\Index as QueuesIndex;
use App\Http\Livewire\Settings\Skills\Index as SkillsIndex;
use App\Http\Livewire\Settings\Users\Index as UsersIndex;
use App\Http\Livewire\Tickets\Index as TicketsIndex;
use App\Models\CallCenter\AbandonedCall as CallCenterAbandonedCall;
use App\Models\QueueCount;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/


Route::middleware(['auth:sanctum', config('jetstream.auth_session'), 'verified'])->group(function () {
   
    Route::get('/', DashboardController::class)->name('dashboard.index');
    Route::prefix('leads')->group(function () {
        Route::get('/', LeadsIndex::class)->name('leads.index')->can('can-view-leads');
        // Route::get('/{lead}', Create::class)->name('leads.create')->can('can-view-leads');
        Route::get('/{lead}', Show::class)->name('leads.create')->can('can-view-leads');
        Route::get('/{lead}', Show::class)->name('leads.show')->can('can-view-leads');
    });

    Route::get('/tickets', TicketsIndex::class)->name('tickets.index');
    Route::get('/orders', OrdersIndex::class)->name('orders.index');
    Route::get('/contact-feeds', ContactFeedsIndex::class)->name('contact-feeds.index')->can('is-admin');

    Route::prefix('reports')->group(function () {
        Route::get('/', ReportsIndex::class)->name('reports.index');
        Route::get('/call-detail-report', CallDetail::class)->name('reports.call-detail')->can('is-admin');
        Route::get('/abandoned-call-report', AbandonedCall::class)->name('reports.abandoned-call')->can('is-admin');
        Route::get('/agent-break-summary-report', BreakSummary::class)->name('reports.agent-break-summary-report')->can('is-admin');
    });

    Route::prefix('settings')->group(function () {
        Route::get('/', SettingsIndex::class)->name('settings.index')->can('is-admin');
        Route::get('/users/', UsersIndex::class)->name('settings.users.index')->can('is-admin');
        Route::get('/extensions/', ExtensionsIndex::class)->name('settings.extensions.index')->can('is-admin');
        Route::get('/moh/', MohIndex::class)->name('settings.moh.index')->can('is-admin');
        Route::get('/skills/', SkillsIndex::class)->name('settings.skills.index')->can('is-admin');
    });


    
   
});
