@extends('backend.layouts.master')

@section('content')
    <!--app-content open-->
    <div class="main-content app-content mt-0">
        <div class="side-app">

            <!-- CONTAINER -->
            <div class="main-container container-fluid">

                <!-- PAGE-HEADER -->
                <div class="page-header">
                    <h1 class="page-title">Product Bulk Upload</h1>
                    <div>
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{route('dashboard')}}">Dashboard</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Product Bulk Upload</li>
                        </ol>
                    </div>
                </div>
                        <!-- PAGE-HEADER END -->
                <div class="row justify-content-between">
                    <div class="col-lg-12 col-md-12">
                        <div class="card card-static-2 mb-30 p-3">
                            <div class="card-body-table">
                                <div class="alert alert-success">
                                    <strong>Step 1:</strong>
                                    <p>1. Download the skeleton file and populate it with the necessary information.</p>
                                    <p>2. After you've downloaded and filled out the skeleton file, please upload it and submit it using the form below.</p>
                                    <p>3. After you've uploaded your products, you'll need to modify them and configure their photos and options.</p>
                                </div>
                                <br>
                                <div class="">
                                    <a href="{{ asset('download/product_bulk_demo.xlsx') }}" download><button class="btn btn-purple">Download CSV</button></a>
                                </div>
                                <div class="alert alert-success mt-5">
                                    <strong>Step 2:</strong>
                                    <p>1. Category should be in numerical id.</p>
                                    <p>2. To get the Category id, you can download the document.</p>
                                </div>
                                <br>
                                <div class="">
                                    <a href="{{route('pdf.category')}}"><button class="btn btn-purple">Download Category</button></a>
                                </div>
                                <br>
                            </div>
                        </div>
                        <div class="card mb-4">
                            <div class="card-header">
                                <h5 class="mb-0 h6"><strong>Upload Product File</strong></h5>
                            </div>
                            <div class="card-body">
                                <form class="form-horizontal" action="{{route('product.import')}}" method="POST" enctype="multipart/form-data">
                                    @csrf
                                    <div class="form-group row">
                                        <div class="col-sm-12">
                                            <div class="custom-file">
                                                <label class="custom-file-label">
                                                    <input type="file" name="bulk_file"  required>
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group mb-0">
                                        <button type="submit" class="btn btn-purple">Upload CSV</button>
                                    </div>
                                </form>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

