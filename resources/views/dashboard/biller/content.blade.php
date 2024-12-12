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
                        <div id="dataTable_wrapper" class="dataTables_wrapper dt-bootstrap4"><div class="row"><div class="col-sm-12 col-md-6"><div class="dataTables_length" id="dataTable_length"><label>Show <select name="dataTable_length" aria-controls="dataTable" class="custom-select custom-select-sm form-control form-control-sm"><option value="10">10</option><option value="25">25</option><option value="50">50</option><option value="100">100</option></select> entries</label></div></div><div class="col-sm-12 col-md-6"><div id="dataTable_filter" class="dataTables_filter"><label>Search:<input type="search" class="form-control form-control-sm" placeholder="" aria-controls="dataTable"></label></div></div></div><div class="row"><div class="col-sm-12"><table class="table table-bordered dataTable" id="dataTable" width="100%" cellspacing="0" role="grid" aria-describedby="dataTable_info" style="width: 100%;">
                            <thead>
                                <tr role="row"><th class="sorting sorting_asc" tabindex="0" aria-controls="dataTable" rowspan="1" colspan="1" aria-sort="ascending" aria-label="Name: activate to sort column descending" style="width: 168.266px;">Name</th><th class="sorting" tabindex="0" aria-controls="dataTable" rowspan="1" colspan="1" aria-label="Position: activate to sort column ascending" style="width: 275.719px;">Position</th><th class="sorting" tabindex="0" aria-controls="dataTable" rowspan="1" colspan="1" aria-label="Office: activate to sort column ascending" style="width: 119.93px;">Office</th><th class="sorting" tabindex="0" aria-controls="dataTable" rowspan="1" colspan="1" aria-label="Age: activate to sort column ascending" style="width: 53.6797px;">Age</th><th class="sorting" tabindex="0" aria-controls="dataTable" rowspan="1" colspan="1" aria-label="Start date: activate to sort column ascending" style="width: 113.195px;">Start date</th><th class="sorting" tabindex="0" aria-controls="dataTable" rowspan="1" colspan="1" aria-label="Salary: activate to sort column ascending" style="width: 101.211px;">Salary</th></tr>
                            </thead>
                            <tfoot>
                                <tr><th rowspan="1" colspan="1">Name</th><th rowspan="1" colspan="1">Position</th><th rowspan="1" colspan="1">Office</th><th rowspan="1" colspan="1">Age</th><th rowspan="1" colspan="1">Start date</th><th rowspan="1" colspan="1">Salary</th></tr>
                            </tfoot>
                            <tbody>
                            <tr class="odd">
                                    <td class="sorting_1">Airi Satou</td>
                                    <td>Accountant</td>
                                    <td>Tokyo</td>
                                    <td>33</td>
                                    <td>2008/11/28</td>
                                    <td>$162,700</td>
                                </tr><tr class="even">
                                    <td class="sorting_1">Angelica Ramos</td>
                                    <td>Chief Executive Officer (CEO)</td>
                                    <td>London</td>
                                    <td>47</td>
                                    <td>2009/10/09</td>
                                    <td>$1,200,000</td>
                                </tr><tr class="odd">
                                    <td class="sorting_1">Ashton Cox</td>
                                    <td>Junior Technical Author</td>
                                    <td>San Francisco</td>
                                    <td>66</td>
                                    <td>2009/01/12</td>
                                    <td>$86,000</td>
                                </tr><tr class="even">
                                    <td class="sorting_1">Bradley Greer</td>
                                    <td>Software Engineer</td>
                                    <td>London</td>
                                    <td>41</td>
                                    <td>2012/10/13</td>
                                    <td>$132,000</td>
                                </tr><tr class="odd">
                                    <td class="sorting_1">Brenden Wagner</td>
                                    <td>Software Engineer</td>
                                    <td>San Francisco</td>
                                    <td>28</td>
                                    <td>2011/06/07</td>
                                    <td>$206,850</td>
                                </tr><tr class="even">
                                    <td class="sorting_1">Brielle Williamson</td>
                                    <td>Integration Specialist</td>
                                    <td>New York</td>
                                    <td>61</td>
                                    <td>2012/12/02</td>
                                    <td>$372,000</td>
                                </tr><tr class="odd">
                                    <td class="sorting_1">Bruno Nash</td>
                                    <td>Software Engineer</td>
                                    <td>London</td>
                                    <td>38</td>
                                    <td>2011/05/03</td>
                                    <td>$163,500</td>
                                </tr><tr class="even">
                                    <td class="sorting_1">Caesar Vance</td>
                                    <td>Pre-Sales Support</td>
                                    <td>New York</td>
                                    <td>21</td>
                                    <td>2011/12/12</td>
                                    <td>$106,450</td>
                                </tr><tr class="odd">
                                    <td class="sorting_1">Cara Stevens</td>
                                    <td>Sales Assistant</td>
                                    <td>New York</td>
                                    <td>46</td>
                                    <td>2011/12/06</td>
                                    <td>$145,600</td>
                                </tr><tr class="even">
                                    <td class="sorting_1">Cedric Kelly</td>
                                    <td>Senior Javascript Developer</td>
                                    <td>Edinburgh</td>
                                    <td>22</td>
                                    <td>2012/03/29</td>
                                    <td>$433,060</td>
                                </tr></tbody>
                        </table></div></div><div class="row"><div class="col-sm-12 col-md-5"><div class="dataTables_info" id="dataTable_info" role="status" aria-live="polite">Showing 1 to 10 of 57 entries</div></div><div class="col-sm-12 col-md-7"><div class="dataTables_paginate paging_simple_numbers" id="dataTable_paginate"><ul class="pagination"><li class="paginate_button page-item previous disabled" id="dataTable_previous"><a href="#" aria-controls="dataTable" data-dt-idx="0" tabindex="0" class="page-link">Previous</a></li><li class="paginate_button page-item active"><a href="#" aria-controls="dataTable" data-dt-idx="1" tabindex="0" class="page-link">1</a></li><li class="paginate_button page-item "><a href="#" aria-controls="dataTable" data-dt-idx="2" tabindex="0" class="page-link">2</a></li><li class="paginate_button page-item "><a href="#" aria-controls="dataTable" data-dt-idx="3" tabindex="0" class="page-link">3</a></li><li class="paginate_button page-item "><a href="#" aria-controls="dataTable" data-dt-idx="4" tabindex="0" class="page-link">4</a></li><li class="paginate_button page-item "><a href="#" aria-controls="dataTable" data-dt-idx="5" tabindex="0" class="page-link">5</a></li><li class="paginate_button page-item "><a href="#" aria-controls="dataTable" data-dt-idx="6" tabindex="0" class="page-link">6</a></li><li class="paginate_button page-item next" id="dataTable_next"><a href="#" aria-controls="dataTable" data-dt-idx="7" tabindex="0" class="page-link">Next</a></li></ul></div></div></div></div>
                    </div>
                </div>
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
     <script src="vendor/datatables/jquery.dataTables.min.js"></script>
@endsection