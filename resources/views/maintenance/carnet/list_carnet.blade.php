@extends('maintenance.basefront')
@section('title','Carnet')
@section('content')
    <div class="col-lg-12">
        <h1 class="page-header">Tous les équipements</h1>

        <div class="panel panel-default">
            <div class="panel-heading">
                <strong>Importer les équipements</strong>
            </div>
            <div class="panel-body">
                <form action="{{ route('carnet.equipement.import') }}" method="POST" enctype="multipart/form-data" class="form-inline text-center">
                    @csrf
                    <div class="form-group" style="margin-right:10px;">
                        <label for="fichier" class="sr-only">Fichier Excel :</label>
                        <input type="file" name="fichier" id="fichier" class="form-control" required>
                    </div>
                    <button type="submit" class="btn btn-success">
                        <i class="fa fa-upload"></i> Importer
                    </button>
                    <a href="{{ route('carnet.create_carnet') }}" class="btn btn-primary" style="margin-left:10px;">
                        <i class="fa fa-plus"></i> Nouveau Item
                    </a>
                </form>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    Equipements
                </div>
                <div class="panel-body">
                    <div class="table-responsive">
                        <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                            <thead>
                            <tr>
                                <th>#</th>
                                <th>Item</th>
                                <th>Emplacement</th>
                                <th>Employe responsable</th>
                                <th>Matricule</th>
                                <th>Actions</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach ($equipements as $e)
                            <tr class="odd gradeX">
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $e->nomequipement }}</td>
                                    <td>{{ $e->emplacement }}</td>
                                    <td>{{ $e->nomemploye }}</td>
                                    <td>{{ $e->matricule }}</td>
                                    <td class="text-center">
                                        <a href="{{ route('carnet.fiche_carnet_historique', $e->idequipement) }}"
                                        class="btn btn-primary btn-circle"
                                        title="Checklist">
                                            <i class="fa fa-list-alt"></i>
                                        </a>
                                        <a href="#"
                                        class="btn btn-success btn-circle"
                                        title="Modifier">
                                            <i class="fa fa-pencil"></i>
                                        </a>
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
@endsection
