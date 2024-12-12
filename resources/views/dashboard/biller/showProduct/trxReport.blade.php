@extends('dashboard.app')
@section('activeMenu')
@php
    $activeMenu="";
@endphp
@endsection
@section('pageheading')
<meta name="csrf-token" content="{{ csrf_token() }}">
<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">Dashboard</h1>
    <a href="#" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i
            class="fas fa-download fa-sm text-white-50"></i> Generate Report</a>
</div>
@endsection

@section('content')
<div class="row">
    <div class="col-lg-6">
        <table id="myTable" class="display">
            <thead>
                <tr>
                    <th>Column 1</th>
                    <th>Column 2</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>Row 1 Data 1</td>
                    <td>Row 1 Data 2</td>
                </tr>
                <tr>
                    <td>Row 2 Data 1</td>
                    <td>Row 2 Data 2</td>
                </tr>
            </tbody>
        </table>
    </div>
</div>
@endsection
@section('customLink')
<link href="vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">
@endsection
@section('customScript')    
     <!-- Page level plugins -->
     {{-- <script src="{{url('admin/vendor/chart.js/Chart.min.js')}}"></script>

     <!-- Page level custom scripts -->
     <script src="{{url('admin/js/demo/chart-area-demo.js')}}"></script>
     <script src="{{url('admin/js/demo/chart-pie-demo.js')}}"></script> --}}
     <script src="vendor/datatables/jquery.dataTables.min.js"></script>
     <script src="vendor/datatables/dataTables.bootstrap4.min.js"></script>
     <script src="js/demo/datatables-demo.js"></script>
@endsection