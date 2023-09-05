@extends('adminlte::page')

@section('title', 'Tipo de Eventos')

@section('content')

   
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
            
        })
    </script>
@stop
