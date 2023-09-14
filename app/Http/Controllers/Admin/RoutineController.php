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

            for ($i = 1; $i < 7; $i++) {
                $day = new RoutineDays();
                $day->user_id = Auth::user()->id;
                $day->day = $i;
                $day->status = 1;
                $day->save();
            }

            foreach ($exercises as $exercise) {
                $routine = new Routine();
                $routine->user_id = $request->id;
                $routine->general_category_id = $exercise->general_category_id;
                $routine->exercise_id = $exercise->id;
                $routine->alt = 0;
                $routine->series = 0;
                $routine->reps = 0;
                $routine->status = 1;
                $routine->save();
            }
            $user = User::find($request->id);
            $user->is_routine = 1;
            $user->save();

            return redirect('/users')->with(['status' => 'Se ha creado la rutina con éxito', 'icon' => 'success']);
        } catch (Exception $e) {
            $user->is_routine = 0;
            throw $e;
        }
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
        $header->addWatermark('images/katalyst.PNG', array('marginTop' => 50, 'marginLeft' => 55, 'width' => 80,  // Ancho de la imagen en puntos
        'height' => 40));

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
        ];

        // Obtener rutinas y categorizar por categoría general
        $routines = Routine::where('routines.user_id', Auth::user()->id)
            ->where('routines.day', '!=', 0)
            ->where('routines.status', 1)
            ->join('general_categories', 'routines.general_category_id', 'general_categories.id')
            ->join('exercises', 'routines.exercise_id', 'exercises.id')
            ->select(
                'exercises.code as code',
                'general_categories.category as category',
                'exercises.exercise as exercise',
                'routines.day as day',
                'routines.description as description',
                'routines.series as series',
                'routines.alt as alt',
                'routines.weight as weight',
                'routines.form as form',
                'routines.reps as reps'
            )->orderBy('routines.day')->get();

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

        foreach ($categoryGroups as $category => $categoryRoutines) {
            $tabla = $seccion->addTable("estilo3");
            $tabla->addRow();
            $tabla->addCell(null, $styleCell)->addText("Peso", $fuente);
            $tabla->addCell()->addText("Alt", $fuente);
            $tabla->addCell(100, $styleCell)->addText($category, $fuente);
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
                    "bgColor" => $color,
                ];

                $tabla->addRow();
                $tabla->addCell()->addText($routine->weight);
                $tabla->addCell()->addText($routine->alt);
                $tabla->addCell()->addText($routine->exercise, $styleCellItem);
                $tabla->addCell()->addText($routine->series);
                $tabla->addCell()->addText($routine->reps);
                $tabla->addCell()->addText($routine->form);
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
            $tabla->addCell(100, $styleCellItemDay)->addText("Grupos Musculares - Día " . $day, $fuente);

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
