    <script src='https://cdn.jsdelivr.net/npm/fullcalendar@6.1.8/index.global.min.js'></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.18.1/moment.min.js"></script>
    <script>

        document.addEventListener('DOMContentLoaded', function() {
            
            let calendarEvents = [
                @foreach ($events as $event)
                {
                    title: "{{ $event->title }}",
                    start: "{{ $event->start_datetime }}",
                    end: "{{ $event->end_datetime }}",
                    backgroundColor: "{{ $event->eventType->backgroundColor }}",
                    borderColor: "{{ $event->eventType->borderColor }}",
                    textColor: "{{ $event->eventType->textColor }}",
                },
                @endforeach
            ];
            
            let calendarEl = document.getElementById('calendar');

            let calendar = new FullCalendar.Calendar(calendarEl, {
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
                    console.log(e)
                    const startDate = moment(e.date);
                    const endDate = moment(e.date).add(30, "minutes")
                    
                    $('#create-start').val(startDate.format('YY/MM/DD  HH:mm'));
                    $('#create-end  ').val(endDate.format('YY/MM/DD  HH:mm'));
                    $('#createModal').modal('show');
                },
                eventClick: function(e) {
                    console.log(e)
                }
            });

            calendar.render();
        });

    </script>
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
                        <label for="create-name">Nombre del Evento:</label>
                        <input type="text" class="form-control" id="create-name" name="title" placeholder="Nombre del Evento" required>
                    </div>
                    <div class="form-group">
                        <label for="create-type">Tipo de Evento:</label>
                        <select class="form-control" id="create-type" name="event_type_id">
                            @foreach ($event_types as $type)
                                <option value="{{$type->id}}">{{$type->name}}</option>
                            @endforeach
                        </select>
                    </div>
                    <button type="submit" class="btn btn-primary">Guardar</button>
                </form>
            </div>
        </div>
    </div>
</div>

@endsection
@include('layouts.footer')
