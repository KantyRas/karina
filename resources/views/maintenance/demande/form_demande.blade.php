@extends('maintenance.basefront')
@section('title', "Faire une demande")
@section('content')
    <div class="container">
        <h2 class="mb-4">Bon de Demande d'Achat</h2>
        <br>
        <form action="#" method="POST">
            @csrf
            <div class="mb-3 row">
                <label class="col-sm-2 col-form-label">Demandeur :</label>
                <div class="col-sm-4">
                    <input type="text" name="demandeur" class="form-control" required>
                </div>

                <label class="col-sm-2 col-form-label">Date :</label>
                <div class="col-sm-4">
                    <input type="date" name="date" class="form-control" value="{{ date('Y-m-d') }}" required>
                </div>
            </div>
            <br>
            <table class="table table-bordered align-middle" id="articlesTable">
                <thead class="table-light">
                <tr>
                    <th style="width: 5%">Item</th>
                    <th style="width: 20%">Code Article</th>
                    <th style="width: 40%">Désignation</th>
                    <th style="width: 10%">Quantité</th>
                    <th style="width: 15%">Unité</th>
                    <th style="width: 10%">Action</th>
                </tr>
                </thead>
                <tbody>
                <tr>
                    <td>1</td>
                    <td>
                        <input type="text" name="" class="form-control designation" disabled>
                    </td>
                    <td>
                        {{-- <input type="text" name="articles[0][designation]" class="form-control designation"> --}}
                        <select name="" class="form-control code-article-select" required>
                            <option value="">-- Choisir --</option>
                            @foreach($articles as $article)
                                <option value="{{ $article->idarticle }}">{{ $article->designation }}</option>
                            @endforeach
                        </select>
                    </td>
                    <td><input type="number" name="articles[0][quantite]" class="form-control" min="1" value="1" required></td>
                    <td><input type="text" name="articles[0][idUnite]" class="form-control unite" readonly></td>
                    <td class="text-center">
                        <button type="button" class="btn btn-danger btn-sm removeRow" disabled>
                            <i class="fa fa-trash-o"></i>
                        </button>
                    </td>
                </tr>
                </tbody>
            </table>

            <div class="d-flex justify-content-end align-items-center mb-4">
                <button type="button" id="ajouterLigne" class="btn btn-primary me-3">
                    <i class="fa fa-plus"></i> Ajouter un article
                </button>
                <button type="submit" class="btn btn-success">
                    <i class="fa fa-save"></i> Envoyer la demande
                </button>
            </div>

        </form>
    </div>

    <script>
        window.listeArticles = @json($articles);
    </script>
    <script src="{{ asset('js/demande-utils.js') }}"></script>
@endsection
