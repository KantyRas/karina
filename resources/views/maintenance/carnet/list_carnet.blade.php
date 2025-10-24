@extends('maintenance.basefront')
@section('title','Carnet')
@section('content')
    <div class="col-lg-12">
        <h1 class="page-header">Tous les carnets des equipements</h1>
        <div class="text-right" style="margin-bottom:15px;">
            <a href="{{ route('carnet.create_carnet') }}" class="btn btn-primary">
                <i class="fa fa-plus"></i> Nouveau carnet
            </a>
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
                                <th>Equipement</th>
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
