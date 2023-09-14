@extends('layouts.admin')
@section('content')
<div class="card">
    <div class="card-header">
        <h4 class="text-dark">Agregar Disciplina</h4>
    </div>
    <div class="card-body">

        <form class="form-horizontal" action="{{ url('discipline/store') }}" method="post" enctype="multipart/form-data">
            {{ csrf_field() }}
            @include('admin.disciplines.form',['Modo'=>'crear'])
        </form>

    </div>
</div>
@endsection
