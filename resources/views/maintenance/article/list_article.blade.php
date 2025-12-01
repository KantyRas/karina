@extends('maintenance.basefront')
@section('title','Articles')
@section('content')
    <div class="col-lg-12">
        <h1 class="page-header">Toutes les Articles</h1>
        <div class="text-left">
            <form action="{{ route('importAction') }}" method="POST" enctype="multipart/form-data" class="form-inline">
                @csrf
                <div class="form-group mr-2">
                    <input type="file" name="file" class="form-control" required>
                </div>
                <button type="submit" class="btn btn-success">
                    <i class="fa fa-upload"></i> Importer
                </button>
            </form>
        </div>
        <div class="text-right" style="margin-bottom:15px;">
            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#ajoutModal">
                <i class="fa fa-plus"></i> Ajouter article
            </button>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    Listes des Items
                </div>
                <div class="panel-body">
                    <div class="table-responsive" style="max-height: 400px; overflow-y: auto;">
                        <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                            <thead>
                            <tr>
                                <th>#</th>
                                <th>Code Article</th>
                                <th>Désignation</th>
                                <th>Unités</th>
                                <th>Actions</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach ($articles as $index => $a)
                                <tr class="odd gradeX">
                                    <th>{{ $index + 1 }}</th>
                                    <th>{{ $a->code }}</th>
                                    <th>{{ $a->designation }}</th>
                                    <th>{{ $a->unite }}</th>
                                    <td class="text-center">
                                        <a href="{{ route('article.edit', $a) }}"
                                           class="btn btn-success btn-circle"
                                           title="Modifier">
                                            <i class="fa fa-pencil"></i>
                                        </a>
                                        <form action="{{ route('article.destroy', $a)}}" method="POST" style="display:inline-block; margin-left:3px;">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit"
                                                    class="btn btn-danger btn-circle"
                                                    title="Supprimer">
                                                <i class="fa fa-trash-o"></i>
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @if(isset($editArticle))
        <script>
            document.addEventListener("DOMContentLoaded", function() {
                $('#ajoutModal').modal('show');

                $('#ajoutModal').on('hidden.bs.modal', function () {
                    window.location.href = '{{ route("article.index") }}';
                });
            });
        </script>
    @endif

    @include('maintenance.shared.modal', [
        'id' => 'ajoutModal',
        'labelId' => 'ajoutArticleLabel',
        'title' => 'Ajout article',
        'action' => isset($editArticle) ? route('article.update', $editArticle) : route('article.store'),
        'parametre' => $editArticle ?? null,
        'body' => '
            <div class="form-group mb-3">
                <label class="font-weight-bold">Code Article</label>
                <input type="text" class="form-control" name="code" placeholder="..."  value="'.old('code', $editArticle->code ?? ''). '" required>
            </div>
            <div class="form-group mb-3">
                <label class="font-weight-bold">Designation</label>
                <input type="text" class="form-control" name="designation" placeholder="..."  value="'.old('designation', $editArticle->designation ?? ''). '" required>
            </div>
            <div class="form-group mb-3">
                <label class="font-weight-bold">Dépots</label>
                <input type="text" class="form-control" name="depot" placeholder="..."  value="'.old('depot', $editArticle->depot ?? ''). '" required>
            </div>
            <div class="form-group mb-3">
                <label class="font-weight-bold">Famille</label>
                <input type="text" class="form-control" name="famille" placeholder="..."  value="'.old('famille', $editArticle->famille ?? ''). '" required>
            </div>
            <div class="form-group mb-3">
                <label class="font-weight-bold">Unité</label>
                <input type="text" class="form-control" name="unite" placeholder="..."  value="'.old('unite', $editArticle->unite ?? ''). '" required>
            </div>
        '
    ])
@endsection
