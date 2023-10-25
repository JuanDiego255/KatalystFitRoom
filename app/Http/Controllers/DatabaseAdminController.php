<?php

namespace App\Http\Controllers;

use App\Models\Admin\DatabaseAdmin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class DatabaseAdminController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        return view('admin.database_Admin.index');
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        try {
            DB::beginTransaction();
            $newAlias = $request->alias;

            $allTables = Schema::getConnection()->getDoctrineSchemaManager()->listTableNames();

            foreach ($allTables as $table) {
                $newTable = $newAlias . '_' . $table;
                DB::statement("CREATE TABLE $newTable LIKE $table");
            }

            // Confirmar la transacción después de duplicar todas las tablas
            DB::commit();

            return redirect('/tables')->with(['status' => 'Se han generado las tablas', 'icon' => 'success']);
        } catch (\Throwable $th) {
            // Ocurrió un error, realizar un rollback y mostrar un mensaje de error
            DB::rollBack();
            return redirect('/tables')->with(['status' => $th, 'icon' => 'error']);
        }
    }
}
