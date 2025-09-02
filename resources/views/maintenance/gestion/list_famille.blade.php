@extends('maintenance.basefront')
@section('title','Toutes les familles')
@section('content')
    <div class="col-lg-12">
        <h1 class="page-header">Familles</h1>
    </div>
    <div class="row">
        <div class="col-lg-8">
            <div class="panel panel-default">
                <div class="panel-heading">
                    Aperçu des familles maintenance
                </div>
                <div class="panel-body">
                    <div class="table-responsive">
                        <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                            <thead>
                            <tr>
                                <th>#</th>
                                <th>Dépôt</th>
                                <th>Famille</th>
                                <th>Actions</th>
                            </tr>
                            </thead>
                            <tbody>
                            <tr class="odd gradeX">
                                <td>1</td>
                                <td>Fournitures</td>
                                <td>Famille 1</td>
                                <td class="text-center">
                                    <a href="#"
                                       class="btn btn-success btn-circle"
                                       title="Modifier">
                                        <i class="fa fa-pencil"></i>
                                    </a>
                                    <form action="" method="POST" style="display:inline-block; margin-left:3px;">
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
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-4">
            <div class="panel panel-default">
                <div class="panel-heading">
                    Formulaires Ajouts Familles
                </div>
                <div class="panel-body">
                    <div class="row">
                        <div class="col-lg-12">
                            <form action="#">
                                @csrf
                                <div class="form-group">
                                    <label>Depôt</label>
                                    <select class="form-control">
                                        <option value="0">--Choisir--</option>
                                        <option value="idEmploye">Depot 1</option>
                                        <option value="idEmploye">Depot 2</option>
                                        <option value="idEmploye">Depot 3</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label>Nom famille</label>
                                    <input class="form-control" placeholder="...">
                                </div>
                                <button type="submit" class="btn btn-success" style="width:100px;">Validez</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
