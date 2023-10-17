<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>
        <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.3/css/bootstrap.min.css" />
    <!-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.1/css/bootstrap-grid.min.css" integrity="sha512-2cWcZ9cbPMZFm2inlFOhwsBVbNMmNxKBtVXqL8OY9tXCZahhnIfXMxPCzpKqiHF2I2mOiNHNXEDUDglwd+4uYw==" crossorigin="anonymous" referrerpolicy="no-referrer" /> -->

    <link href="https://cdn.datatables.net/1.10.16/css/jquery.dataTables.min.css" rel="stylesheet">
    <link href="https://cdn.datatables.net/1.10.19/css/dataTables.bootstrap4.min.css" rel="stylesheet">
    <link rel='stylesheet' href='https://cdn.jsdelivr.net/npm/sweetalert2@10.10.1/dist/sweetalert2.min.css'>

                
        <!-- Styles -->
        <!-- <link rel="stylesheet" href="{{asset('bootstrap.min.css')}}"> -->
        <!-- <link rel="stylesheet" href="//cdn.datatables.net/1.13.4/css/jquery.dataTables.min.css"> -->
        <!-- <link rel="stylesheet" href="https://cdn.datatables.net/1.13.4/css/dataTables.bootstrap4.min.css"> -->
        
        
        <!-- Fonts -->
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.css" integrity="sha512-Z0kTB03S7BU+JFU0nw9mjSBcRnZm2Bvm0tzOX9/OuOuz01XQfOpa0w/N9u6Jf2f1OAdegdIPWZ9nIZZ+keEvBw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
        <!-- <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" /> -->


        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])

        <style>
            .dropdown-menu {
            max-height: 150px;
            overflow-y: auto;
            }
        </style>
    </head>
    <body class="font-sans antialiased">
        <div class="min-h-screen bg-gray-100">
            @include('layouts.navigation')

            <!-- Page Heading -->
            @if (isset($header))
                <header class="bg-white shadow">
                    <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                        {{ $header }}
                    </div>
                </header>
            @endif

            <!-- Page Content -->
            <main>
                {{ $slot }}
            </main>
        </div>
    </body>
</html>


<!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.0/jquery.min.js" integrity="sha512-3gJwYpMe3QewGELv8k/BX9vcqhryRdzRMxVfq6ngyWXwo03GFEzjsUm8Q7RZcHPHksttq7/GFoxjCVUjkjvPdw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script src="//cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.13.4/js/dataTables.bootstrap5.min.js"></script>
<script src="{{asset('bootstrap.min.js')}}"></script> -->

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script>  
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.0/jquery.validate.js"></script>
    <script src="https://cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.19/js/dataTables.bootstrap4.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10.16.6/dist/sweetalert2.all.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-3-typeahead/4.0.2/bootstrap3-typeahead.min.js"></script>

    


<script  type="text/javascript">
var table_alltasks = $('#datatable-tasks').DataTable({
stateSave: true,
processing: true,
serverSide: true,
ajax: {
   url: "/dashboard",
   data: function (d) {
     d.status = $('#status').val()
     d.site = $('#site').val()
     d.startdate = $('#startdate').val()
     d.enddate = $('#enddate').val()
     d.type = $('#type').val()
    }
   },
columns: [
{data: 'DT_RowIndex', name: '', orderable: false, searchable: false},
{ data: 'site', name: 'site' },
{ data: 'equipment_tag', name: 'equipment_tag' },
{ data: 'equipment_desc', name: 'equipment_desc' },
{ data: 'task_desc', name: 'task_desc' },
{ data: 'due_date', name: 'due_date' },
{ data: 'job_type', name: 'job_type' },
{ data: 'status', name: 'status' },
{ data: 'assignment', name: 'assignment' },
],
order: [[0, 'desc']]
});

var table_issued_tasks = $('#issued-tasks').DataTable({
stateSave: true,
processing: true,
serverSide: true,
ajax: {
   url: "/task/issued",
   data: function (d) {
     d.status = $('#status').val()
     d.site = $('#site').val()
     d.startdate = $('#startdate').val()
     d.enddate = $('#enddate').val()
     d.type = $('#type').val()
    }
   },
columns: [
{data: 'DT_RowIndex', name: '', orderable: false, searchable: false},
{ data: 'site', name: 'site' },
{ data: 'equipment_tag', name: 'equipment_tag' },
{ data: 'equipment_desc', name: 'equipment_desc' },
{ data: 'execution_dep', name: 'execution_dep' },
{ data: 'task_desc', name: 'task_desc' },
{ data: 'due_date', name: 'due_date' },
{ data: 'job_type', name: 'job_type' },
{ data: 'status', name: 'status' },
],
order: [[0, 'desc']]
});

var path = "{{route('autocomplete')}}" ;
$('#search_tag').typeahead({
    items: 9999,
    source:function(query,process) {
        return $.get(path , {
            location : $('#select').val(),
            term : query
        }, function (data) {
            return process(data);
        });
    }
});

$('#search_tag').change(function(e){
e.preventDefault();
$.ajax({
headers:{
'x-csrf-token':$('meta[name="csrf-token"]').attr('content')
},
url  : "/task/description" ,
type : "POST" , 
data : {tag:document.getElementById("search_tag").value} , 		
success : function(response) {
	document.getElementById("desc").value = response.description ;
} 
});
});


var table_equip_status = $('#datatable-status').DataTable({
stateSave: true,
processing: true,
serverSide: true,
ajax:{
url:'{{Route::currentRouteName()}}',
},
columns: [
{data: 'DT_RowIndex', name: '', orderable: false, searchable: false},
{ data: 'equip_tag', name: 'equip_tag' },
{ data: 'date', name: 'date',width:'100' },
{ data: 'status', name: 'status' },
{ data: 'remarks', name: 'remarks' },
],
order: [[0, 'desc']]
}); 


$('#startdate').change(function(){   
    table_alltasks.draw();
    table_issued_tasks.draw();
});
$('#enddate').change(function(){  
    table_alltasks.draw();
    table_issued_tasks.draw();
});
$('#site').change(function(){   
    table_alltasks.draw();
    table_issued_tasks.draw();
});
$('#status').change(function(){   
    table_alltasks.draw();
    table_issued_tasks.draw();
});
$('#type').change(function(){   
    table_alltasks.draw();
    table_issued_tasks.draw();
});




</script>   