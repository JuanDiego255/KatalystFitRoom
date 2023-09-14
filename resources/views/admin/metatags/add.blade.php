@extends('layouts.admin')
@section('content')
<div class="card">
    <div class="card-header">
        <h4 class="text-dark">Agregar Metatag</h4>
    </div>
    <div class="card-body">

        <form class="form-horizontal" action="{{ url('metatag') }}" method="post" enctype="multipart/form-data">
            {{ csrf_field() }}
            @include('admin.metatags.form',['Modo'=>'crear'])
        </form>

    </div>
</div>
@endsection
