
<?php

use App\Http\Controllers\JobSeekerRegistrationController;
use App\Http\Controllers\RecruiterRegistrationController;
use App\Http\Controllers\JobSeeker\JobSeekerController;
use App\Http\Controllers\Recruiter\JobController;
use App\Http\Controllers\Recruiter\CandidateController;
use App\Http\Controllers\Recruiter\ApplicationController;
use App\Http\Controllers\Recruiter\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
})->name('home');

// Job Seeker Registration
Route::get('/register/job-seeker', [JobSeekerRegistrationController::class, 'create'])
    ->name('job-seeker.register');

Route::post('/register/job-seeker', [JobSeekerRegistrationController::class, 'store'])
    ->name('job-seeker.register.store');

// Recruiter Registration
Route::get('/register/recruiter', [RecruiterRegistrationController::class, 'create'])
    ->name('recruiter.register');

Route::post('/register/recruiter', [RecruiterRegistrationController::class, 'store'])
    ->name('recruiter.register.store');

// General Profile Routes
Route::middleware('auth')->group(function () {

    Route::get('/profile', [ProfileController::class, 'edit'])
        ->name('profile.edit');

    Route::patch('/profile', [ProfileController::class, 'update'])
        ->name('profile.update');

    Route::delete('/profile', [ProfileController::class, 'destroy'])
        ->name('profile.destroy');
});

require __DIR__ . '/auth.php';

// Recruiter Routes
Route::middleware(['auth', 'role:recruiter'])
    ->prefix('recruiter')
    ->name('recruiter.')
    ->group(function () {

        Route::get('/dashboard', function () {
            return view('recruiter.dashboard');
        })->name('dashboard');

        // Job Management
        Route::get('/jobs', [JobController::class, 'index'])
            ->name('jobs.index');

        Route::get('/jobs/create', [JobController::class, 'create'])
            ->name('jobs.create');

        Route::post('/jobs', [JobController::class, 'store'])
            ->name('jobs.store');

        Route::get('/jobs/{job}/edit', [JobController::class, 'edit'])
            ->name('jobs.edit');

        Route::put('/jobs/{job}', [JobController::class, 'update'])
            ->name('jobs.update');

        Route::delete('/jobs/{job}', [JobController::class, 'destroy'])
            ->name('jobs.destroy');

        Route::patch('/jobs/{job}/status', [JobController::class, 'status'])
            ->name('jobs.status');

        // Candidates & Applications
        Route::get('/candidates', [CandidateController::class, 'index'])
            ->name('candidates');

        Route::get('/applications', [ApplicationController::class, 'index'])
            ->name('applications');

        // Recruiter Profile
        Route::get('/profile', [ProfileController::class, 'edit'])
            ->name('profile');

        Route::put('/profile', [ProfileController::class, 'update'])
            ->name('profile.update');
    });

// Job Seeker Routes
Route::middleware(['auth', 'role:job_seeker'])
    ->prefix('job-seeker')
    ->name('job-seeker.')
    ->group(function () {

        Route::get('/dashboard', [JobSeekerController::class, 'dashboard'])
            ->name('dashboard');

        Route::get('/jobs', [JobSeekerController::class, 'jobs'])
            ->name('jobs');

        Route::post('/jobs/{job}/apply', [JobSeekerController::class, 'apply'])
            ->name('jobs.apply');

        Route::get('/applications', [JobSeekerController::class, 'applications'])
            ->name('applications');

        Route::get('/profile', [JobSeekerController::class, 'profile'])
            ->name('profile');

        Route::put('/profile', [JobSeekerController::class, 'updateProfile'])
            ->name('profile.update');
    });