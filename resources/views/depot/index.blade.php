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
                        Depot
                        <div class="page-title-subheading">
                            Add and view existing Depot of 4th Dimension
                        </div>
                    </div>
                </div>
                <div class="page-title-actions">
                    @can('create', new \App\Models\Depot)
                    <button type="button" class="btn btn-shadow btn-danger" data-toggle="modal"
                        data-target="#addDepot">Add Depot</button>
                    @endcan
                </div>
            </div>
        </div>

        <div class="">
            <div class="main-card mb-3 card">
                <div class="card-body">
                    <h5 class="card-title">Locations</h5>
                    <div class="card-content">
                        <table id="depotTable" class="table" data-id-field="code" data-sort-name="value1"
                            data-sort-order="desc" data-show-chart="false" data-pagination="false"
                            data-show-pagination-switch="false">
                            <thead>
                                <tr>
                                    <th>Id</th>
                                    <th>Name</th>
                                    <th>Location</th>
                                    <th>Cage Number</th>
                                    <th>Pallet Number</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach(\App\Models\Depot::with('location')->get() as $depot)
                                <tr>
                                    <td>{{$loop->iteration}}</td>
                                    <td>{{$depot->name}}</td>
                                    <td>{{$depot->location->name}}</td>
                                    <td>{{$depot->number_of_cage}}</td>
                                    <td>{{$depot->number_of_pallet}}</td>
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

<div class="modal fade" id="addDepot" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-modal="true"
    data-keyboard="false" data-backdrop="static">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content">
            <form class="form w-100" method="POST" action="{{route('resource.store')}}">
                @csrf
                <input type="hidden" name="resource_type" value="depot">
                <input type="hidden" name="action" value="create">
                <input type="hidden" name="redirect_url" value="/admin/depot">
                <div class="modal-header">
                    <h5 class="modal-title font-weight-bold" id="exampleModalLongTitle">Add Depot</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label>Depot Name</label>
                        <input type="text" name="name" class="form-control" placeholder="Name" required="required">
                    </div>

                    <div class="form-group">
                        <label>Location</label>
                        <select name="location_id" id="" required="true" class="mb-2 form-control">
                            <option value="">Select Location</option>
                            @foreach (\App\Models\Location::all() as $location)
                            <option value="{{$location->id}}">{{$location->name}}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="form-group">
                        <label>Number of Cage</label>
                        <input type="number" name="number_of_cage" class="form-control" placeholder="Cage number"
                            required="required">
                    </div>
                    <div class="form-group">
                        <label>Number of pallet</label>
                        <input type="number" name="number_of_pallet" class="form-control" placeholder="pallet number"
                            required="required">
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



    var table = $('#depotTable').DataTable({
        select: false,
        "columnDefs": [{
            className: "Name",
            "targets": [0],
            "visible": true,
            "searchable": true
        }]
    });
    $('#depotTable').Tabledit({
        url: `{{ config('app.APP_URL') }}`,
        columns: {
            identifier: [0, 'id'],
            editable: [
                [1, 'name'],
                [2, 'location']
            ],
        }
    });

})
</script>
@endsection