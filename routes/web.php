<?php

use App\Http\Controllers\Admin\DisciplineController;
use App\Http\Controllers\Admin\ExercisesController;
use App\Http\Controllers\Admin\GeneralCategoryController;
use App\Http\Controllers\Admin\RoutineController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Frontend\FrontendController;
use App\Http\Controllers\Admin\MetaTagsController;
use App\Http\Controllers\AsistController;
use App\Http\Controllers\Admin\DetailsCategoryController;
use App\Http\Controllers\Admin\PaymentTypeController;
use App\Http\Controllers\Admin\DetailsController;
use App\Http\Controllers\RoutineParameterController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

use function Ramsey\Uuid\v1;

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

Route::get('/', [FrontendController::class, 'index']);
Route::get('/asist-index/', [AsistController::class, 'index']);
Route::post('/asist', [AsistController::class, 'store']);

Route::get('/register/user', [UserController::class, 'newRegister']);

Auth::routes();

Route::group(['auth'], function () {

    Route::get('/go-routine/{id}', [UserController::class, 'routineByCategory']);
    Route::get('/my-routine', [UserController::class, 'myRoutine']);
    Route::get('/create-word/{id}', [RoutineController::class, 'createWordToZero']);

    Route::group(['middleware' => 'isAdmin'], function () {
        Route::get('/disciplines', [DisciplineController::class, 'index']);
        Route::get('discipline/add', [DisciplineController::class, 'add']);
        Route::get('/discipline/edit/{id}', [DisciplineController::class, 'edit']);
        Route::post('discipline/store', [DisciplineController::class, 'store']);
        Route::put('/discipline/update/{id}', [DisciplineController::class, 'update']);
        Route::delete('/delete/discipline/{id}', [DisciplineController::class, 'destroy']);

        //Rutas para categoría general
        Route::get('/categories', [GeneralCategoryController::class, 'index']);

        Route::post('categories/store', [GeneralCategoryController::class, 'store']);
        Route::put('/categories/update/{id}', [GeneralCategoryController::class, 'update']);
        Route::delete('/delete/categories/{id}', [GeneralCategoryController::class, 'destroy']);

        //Rutas para ejercicios
        Route::get('/exercises', [ExercisesController::class, 'index']);
        Route::post('exercises/store', [ExercisesController::class, 'store']);
        Route::put('/exercises/update/{id}', [ExercisesController::class, 'update']);
        Route::delete('/delete/exercises/{id}', [ExercisesController::class, 'destroy']);

        //Rutas para usuarios
        Route::get('/users', [UserController::class, 'index']);

        Route::post('create/routine', [RoutineController::class, 'store']);
        Route::post('asign/routine', [RoutineController::class, 'asignRoutine']);
        Route::post('/update-routine', [RoutineController::class, 'update']);
        Route::post('/update-routine-status', [RoutineController::class, 'updateStatus']);
        Route::post('/update-routine-keep', [RoutineController::class, 'updateKeep']);
        Route::post('/update-routine-day-status', [RoutineController::class, 'updateStatusDay']);
        Route::post('/update-routine-form', [RoutineController::class, 'updateForm']);
        Route::put('/update-description/routine/{id}', [RoutineController::class, 'updateDescription']);
        Route::get('/user/routine/{id}', [UserController::class, 'showRoutine']);
        Route::get('/user/asign/{id}', [UserController::class, 'showUserWithoutRoutine']);
        Route::get('/view-process/{id}', [UserController::class, 'showProcess']);
        Route::get('/user/routine-day/{id}', [UserController::class, 'showRoutineDays']);
        Route::get('/register-user', [UserController::class, 'newUser']);
        Route::post('/register-create', [UserController::class, 'store']);
        Route::delete('/delete/user/{id}', [UserController::class, 'destroy']);
        Route::delete('/delete/routine/{id}', [UserController::class, 'destroyRoutine']);
        Route::post('/end-day/{id}', [UserController::class, 'finishDay']);

        //Routes for Metatags
        Route::get('/meta-tags/indexadmin', [MetaTagsController::class, 'index']);
        Route::post('/metatag', [MetaTagsController::class, 'store']);
        Route::get('/metatag/agregar', [MetaTagsController::class, 'agregar']);
        Route::get('metatag/edit/{id}', [MetaTagsController::class, 'edit']);
        Route::put('metatags/{id}', [MetaTagsController::class, 'update']);
        Route::delete('delete-metatag/{id}', [MetaTagsController::class, 'destroy']);

        //Rutas para categorias de detalle
        Route::get('/detail/category', [DetailsCategoryController::class, 'index']);
        Route::post('/det-cat/', [DetailsCategoryController::class, 'store']);
        Route::put('det-cat/{id}', [DetailsCategoryController::class, 'update']);
        Route::delete('det-cat/delete/{id}', [DetailsCategoryController::class, 'destroy']);

        //Rutas para tipos de pago
        Route::get('/payments', [PaymentTypeController::class, 'index']);
        Route::post('/payments/store', [PaymentTypeController::class, 'store']);
        Route::put('payments/{id}', [PaymentTypeController::class, 'update']);
        Route::delete('payments/delete/{id}', [PaymentTypeController::class, 'destroy']);

        //Rutas para productos
        Route::get('/products', [DetailsController::class, 'index']);
        Route::post('/products/store', [DetailsController::class, 'store']);
        Route::put('products/update/{id}', [DetailsController::class, 'update']);
        Route::delete('products/delete/{id}', [DetailsController::class, 'destroy']);

        //Rutas para parámetros
        Route::get('/parameters', [RoutineParameterController::class, 'index']);
        Route::post('/parameter/store', [RoutineParameterController::class, 'store']);       
        Route::delete('parameter/delete/{id}', [RoutineParameterController::class, 'destroy']);
    });
});
