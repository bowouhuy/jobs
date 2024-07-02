@extends('mitra.layouts.main')
@section('body')

    <div class="container">
        <div class="row">
            <div class="col-xl-12 col-md-12">
                <div class="card">
                    <div class="card-body">
                        <div class="row">
                            <!-- <div class="col-3"><h4 class="header-title">Pengerjaan</h4></div> -->
                            <div class="col-10">
                                <h1 class="font-size timer"></h1>
                                <span class="card-text text-danger timer-desc mt-0">*Pesanan akan dibatalkan jika tidak mulai dikerjakan dalam waktu 24 jam</span>
                            </div>
                            <div class="col-2 ">
                                <button type="button" class="btn btn-primary btn-kerjakan" data-toggle="modal" data-target="#modalAction">Kerjakan</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-6">
                <div class="card">
                    <div class="card-title p-3 mb-0">
                        <h5 class="card-title">Detail Pemesanan #{{$order->order_id}}</h5>
                    </div>
                    <div class="card-body p-3">
                        <h4 class="header-title">{{$order->jasa->nama}}{{$order->created_at}}</h4>
                        <h5 class="header-title">{{$order->paket->nama}}</h5>
                        <p class="card-text">{{$order->paket->deskripsi}}</p>
                        <p class="card-text">Rp. {{number_format($order->paket->harga)}}</p>
                        <img style="height:400px" class="d-block mx-auto img-fluid" src="{{asset('images/jasa_image/'.$order->paket->jasa->jasaimages[0]->url)}}" alt="{{$order->paket->jasa->jasaimages[0]->filename}}">
                    </div>
                </div>
            </div>
            <div class="col-6">
                <div class="card">
                    <div class="card-title p-3 mb-0">
                        <h5 class="card-title">Riwayat Pesanan</h5>
                    </div>
                    <div class="card-body p-3">
                        <table class="table">
                            <tbody>
                                @foreach($mergeHistory as $history)
                                    <tr>
                                        <td>{{$history['date']}}</td>
                                        <td>{{$history['status']}}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    // modal confirmation when click kerjakan button
    <div class="modal fade" id="modalAction" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Konfirmasi Kerjakan Pesanan</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    Ketika anda menekan tombol kerjakan, maka pesanan akan dianggap sudah mulai dikerjakan oleh anda. Apakah anda yakin?
                </div>
                <div class="modal-footer">
                    <form action="{{url('mitra/order/kerjakan')}}" method="post">
                        <input type="hidden" name="id" value="{{$order->id}}">
                    @csrf
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Kerjakan</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
                

    <script src="{{ asset('admin_template/assets/js/jquery.min.js') }}"></script>
    <script src="{{ asset('admin_template/assets/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('admin_template/assets/plugins/datatables/jquery.dataTables.min.js')}}"></script>
    <script src="{{ asset('admin_template/assets/plugins/datatables/dataTables.bootstrap4.min.js')}}"></script>
    <script src="{{ asset('user_template/assets/plugins/sweet-alert2/sweetalert2.min.js')}} "></script>
    <script src="{{ asset('user_template/assets/pages/sweet-alert.init.js')}} "></script>
    <script>
        $(document).ready(function() {
            var orderStatus = "{{$order->status}}";
            var orderDatetime = "{{$order->created_at}}";
            var deadlineWorkDays = "{{$order->paket->estimasi}}"
            var dateStartWorks = "{{$dates['start_works']}}";

            if(orderStatus == 2) {
                countDown(1, orderDatetime);
            }else if(orderStatus == 3) {
                countDown(deadlineWorkDays, dateStartWorks);
                document.querySelector('.btn-kerjakan').style.display = "none";
                document.querySelector('.timer-desc').innerHTML = "*Pesanan akan selesai dalam waktu " + deadlineWorkDays + " hari";
            }else {
                document.querySelector('.timer').innerHTML = "Pesanan telah selesai";
                document.querySelector('.timer-desc').innerHTML = "";
                document.querySelector('.btn-kerjakan').style.display = "none";
            }
        });
        // add timer since created at in hh:mm:ss realtime to div class timer
        function countDown(distance, targetDate) {
            var targetTime = new Date(targetDate).getTime();
            var now = new Date().getTime();
            var countDownDate = targetTime + (distance * 24 * 60 * 60 * 1000);

            var x = setInterval(function() {
                now = new Date().getTime();
                var remainingTime = countDownDate - now;

                if (remainingTime < 0) {
                    clearInterval(x);
                    document.querySelector('.timer').innerHTML = "Countdown finished";
                    return;
                }

                var days = Math.floor(remainingTime / (1000 * 60 * 60 * 24));
                var hours = Math.floor((remainingTime % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
                var minutes = Math.floor((remainingTime % (1000 * 60 * 60)) / (1000 * 60));
                var seconds = Math.floor((remainingTime % (1000 * 60)) / 1000);

                // Format hours, minutes, and seconds to always have two digits
                hours = String(hours).padStart(2, '0');
                minutes = String(minutes).padStart(2, '0');
                seconds = String(seconds).padStart(2, '0');

                document.querySelector('.timer').innerHTML = days + " Day(s) " + hours + ":" + minutes + ":" + seconds;
            }, 1000);
        }

        // Usage example:
        // var duration = 1 ; // day(s)
        // var targetDate = "2024-07-02T00:00:00"; // Example target date and time
        // countDown(duration, targetDate);
   
    </script>

@endsection
