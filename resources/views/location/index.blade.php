@extends('admin')

@section('content')
<div class="app-main__outer">
    <div class="app-main__inner">
        <div class="app-page-title">
            <div class="page-title-wrapper">
                <div class="page-title-heading">
                    <div class="page-title-icon">
                        <i class="pe-7s-map-marker icon-gradient bg-love-kiss">
                        </i>
                    </div>
                    <div>
                        Location
                        <div class="page-title-subheading">
                            Add and view existing location of 4th Dimension
                        </div>
                    </div>
                </div>
                <div class="page-title-actions">
                    @can('create', new \App\Models\Location)
                    <button type="button" class="btn btn-shadow btn-danger" data-toggle="modal"
                        data-target="#addLocation">Add Location</button>
                    @endcan
                    @can('create', new \App\Models\TruckType)
                    <button type="button" class="btn btn-shadow btn-danger" data-toggle="modal"
                        data-target="#addTruck">Add Truck Type</button>
                    @endcan
                    @can('create', new \App\Models\Supplier)
                    <button type="button" class="btn btn-shadow btn-danger" data-toggle="modal"
                        data-target="#addSup">Add Supplier</button>
                    @endcan
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-8">
                <div class="main-card mb-3 card">
                    <div class="card-body">
                        <h5 class="card-title">Locations</h5>
                        <div class="card-content">
                            <table id="locationTable" class="table" data-id-field="code" data-sort-name="value2"
                                data-sort-order="desc" data-show-chart="false" data-pagination="false"
                                data-show-pagination-switch="false">
                                <thead>
                                    <tr>
                                        <th>Id</th>
                                        <th>Name</th>
                                        <th>Address</th>
                                        <th>Truck Type</th>
                                        <th>Supplier</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach(\App\Models\Location::with(['truck_type','supplier'])->get() as $location)
                                    <tr>
                                        <td>{{$loop->iteration}}</td>
                                        <td>{{$location->name}}</td>
                                        <td>{{$location->address}}</td>
                                        <td>{{$location->truck_type?->name}}</td>
                                        <td>{{$location->supplier?->name}}</td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="main-card mb-3 card">
                    <div class="card-body">
                        <h5 class="card-title">Truck Type</h5>
                        <div class="card-content">
                            <table id="truckTable" class="table" data-id-field="code" data-sort-name="value2"
                                data-sort-order="desc" data-show-chart="false" data-pagination="false"
                                data-show-pagination-switch="false">
                                <thead>
                                    <tr>
                                        <th>Id</th>
                                        <th>Truck Type</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach(\App\Models\TruckType::all() as $type)
                                    <tr>
                                        <td>{{$loop->iteration}}</td>
                                        <td>{{$type->name}}</td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <div class="main-card mb-3 card">
                    <div class="card-body">
                        <h5 class="card-title">Supplier</h5>
                        <div class="card-content">
                            <table id="supTable" class="table" data-id-field="code" data-sort-name="value2"
                                data-sort-order="desc" data-show-chart="false" data-pagination="false"
                                data-show-pagination-switch="false">
                                <thead>
                                    <tr>
                                        <th>Id</th>
                                        <th>Supplier</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach(\App\Models\Supplier::all() as $type)
                                    <tr>
                                        <td>{{$loop->iteration}}</td>
                                        <td>{{$type->name}}</td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
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

</div>

<div class="modal fade" id="addLocation" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel"
    aria-modal="true" data-keyboard="false" data-backdrop="static">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content">
            <form class="form w-100" action="{{route('resource.store')}}" method="POST">
                @csrf
                <input type="hidden" name="resource_type" value="location">
                <input type="hidden" name="action" value="create">
                <input type='hidden' name="redirect_url" value="/admin/location">
                <div class="modal-header">
                    <h5 class="modal-title font-weight-bold" id="exampleModalLongTitle">Add Location</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label>Location Name</label>
                        <input type="text" name="name" class="form-control" placeholder="Location" required="requried">
                    </div>

                    <div class="form-group">
                        <label>Location Address</label>
                        <input type="text" name="address" class="form-control" placeholder="Location Address"
                            required="requried">
                    </div>

                    <div class="form-group">
                        <label>Truck Type</label>
                        <select name="truck_type_id" required="true" class="mb-2 form-control">
                            <option value="">Select an option</option>
                            @foreach(\App\Models\TruckType::all() as $type)
                            <option value="{{$type->id}}">{{$type->name}}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="form-group">
                        <label>Supplier</label>
                        <select name="supplier_id" required="true" class="mb-2 form-control">
                            <option value="">Select an option</option>
                            @foreach(\App\Models\Supplier::all() as $type)
                            <option value="{{$type->id}}">{{$type->name}}</option>
                            @endforeach
                        </select>
                    </div>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary btn-lg" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-danger btn-lg">Save changes</button>
                </div>
            </form>
        </div>
    </div>
</div>
<div class="modal fade" id="addTruck" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-modal="true"
    data-keyboard="false" data-backdrop="static">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content">
            <form class="form w-100" action="{{route('resource.store')}}" method="POST">
                @csrf
                <input type="hidden" name="resource_type" value="trucktype">
                <input type="hidden" name="action" value="create">
                <input type='hidden' name="redirect_url" value="/admin/location">
                <div class="modal-header">
                    <h5 class="modal-title font-weight-bold" id="exampleModalLongTitle">Add Truck</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label>Truck Type Name</label>
                        <input type="text" class="form-control" name="name">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary btn-lg" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-danger btn-lg">Save changes</button>
                </div>
            </form>
        </div>
    </div>
</div>
<div class="modal fade" id="addSup" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-modal="true"
    data-keyboard="false" data-backdrop="static">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content">
            <form class="form w-100" action="{{route('resource.store')}}" method="POST">
                @csrf
                <input type="hidden" name="resource_type" value="supplier">
                <input type="hidden" name="action" value="create">
                <input type='hidden' name="redirect_url" value="/admin/location">
                <div class="modal-header">
                    <h5 class="modal-title font-weight-bold" id="exampleModalLongTitle">Add Supplier</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label>Supplier Name</label>
                        <input type="text" name="name" class="form-control" placeholder="Supplier">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary btn-lg" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-danger btn-lg">Save changes</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
<script>
$(document).ready(function() {
    var table = $('#locationTable').DataTable({
        select: false,
        "columnDefs": [{
            className: "Name",
            "targets": [0],
            "visible": true,
            "searchable": true
        }]
    });

    $('#locationTable').Tabledit({
        url: `{{ config('app.APP_URL') }}`,
        eventType: 'dblclick',
        editButton: true,
        columns: {
            identifier: [0, 'id'],
            editable: [
                [1, 'name'],
                [2, 'Truck Type', '{"1": "Red", "2": "Green", "3": "Blue"}'],
                [3, 'Supplier', '{"1": "Red", "2": "Green", "3": "Blue"}']
            ]
        }
    });


    $('#truckTable').Tabledit({
        url: `{{ config('app.APP_URL') }}`,
        eventType: 'dblclick',
        editButton: true,
        columns: {
            identifier: [0, 'id'],
            editable: [
                [1, 'name'],
                [2, 'Truck Type']
            ]
        }
    });

    $('#supTable').Tabledit({
        url: `{{ config('app.APP_URL') }}`,
        eventType: 'dblclick',
        editButton: true,
        columns: {
            identifier: [0, 'id'],
            editable: [
                [1, 'name'],
                [2, 'Supplier']
            ]
        }
    });
})
</script>
@endsection