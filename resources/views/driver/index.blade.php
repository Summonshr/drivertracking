@extends('admin')

@section('content')

<div class="app-main__outer">
    <div class="app-main__inner">
        <div class="app-page-title">
            <div class="page-title-wrapper">
                <div class="page-title-heading">
                    <div class="page-title-icon">
                        <i class="pe-7s-car icon-gradient bg-love-kiss">
                        </i>
                    </div>
                    <div>
                        Drivers
                        <div class="page-title-subheading">
                            All drivers associated with 4th Dimension
                        </div>
                    </div>
                </div>
                <div class="page-title-actions">
                    @can('create', new \App\Models\Driver)
                    <a class="btn btn-shadow btn-danger" href="{{route('resource.view',['driver','create'])}}">Add
                        Drivers</a>
                    @endcan
                </div>
            </div>
        </div>

        <div class="">
            <div class="main-card mb-3 card">
                <div class="card-body">
                    <h5 class="card-title">Drivers</h5>
                    <div class="card-content">
                        <table id="driverTable" class="table" data-id-field="code" data-sort-name="value1"
                            data-sort-order="desc" data-show-chart="false" data-pagination="false"
                            data-show-pagination-switch="false">
                            <thead>
                                <tr>
                                    <th>Id</th>
                                    <th>Name</th>
                                    <th>Pin</th>
                                    <th>Depot</th>
                                    <th>Comments</th>
                                    <th>Phone Number</th>
                                    <th>Email</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach(\App\Models\Driver::with('depot')->get() as $driver)
                                <tr>
                                    <td>{{$loop->iteration}}</td>
                                    <td><a href="{{$driver->getUrl()}}">{{$driver->name}}</a></td>
                                    <td>{{$driver->pin}}</td>
                                    <td>{{$driver->depot->name}}</td>
                                    <td>{{$driver->comments}}</td>
                                    <td>{{$driver->phone}}</td>
                                    <td>{{$driver->email}}</td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
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
})
</script>

@endsection