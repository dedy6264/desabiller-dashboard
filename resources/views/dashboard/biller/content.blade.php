@extends('dashboard.app')
@section('activeMenu')
@php
    $activeMenu="";
@endphp
@endsection
@section('pageheading')
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Dashboard</h1>
        <a href="#" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i
                class="fas fa-download fa-sm text-white-50"></i> Generate Report</a>
    </div>
@endsection

@section('customLink')
{{-- <link rel="stylesheet" href="https://cdn.datatables.net/2.1.8/css/dataTables.dataTables.css" /> --}}
@endsection

@section('content')
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    @if (Session::get('fail'))
        <div class="alert alert-warning" role="alert">
            {{Session::get('fail')}}
        </div>
    @endif

    <div class="row">
        <div class="col-lg-6">
            <!-- Color System -->
            <div class="row">
                <div class="col-lg-3 mb-4 d-flex justify-content-center align-items-center">
                    <a href="{{route('showProduct')}}" class="btn btn-primary btn-circle "  >
                        <i class="fab fa-facebook-f"></i>
                    </a>
                </div>
            @foreach ($dataRes as $item)
                @if ( $item['id']==1)
                    <div class="col-lg-3 mb-4 d-flex justify-content-center align-items-center">
                        <a href="{{route('showProduct')}}" class="btn btn-primary btn-circle btn-lg"  >
                            <i class="fab fa-facebook-f"></i>
                        </a>
                    </div>
                @else
                    <div class="col-lg-3 mb-4">
                        {{-- <div class="card bg-dark text-white shadow"> --}}
                            <a class="btn btn-success btn-sm card bg-success text-white text-left shadow" href="#" data-dismiss="modal" data-toggle="modal" data-target="#modalPayment{{$item['id']}}">                    
                                <div class="card-body">
                                    {{$item['productCategoryName']}}
                                    <div class="text-white-50 small">{{$item['id']}}</div>
                                </div>
                            </a>    

                            {{-- modal input id --}}
                            <div class="modal fade" id="modalPayment{{$item['id']}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel">Payment</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                    </div>
                                    <div class="modal-body">
                                        <div class="row">
                            
                                        <div class="col-md-12 mb-4">
                                            <form action="{{route('getProducts')}}" method="post">
                                                @csrf
                                                <input type="text" name="idCustomer" value="{{--$pay->id--}}" >
                                                <input type="text" name="categoryId" value="{{$item['id']}}" hidden>
                                                <button class="btnprn btn btn-success  btn-lg btn-block" type="submit" value="submit">{{--$pay->payment_method_name--}}ABCD</button>
                                            </form>
                                        </div>

                                        </div>
                                    </div>
                                </div>
                                </div>
                            </div>
                            {{-- <a class="btn btn-success btn-sm card bg-success text-white text-left shadow" href="{{ route('getProducts') }}"> 
                                <div class="card-body">
                                    {{$item['productCategoryName']}}
                                    <div class="text-white-50 small">{{$item['id']}}</div>
                                </div>
                                </a>    
                                
                                {{-- </div> --}}
                    </div>
                @endif
            @endforeach
            </div>
        </div>
        <div class="col-lg-6">
            <div class="card shadow mb-0" >
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Transaksi Report</h6>
                </div>
                <div class="card-body" >
                    <div class="table-responsive">
                        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                            <thead>
                                <tr>
                                    <th>Name</th>
                                    <th>Position</th>
                                    <th>Office</th>
                                    <th>Age</th>
                                    {{-- <th>Start date</th>
                                    <th>Salary</th> --}}
                                </tr>
                            </thead>
                            {{-- <tfoot>
                                <tr>
                                    <th>Name</th>
                                    <th>Position</th>
                                    <th>Office</th>
                                    <th>Age</th>
                                    <th>Start date</th>
                                    <th>Salary</th>
                                </tr>
                            </tfoot> --}}
                            <tbody>
                                {{-- <tr>
                                    <td>Donna Snider</td>
                                    <td>Customer Support</td>
                                    <td>New York</td>
                                    <td>27</td>
                                    <td>2011/01/25</td>
                                    <td>$112,000</td>
                                </tr> --}}
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('customScript')
    <script>
    $(document).ready(function() {
        var data = [
    {
        "name":       "Tiger Nixon",
        "position":   "System Architect",
        "salary":     "$3,120",
        "start_date": "2011/04/25",
        "office":     "Edinburgh",
        "extn":       "5421"
    },
    {
        "name":       "Garrett Winters",
        "position":   "Director",
        "salary":     "$5,300",
        "start_date": "2011/07/25",
        "office":     "Edinburgh",
        "extn":       "8422"
    }
]
    $('#dataTable').DataTable({
        data:data,
        columns: [
        { data: 'name' },
        { data: 'position' },
        { data: 'salary' },
        { data: 'office' }
    ]
    });
    });    
    </script>
     <!-- Page level plugins -->
     {{-- <script src="{{url('admin/vendor/chart.js/Chart.min.js')}}"></script> --}}

     <!-- Page level custom scripts -->
     {{-- <script src="{{url('admin/js/demo/chart-area-demo.js')}}"></script>
     <script src="{{url('admin/js/demo/chart-pie-demo.js')}}"></script> --}}
     <script src="{{url('admin/vendor/datatables/jquery.dataTables.min.js')}}"></script>
    <script src="{{url('vendor/datatables/dataTables.bootstrap4.min.js')}}"></script>
    {{-- <script src="{{url('admin/js/demo/datatables-demo.js')}}"></script> --}}

@endsection