<div class="modal fade" id="quantity-exercises" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title font-weight-normal" id="exampleModalLabel">Cuántos ejercicios desea generar
                    aleatoriamente?</h5>
                <button type="button" class="btn-close text-dark" data-bs-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form method="post" action="{{ url('/create/routine/') }}" style="display:inline">
                    {{ csrf_field() }}
                    <input type="hidden" id="id" name="id" value="{{ $id }}">
                    <input type="hidden" id="type" name="type" value="1">
                    <div class="row">
                        @foreach ($general_categories as $category)
                            <div class="col-md-6 mb-1">
                                <div class="input-group input-group-lg input-group-static my-3 w-100">
                                    <label>{{ $category->category }}</label>
                                    <input value="0" type="number" min="0"
                                        class="form-control form-control-lg" name="{{ $category->id }}"
                                        id="{{ $category->id }}" required>

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
