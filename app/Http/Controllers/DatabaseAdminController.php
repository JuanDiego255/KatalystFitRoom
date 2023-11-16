<?php

namespace App\Http\Controllers;

use App\Models\Admin\DatabaseAdmin;
use App\Models\Company;
use App\Models\Tables;
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
        $companies = Company::get();
        return view('admin.database_Admin.index', compact('companies'));
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

            $allTables = Tables::get();

            foreach ($allTables as $table) {
                
                $newTable = $newAlias . '_' . $table->table;
                DB::statement("CREATE TABLE $newTable LIKE $table->table");
            }

            $company = new Company();
            $company->company = $request->company;
            $company->alias = $request->alias;
            $company->save();
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
