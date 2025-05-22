<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Models\Challenge;
use Illuminate\Http\Request;

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::get('/', function () {
    return view('challenges.index');
})->name('home');

Route::get('auth/login', function () {
    return view('auth.login');
})->name('auth.login');

Route::get('auth/register', function () {
    return view('auth.register');
})->name('auth.register');

Route::get('/challenges/all', function () {
    $userId = Auth::id();
    $filter = request('filter', 'all');
    $query = Challenge::query();

    if ($userId) {
        if ($filter === 'public') {
            $query->where('public', true);
        } elseif ($filter === 'own') {
            $query->where('user_id', $userId);
        } else {
            $query->where(function ($q) use ($userId) {
                $q->where('public', true)
                  ->orWhere('user_id', $userId);
            });
        }
    } else {
        $query->where('public', true);
    }

    $challenges = $query->latest()->get();

    return view('challenges.all', compact('challenges', 'filter'));
})->name('challenges.all');

Route::get('/challenges/{challenge}', function (Challenge $challenge) {
    return view('challenges.show', compact('challenge'));
})->name('challenges.show');

Route::delete('/challenges/{challenge}', function (Challenge $challenge, Request $request) {
    $challenge->delete();
    return redirect()->route('challenges.all')->with('success', 'Challenge gelöscht!');
})->name('challenges.delete');
require __DIR__.'/auth.php';
