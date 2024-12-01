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

@section('content')
<div class="row">
    <div class="col-lg-6">
        <!-- Color System -->
        <div class="row">
            <div class="col-lg-3 mb-4">
                <a class="btn btn-success btn-sm card bg-success text-white text-left shadow" href="#">
                <!-- <div class="card bg-success text-white shadow"> -->
                    <div class="card-body">
                        Success
                        <div class="text-white-50 small">#1cc88a</div>
                    </div>
                <!-- </div> -->
                </a>
            </div>
        @foreach ($dataProducts as $item)
            <div class="col-lg-3 mb-4">
                {{-- <div class="card bg-dark text-white shadow"> --}}
                    {{-- <a class="btn btn-success btn-sm card bg-success text-white text-left shadow" href="{{ route('pulsa') }}">{{$item['productName']}}                    
                    <div class="card-body">
                        Rp.{{$item['productPrice']}}
                        <div class="text-white-50 small">{{$idCustomer}}</div>
                    </div>
                    </a>     --}}

                    <form action="{{route('inquiry')}}" method="post">
                        @csrf
                        <input type="text" name="productCode" value="{{$item['productCode']}}" hidden>
                        <input type="text" name="idCustomer" value="{{$idCustomer}}" hidden>
                        <button class="btnprn btn btn-success  btn-lg btn-block" type="submit" value="submit">{{$item['productName']}}
                            Rp.{{$item['productPrice']}}
                        </button>
                    </form>
                {{-- </div> --}}
            </div>
        @endforeach
        </div>
    </div>
</div>
@endsection

@section('customScript')
     <!-- Page level plugins -->
     <script src="{{url('admin/vendor/chart.js/Chart.min.js')}}"></script>

     <!-- Page level custom scripts -->
     <script src="{{url('admin/js/demo/chart-area-demo.js')}}"></script>
     <script src="{{url('admin/js/demo/chart-pie-demo.js')}}"></script>
@endsection