@extends('adminlte::page')
@section('title', 'Inicio')
@section('content')
    <script src='https://cdn.jsdelivr.net/npm/fullcalendar@6.1.8/index.global.min.js'></script>
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
                    textColor: "{{ $event->eventType->textColor }}"
                },
                @endforeach
            ];
            
            let calendarEl = document.getElementById('calendar');

            let calendar = new FullCalendar.Calendar(calendarEl, {
                locale: 'es',
                initialView: 'timeGridWeek',
                hiddenDays: [0, 6],
                allDaySlot: false,
                slotDuration: '00:30:00',
                slotMinTime: '07:00:00', 
                slotMaxTime: '20:00:00',
                slotLabelInterval: '00:30:00',
                headerToolbar:{
                    left: "prev,next today",
                    center: "title",
                    right: "dayGridMonth,timeGridWeek,timeGridDay"
                },
                slotLabelFormat: {
                    hour: '2-digit',
                    minute: '2-digit',
                    omitZeroMinute: false,
                    meridiem: 'narrow'
                },
                events: calendarEvents,
                dateClick: function(e) {
                    console.log(e)
                }
            });

            calendar.render();
        });

    </script>
    <div id='calendar' style=""></div>
@endsection
@section('footer')
    @include('layouts.footer')
@endsection
