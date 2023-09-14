@extends('layouts.admin')

@section('content')
    <div class="card">
        <div class="card-header">
            <h4 class="text-dark">Editar Disciplina</h4>
        </div>
        <div class="card-body">
            <form method="POST" action="{{ url('/discipline/update/' . $discipline->id) }}" enctype="multipart/form-data">
                {{ csrf_field() }}
                {{ method_field('PUT') }}
                @include('admin.disciplines.form', ['Modo' => 'editar'])
            </form>
        </div>
    </div>
@endsection
