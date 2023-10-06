@extends('admin.admin_master')

@section('admin')
    <div class="page-content">
        <div class="container-fluid">

            <div class="row">
                <div class="col-md-4 col-xl-4">

                    <!-- Simple card -->
                    <div class="card">
                        <img class="card-img-top img-fluid" src="{{ asset('backend/assets/images/small/img-1.jpg') }}" alt="Card image cap">
                        <div class="card-body">
                            <h4 class="card-title">Name: {{ $adminData->name }}</h4>
                            <h4 class="card-title">E-Mail: {{ $adminData->email }}</h4>
                            <h4 class="card-title">Username: {{ $adminData->username }}</h4>
                            <hr>
                            <a href="" class="btn btn-dark btn-rounded waves-effect waves-light">Edit Profile</a>
                        </div>
                    </div>

                </div><!-- end col -->
            </div>
            <!-- end row -->

        </div>
    </div>
@endsection
