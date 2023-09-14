<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Routine;
use App\Models\RoutineDays;
use App\Models\User;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //

        $users = User::simplePaginate(5);
        return view('admin.users.index', compact('users'));
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function myRoutine()
    {
        //
        $is_routine = Auth::user()->is_routine;
        if ($is_routine == 0) {
            return redirect('/')->with(['status' => 'Aún no han generado su rutina, comunícate con personal del gimnasio para asignarla.', 'icon' => 'warning']);
        }

        $uniqueCategories = Routine::where('day', '!=', '0')
            ->where('user_id', Auth::user()->id)
            ->join('general_categories', 'routines.general_category_id', 'general_categories.id')
            ->select(
                'general_categories.category as category',
                'routines.day as day'
            )->distinct('general_category_id')->get();

        $groupedCategories = [];

        $days = RoutineDays::where('user_id',Auth::user()->id)->get();

        foreach ($uniqueCategories as $category) {
            $day = $category['day'];
            $categoryName = $category['category'];

            if (!isset($groupedCategories[$day])) {
                $groupedCategories[$day] = [];
            }

            $groupedCategories[$day][] = $categoryName;
        }

        return view('admin.users.index-routine', compact('groupedCategories','days'));
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function showRoutine($id, Request $request)
    {
        //
        $Nombre = $request->get('searchfor');
        $user = User::find($id);
        $name = $user->name;
       

        $max_day = RoutineDays::where('user_id', $user->id)->where('status', 1)->max('day');

        $routines = Routine::where('routines.user_id', $id)
            ->Where('general_categories.category', 'like', "%$Nombre%")
            ->join('general_categories', 'routines.general_category_id', 'general_categories.id')
            ->join('exercises', 'routines.exercise_id', 'exercises.id')
            ->select(
                'exercises.id as id',
                'exercises.exercise as exercise',
                'general_categories.id as gen_category_id',
                'general_categories.category as gen_category',
                'routines.alt as alt',
                'routines.series as series',
                'routines.reps as reps',
                'routines.form as form',
                'routines.weight as weight',
                'routines.day as day',
                'routines.description as description',
                'routines.status as status',
                'routines.id as id',

            )->orderBy('routines.day', 'desc')
            ->simplePaginate(7);

           
        return view('admin.users.user-routine', compact('routines', 'name', 'id', 'max_day'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        // Validar los datos del formulario de registro
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'telephone' => ['required', 'string', 'max:255'],
            'birthdate' => ['required', 'string', 'max:255'],
            'telephone' => ['required', 'string', 'max:255'],
            'whatsapp' => ['required', 'string', 'max:255'],
            'tutor' => ['required', 'string', 'max:255'],
            'address' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
        ]);

        // Crear un nuevo usuario
        $usuario = new User();

        $usuario->name = $request->name;
        $usuario->identification = $request->identification;
        $usuario->telephone = $request->telephone;
        $usuario->whatsapp = $request->whatsapp;
        $usuario->birthdate = $request->birthdate;
        $usuario->email = $request->email;
        $usuario->tutor = $request->tutor;
        $usuario->blood_type = 0;
        $usuario->address = $request->address;
        $usuario->injuries = $request->injuries;
        $usuario->sick = $request->sick;
        $usuario->height = $request->height;
        $usuario->weight = $request->weight;
        $usuario->gender = $request->gender;
        $usuario->sex = $request->gender;

        if ($request->anemia != null) {
            $usuario->anemia = 1;
        }
        if ($request->suffocation != null) {
            $usuario->suffocation = 1;
        }
        if ($request->asthmatic != null) {
            $usuario->asthmatic = 1;
        }
        if ($request->epileptic != null) {
            $usuario->epileptic = 1;
        }
        if ($request->diabetic != null) {
            $usuario->diabetic = 1;
        }
        if ($request->smoke != null) {
            $usuario->smoke = 1;
        }
        $usuario->dizziness = $request->dizziness;
        $usuario->fainting = $request->fainting;
        $usuario->nausea = $request->nausea;
        $usuario->sport_Activity = $request->sport_Activity;
        $usuario->contact_emergency = $request->contact_emergency;

        $usuario->password = Hash::make($request->identification);
        $usuario->save();

        // Redireccionar o realizar cualquier otra acción necesaria
        return redirect('/users')->with(['status' => 'Usuario registrado exitosamente.', 'icon' => 'success']);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function routineByCategory($id)
    {
        //

        $user_id = Auth::user()->id;

        $routines = Routine::where('routines.user_id', $user_id)
            ->where('routines.day', $id)
            ->where('routines.status', 1)
            ->join('general_categories', 'routines.general_category_id', 'general_categories.id')

            ->join('exercises', 'routines.exercise_id', 'exercises.id')
            ->select(
                'exercises.id as id',
                'exercises.exercise as exercise',
                'exercises.image as image',
                'general_categories.id as id',
                'general_categories.category as gen_category',
                'routines.alt as alt',
                'routines.series as series',
                'routines.reps as reps',
                'routines.description as description',
                'routines.form as form',
                'routines.weight as weight',
                'routines.completed as completed',
                'routines.status as status',
                'routines.id as id'
            )
            ->get();

        return view('admin.users.routine-cat', compact('routines', 'id'));
    }

    protected function newuser()
    {

        return view('auth.register');
    }

    protected function newRegister()
    {

        return view('auth.register-user');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function showRoutineDays($id, Request $request)
    {
        //       
        $user = User::find($id);
        $name = $user->name;
        $routine_days = RoutineDays::where('user_id', $id)->get();
        return view('admin.users.days', compact('routine_days', 'name', 'id'));
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function finishDay($day)
    {
        //
        try {


            $user_id = Auth::user()->id;
            $rotuine_days_upd = RoutineDays::where('user_id', $user_id)->get();

            foreach ($rotuine_days_upd as $routine) {
                $routine = RoutineDays::findOrfail($routine->id);

                $routine->last_day = 0;
                $routine->next_day = 0;
                $routine->update();
            }



            $routine_Days = RoutineDays::where('user_id', $user_id)
                ->where('day', $day)->get();

            foreach ($routine_Days as $rout) {
                $day_id = $rout->id;
            }

            $routine = RoutineDays::findOrfail($day_id);

            $routine->last_day = 1;
            $routine->update();

            $max_day = Routine::where('user_id', $user_id)->where('status', 1)->max('day');

            if ($day != $max_day) {
                $routine_days = RoutineDays::where('user_id', $user_id)
                    ->where('day', $day + 1)->get();

                foreach ($routine_days as $rout) {
                    $day_id = $rout->id;
                }
                $routine = RoutineDays::findOrfail($day_id);

                $routine->next_day = 1;
            } else {
                $routine_days = RoutineDays::where('user_id', $user_id)
                    ->where('day', 1)->get();

                foreach ($routine_days as $rout) {
                    $day_id = $rout->id;
                }
                $routine = RoutineDays::findOrfail($day_id);

                $routine->next_day = 1;
            }

            $routine->update();

            $routine_exercise = Routine::where('user_id', $user_id)
            ->where('status', 1)
            ->where('day', $day)
            ->where('completed',1)->get();
            foreach ($routine_exercise as $routine) {

                $routine = Routine::findOrfail($routine->id);
                $routine->completed = 0;               
                $routine->update();
            }


            return redirect('/my-routine')->with(['status' => 'Día Finalizado.', 'icon' => 'success']);;
        } catch (Exception $e) {
            //throw $th;
        }
    }
}
