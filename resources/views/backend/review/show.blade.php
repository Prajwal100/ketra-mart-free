@extends('backend.layouts.master')

@section('content')
    <!--app-content open-->
    <div class="main-content app-content mt-0">
        <div class="side-app">

            <!-- CONTAINER -->
            <div class="main-container container-fluid">

                <!-- PAGE-HEADER -->
                <div class="page-header">
                    <h1 class="page-title">Reviews <a href="{{route('reviews.index')}}" class="btn btn-primary me-2"><i class="fe fe-arrow-left"></i> Go Back</a>
                    </h1>
                    <div>
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{route('dashboard')}}">Dashboard</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Reviews</li>
                        </ol>
                    </div>
                </div>
                <!-- PAGE-HEADER END -->
                <!-- PAGE-HEADER END -->
                <div class="row mb-4">
                    <div class="col-md-12">
                        @include('layouts._error_notify')
                    </div>
                </div>

                <div class="card height-auto">
                    <div class="card-body">

                        <div class="single-info-details">
                            <div class="item-content mt-5">
                                <div class="info-table table-responsive">
                                    @php
                                        $product=\App\Models\Product::where('id',$review->product_id)->first();
                                    @endphp
                                    <table class="table table-bordered text-nowrap">
                                        <tbody>

                                        <tr>
                                            <th>
                                                Reviewed By :
                                            </th>
                                            <td class="font-medium text-dark-medium">{{$review->name}}</td>
                                        </tr>
                                        <tr>
                                            <th>
                                                Product Rate:
                                            </th>
                                            <td class="font-medium text-dark-medium"><a href="{{route('product.detail',$product->slug)}}" target="_blank">{{ucfirst($product->title)}}</a></td>
                                        </tr>
                                        <tr>
                                            <th>Product Rate :</th>
                                            <td class="font-medium text-dark-medium">
                                                @php
                                                    $rate = ceil($review->rate);
                                                @endphp
                                                @for ($i = 0; $i < 5; $i++)
                                                    @if ($i < $rate)
                                                        <i class="fa fa-star text-warning"></i>
                                                    @else
                                                        <i class="fa fa-star-o text-warning"></i>
                                                    @endif
                                                @endfor
                                            </td>
                                        </tr>
                                        <tr>
                                            <th>Review:</th>
                                            <td class="font-medium text-dark-medium">{!! html_entity_decode($review->review) !!}</td>
                                        </tr>
                                        <tr>
                                            <th>Review Date:</th>
                                            <td class="font-medium text-dark-medium">{{\Carbon\Carbon::parse($review->created_at)->format('d-M-Y')}}</td>
                                        </tr>
                                        <tr>
                                            <td>Status:</td>
                                            <td class="font-medium text-dark-medium">
                                                <form action="{{route('reviews.update',$review->id)}}" id="order-status" method="post">
                                                    @csrf
                                                    @method('patch')
                                                    <input type="hidden" name="review_id" value="{{$review->id}}">
                                                        <select class="form-control select2" name="status" id="">
                                                            <option value="pending" {{$review->status=='pending' ? 'selected' : ''}}>Pending</option>
                                                            <option value="accept" {{$review->status=='accept' ? 'selected' : ''}}>Accept</option>
                                                            <option value="reject" {{$review->status=='reject' ? 'selected' : ''}}>Reject</option>
                                                        </select>
                                                    <br>
                                                    <button type="submit" id="status_btn" class="btn btn-primary mt-2"><i class="fe fe-plus-circle"></i> Update Review</button>

                                                </form>
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
    </div>
@endsection

@section('scripts')
    <script>
        $('#status_btn').click(function () {
            $('#status_btn').html('<i class="fas fa-spinner fa-spin"></i> Updating..');
            $('#order-status').submit();
        });
    </script>
@endsection
