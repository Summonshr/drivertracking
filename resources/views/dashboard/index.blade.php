@extends('admin')

@section('content')

<div class="app-main__outer">
    <div class="app-main__inner">
        <div class="app-page-title">
            <div class="page-title-wrapper">
                <div class="page-title-heading">
                    <div class="page-title-icon">
                        <i class="pe-7s-helm icon-gradient bg-love-kiss">
                        </i>
                    </div>
                    <div>
                        Recent activities
                        <div class="page-title-subheading">
                            All drivers associated with 4th Dimension
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="">
            <div class="main-card mb-3 card">
                <div class="card-body">
                    <h5 class="card-title">Recent activities</h5>
                    <div class="card-content">
                        <table id="driverTable" class="table" data-id-field="code" data-sort-name="value1" data-sort-order="desc" data-show-chart="false" data-pagination="false" data-show-pagination-switch="false">
                            <thead>
                                <tr>
                                    <th size="5">Date</th>
                                    <th> Driver Name</th>
                                    <th>Time</th>
                                    <th>Status</th>
                                    <th>Time Taken</th>
                                    <th>From</th>
                                    <th>To</th>
                                    <th> Load/Unload Time</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach(\App\Models\Log::with('user')->latest()->take(100)->get() as $log)
                                <tr>
                                    <td>{{$log->created_at->format('d-m-Y')}}</td>
                                    <td> <a href="{{route('admin.driver.single')}}">{{$log->user->name}}</a></td>
                                    <td>{{$log->created_at->format('h:i A')}}</td>
                                    <td>Depart</td>
                                    <td>00</td>
                                    <td>-</td>
                                    <td>-</td>
                                    <td>1hr</td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">

            <div class="col-md-8">
                <div class="main-card mb-3 card">
                    <div class="card-body">
                        <h5 class="card-title">Average Time to reach from one location to another</h5>
                        <div class="card-content">
                            <table id="timeTable" class="table" data-id-field="code" data-sort-name="value1" data-sort-order="desc" data-show-chart="false" data-pagination="false" data-show-pagination-switch="false">
                                <thead>
                                    <tr>
                                        <th>From</th>
                                        <th> To</th>
                                        <th>Time Taken</th>

                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>Port Melbourne</td>
                                        <td> Dandenong</td>
                                        <td>2 hrs</td>

                                    </tr>
                                    <tr>
                                        <td>Port Melbourne</td>
                                        <td> New Aim</td>
                                        <td>2 hrs</td>
                                    </tr>
                                    <tr>
                                        <td>New Aim</td>
                                        <td> Dandenong</td>
                                        <td>2 hrs</td>
                                    </tr>
                                    <tr>
                                        <td> New Aim</td>
                                        <td>Port Melbourne</td>

                                        <td>2 hrs</td>
                                    </tr>

                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-4">
                <div class="main-card mb-3 card">
                    <div class="card-body">
                        <h5 class="card-title">Load Unload average time</h5>
                        <div class="card-content">
                            <table id="ULTable" class="table" data-id-field="code" data-sort-name="value1" data-sort-order="desc" data-show-chart="false" data-pagination="false" data-show-pagination-switch="false">
                                <thead>
                                    <tr>
                                        <th>Location</th>
                                        <th> Average Time </th>

                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>Port Melbourne</td>
                                        <td>2 hrs</td>

                                    </tr>
                                    <tr>
                                        <td> New Aim</td>
                                        <td>2 hrs</td>
                                    </tr>
                                    <tr>
                                        <td> Dandenong</td>
                                        <td>2 hrs</td>
                                    </tr>


                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="app-wrapper-footer">
        <div class="app-footer">
            <div class="app-footer__inner bg-white">
                <div class="app-footer-left">
                    <ul class="nav">
                        <li class="nav-item">
                            &copy; 2022 4th Dimension.
                        </li>
                    </ul>
                </div>
                <div class="app-footer-right">
                    <ul class="nav">
                        <li class="nav-item">
                            Build Version: 0.1
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
</div>

<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
<script>
    $(document).ready(function() {


        var table = $('#driverTable').DataTable({
            select: false,
            "columnDefs": [{
                className: "Name",
                "targets": [0],
                "visible": true,
                "searchable": true
            }]
        });
        $('input[name="dates"]').daterangepicker({
            singleDatePicker: true,
            showDropdowns: true,
            minYear: 1901,
            maxYear: parseInt(moment().format('YYYY'), 10)
        }, function(start, end, label) {
            var years = moment().diff(start, 'years');
            alert("You are " + years + " years old!");
        });

    })
</script>

@endsection