@extends('maintenance.basefront')
@section('title','Listes utilisateurs')
@section('content')
    <div class="col-lg-12">
        <h1 class="page-header">Tous les utilisateurs</h1>
        <div class="text-right" style="margin-bottom:15px;">
            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#ajoutModal">
                <i class="fa fa-plus"></i>  Ajout comptes utilisateurs
            </button>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    Comptes Utilisateurs
                </div>
                <div class="panel-body">
                    <div class="table-responsive">
                        <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                            <thead>
                            <tr>
                                <th>#</th>
                                <th>Nom d'utilisateur</th>
                                <th>Email</th>
                                <th>Rôle</th>
                                <th>Actions</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($users as $index => $user)
                                <tr class="odd gradeX">
                                    <td>{{ $index + 1 }}</td>
                                    <td>{{ $user->username }}</td>
                                    <td>{{ $user->email }}</td>
                                    <td>{{ $user->roleRelation?->role }}</td>
                                    <td class="text-center">
                                        <a href="#"
                                           class="btn btn-primary btn-circle"
                                           title="Détails">
                                            <i class="fa fa-list-alt"></i>
                                        </a>
                                        <a href="{{ route('admin.personnel.user.edit',$user) }}"
                                           class="btn btn-success btn-circle"
                                           title="Modifier">
                                            <i class="fa fa-pencil"></i>
                                        </a>
                                        <form action="{{ route('admin.personnel.user.destroy',$user) }}" method="POST" style="display:inline-block; margin-left:3px;">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit"
                                                    class="btn btn-danger btn-circle"
                                                    title="Supprimer"
                                                    onclick="return confirm('Voulez-vous vraiment supprimer cet utilisateur ?')">
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
    @if(isset($editUser))
        <script>
            document.addEventListener("DOMContentLoaded", function() {
                $('#ajoutModal').modal('show');

                $('#ajoutModal').on('hidden.bs.modal', function () {
                    window.location.href = '{{ route("admin.personnel.user.index") }}';
                });
            });
        </script>
    @endif
{{-- modal --}}
    <div class="modal fade" id="ajoutModal" tabindex="-1" role="dialog" aria-labelledby="ajoutUserLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    Formulaire Ajout Compte
                </div>
                <div class="row">
                    <div class="col-lg-12">
                        <div class="modal-body">
                            <form action="{{ isset($editUser) ? route('admin.personnel.user.update', $editUser->iduser) : route('admin.personnel.user.store') }}" method="post">
                                @csrf
                                @if(isset($editUser))
                                    @method('PUT')
                                @endif
                                <div class="form-group">
                                    <label>Matricule</label>
                                    <select class="form-control" name="idemploye">
                                        <option value="">--Choisir--</option>
                                        @foreach ($employes as $emp)
                                            <option value="{{ $emp->idemploye }}"
                                                {{ (isset($editUser) && $editUser->idemploye == $emp->idemploye) || old('idemploye') == $emp->idemploye ? 'selected' : '' }}>
                                                {{ $emp->matricule }} - {{ $emp->nom }} {{ $emp->prenom }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label>Username</label>
                                    <input type="text" class="form-control" name="username"
                                           value="{{ old('username', $editUser->username ?? '') }}">
                                </div>
                                <div class="form-group">
                                    <label>Email</label>
                                    <input type="email" class="form-control" name="email"
                                           value="{{ old('email', $editUser->email ?? '') }}">
                                </div>
                                <div class="form-group">
                                    <label>Mot de passe</label>
                                    @if(isset($editUser))
                                        <input type="password" class="form-control" name="password" placeholder="Laisser vide pour ne pas changer">
                                        <small class="text-muted">Laissez vide si vous ne souhaitez pas modifier le mot de passe.</small>
                                    @else
                                        <input type="password" class="form-control" name="password" required>
                                    @endif
                                </div>

                                <div class="form-group">
                                    <label>Rôle</label>
                                    <select class="form-control" name="role">
                                        @foreach ($role as $r)
                                            <option value="{{ $r->idrole }}"
                                                {{ (isset($editUser) && $editUser->role == $r->idrole) || old('role') == $r->idrole ? 'selected' : '' }}>
                                                {{ $r->role }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Annuler</button>
                                    <button type="submit" class="btn btn-success">Valider</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
