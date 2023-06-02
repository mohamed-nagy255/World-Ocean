@extends('back-end.layouts.app')
@section('title', 'المدن')
@section('css')
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.4/css/jquery.dataTables.min.css">
    <style>
        nav {
            display: flex;
            justify-content: space-between;
        }

        table {
            padding: 20px;
        }
    </style>
@endsection
@section('content')
    <main id="main" class="main">

        <div class="pagetitle">
            <h1>المدن</h1>
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="/dashboard">الرئيسية</a></li>
                    <li class="breadcrumb-item active">المدن</li>
                </ol>

                <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">
                    اضافة مدينة
                </button>
            </nav>
        </div><!-- End Page Title -->
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        @if (session()->has('add'))
            <div class="alert alert-success alert-dismissible fade show" rol="alert">
                <strong>{{ session()->get('add') }}</strong>
            </div>
        @endif
        @if (session()->has('edit'))
            <div class="alert alert-success alert-dismissible fade show" rol="alert">
                <strong>{{ session()->get('edit') }}</strong>
            </div>
        @endif
        @if (session()->has('del'))
            <div class="alert alert-danger alert-dismissible fade show" rol="alert">
                <strong>{{ session()->get('del') }}</strong>
            </div>
        @endif
        <section class="section">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">جدول المدن</h5>
                            <!-- Table with stripped rows -->
                            <table id='table' class="table datatable">
                                <thead>
                                    <tr>
                                        <th scope="col">#</th>
                                        <th scope="col">اسم المدينة</th>
                                        <th scope="col">الصورة</th>
                                        <th scope="col">التحكم</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @php($i = 0)
                                    @foreach ($countries as $country)
                                        <tr>
                                            <th scope="row">{{ ++$i }}</th>
                                            <td>{{ $country->name }}</td>
                                            <td>
                                                <img src="{{ URL('assets/front-end/images/countries', $country->image) }}"
                                                    style="width: 100px; height: 100px;">
                                            </td>
                                            <td>
                                                <button type="button" class="btn btn-primary" 
                                                data-bs-toggle="modal" data-bs-target="#update"
                                                data-id="{{ $country -> id }}"
                                                data-name="{{ $country -> name }}"
                                                data-image="{{ $country -> image }}">
                                                    تعديل 
                                                </button>
                                                <br>
                                                <br>
                                                <button type="button" class="btn btn-danger" 
                                                data-bs-toggle="modal" data-bs-target="#delete"
                                                data-id="{{ $country -> id }}"
                                                data-name="{{ $country -> name }}">
                                                    حذف 
                                                </button>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                            <!-- End Table with stripped rows -->
                        </div>
                    </div>
                </div>
            </div>
        </section>
        @include('back-end.countries.addModel')
        @include('back-end.countries.editModel')
        @include('back-end.countries.deleteModel')
    </main><!-- End #main -->
@endsection
@section('js')
    {{-- data table  --}}
    <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
    <script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>
    <script>
        $(document).ready(function() {
            $('#table').DataTable();
        });
    </script>

    {{-- update model & delete --}}
    <script>
        $('#update').on('show.bs.modal', function(event) {
            var button = $(event.relatedTarget)
            var id = button.data('id')
            var name = button.data('name')
            var image = button.data('image')
            var modal = $(this)
            modal.find('.modal-body #id').val(id);
            modal.find('.modal-body #name').val(name);
            modal.find('.modal-body #image').val(image);
        })

        $('#delete').on('show.bs.modal', function(event) {
            var button = $(event.relatedTarget)
            var id = button.data('id')
            var name = button.data('name')
            var modal = $(this)
            modal.find('.modal-body #id').val(id);
            modal.find('.modal-body #name').val(name);
        })
    </script>
@endsection
