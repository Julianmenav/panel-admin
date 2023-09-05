@extends('adminlte::page')
@section('title', 'Inicio')
@section('content')
    <script src='https://cdn.jsdelivr.net/npm/fullcalendar@6.1.8/index.global.min.js'></script>
    <script>

        document.addEventListener('DOMContentLoaded', function() {
        let calendarEl = document.getElementById('calendar');
        let calendar = new FullCalendar.Calendar(calendarEl, {
            locale: 'es',
            initialView: 'timeGridWeek',
            hiddenDays: [0, 6],
            allDaySlot: false,
            slotDuration: '00:30:00',
            slotMinTime: '07:00:00', 
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
            events: [{
              title: "prueba",
              start: "2023-09-06 10:00:00",  
              end: "2023-09-06 12:00:00",
              backgroundColor: "#9EFF49"  ,
              borderColor: "#77005F",
              textColor: "#FF0000"
            }],
            dateClick: function(e) {
                console.log(e)
            }
        });
        calendar.render();
        });

    </script>
    <div id='calendar' style="padding: 20px"></div>
@endsection
@section('footer')
    @include('layouts.footer')
@endsection
