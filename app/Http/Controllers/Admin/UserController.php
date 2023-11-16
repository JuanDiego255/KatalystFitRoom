<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Company;
use App\Models\GeneralCategory;
use App\Models\Routine;
use App\Models\RoutineDays;
use App\Models\User;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{

    private $alias;

    public function __construct()
    {
        $this->middleware(function ($request, $next) {
            if (Auth::user()->alias != "") {
                $this->alias = Auth::user()->alias . '_' ?? '';
            } else {
                $this->alias = "";
            }
            // Obtener el alias una vez en el constructor
            return $next($request);
        });
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        //
        $general_categories = GeneralCategory::get();
        $paginate = 10;
        $name = $request->get('searchfor');
        date_default_timezone_set('America/Chihuahua');
        $date = date("Y-m-d");

        $users = User::Where('users.name', 'like', "%$name%")
            ->where('alias', Auth::user()->alias)
            ->select(
                'users.name as name',
                'users.id as id',
                'users.is_routine as is_routine',
                'users.change_routine as change_routine',
                'users.weight as weight',
                'users.telephone as telephone'
            )->orderBy('users.name', 'asc')->simplePaginate($paginate);
        return view('admin.users.index', compact('users', 'date','general_categories'));
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function myRoutine()
    {
        //      


        $alias = $this->alias;

        $uniqueCategories = Routine::where($alias . 'routines.day', '!=', '0')
            ->where($alias . 'routines.user_id', Auth::user()->id)
            ->where($alias . 'routines.status', 1)
            ->join($alias . 'general_categories', $alias . 'routines.general_category_id', $alias . 'general_categories.id')
            ->select(
                $alias . 'general_categories.category as category',
                $alias . 'routines.day as day'
            )->distinct($alias . 'general_category_id')->orderBy($alias . 'routines.day', 'asc')->get();

        if ($uniqueCategories == null) {
            return redirect('/')->with(['status' => 'Aún no han generado su rutina, comunícate con personal del gimnasio para asignarla.', 'icon' => 'warning']);
        }

        $groupedCategories = [];

        $days = RoutineDays::where('user_id', Auth::user()->id)->get();

        foreach ($uniqueCategories as $category) {
            $day = $category['day'];
            $categoryName = $category['category'];

            if (!isset($groupedCategories[$day])) {
                $groupedCategories[$day] = [];
            }

            $groupedCategories[$day][] = $categoryName;
        }

        return view('admin.users.index-routine', compact('groupedCategories', 'days'));
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function showRoutine($id, Request $request)
    {
        $user = User::find($id);
        $name = $user->name;
        $general_categories = GeneralCategory::get();
        $alias = $this->alias;

        $max_day = RoutineDays::where('user_id', $user->id)->where('status', 1)->max('day');

        $routines = Routine::where($alias . 'routines.user_id', $id)
            ->where($alias . 'routines.status', 1)
            ->join($alias . 'general_categories', $alias . 'routines.general_category_id', $alias . 'general_categories.id')
            ->join($alias . 'exercises', $alias . 'routines.exercise_id', $alias . 'exercises.id')
            ->select(
                $alias . 'exercises.id as id',
                $alias . 'exercises.exercise as exercise',
                $alias . 'general_categories.id as gen_category_id',
                $alias . 'general_categories.category as gen_category',
                $alias . 'routines.alt as alt',
                $alias . 'routines.series as series',
                $alias . 'routines.reps as reps',
                $alias . 'routines.form as form',
                $alias . 'routines.weight as weight',
                $alias . 'routines.day as day',
                $alias . 'routines.description as description',
                $alias . 'routines.status as status',
                $alias . 'routines.keep_exercise as keep_exercise',
                $alias . 'routines.id as id',

            )->orderBy($alias . 'routines.day', 'desc')
            ->get();
        $exer_active = 0;
        foreach ($routines as $routine) {

            if ($routine->day != 0) {
                $exer_active++;
            }
        }


        return view('admin.users.user-routine', compact('routines', 'name', 'id', 'max_day', 'general_categories', 'exer_active'));
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
        try {
            $request->validate([
                'name' => ['required', 'string', 'max:255'],
                'telephone' => ['required', 'string', 'max:255'],
                'identification' => ['required', 'string', 'max:255'],
            ]);

            $alias = Company::findOrfail($request->company_id);
            // Crear un nuevo usuario
            $usuario = new User();

            $usuario->name = $request->name;
            $usuario->identification = $request->identification;
            $usuario->telephone = $request->telephone;
            $usuario->whatsapp = $request->whatsapp;
            $usuario->birthdate = $request->birthdate;
            $usuario->email = $request->email;
            $usuario->tutor = $request->tutor;
            $usuario->blood_type = $request->blood_type;
            $usuario->address = $request->address;
            $usuario->injuries = $request->injuries;
            $usuario->sick = $request->sick;
            $usuario->height = $request->height;
            $usuario->weight = $request->weight;
            $usuario->gender = $request->gender;
            $usuario->sex = $request->gender;
            $usuario->company = $request->company_id;
            $usuario->alias = $alias->alias;

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
        } catch (\Exception $th) {
            //throw $th;
        }
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
        try {
            User::destroy($id);
            return redirect()->back()->with(['status' => 'Se ha eliminado el usuario con éxito', 'icon' => 'success']);
        } catch (\Exception $th) {
            //throw $th;
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroyRoutine($id)
    {
        //
        try {
            Routine::where('user_id', $id)->delete();
            $user = User::find($id);
            $user->is_routine = 0;
            $user->change_routine = null;
            $user->save();
            return redirect()->back()->with(['status' => 'Se ha eliminado la rutina con éxito', 'icon' => 'success']);
        } catch (\Exception $th) {
            //throw $th;
        }
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
        $alias = $this->alias;

        $routines = Routine::where($alias . 'routines.user_id', $user_id)
            ->where($alias . 'routines.day', $id)
            ->where($alias . 'routines.status', 1)
            ->join($alias . 'general_categories', $alias . 'routines.general_category_id', $alias . 'general_categories.id')

            ->join($alias . 'exercises', $alias . 'routines.exercise_id', $alias . 'exercises.id')
            ->select(
                $alias . 'exercises.id as id',
                $alias . 'exercises.exercise as exercise',
                $alias . 'exercises.image as image',
                $alias . 'general_categories.id as id',
                $alias . 'general_categories.category as gen_category',
                $alias . 'routines.alt as alt',
                $alias . 'routines.series as series',
                $alias . 'routines.reps as reps',
                $alias . 'routines.description as description',
                $alias . 'routines.form as form',
                $alias . 'routines.weight as weight',
                $alias . 'routines.completed as completed',
                $alias . 'routines.status as status',
                $alias . 'routines.id as id'
            )
            ->get();

        return view('admin.users.routine-cat', compact('routines', 'id'));
    }

    protected function newuser()
    {
        $companies = Company::where('id', Auth::user()->company)->get();
        return view('auth.register', compact('companies'));
    }

    protected function newRegister()
    {
        $companies = Company::get();
        return view('auth.register-user', compact('companies'));
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
        DB::beginTransaction();
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
                ->where('completed', 1)->get();
            foreach ($routine_exercise as $routine) {

                $routine = Routine::findOrfail($routine->id);
                $routine->completed = 0;
                $routine->update();
            }
            DB::commit();

            return redirect('/my-routine')->with(['status' => 'Día Finalizado.', 'icon' => 'success']);;
        } catch (Exception $e) {
            //throw $e;
            DB::beginTransaction();
        }
    }

    public function showUserWithoutRoutine($id, Request $request)
    {
        $Nombre = $request->get('searchfor');

        $users = User::Where('users.name', 'like', "%$Nombre%")
            ->Where('users.is_routine', 0)
            ->select(
                'users.name as name',
                'users.id as id',
                'users.is_routine as is_routine',
                'users.change_routine as change_routine',
                'users.weight as weight',
                'users.telephone as telephone'
            )->orderBy('users.name', 'asc')->simplePaginate(7);

        if ($users->isEmpty()) {
            return redirect()->back()->with(['status' => 'No hay usuarios sin rutina', 'icon' => 'warning']);
        }
        return view('admin.users.asign-user', compact('users', 'id'));
    }

    public function showProcess($id)
    {
        $alias = $this->alias;
        $query = 'count(' . $alias . 'routines.exercise_id) as quantity';

        $results = DB::table($alias . 'routines')
            ->join($alias . 'general_categories', $alias . 'routines.general_category_id', $alias . 'general_categories.id')
            ->where($alias . 'routines.user_id', $id)
            ->where($alias . 'routines.day', '!=', 0)
            ->where($alias . 'routines.status', 1)
            ->select($alias . 'routines.day', $alias . 'general_categories.category')
            ->selectRaw($query)
            ->groupBy($alias . 'routines.day', $alias . 'general_categories.category')
            ->get();

        // Procesa los resultados para eliminar las repeticiones en la primera línea
        $processedResults = [];

        foreach ($results as $result) {
            $day = $result->day;
            $category = $result->category;
            $quantity = $result->quantity;

            if (isset($processedResults[$day])) {
                // Verifica si la categoría ya existe para ese día
                if (isset($processedResults[$day]['categories'][$category])) {
                    $processedResults[$day]['categories'][$category] += $quantity;
                } else {
                    // Si no existe, agrega la categoría
                    $processedResults[$day]['categories'][$category] = $quantity;
                }

                // Suma la cantidad de ejercicios para ese día
                $processedResults[$day]['quantity'] += $quantity;
            } else {
                // Si es un nuevo día, crea una nueva entrada en el array de resultados procesados
                $processedResults[$day] = [
                    'day' => $day,
                    'categories' => [$category => $quantity],
                    'quantity' => $quantity,
                ];
            }
        }

        return response()->json($processedResults);
    }
}
