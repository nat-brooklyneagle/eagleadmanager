<?php

    use App\Http\Controllers\AdvertiserController;
    use App\Http\Controllers\TeamInvitationController;
    use Illuminate\Foundation\Application;
    use Illuminate\Support\Facades\Route;
    use Inertia\Inertia;
    use App\Http\Controllers\AuthenticatedSessionController;
    use Laravel\Jetstream\Jetstream;

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

    Route::get('/', function () {
        return Inertia::render('Welcome', [
            'canLogin'        => Route::has('login'),
            'canRegister'     => Route::has('register'),
            'permissions'     => [
                'canViewAdvertisers' => Route::has('advertisers.index'),
            ],
            'laravelVersion'  => Application::VERSION,
            'phpVersion'      => PHP_VERSION,
            'applicationName' => config('app.name')
        ]);
    });

    Route::middleware([
        'auth:sanctum',
        config('jetstream.auth_session'),
        'verified'
    ])->group(function () {
        Route::get('/dashboard', function () {
            return Inertia::render('Dashboard',
                ['advertiser_count' => Auth::user()->currentTeam?->advertisers()->count()]);
        })->name('dashboard');

        Route::resource('advertisers', AdvertiserController::class);
    });

// Override Jetstream Team Invitation route
    Route::group(['middleware' => config('jetstream.middleware', ['web'])], function () {

        $authMiddleware = config('jetstream.guard')
            ? 'auth:' . config('jetstream.guard')
            : 'auth';

        $authSessionMiddleware = config('jetstream.auth_session', false)
            ? config('jetstream.auth_session')
            : null;

        Route::group([
            'middleware' => array_values(array_filter([
                $authMiddleware,
                $authSessionMiddleware,
                'verified'
            ]))
        ], function () {
            // Teams...
            if (Jetstream::hasTeamFeatures()) {
                Route::get('/team-invitations/{invitation}', [TeamInvitationController::class, 'accept'])
                    ->middleware(['signed'])
                    ->name('team-invitations.accept');
            }
        });
    });

    Route::post('/logout', [AuthenticatedSessionController::class, 'destroy'])
        ->name('logout');
