<?php

use App\Http\Controllers\CommentController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\VideosController;
use App\Http\Resources\VideoResource;
use App\Models\Video;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;
use Illuminate\Http\Request;

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
        'videos' => VideoResource::collection(
            Video::orderBy('created_at', 'desc')->get()
        )->collection
    ]);
})->name('home');

Route::get('/popular', function () {
    return Inertia::render('Popular', [
        'videos' => VideoResource::collection(
            Video::orderBy('likes', 'desc')->get()
        )->collection
    ]);
})->name('popular');


Route::get('/my_videos', function (Request $request) {
    $name = $request->user()->name;
    if ($name === null) {
        return Inertia::render('MyVideos', [
            'videos' => []
        ]);
    }
    return Inertia::render('MyVideos', [
        'videos' => VideoResource::collection(
            Video::where('user', $name)->orderBy('created_at', 'desc')->get()
        )->collection
    ]);
})->name('my_videos');


Route::get('/categories/{category}', function ($category) {
    return Inertia::render('CategoriesPage', [
        'videos' => VideoResource::collection(
            Video::where('category', $category)->orderBy('created_at', 'desc')->get()
        )->collection
    ]);
})->name('categories');


Route::get('/add-video', function () {
    return Inertia::render('AddVideo');
})->name('addVideo');

Route::get('/delete-video', function () {
    return Inertia:: render('DeleteVideo', [
        'videos' => Video::all()
    ]);
})->name('deleteVideo');


Route::get('/clips/{id}', [VideosController::class, 'show'])->name('clips.show');
Route::post('/clips/{id}/like', [VideosController::class, 'like'])->name('clips.like');
Route::post('/clips/{id}/dislike', [VideosController::class, 'dislike'])->name('clips.dislike');
Route::post('/clips', [VideosController::class, 'store'])->name('clips.store');
Route::delete('/clips/{id}', [VideosController:: class, 'destroy'])->name('clips.destroy');


Route::get('/comments', [CommentController::class, 'index']);
Route::get('/comments/{comment}', [CommentController::class, 'show']);
Route::post('/comments', [CommentController::class, 'store']);


//
//Route::get('/', function () {
//    return Inertia::render('Welcome', [
//        'canLogin' => Route::has('login'),
//        'canRegister' => Route::has('register'),
//        'laravelVersion' => Application::VERSION,
//        'phpVersion' => PHP_VERSION,
//    ]);
//});
//
Route::get('/dashboard', function () {
    return Inertia::render('Dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php';
