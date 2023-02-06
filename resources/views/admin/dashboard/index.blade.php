@extends('admin.layouts.main')

@section('body')
<div class="row">
    <div class="col-xl-12 col-md-12">
        <div class="row">
            <div class="col-xl-3 col-md-6">
                <div class="card mini-stats">
                    <div class="p-3 mini-stats-content">
                        <div class="mb-4">
                            <div class="float-right text-right">
                                <span class="badge badge-light @if($stats['curr_total_orders'] >= $stats['recent_total_orders']) text-info @else text-danger @endif mt-2 mb-2">
                                    @if($stats['curr_total_orders'] >= $stats['recent_total_orders']) + @else - @endif 
                                    @if($stats['recent_total_orders'])
                                    {{round((float)($stats['curr_total_orders']/$stats['recent_total_orders']) * 100)}} %
                                    @else 
                                    0
                                    @endif
                                </span> 
                                <p class="text-white-50">From previous period</p>
                            </div>
                            
                            <span class="peity-pie" data-peity='{ "fill": ["rgba(255, 255, 255, 0.8)", "rgba(255, 255, 255, 0.2)"]}' data-width="54" data-height="54">{{$stats['curr_total_orders']}}/{{$stats['recent_total_orders']}}</span>
                        </div>
                    </div>
                    <div class="ml-3 mr-3">
                        <div class="bg-white p-3 mini-stats-desc rounded">
                            <h5 class="float-right mt-0">{{$stats['curr_total_orders']}}</h5>
                            <h6 class="mt-0 mb-3">Orders</h6>
                            <p class="text-muted mb-0">Sed ut perspiciatis unde iste</p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-3 col-md-6">
                <div class="card mini-stats">
                    <div class="p-3 mini-stats-content">
                        <div class="mb-4">
                            <div class="float-right text-right">
                                <span class="badge badge-light @if($stats['curr_total_revenue'] >= $stats['recent_total_revenue']) text-info @else text-danger @endif mt-2 mb-2">
                                    @if($stats['curr_total_revenue'] >= $stats['recent_total_revenue']) + @else - @endif 
                                    @if($stats['recent_total_revenue'])
                                    {{round((float)($stats['curr_total_revenue']/$stats['recent_total_revenue']) * 100)}} % 
                                    @else 
                                    0
                                    @endif
                                </span> 
                                <p class="text-white-50">From previous period</p>
                            </div>
                            
                            <span class="peity-donut" data-peity='{ "fill": ["rgba(255, 255, 255, 0.8)", "rgba(255, 255, 255, 0.2)"], "innerRadius": 18, "radius": 32 }' data-width="54" data-height="54">$stats['curr_total_revenue']/$stats['recent_total_revenue']</span>
                        </div>
                    </div>
                    <div class="ml-3 mr-3">
                        <div class="bg-white p-3 mini-stats-desc rounded">
                            <h5 class="float-right mt-0">{{number_format($stats['curr_total_revenue'],0,'.','.')}}</h5>
                            <h6 class="mt-0 mb-3">Revenue</h6>
                            <p class="text-muted mb-0">Sed ut perspiciatis unde iste</p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-3 col-md-6">
                <div class="card mini-stats">
                    <div class="p-3 mini-stats-content">
                        <div class="mb-4">
                            <div class="float-right text-right">
                                <span class="badge badge-light text-primary mt-2 mb-2"> 0% </span> 
                                <p class="text-white-50">From previous period</p>
                            </div>
                            
                            <span class="peity-pie" data-peity='{ "fill": ["rgba(255, 255, 255, 0.8)", "rgba(255, 255, 255, 0.2)"]}' data-width="54" data-height="54">3/8</span>
                        </div>
                    </div>
                    <div class="ml-3 mr-3">
                        <div class="bg-white p-3 mini-stats-desc rounded">
                            <h5 class="float-right mt-0">{{$stats['curr_total_average']}}</h5>
                            <h6 class="mt-0 mb-3">Average Price</h6>
                            <p class="text-muted mb-0">Sed ut perspiciatis unde iste</p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-3 col-md-6">
                <div class="card mini-stats">
                    <div class="p-3 mini-stats-content">
                        <div class="mb-4">
                            <div class="float-right text-right">
                                <span class="badge badge-light @if($stats['curr_total_jasa'] >= $stats['recent_total_jasa']) text-info @else text-danger @endif mt-2 mb-2"> 
                                    @if($stats['curr_total_jasa'] >= $stats['recent_total_jasa']) + @else - @endif 
                                    @if($stats['recent_total_jasa'])
                                    {{round((float)($stats['curr_total_jasa']/$stats['recent_total_jasa']) * 100)}} % 
                                    @else 
                                    0
                                    @endif
                                </span> 
                                <p class="text-white-50">From previous period</p>
                            </div>
                            <span class="peity-donut" data-peity='{ "fill": ["rgba(255, 255, 255, 0.8)", "rgba(255, 255, 255, 0.2)"], "innerRadius": 18, "radius": 32 }' data-width="54" data-height="54">{{$stats['curr_total_jasa']}}/{{$stats['recent_total_jasa']}}</span>
                        </div>
                    </div>
                    <div class="ml-3 mr-3">
                        <div class="bg-white p-3 mini-stats-desc rounded">
                            <h5 class="float-right mt-0">{{$stats['curr_total_jasa']}}</h5>
                            <h6 class="mt-0 mb-3">Jasa</h6>
                            <p class="text-muted mb-0">Sed ut perspiciatis unde iste</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-xl-9">
                <div class="card">
                    <div class="card-body">
                        <h4 class="mt-0 header-title mb-5">Monthly Earning</h4>
                        <div id="morris-bar-stacked" class="morris-chart-height morris-charts"></div>
                    </div>
                </div>
            </div>

            <div class="col-xl-3">
                <div class="card">
                    <div class="card-body">
                        <h4 class="mt-0 header-title">Sales Analytics</h4>

                        <div class="row text-center m-t-20">
                            <div class="col-6">
                                <h5 class="">{{$stats['total_transaksi']}}</h5>
                                <p class="text-muted font-14">Transactions</p>
                            </div>
                            <div class="col-6">
                                <h5 class="">{{number_format($stats['total_income'],0,'.','.')}}</h5>
                                <p class="text-muted font-14">Total Income</p>
                            </div>
                        </div>

                        <div id="morris-donut-example" class="dash-chart morris-charts text-center"></div>
                    </div>
                </div>

            </div>
        </div>

        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">
                        <h4 class="mt-0 header-title">Latest Transactions</h4>
                        <a class="btn btn-primary" href="{{url('admin/transaksi/export')}}" role="button">Get Reporting</a>

                        <div class="table-responsive mt-4">
                            <table class="table table-hover mb-0">
                                <thead>
                                    <tr>
                                        <th scope="col">(#) Id</th>
                                        <th scope="col">Name</th>
                                        <th scope="col">Date</th>
                                        <th scope="col">Status</th>
                                        <th scope="col">Price</th>
                                        <th scope="col">Quantity</th>
                                        <th scope="col" colspan="2">Amount</th>
                                        
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <th scope="row">#16252</th>
                                        <td>
                                            <div>
                                                <img src="assets/images/users/avatar-2.jpg" alt="" class="thumb-sm rounded-circle mr-2"> Rafael Reardon
                                            </div>
                                        </td>
                                        <td>14/10/2018</td>
                                        <td><span class="badge badge-success">Delivered</span></td>
                                        <td>$80</td>
                                        <td>1</td>
                                        <td>$80</td>
                                        <td>
                                            <div>
                                                <a href="#" class="btn btn-primary btn-sm">Edit</a>
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <th scope="row">#16253</th>
                                        <td>
                                            <div>
                                                <img src="assets/images/users/avatar-3.jpg" alt="" class="thumb-sm rounded-circle mr-2"> Thomas Hirsch
                                            </div>
                                        </td>
                                        <td>15/10/2018</td>
                                        <td><span class="badge badge-warning">Pending</span></td>
                                        <td>$76</td>
                                        <td>2</td>
                                        <td>$152</td>
                                        <td>
                                            <div>
                                                <a href="#" class="btn btn-primary btn-sm">Edit</a>
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <th scope="row">#16254</th>
                                        <td>
                                            <div>
                                                <img src="assets/images/users/avatar-4.jpg" alt="" class="thumb-sm rounded-circle mr-2"> Archer Desaillly
                                            </div>
                                        </td>
                                        <td>15/10/2018</td>
                                        <td><span class="badge badge-success">Delivered</span></td>
                                        <td>$86</td>
                                        <td>1</td>
                                        <td>$86</td>
                                        <td>
                                            <div>
                                                <a href="#" class="btn btn-primary btn-sm">Edit</a>
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <th scope="row">#16255</th>
                                        <td>
                                            <div>
                                                <img src="assets/images/users/avatar-5.jpg" alt="" class="thumb-sm rounded-circle mr-2"> Michael Flannery
                                            </div>
                                        </td>
                                        <td>16/10/2018</td>
                                        <td><span class="badge badge-danger">Cancel</span></td>
                                        <td>$82</td>
                                        <td>2</td>
                                        <td>$164</td>
                                        <td>
                                            <div>
                                                <a href="#" class="btn btn-primary btn-sm">Edit</a>
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <th scope="row">#16256</th>
                                        <td>
                                            <div>
                                                <img src="assets/images/users/avatar-6.jpg" alt="" class="thumb-sm rounded-circle mr-2"> Jamie Fishbourne
                                            </div>
                                        </td>
                                        <td>17/10/2018</td>
                                        <td><span class="badge badge-success">Delivered</span></td>
                                        <td>$84</td>
                                        <td>2</td>
                                        <td>$84</td>
                                        <td>
                                            <div>
                                                <a href="#" class="btn btn-primary btn-sm">Edit</a>
                                            </div>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection