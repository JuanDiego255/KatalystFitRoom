@extends('layouts.admin')
@section('content')
    <div class="container">

        <h2 class="text-center font-title"><strong>Maneja las meta etiquetas desde acá</strong>
        </h2>

        <hr class="hr-servicios">
        <a href="{{ url('metatag/agregar') }}" class="btn bg-gradient-safewor-black text-white">Nueva Sección</a>

    </div>
    <center>
        <div class="card">
            <div class="table-responsive">
                <table class="table align-items-center mb-0">
                    <thead>
                        <tr>
                            <th class="text-center text-uppercase text-secondary text-xs font-weight-bolder opacity-7">
                                Section</th>
                            <th class="text-center text-uppercase text-secondary text-xs font-weight-bolder opacity-7">
                                Title</th>
                            <th class="text-center text-uppercase text-secondary text-xs font-weight-bolder opacity-7">
                                Meta Keywords</th>
                            <th class="text-center text-uppercase text-secondary text-xs font-weight-bolder opacity-7">
                                OG Title</th>
                            <th class="text-center text-uppercase text-secondary text-xs font-weight-bolder opacity-7">
                                OG Image</th>
                            <th class="text-center text-uppercase text-secondary text-xs font-weight-bolder opacity-7">
                                URL Canonical</th>
                            <th class="text-center text-uppercase text-secondary text-xs font-weight-bolder opacity-7">
                                Type</th>
                            <th class="text-center text-uppercase text-secondary text-xs font-weight-bolder opacity-7">
                                Acciones</th>
                            <th class="text-secondary opacity-7"></th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($metatags as $tag)
                            <tr>
                                <td class="align-middle text-xxs text-center">
                                    <p class=" font-weight-bold mb-0">{{ $tag->section }}</p>
                                </td>
                                <td class="align-middle text-xxs text-center">
                                    <p class=" font-weight-bold mb-0">{{ $tag->title }}</p>
                                </td>
                                <td class="align-middle text-xxs text-center text-sm">
                                    <p class=" font-weight-bold mb-0">{{ $tag->meta_keywords }}</p>
                                </td>
                                <td class="align-middle text-xxs text-center">
                                    <p class=" font-weight-bold mb-0">{{ $tag->meta_og_title }}</p>
                                </td>
                                <td class="align-middle text-xxs text-center">
                                    <p class="font-weight-bold mb-0">{{ $tag->url_image_og }}</p>
                                </td>
                                <td class="align-middle text-xxs text-center">
                                    <p class="font-weight-bold mb-0">{{ $tag->url_canonical }}</p>
                                </td>
                                <td class="align-middle text-xxs text-center">
                                    <p class=" font-weight-bold mb-0">{{ $tag->meta_type }}</p>
                                </td>
                                <td class="align-middle">
                                    <center>
                                        <a href="{{ url('metatag/edit/' . $tag->id) }}"
                                            class="btn bg-gradient-safewor-black text-white">Detalles</a>
                                        <form method="post" action="{{ url('/delete-metatag/' . $tag->id) }}"
                                            style="display:inline">
                                            {{ csrf_field() }}
                                            {{ method_field('DELETE') }}
                                            <button class="btn bg-gradient-safewor-black text-white" type="submit"
                                                onclick="return confirm('Deseas borrar esta sección?')">Borrar
                                            </button>
                                        </form>
                                    </center>

                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
        {{ $metatags ?? ('')->links('pagination::simple-bootstrap-4') }}


    </center>
@endsection
