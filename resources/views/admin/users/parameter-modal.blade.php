<div class="modal modal-lg fade" id="parameter-routine{{ $user->id }}" tabindex="-1" role="dialog"
    aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title font-weight-normal" id="exampleModalLabel">Generar Rutina Aleatoria</h5>
                <button type="button" class="btn-close text-dark" data-bs-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
                <form action="{{ url('/create/routine/') }}" method="post"
                    style="display:inline">
                    {{ csrf_field() }}
                    <input type="hidden" id="id" name="id" value="{{ $user->id }}">
                    <input type="hidden" id="type" name="type" value="0">
                    <div class="row">


                        @foreach ($general_categories as $category)
                            <h4>{{ $category->category }}</h4>
                                <div class="col-md-6 mb-1">
                                    <div class="input-group input-group-lg input-group-static">
                                        <label>Cantidad</label>
                                        <input value="0" type="number" min="0"
                                            class="form-control form-control-lg" name="quantity_{{ $category->id }}"
                                            id="quantity_{{ $category->id }}" required>

                                    </div>
                                </div>
                                <div class="col-md-6 mb-1">
                                    <div class="input-group input-group-lg input-group-static">
                                        <label>Día</label>
                                        <input value="0" type="number" min="0"
                                            class="form-control form-control-lg" name="day_{{ $category->id }}"
                                            id="day_{{ $category->id }}" required>

                                    </div>
                                </div>
                        @endforeach
                    </div>

                    <button class="btn bg-gradient-safewor-red text-white" type="submit">Generar
                    </button>

                </form>
            </div>

        </div>
    </div>
</div>
