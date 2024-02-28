@extends('app')
@section('content')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/datatables/1.10.21/css/dataTables.bootstrap.min.css" integrity="sha512-BMbq2It2D3J17/C7aRklzOODG1IQ3+MHw3ifzBHMBwGO/0yUqYmsStgBjI0z5EYlaDEFnvYV7gNYdD3vFLRKsA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js" integrity="sha512-v2CJ7UaYy4JwqLDIrZUI/4hqeoQieOmAZNXBeQyjo21dadnwR+8ZaIJVT8EE2iyI61OV8e6M8PP2/4hpQINQ/g==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/datatables/1.10.21/js/jquery.dataTables.min.js" integrity="sha512-BkpSL20WETFylMrcirBahHfSnY++H2O1W+UnEEO4yNIl+jI2+zowyoGJpbtk6bx97fBXf++WJHSSK2MV4ghPcg==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    
{{-- @inject('_searchFilter', 'App\Http\Controllers\Panel\SearchFiltersController') --}}


<div class="d-flex bd-highlight p-auto">

    <div class="pt-2 bd-highlight">
        <div class="select2-control-clear" style="width: 70px;">
            <select class="form-control control-clear" id="pageLenght">
                <option value="10">10</option>
                <option value="25">25</option>
                <option value="50">50</option>
                <option value="100">100</option>
            </select>
        </div>
    </div>
    <div class="p-2 bd-highlight">
        <div class="input-icon" style="width: 180px;">
            <input type="text" id="buscar" class="form-control control-clear w300" placeholder="BUSCAR '...' "
                data-identifier="global-search">
        </div>
    </div>

        <div class="pt-2 bd-highlight ms-2" style="width: 225px;">
            <input type="text" id="buscar" class="form-control control-clear w300" placeholder="Buscar por Nick" data-identifier="global-search">
        </div>
        <div class="pt-2 bd-highlight ms-2" style="width: 225px;">
            <input type="text" id="buscar" class="form-control control-clear w300" placeholder="Buscar por Nombre" data-identifier="global-search">
        </div>
        <div class="pt-2 bd-highlight ms-2" style="width: 225px;">
            <input type="text" id="buscar" class="form-control control-clear w300" placeholder="Buscar por Email" data-identifier="global-search">
        </div>
        <div class="pt-2 bd-highlight ms-2" style="width: 225px;">
                     <input type="text" id="buscar" class="form-control control-clear w300" placeholder="Buscar por Rol" data-identifier="global-search">   
        </div>
    </div>


    {{-- DATATABLE USERS --}}
    <div class="col-8 m-auto">
        <div class="card">
            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table table-bordered main-datatable mb-0" id="datatableAll">
                        <thead>
                            <th><input type="checkbox" class="select-all as-checkbox"></th>
                            <th>NICK</th>
                            <th>NOMBRE</th>
                            <th>EMAIL</th>
                            <th>VERIFICADO</th>
                            <th>ROL ACTIVO</th>
                        </thead>
                        <tbody id="table_body">
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

    </div>

    <script>
        $(document).ready(function() {
            console.log('traza 1')
            //DataTable
            var datatableAll = $("#datatableAll").DataTable({
                "order": [[1, "desc"]],
                processing: true,
                serverSide: true,
                ajax: {
                    url: "{{ route('admin.datatable') }}",
                },
                colReorder: true,
                    'colReorder': {
                    'allowReorder': false
                },
                searching: true,
                lengthChange: true,
                info: false,
                paging: true,
                dom: 'Brtp',
                columns: [
                    {
                        name: 'id',
                        data: 'id',
                        sortable: false,
                        render: function(data, type, row) {
                            console.log('traza 2')
                            return `<input type="checkbox" name="checkbox[]" value="${data}">`;
                        }
                    },
                    {
                        name: 'nick', // CODIGO DE WOSPER
                        data: 'nick',
                    },
                    {
                        name: 'nombre', 
                        data: 'name',
                    },
                    {
                        name: 'email', 
                        data: 'email',
                    },

                    {
                        name: 'status',
                        data: 'email_verified_at',
                        orderable: false,
                        render: function(data, row, meta) {
                            console.log('traza 3')
                            if(data && data !="") {
                                return `<span class="badge bg-primary rounded-pill">Verificado</span>`;
                            }
                            else{
                                return `<span class="badge bg-warning rounded-pill">Pendiente</span>`;
                            }
                        }
                    },
                    {
                        name: 'id',
                        data: 'id',
                        orderable: false,
                        render: function(data, row, meta) {
                            console.log('traza 4')
                            var editUrl = '{{ URL::route("user.profile", ":id") }}';editUrl = editUrl.replace(':id', row.user_id);
                            let url = "{{ route('user.profile', [':id']) }}";url = url.replace(':id', meta.userid);
                            return `<div class='d-flex gap-1 '>
                                            <button id='eliminar' idEliminar='${data}' class='btn btn-light btn-sm' title =''' > <i class="fa fa-trash" idEliminar='${data}'></i></button>
                                            <button id='editar' idEditar='${data}' class='btn btn-light btn-sm' title ='' ><i class="far fa-edit" idEditar='${data}'></i></button>
                                            <a href="${url}"><button type='button' class='btn btn-light btn-sm'><i class='fas fa-eye'></i></button></a>
                                        </div>`;
                            
                        }
                    }
                ]
            });
            $('#buscar').on('change', function() {
                    dataTable.search($(this).val(), false, true).draw();
            });
        });
    </script>
@endsection