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
                        Drivers
                        <div class="page-title-subheading">
                            All drivers associated with 4th Dimension
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="">
            <div class="main-card mb-3 card col-8">
                <div class="card-body">
                    <h5 class="card-title">Drivers</h5>

                    <div class="card-content ">
                        <form class="form w-100" method="POST" action="{{route('resource.store')}}">
                            @csrf
                            <input type="hidden" name="redirect_url" value="{{route('resource.view',['driver'])}}">
                            <input type="hidden" name="resource_type" value="driver">
                            <input type="hidden" name="action" value="create">
                            <div class="modal-header">
                                <h5 class="modal-title font-weight-bold" id="exampleModalLongTitle">Add Drivers</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">×</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <div class="form-group row">
                                    <div class="col-md-6">
                                        <label>Full Name</label>
                                        <input type="text" name="name" value="{{old('name')}}" class="form-control"
                                            placeholder="Driver's full name" required="">
                                    </div>

                                    <div class="col-md-6 relative-class">
                                        <label>Pin Number</label>
                                        <!-- <input type="number" class="form-control" placeholder="Generate Pin" required=""> -->
                                        <input id="formGridPin" minlength="4" type="number" name="pin"
                                            value="{{old('pin')}}"
                                            class="form-control @error('pin')) border border-danger @enderror" value=""
                                            placeholder="PIN" maxLength="4" minLength="4" />
                                        @error('pin'))<p class="text text-danger">{{$message}}</p>@enderror
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <div class="col-md-4">
                                        <label>Email Address</label>
                                        <input type="text"
                                            class="form-control @error('email')) border border-danger @enderror"
                                            name="email" value="{{old('email')}}" placeholder="Driver's email address"
                                            required="">
                                        @error('email'))<p class="text text-danger">{{$message}}</p>@enderror
                                    </div>

                                    <div class="col-md-4">
                                        <label>Phone Number</label>
                                        <input type="text" class="form-control" name="phone" value="{{old('phone')}}"
                                            placeholder="Driver's contact number" required="">
                                    </div>

                                    <div class="col-md-4">
                                        <label>DOB</label>
                                        <input type="date" name="date_of_birth" value="{{old('date_of_birth')}}"
                                            class="form-control" placeholder="Driver's date of birth" required="">
                                    </div>
                                </div>

                                <div class="form-group row">

                                    <div class="col-md-4">
                                        <label>Comments</label>
                                        <textarea class="form-control" name="comments" rows=" 3"
                                            placeholder="Comments">{{old('comments')}}</textarea>
                                    </div>

                                    <div class="col-md-4">
                                        <label>Depo</label>
                                        <select name="depo_id" class="mb-2 form-control">
                                            <option value="">Select Depo</option>
                                            @foreach(\App\Models\Depot::all() as $type)
                                            <option @selected($type->id == old('depo_id'))
                                                value="{{$type->id}}">{{$type->name}}</option>
                                            @endforeach
                                        </select>
                                    </div>

                                    <div class="col-md-4">
                                        <label>Select Image</label>
                                        @include('components.file-upload', ['resource' => new \App\Models\Driver])
                                    </div>
                                </div>

                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary btn-lg"
                                    data-dismiss="modal">Close</button>
                                <button type="submit" class="btn btn-danger btn-lg">Save changes</button>
                            </div>
                        </form>
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
@endsection