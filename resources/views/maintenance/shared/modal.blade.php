<div class="modal fade" id="{{ $id ?? 'ajoutModal' }}" tabindex="-1" role="dialog" aria-labelledby="{{ $labelId ?? 'defaultLabel' }}" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content border-0 shadow-lg rounded-3">
            <form action="{{ $action ?? '#' }}" method="{{ $method ?? 'POST' }}">
                @csrf
                @if(isset($parametre))
                    @method('PUT')
                @endif
                <div class="modal-header bg-primary text-white">
                    <h5 class="modal-title" id="{{ $labelId ?? 'defaultLabel' }}">
                        <i class="fa fa-plus-circle"></i> {{ $title ?? 'Titre Modal' }}
                    </h5>
                    <button type="button" class="close text-white" data-dismiss="modal" aria-label="Fermer">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>

                <div class="modal-body">
                    {!! $body ?? '' !!}
                </div>

                <div class="modal-footer border-0">
                    <button type="button" class="btn btn-outline-secondary" data-dismiss="modal">
                        <i class="fa fa-times"></i> Annuler
                    </button>
                    <button type="submit" class="btn btn-success">
                        <i class="fa fa-check"></i> Valider
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
