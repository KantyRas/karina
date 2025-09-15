@extends('maintenance.basefront')
@section('title','Ajout Employé')
@section('content')
    <div class="col-lg-12">
        <h1 class="page-header">Employés</h1>
    </div>
    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    Formulaires Ajouts Employés
                </div>
                <div class="panel-body">
                    <div class="row">
                        <form action="{{ route($employe->exists ? 'admin.personnel.employe.update' : 'admin.personnel.employe.store', $employe) }}" method="post">
                            @csrf
                            @method($employe->exists ? 'PUT' : 'POST')
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label>Nom</label>
                                    <input class="form-control @error('nom') is-invalid @enderror"
                                           name="nom"
                                           placeholder="Entrez le nom"
                                           value="{{ old('nom', $employe->nom ?? '') }}">
                                </div>
                                <div class="form-group">
                                    <label>Prénom</label>
                                    <input class="form-control" name="prenom" placeholder="Entrez le prénom" value={{ $employe->prenom ?? ''}}>
                                    @error('prenom')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label>Matricule nº</label>
                                    <input type="text" class="form-control" name="matricule" placeholder="ex: 6906" value={{ $employe->matricule ?? ''}}>
                                    @error('matricule')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label>Email</label>
                                    <input type="email" class="form-control" name="email" placeholder="ex: rakoto@gmail.com" value={{ $employe->email ?? ''}}>
                                    @error('email')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label>Téléphone</label>
                                    <input type="tel" class="form-control" name="telephone" placeholder="ex: 0348945621" value={{ $employe->telephone ?? ''}}>
                                    @error('telephone')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label>Fonction</label>
                                    <select class="form-control" name="idfonction">
                                        <option value="">--Choisir--</option>
                                        @foreach ($fonction as $f)
                                        <option value="{{ $f->idfonction }}" {{ $employe->idfonction == $f->idfonction ? 'selected' : '' }} >
                                            {{ $f->fonction }}
                                        </option>
                                        @endforeach
                                    </select>
                                    @error('idfonction')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-lg-12">
                                <button type="submit" class="btn btn-success" style="width:200px;">Valider</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
