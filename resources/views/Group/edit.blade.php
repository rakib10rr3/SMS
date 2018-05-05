@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    @foreach($waiter as $waiter)
                    <div class="card-header">Edit Waiter : <b>{{$waiter->name}}</b></div>

                    <div class="card-body">
                        @if (session('status'))
                            <div class="alert alert-success">
                                {{ session('status') }}
                            </div>
                        @endif
                        <form method="post" action="/waiter/{{$waiter->id}}">
                            {{csrf_field()}}
                            {{method_field('PUT')}}
                                <div class="form-group row">
                                    <label for="example-text-input" class="col-2 col-form-label">Name</label>
                                    <div class="col-10">
                                        <input class="form-control" type="text" placeholder="Rakibul Huda" value="{{$waiter->name}}" id="name"
                                               name="name">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="example-search-input" class="col-2 col-form-label">Phone Number</label>
                                    <div class="col-10">
                                        <input class="form-control" type="tel" placeholder="0123456789" id="mobile" value="{{$waiter->mobile}}"
                                               name="mobile">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="example-email-input" class="col-2 col-form-label">Address</label>
                                    <div class="col-10">
                                        <input class="form-control" type="text"
                                               placeholder="Elmah,Enayet Bazar,Chittagong" id="address" name="address" value="{{$waiter->address}}">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="example-url-input" class="col-2 col-form-label">NID</label>
                                    <div class="col-10">
                                        <input class="form-control" type="text" placeholder="BD0123456789" id="nid"
                                               name="nid" value="{{$waiter->nid}}">
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="example-color-input" class="col-2 col-form-label"></label>
                                    <div class="col-10">
                                        <button type="submit" class="btn btn-outline-success">Update</button>
                                    </div>
                                </div>
                            @endforeach
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
