<div class="modal fade" id="add-parameter-modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title font-weight-normal" id="exampleModalLabel">Nuevo Parámetro</h5>
                <button type="button" class="btn-close text-dark" data-bs-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form class="form-horizontal" action="{{ url('parameter/store') }}" method="post"
                    enctype="multipart/form-data">
                    {{ csrf_field() }}

                    @include('admin.parameters.form', ['Modo' => 'crear'])

                </form>
            </div>
            
        </div>
    </div>
</div>
