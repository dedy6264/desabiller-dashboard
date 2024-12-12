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
        <div class="card shadow mb-0" >
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Pulsa Telkomsel 20.000</h6>
            </div>
            <div class="card-body" >
                <div class="row">
                    <div class="col-md-12 text-center">
                        <form id="pulsaForm">
                            <label for="nomorTujuan">Nomor Tujuan:</label>
                            <input type="text" id="nomorTujuan" name="nomorTujuan" class="form-control bg-light border-0 small" placeholder="08xx xxxx xxx" autofocus>
                        </form>
                        <div class="row py-4" id="responseContainer">
                            {{-- <div id="responseContainer"> --}}
                                <p class="error-message text-center"  style="color: red;">Masukkan nomor tujuan terlebih dulu.</p>
                            {{-- </div> --}}
                        </div>
                    </div>
                    {{-- <div class="col-md-8">TSTLOCAL2024120600001</div> --}}
                </div>
            </div>
        </div>
    </div>
    <div class="col-lg-6">
       
    </div>
</div>
<!-- Large modal -->
{{-- <button type="button" class="btn btn-primary" data-toggle="modal" data-target=".bd-example-modal-lg">Large modal</button> --}}

<div class="modal fade bd-example-modal-lg" id="modalInq"   tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="false" >
  <div class="modal-dialog modal-lg">
    <div class="modal-content" id="modalDataInq">
        {{-- <div class="card shadow mb-0" >
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Pulsa Telkomsel 20.000</h6>
            </div>
            <div class="card-body" >
                <div class="row">
                    <div class="col-md-4">No Trx.</div>
                    <div class="col-md-8">TSTLOCAL2024120600001</div>
                </div>
                <div class="row">
                    <div class="col-md-4">Tgl Trx.</div>
                    <div class="col-md-8">06-10-2024 11:10</div>
                </div>
                <div class="row">
                    <div class="col-md-4">Customer Id.</div>
                    <div class="col-md-8">082137789378</div>
                </div>
                <div class="row">
                    <div class="col-md-4">Harga.</div>
                    <div class="col-md-8">21.000</div>
                </div>
            </div>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
            <button type="button" class="btn btn-primary">Pembayaran</button>
          </div> --}}
    </div>
  </div>
</div>

<!-- Small modal -->
{{-- <button type="button" class="btn btn-primary" data-toggle="modal" data-target=".bd-example-modal-sm">Small modal</button> --}}

<div class="modal fade bd-example-modal-sm" id="modalTrx" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-sm">
    <div class="modal-content" id="modalDataTrx">
       {{-- <div class="card shadow mb-0" >
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Transaksi Berhasil</h6>
            </div>
            <div class="card-body" >
                <div class="row">
                    <div class="col-md-4">No Trx.</div>
                    <div class="col-md-8">TSTLOCAL2024120600001</div>
                </div>
                <div class="row">
                    <div class="col-md-4">Tgl Trx.</div>
                    <div class="col-md-8">06-10-2024 11:10</div>
                </div>
                <div class="row">
                    <div class="col-md-4">Customer Id.</div>
                    <div class="col-md-8">082137789378</div>
                </div>
                <div class="row">
                    <div class="col-md-4">Harga.</div>
                    <div class="col-md-8">21.000</div>
                </div>
            </div>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
          </div> --}}
    </div>
  </div>
</div>
@endsection
@section('customScript')
<script>
    document.getElementById('nomorTujuan').addEventListener('input', async function () {

        const nomor = this.value.trim();
        const responseContainer = document.getElementById('responseContainer');
    
        // Jika input kurang dari 4 karakter, jangan lakukan request
        if (nomor.length < 5) {
            responseContainer.innerHTML = '<p class="error-message" style="color: red;">Masukkan nomor tujuan lebih dari 3 karakter.</p>';
            return;
        }

        try {
            // Kirim request ke server
            const response = await fetch('/showProductKhusus', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                },
                body: JSON.stringify({ nomorTujuan: nomor })
            });
    
            if (!response.ok) {
                throw new Error('Error fetching data');
            }
    
            const data = await response.json();
            responseContainer.innerHTML = data.map((item, index) => `
            <div class="col-lg-4 mb-2 py-2">
                <form id="formLayanan${index}" class="layananForm">
                    <input type="hidden" name="productCode" value="${item.productCode}" >
                    
                    <button type="submit" class="btn btn-success btn-sm btn-block card bg-success text-white text-left shadow">
                        <div class="card-body">
                            <div class="text-white small">${item.productName}</div>
                            <div class="text-white small">${item.productPrice}</div>
                        </div>    
                    </button>
                </form>
            </div>
                            `).join('');
                            
                            // <input type="hidden" name="subscriberNumber" value="${nomor}" >
            const forms = document.querySelectorAll('.layananForm');
            forms.forEach((form, index) => {
                form.addEventListener('submit',async function (e) {
                    e.preventDefault(); // Mencegah reload halaman
                    
                    // Ambil data dari input hidden
                    const formData = new FormData(form);
                    const productCode = formData.get('productCode');
                    // const subscriberNumber = formData.get('subscriberNumber');
                
                    console.log(`Layanan yang dipilih: ${productCode}, Harga: Rp ${nomor}`);
                
                    // Proses selanjutnya, misalnya panggil API
                    // fetch('/api/submit', { method: 'POST', body: formData });
                    // Kirim data layanan yang dipilih ke API lain
                    try {
                        console.log("masuk");
                        const lanjutResponse = await fetch('/inquiry', {
                            method: 'POST',
                            headers: {
                                'Content-Type': 'application/json',
                                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                            },
                            body: JSON.stringify({
                                productCode: productCode,
                                subscriberNumber: nomor
                            })
                        });
                        if (!lanjutResponse.ok) {
                            throw new Error('Error submitting selected layanan');
                        }
                        
                        const lanjutData = await lanjutResponse.json();
                        // console.log(lanjutData);
                        const modalDataInq = document.getElementById('modalDataInq');
                        modalDataInq.innerHTML=`
                        <div class="card shadow mb-0" >
                            <div class="card-header py-3">
                                <h6 class="m-0 font-weight-bold text-primary">${lanjutData.productName}</h6>
                            </div>
                            <div class="card-body" >
                                <div class="row">
                                    <div class="col-md-4">No Trx.</div>
                                    <div class="col-md-8">${lanjutData.referenceNumber}</div>
                                </div>
                                <div class="row">
                                    <div class="col-md-4">Tgl Trx.</div>
                                    <div class="col-md-8">${lanjutData.createdAt}</div>
                                </div>
                                <div class="row">
                                    <div class="col-md-4">Customer Id.</div>
                                    <div class="col-md-8">${lanjutData.subscriberNumber}</div>
                                </div>
                                <div class="row">
                                    <div class="col-md-4">Harga.</div>
                                    <div class="col-md-8">${lanjutData.productPrice}</div>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <form  class="formPayment">
                                    <input type="hidden" name="referenceNumber" value='${lanjutData.referenceNumber}'>
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal" id="cancelBtn">Cancel</button>
                                    <button type="submit"  class="btn btn-primary" id="payBtn">Pembayaran</button>
                                </form>
                            </div>
                        </div>
                        `
                        const modal = new bootstrap.Modal(document.getElementById('modalInq'), {
                            backdrop: 'static', // Tidak bisa ditutup dengan klik di luar modal
                            keyboard: false,    // Tidak bisa ditutup dengan tombol ESC
                        });
                        modal.show();
                        const formPayment = document.querySelector('.formPayment');
                        if (formPayment){
                            formPayment.addEventListener('submit', async function (e) {
                                e.preventDefault(); // Mencegah reload halaman
                                const payBtn=document.getElementById('payBtn');
                                payBtn.setAttribute('disabled','');
                                const cancelBtn=document.getElementById('cancelBtn');
                                cancelBtn.setAttribute('disabled','');
                                // Ambil data dari input hidden
                                const formDataPayment = new FormData(formPayment);
                                const referenceNumber = formDataPayment.get('referenceNumber');
                                console.log("====", referenceNumber);

                                // Lakukan sesuatu dengan referenceNumber
                                // Contoh: Kirim ke server
                                const response = await fetch('/payment', {
                                    method: 'POST',
                                    headers: {
                                        'Content-Type': 'application/json',
                                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                                    },
                                    body: JSON.stringify({
                                        referenceNumber: referenceNumber
                                    })
                                });
                            
                                if (response.ok) {
                                    const dataResponse = await response.json();
                                    console.log('Payment submitted successfully',dataResponse);
                                    modal.hide();
                                    const modalDataInq = document.getElementById('modalDataTrx');
                                    modalDataInq.innerHTML=`
                                    <div class="card shadow mb-0" >
                                        <div class="card-header py-3">
                                            <h6 class="m-0 font-weight-bold text-primary">Transaksi Berhasil</h6>
                                        </div>
                                        <div class="card-body" >
                                            <div class="row">
                                                <div class="col-md-4">No Trx.</div>
                                                <div class="col-md-8">${dataResponse.referenceNumber}</div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-4">Tgl Trx.</div>
                                                <div class="col-md-8">${dataResponse.createdAt}</div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-4">Customer Id.</div>
                                                <div class="col-md-8">${dataResponse.subscriberNumber}</div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-4">Harga.</div>
                                                <div class="col-md-8">${dataResponse.productPrice}</div>
                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                                <a href="{{route('home')}}"  class="btn btn-secondary" >Close</a>
                                        </div>
                                    </div>
                                    `
                                    const modalTrx = new bootstrap.Modal(document.getElementById('modalTrx'), {
                                        backdrop: 'static', // Tidak bisa ditutup dengan klik di luar modal
                                        keyboard: false,    // Tidak bisa ditutup dengan tombol ESC
                                    });
                                    modalTrx.show();
                                    // window.location.replace("/");
                                } else {
                                    console.error('Failed to submit payment');
                                }
                            });
                        }else {
                            console.error('Form .formPayment tidak ditemukan di DOM');
                        }

                        // $('#ccc').modal('show');
                        // responseContainer.innerHTML = `<p>${lanjutData.message}</p>`;
                    } catch (error) {
                        console.error(error);
                        responseContainer.innerHTML = '<p class="error-message" style="color: red;">Terjadi kesalahan saat melanjutkan proses.</p>';
                    }
                });
            });
        } catch (error) {
            console.error(error);
            responseContainer.innerHTML = '<p class="error-message" style="color: red;">Terjadi kesalahan saat memuat data.</p>';
        }
    });
    </script>
    
     <!-- Page level plugins -->
     {{-- <script src="{{url('admin/vendor/chart.js/Chart.min.js')}}"></script>

     <!-- Page level custom scripts -->
     <script src="{{url('admin/js/demo/chart-area-demo.js')}}"></script>
     <script src="{{url('admin/js/demo/chart-pie-demo.js')}}"></script> --}}
@endsection