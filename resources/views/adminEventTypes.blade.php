@extends('adminlte::page')

@section('title', 'Tipo de Eventos')

@section('content')
    <div class="p-1">
        <button id="create-type-btn" data-toggle="modal" data-target="#createTypeModal" class="btn-success"><i class="fa fa-plus"></i></button>
    </div>
    <table class="table">
        <thead>
            <tr>
                <th scope="col">ID</th>
                <th scope="col">Nombre</th>
                <th scope="col">Fondo</th>
                <th scope="col">Borde</th>
                <th scope="col">Texto</th>
                <th scope="col">Acciones</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($eventTypesPag as $type)
                <tr>
                    <th scope="row">{{$type->id}}</th>
                    <td>{{$type->name}}</td>
                    <td>
                        <p style="border: 2px solid  {{$type->backgroundColor}}">{{$type->backgroundColor}}</p>
                    </td>
                    <td>
                        <p style="border: 2px solid  {{$type->borderColor}}">{{$type->borderColor}}</p>
                    </td>
                    <td>
                        <p style="border: 2px solid  {{$type->textColor}}">{{$type->textColor}}</p>
                    </td>
                    <td>
                        <button type="submit" class="btn btn-success edit-type-btn" data-type-id="{{$type->id}}"><i class="fa fa-edit"></i></button>
                        <button type="submit" class="btn btn-danger ml-1 delete-type-btn" data-type-id="{{$type->id}}"><i class="fa fa-trash"></i></button>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <nav aria-label="Page navigation">
        <ul class="pagination">
            @if ($eventTypesPag->onFirstPage())
                <li class="page-item disabled">
                    <span class="page-link">Anterior</span>
                </li>
            @else
                <li class="page-item">
                    <a class="page-link" href="{{ $eventTypesPag->previousPageUrl() }}" rel="prev">Anterior</a>
                </li>
            @endif

            @if ($eventTypesPag->hasMorePages())
                <li class="page-item">
                    <a class="page-link" href="{{ $eventTypesPag->nextPageUrl() }}" rel="next">Siguiente</a>
                </li>
            @else
                <li class="page-item disabled">
                    <span class="page-link">Siguiente</span>
                </li>
            @endif
        </ul>
    </nav>   
    <div class="modal fade" id="editTypeModal" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" >Editar Tipo de evento</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="edit-type-form">
                        @csrf
                        <input type="hidden" id="edit-type-id" name="id">
                        <div class="form-group">
                            <label for="edit-type-name">Nombre</label>
                            <input type="text" class="form-control" id="edit-type-name" name="name" >
                        </div>
                        <div>
                            <div class="form-group">
                                <label for="edit-type-background">Fondo</label>
                                <input type="color" class="form-control" id="edit-type-background" name="backgroundColor" >
                            </div>
                            <div class="form-group">
                                <label for="edit-type-border">Borde</label>
                                <input type="color" class="form-control" id="edit-type-border" name="borderColor" >
                            </div>
                            <div class="form-group">
                                <label for="edit-type-text">Texto</label>
                                <input type="color" class="form-control" id="edit-type-text" name="textColor" >
                            </div>
                        </div>
                        <div class="d-flex justify-content-end">
                            <button id="update-btn" type="submit" class="btn btn-success"><i class="fa fa-edit"></i>Editar</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="createTypeModal" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" >Crear Tipo de evento</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="create-type-form" action="{{ route('eventTypes.create') }}" method="POST">
                        @csrf
                        <div class="form-group">
                            <label for="create-type-name">Nombre</label>
                            <input type="text" class="form-control" id="create-type-name" name="name" required>
                        </div>
                        <div>
                            <div class="form-group">
                                <label for="create-type-background">Fondo</label>
                                <input type="color" class="form-control" id="create-type-background" name="backgroundColor" required>
                            </div>
                            <div class="form-group">
                                <label for="create-type-border">Borde</label>
                                <input type="color" class="form-control" id="create-type-border" name="borderColor" required>
                            </div>
                            <div class="form-group">
                                <label for="create-type-text">Texto</label>
                                <input type="color" class="form-control" id="create-type-text" name="textColor" required>
                            </div>
                        </div>
                        <div class="d-flex justify-content-end">
                            <button id="update-btn" type="submit" class="btn btn-primary"><i class="fa fa-create"></i>Crear</button>
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
            
            $(".edit-type-btn").click(function () {
                const typeId = $(this).data("type-id")

                $.ajax({
                    url: "{{ route('eventTypes.edit') }}", 
                    type: "GET",
                    data:{
                        id: typeId
                    },
                    dataType: "json",
                    success: function (data) {
                        console.log(data)
                        $("#edit-type-id").val(data.id);
                        $("#edit-type-name").val(data.name);
                        $("#edit-type-background").val(data.backgroundColor);
                        $("#edit-type-border").val(data.borderColor);
                        $("#edit-type-text").val(data.textColor);
                    },
                    error: function (error) {
                        console.error("Error al cargar los datos.");
                    }
                });

                $('#editTypeModal').modal('show');
            });

            $("#edit-type-form").submit(function (e) {
                e.preventDefault();

                const formData = $(this).serialize();
                $.ajax({
                    url: "{{ route('eventTypes.update') }}", 
                    type: "PUT",
                    data: formData,
                    success: function (response) {
                        location.reload();
                    },
                    error: function (error) {
                        console.error("Error al actualizar.");
                    }
                });
            });


            $(".delete-type-btn").click(function (e) {
                e.preventDefault();
                const userId = $(this).data("type-id")

                $.ajax({
                    url: "{{ route('eventTypes.delete') }}", 
                    type: "DELETE",
                    data: {
                        id: userId
                    },
                    success: function (response) {
                        location.reload()
                    },
                    error: function (error) {
                        console.error("Error al eliminar el tipo de evento.");
                    }
                });
            });
















        })
    </script>
@stop
