@extends('adminlte::page')

@section('title', 'Inicio')

@section('content')
    <div id='calendar'></div>

    <div class="modal fade" id="createModal" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" >Crear Evento</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('event.create') }}" method="POST">
                        @csrf
                        <div class="form-group">
                            <label for="create-start">Hora de Inicio:</label>
                            <input type="text" class="form-control" id="create-start" name="start_datetime" placeholder="Hora de Inicio" readonly>
                        </div>
                        <div class="form-group">
                            <label for="create-end">Hora de Fin:</label>
                            <input type="text" class="form-control" id="create-end" name="end_datetime" placeholder="Hora de Fin" readonly>
                        </div>
                        <div class="form-group">
                            <label for="create-title">Nombre del Evento:</label>
                            <input type="text" class="form-control" id="create-title" name="title" placeholder="Nombre del Evento" required>
                        </div>
                        <div class="form-group">
                            <label for="create-type">Tipo de Evento:</label>
                            <select class="form-control" id="create-type" name="event_type_id">
                                @foreach ($event_types as $type)
                                    <option value="{{$type->id}}">{{$type->name}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="d-flex justify-content-end">
                            <button type="submit" class="btn btn-primary">Guardar</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" >Editar Evento</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="edit-form">
                        @csrf
                        <input type="hidden" id="edit-eventId">
                        <div class="form-group">
                            <label for="edit-start">Hora de Inicio:</label>
                            <input type="text" class="form-control" id="edit-start" name="start_datetime" placeholder="Hora de Inicio" readonly>
                        </div>
                        <div class="form-group">
                            <label for="edit-end">Hora de Fin:</label>
                            <input type="text" class="form-control" id="edit-end" name="end_datetime" placeholder="Hora de Fin" readonly>
                        </div>
                        <div class="form-group">
                            <label for="edit-title">Nombre del Evento:</label>
                            <input type="text" class="form-control" id="edit-title" name="title" placeholder="Nombre del Evento" required>
                        </div>
                        <div class="form-group">
                            <label for="edit-type">Tipo de Evento:</label>
                            <select class="form-control" id="edit-type" name="event_type_id">
                                @foreach ($event_types as $type)
                                    <option value="{{$type->id}}">{{$type->name}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="d-flex justify-content-end">
                            <button id="edit-btn" type="submit" class="btn btn-success"><i class="fa fa-edit"></i>Editar</button>
                            <button id="delete-btn" type="submit" class="btn btn-danger ml-3"><i class="fa fa-trash"></i>Borrar</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@stop

@include('layouts.footer')

@section('js')
    <script src='https://cdn.jsdelivr.net/npm/fullcalendar@6.1.8/index.global.min.js'></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            
            let calendarEvents = [
                @foreach ($events as $event)
                {
                    title: "{{ $event->title }}",
                    start: "{{ $event->start_datetime }}",
                    end: "{{ $event->end_datetime }}",
                    backgroundColor: "{{ $event->eventType->backgroundColor }}",
                    borderColor: "{{ $event->eventType->borderColor }}",
                    textColor: "{{ $event->eventType->textColor }}",
                    eventTypeId: "{{ $event->eventType->id }}",
                    extendedProps: {
                        eventId: "{{ $event->id }}",
                    }
                },
                @endforeach
            ];
            
            let calendarEl = document.getElementById('calendar');

            let calendar = new FullCalendar.Calendar(calendarEl, {
                lang: 'es',
                locale: 'es',
                height: "auto",
                initialView: 'timeGridWeek',
                hiddenDays: [0, 6],
                allDaySlot: false,
                slotDuration: '00:30:00',
                slotMinTime: '07:00:00', 
                slotMaxTime: '21:30:00', 
                slotLabelInterval: '00:30:00',
                headerToolbar:{
                    left: "prev,next today",
                    center: "title",
                    right: "dayGridMonth,timeGridWeek,timeGridDay"
                },
                slotLabelFormat: {
                    hour: '2-digit',
                    minute: '2-digit',
                    omitZeroMinute: false
                },
                events: calendarEvents,
                dateClick: function(e) {
                    const startDate = new Date(e.date);
                    const endDate = new Date(e.date);
                    endDate.setMinutes(endDate.getMinutes() + 30);

                    $('#create-start').val(formatDate(startDate));
                    $('#create-end').val(formatDate(endDate));
                    $('#createModal').modal('show');
                },

                eventClick: function(e) {
                    const title = e.event.title
                    const startDate = new Date(e.event.start);
                    const endDate = new Date(e.event.end);

                    $('#edit-start').val(formatDate(startDate));
                    $('#edit-end').val(formatDate(endDate));
                    $('#edit-type').val(e.event.extendedProps.eventTypeId);
                    $('#edit-title').val(title);
                    $('#edit-eventId').val(e.event.extendedProps.eventId);
                    $('#editModal').modal('show');
                }
            });

            calendar.render();

            $('#edit-btn').on('click', function(e) {
                e.preventDefault(); 
            
                const formData = {
                    id: $('#edit-eventId').val(),
                    title:  $('#edit-title').val(),
                    event_type_id: $('#edit-type').val()
                };

                $.ajax({
                    type: 'PUT', 
                    url: "{{ route('event.update') }}", 
                    data: formData,
                    success: function(response) {
                        location.reload();
                    },
                    error: function(error) {
                        console.error('Error:', error);
                    }
                });
            });

            $('#delete-btn').on('click', function(e) {
                e.preventDefault(); 
            
                const eventId = $('#edit-eventId').val()

                $.ajax({
                    type: 'DELETE', 
                    url: "{{ route('event.delete') }}", 
                    data: {id: eventId},
                    success: function(response) {
                        location.reload();
                    },
                    error: function(error) {
                        console.error('Error:', error);
                    }
                });
            });
        });

        function formatDate(date) {
            const year = date.getFullYear();
            const month = String(date.getMonth() + 1).padStart(2, '0');
            const day = String(date.getDate()).padStart(2, '0');
            const hours = String(date.getHours()).padStart(2, '0');
            const minutes = String(date.getMinutes()).padStart(2, '0');

            return `${year}/${month}/${day} ${hours}:${minutes}`;
        }
    </script>
@stop
