@extends('adminlte::page')

@section('title', 'Usuarios')

@section('content')
    <table class="table">
        <thead>
            <tr>
                <th scope="col">ID</th>
                <th scope="col">Nombre</th>
                <th scope="col">Email</th>
                <th scope="col">Rol</th>
                <th scope="col">Acciones</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($usersPag as $user)
                <tr>
                    <th scope="row">{{$user->id}}</th>
                    <td>{{$user->name}}</td>
                    <td>{{$user->email}}</td>
                    <td>{{$user->role}}</td>
                    <td>
                        <button type="submit" class="btn btn-success edit-user-btn" data-user-id="{{$user->id}}"><i class="fa fa-edit"></i></button>
                        <button type="submit" class="btn btn-danger ml-1 delete-user-btn" data-user-id="{{$user->id}}"><i class="fa fa-trash"></i></button>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <nav aria-label="Page navigation">
        <ul class="pagination">
            @if ($usersPag->onFirstPage())
                <li class="page-item disabled">
                    <span class="page-link">Anterior</span>
                </li>
            @else
                <li class="page-item">
                    <a class="page-link" href="{{ $usersPag->previousPageUrl() }}" rel="prev">Anterior</a>
                </li>
            @endif

            @if ($usersPag->hasMorePages())
                <li class="page-item">
                    <a class="page-link" href="{{ $usersPag->nextPageUrl() }}" rel="next">Siguiente</a>
                </li>
            @else
                <li class="page-item disabled">
                    <span class="page-link">Siguiente</span>
                </li>
            @endif
        </ul>
    </nav>

    <div class="modal fade" id="editUserModal" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" >Editar Evento</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="edit-user-form">
                        @csrf
                        <input type="hidden" id="edit-user-id" name="id">
                        <div class="form-group">
                            <label for="edit-user-name">Nombre</label>
                            <input type="text" class="form-control" id="edit-user-name" name="name" >
                        </div>
                        <div class="form-group">
                            <label for="edit-user-email">Email</label>
                            <input type="text" class="form-control" id="edit-user-email" name="email" >
                        </div>
                        <div class="form-group">
                            <label for="edit-user-role">Rol:</label>
                            <select class="form-control" id="edit-user-role" name="role">
                                <option value="user">user</option>
                                <option value="admin">admin</option>
                            </select>
                        </div>
                        <div class="d-flex justify-content-end">
                            <button id="update-btn" type="submit" class="btn btn-success"><i class="fa fa-edit"></i>Editar</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@stop

@include('layouts.footer')

@section('js')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            /**
             * 
             * 
             * Manejadores de los botones para editar y borrar
            */  
            
            $(".edit-user-btn").click(function () {
                const userId = $(this).data("user-id")

                $.ajax({
                    url: "{{ route('users.edit') }}", 
                    type: "GET",
                    data:{
                        id: userId
                    },
                    dataType: "json",
                    success: function (data) {
                        $("#edit-user-id").val(data.id);
                        $("#edit-user-name").val(data.name);
                        $("#edit-user-email").val(data.email);
                        $("#edit-user-role").val(data.role);
                    },
                    error: function (error) {
                        console.error("Error al cargar los datos del usuario.");
                    }
                });

                $('#editUserModal').modal('show');
            });

            $("#edit-user-form").submit(function (e) {
                e.preventDefault();

                const formData = $(this).serialize();
                $.ajax({
                    url: "{{ route('users.update') }}", 
                    type: "PUT",
                    data: formData,
                    success: function (response) {
                        location.reload();
                    },
                    error: function (error) {
                        console.error("Error al actualizar el usuario.");
                    }
                });
            });

            $(".delete-user-btn").click(function (e) {
                e.preventDefault();
                const userId = $(this).data("user-id")

                $.ajax({
                    url: "{{ route('users.delete') }}", 
                    type: "DELETE",
                    data: {
                        id: userId
                    },
                    success: function (response) {
                        location.reload()
                    },
                    error: function (error) {
                        console.error("Error al eliminar el usuario.");
                    }
                });
            });
        })
    </script>
@stop
