<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\DetailsCategory;
use App\Models\Exercises;
use App\Models\Routine;
use App\Models\RoutineDays;
use App\Models\User;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use PhpOffice\PhpWord\IOFactory;
use PhpOffice\PhpWord\Style\Font;
use PhpOffice\PhpWord\SimpleType\Jc;
use PhpOffice\PhpWord\Style\Language;

class RoutineController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
        //
        try {

            $exercises = Exercises::all();

            if (count($exercises) == 0) {
                return redirect('/users')->with(['status' => 'No existen ejercicios para crear rutinas', 'icon' => 'warning']);
            }

            $last_number = Routine::where('user_id', $request->id)->where('status', 1)->max('routine_number');

            if ($last_number == null) {
                $last_number_opc = 1;
            } else {
                if ($last_number != 3) {
                    $last_number_opc = $last_number + 1;
                } else {
                    $last_number_opc = $last_number;
                }
            }


            $verify_days = RoutineDays::where('user_id', $request->id)->get();

            if (count($verify_days) == 0) {
                for ($i = 1; $i < 7; $i++) {
                    $day = new RoutineDays();
                    $day->user_id = $request->id;
                    $day->day = $i;
                    $day->status = 1;
                    $day->save();
                }
            }

            if ($last_number_opc > 1) {

                $routine_exist = Routine::where('user_id', $request->id)->get();

                foreach ($routine_exist as $routine) {
                    $routine = Routine::findOrfail($routine->id);
                    $routine->status = 0;
                    if ($last_number_opc == 3 && $routine->routine_number == 1 && $last_number == 3) {
                        Routine::destroy($routine->id);
                    } else {
                        if ($routine->routine_number != 1 && $last_number == 3) {
                            $routine->routine_number = $routine->routine_number - 1;
                        }
                        $routine->update();
                    }
                }
            }

            $last_number = Routine::where('user_id', $request->id)->max('routine_number');
            $count_exer_active = 0;
            $new_routine = [];
            $message_error_quantity = false;

            if ($request->type == 0) {
                foreach ($exercises as $exercise) {
                    $routine = new Routine();
                    $routine->user_id = $request->id;
                    $routine->general_category_id = $exercise->general_category_id;
                    $routine->exercise_id = $exercise->id;
                    $routine->alt = 0;
                    $routine->series = 0;
                    $routine->reps = 0;
                    $routine->status = 1;
                    $routine->routine_number = $last_number_opc;
                    $routine->save();
                }
            } else {
                $exercise_active = 0;                
                $previousRoutine = Routine::where('user_id', $request->id)
                    ->where('routine_number', $last_number)
                    ->get();

                foreach ($previousRoutine as $routine) {
                    if ($routine->day != 0 && $request->quantity != $count_exer_active) {
                        $new_routine[] = [
                            "user_id" => $request->id,
                            "general_category_id" => $routine->general_category_id,
                            "exercise_id" => $routine->exercise_id,
                            "alt" => $routine->alt,
                            "series" => $routine->series,
                            "reps" => $routine->reps,
                            "day" => $routine->day,
                            "status" => 1,
                            "routine_number" => $last_number_opc,
                        ];
                        $count_exer_active++;
                    }
                    if ($routine->day != 0) {
                        $exercise_active++;
                    }
                }

                if ($request->quantity > $exercise_active) {
                    $message_error_quantity = true;
                }

                $count_zero = $count_exer_active;
                $count_zero_diff = $count_exer_active;
                $routine_change = $new_routine;

                foreach ($previousRoutine as $routine_item) {
                    $continue = true;
                    $set_routine = false;
                    $routine = new Routine();
                    $routine->user_id = $request->id;

                    if ($routine_item->day == 0 && $count_zero != 0) {
                        $new_routine_value = null;
                        $index = null;
                        foreach ($new_routine as $clave => $elemento) {
                            if ($elemento["general_category_id"] == $routine_item->general_category_id) {
                                $index = $clave;
                                $new_routine_value = $elemento;
                                break; // Rompe el bucle una vez que se encuentra el valor deseado
                            }
                        }

                        if ($new_routine_value !== null) {
                            $routine->general_category_id = $new_routine_value['general_category_id'];
                            $routine->exercise_id = $routine_item->exercise_id;
                            $routine->alt = $new_routine_value['alt'];
                            $routine->series = $new_routine_value['series'];
                            $routine->reps = $new_routine_value['reps'];
                            $routine->day = $new_routine_value['day'];
                            $routine->status = 1;
                            $routine->routine_number = $last_number_opc;
                            $set_routine = true;
                            $continue = false;
                            $count_zero--;
                            unset($new_routine[$index]);
                        } else {
                            $continue = true;
                        }
                    }

                    if ($routine_item->day != 0 && $count_zero_diff != 0 && $continue) {
                        foreach ($routine_change as $item) {
                            if ($routine_item->exercise_id == $item['exercise_id']) {
                                $routine->general_category_id = $routine_item->general_category_id;
                                $routine->exercise_id = $routine_item->exercise_id;
                                $routine->alt = 0;
                                $routine->series = 0;
                                $routine->reps = 0;
                                $routine->day = 0;
                                $routine->status = 1;
                                $routine->routine_number = $last_number_opc;
                                $set_routine = true;
                                $continue = false;
                                $count_zero_diff--;
                            }
                        }
                    }

                    if ($continue) {
                        $routine->general_category_id = $routine_item->general_category_id;
                        $routine->exercise_id = $routine_item->exercise_id;
                        $routine->alt = $routine_item->alt;
                        $routine->series = $routine_item->series;
                        $routine->reps = $routine_item->reps;
                        $routine->day = $routine_item->day;
                        $routine->status = 1;
                        $routine->routine_number = $last_number_opc;
                        $set_routine = true;
                    }
                    if ($set_routine) {
                        $routine->save();
                    }
                }
            }

            $user = User::find($request->id);
            $user->is_routine = 1;
            $user->save();

            if($message_error_quantity){
                return redirect()->back()->with(['status' => 'La cantidad de ejercicios a generar es mayor que la cantidad de ejercicios activos. Ejercicios generados: '.$exercise_active, 'icon' => 'warning']);
            }
            return redirect()->back()->with(['status' => 'Se ha creado la rutina con éxito', 'icon' => 'success']);
        } catch (Exception $e) {

            throw $e;
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($user_id)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function saveRoutine($user_id, $gen_cat_id, $exercise_id, $alt, $series, $reps, $rout_number)
    {
        //
        $routine = new Routine();
        $routine->user_id = $user_id;
        $routine->general_category_id = $gen_cat_id;
        $routine->exercise_id = $exercise_id;
        $routine->alt = $alt;
        $routine->series = $series;
        $routine->reps = $reps;
        $routine->status = 1;
        $routine->routine_number = $rout_number;
        $routine->save();
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
    public function update(Request $request)
    {
        //
        $name = $request->name;
        $valor = $request->val;
        $id = $request->id;
        $routine = Routine::where('id', $id)->first();
        if ($name == "alt") {
            $routine->alt = $valor;
        } else if ($name == "reps") {
            $routine->reps = $valor;
        } else if ($name == "series") {
            $routine->series = $valor;
        } else if ($name == "day") {
            $routine->day = $valor;
        } else {
            $routine->weight = $valor;
        }

        $routine->update();

        return response()->json(['status' => 'Se modificó con éxito', 'icon' => 'success']);
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
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function updateStatus(Request $request)
    {
        //

        $valor = $request->val;

        $id = $request->id;
        $routine = Routine::where('id', $id)->first();

        if ($request->completed != 1) {
            $routine->status = $valor;
        } else {
            $routine->completed = $valor;
        }

        $routine->update();

        return response()->json(['status' => 'Se modificó el estado con éxito', 'icon' => 'success']);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function updateForm(Request $request)
    {
        //

        $valor = $request->val;

        $id = $request->id;
        $routine = Routine::where('id', $id)->first();

        $routine->form = $valor;

        $routine->update();

        return response()->json(['status' => 'Se modificó la forma con éxito', 'icon' => 'success']);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function updateStatusDay(Request $request)
    {
        //

        $valor = $request->val;

        $id = $request->id;
        $routine = RoutineDays::where('id', $id)->first();

        $routine->status = $valor;

        $routine->update();

        return response()->json(['status' => 'Se modificó el estado con éxito', 'icon' => 'success']);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function updateDescription(Request $request, $id)
    {
        //  


        $routine = Routine::findOrfail($id);

        $routine->description = $request->description;

        $routine->update();

        return redirect('user/routine/' . $request->user_id);
    }

    public function createWordToZero()
    {

        $is_routine = Auth::user()->is_routine;
        if ($is_routine == 0) {
            return redirect('/')->with(['status' => 'Aún no han generado su rutina, comunícate con personal del gimnasio para asignarla.', 'icon' => 'warning']);
        }

        $documento = new \PhpOffice\PhpWord\PhpWord();
        $propiedades = $documento->getDocInfo();
        $propiedades->setCreator("Katalyst Fit Room");
        $propiedades->setTitle("Tablas");

        $seccion = $documento->addSection();

        // Agregar imagen al encabezado

        $header = $seccion->addHeader();
        $header->addWatermark('images/katalyst.PNG', array(
            'marginTop' => 50, 'marginLeft' => 55, 'width' => 80,  // Ancho de la imagen en puntos
            'height' => 40
        ));

        $seccion->addTextBreak();

        $estiloTabla = [
            "borderColor" => "000000",
            "alignment" => Jc::CENTER,
            "borderSize" => 10,
            "cellMargin" => 100

        ];

        $documento->addTableStyle("estilo3", $estiloTabla);
        $tabla = $seccion->addTable("estilo3");


        $styleCell = [
            "bgColor" => "A8E1F5",
            "cellMargin" => 100
        ];

        // Obtener rutinas y categorizar por categoría general
        $routines = Routine::where('routines.user_id', Auth::user()->id)
            ->where('routines.day', '!=', 0)
            ->where('routines.status', 1)
            ->join('general_categories', 'routines.general_category_id', 'general_categories.id')
            ->join('exercises', 'routines.exercise_id', 'exercises.id')
            ->select(

                'general_categories.category as category',
                'exercises.exercise as exercise',
                'routines.day as day',
                'routines.description as description',
                'routines.series as series',
                'routines.alt as alt',
                'routines.weight as weight',
                'routines.form as form',
                'routines.reps as reps'
            )->orderBy('routines.day', 'asc')->orderBy('routines.alt', 'asc')->get();

        $categoryGroups = []; // Para almacenar categorías únicas

        foreach ($routines as $routine) {
            // Usar la categoría general como clave para agrupar en categorías
            $categoryGroups[$routine->category][] = $routine;
        }

        $fuente = [
            "name" => "Arial",
            "size" => 12,
            "color" => "000000",
        ];

        $styleCellItemOther = [
            "name" => "Arial",
            "size" => 12,
            "color" => '000000',
            "width" => 10
        ];

        foreach ($categoryGroups as $category => $categoryRoutines) {
            $tabla = $seccion->addTable("estilo3");
            $tabla->addRow();
            $tabla->addCell(null, $styleCell)->addText("Peso", $fuente);
            $tabla->addCell()->addText("Alt", $fuente);
            $tabla->addCell(null, $styleCell)->addText($category, $fuente);
            $tabla->addCell()->addText("Series", $fuente);
            $tabla->addCell()->addText("Reps", $fuente);
            $tabla->addCell()->addText("Tipo", $fuente);
            $tabla->addCell()->addText("Descripción", $fuente);
            $tabla->setWidth(80 * 60);

            foreach ($categoryRoutines as $routine) {

                $color = $this->getColor($routine->day);

                $styleCellItem = [
                    "name" => "Arial",
                    "size" => 12,
                    "color" => 'FFF',
                    "width" => 100 * 50,
                    "bgColor" => $color,
                ];

                $tabla->addRow();
                $tabla->addCell()->addText($routine->weight, $styleCellItemOther);
                $tabla->addCell()->addText($routine->alt, $styleCellItemOther);
                $tabla->addCell()->addText($routine->exercise, $styleCellItem);
                $tabla->addCell()->addText($routine->series, $styleCellItemOther);
                $tabla->addCell()->addText($routine->reps, $styleCellItemOther);
                $tabla->addCell()->addText($routine->form, $styleCellItemOther);
                $tabla->addCell()->addText($routine->description);
            }
        }

        $seccion->addTextBreak();

        $fuenteNormal = [
            "name" => "Arial",
            "size" => 12,
            "color" => "000000",
        ];
        $fuenteLink = [
            "name" => "Arial",
            "size" => 12,
            "color" => "1E10F7",
        ];

        $fuenteTitle = [
            "name" => "Arial",
            "size" => 12,
            "color" => "000000",

            "bold" => true,
        ];

        $seccion->addText("Importante:", $fuenteTitle);


        $seccion->addText("Para llevar control de peso, visita:", $fuenteNormal);
        $seccion->addLink('https://www.katalystfitroom.com/Login.html', 'https://www.katalystfitroom.com/Login.html', $fuenteLink, false);
        $seccion->addText("Para registrar tu asistencia, visita:", $fuenteNormal);
        $seccion->addLink('https://katalystfitroom.com/Asistencia.php', 'https://katalystfitroom.com/Asistencia.php', $fuenteLink, false);
        $seccion->addText("introducir num de ced - presionar 3 lineas izquier arriba-bitcora - insertar dato por dato-si necesita ayuda cualquier COACH presente te puede ayuda", $fuenteNormal);

        $seccion->addTextBreak();

        $dayCategoryGroups = []; // Para almacenar días y categorías únicas

        foreach ($routines as $routine) {
            // Usar el día y la categoría general como claves para agrupar en categorías
            $dayCategoryGroups[$routine->day][$routine->category][] = $routine;
        }

        foreach ($dayCategoryGroups as $day => $categoryGroups) {

            $categories = '';

            $tabla = $seccion->addTable("estilo3");
            $tabla->setWidth(80 * 60);

            $color = $this->getColor($day);

            $styleCellItemDay = [
                "name" => "Arial",
                "size" => 12,
                "color" => 'FFF',
                "bgColor" => $color,
            ];

            $tabla->addRow();
            $tabla->addCell(null, $styleCellItemDay)->addText("Grupos Musculares - Día " . $day, $fuente);

            foreach ($categoryGroups as $category => $categoryRoutines) {
                $categories .= $category . ' ';
            }

            $tabla->addRow();
            $tabla->addCell()->addText($categories, $fuente);
        }


        $documento->getCompatibility()->setOoxmlVersion(15);
        $documento->getSettings()->setThemeFontLang(new Language("ES-CR"));

        $objWriter = \PhpOffice\PhpWord\IOFactory::createWriter($documento, "Word2007");

        $modifiedFilePath = 'Rutina de ' . Auth::user()->name . '.docx';
        $objWriter->save($modifiedFilePath);

        return response()->download($modifiedFilePath);
    }

    public function getColor($day)
    {
        switch ($day) {
            case '1':
                $color = 'FF0000';
                break;
            case '2':
                $color = 'FFDC00';
                break;
            case '3':
                $color = '0CFF00';
                break;
            case '4':
                $color = '0017FF';
                break;
            case '5':
                $color = 'A600FF';
                break;
            default:
                $color = 'FF7400';
                break;
        }
        return $color;
    }
}
