@extends('frontend.layouts.master')
@section('title', 'Place Order || Bigday')

@section('content')

    <main class="main-content my-5">
        <!-- MultiStep Form For Checkout -->
        <div class="row align-items-center justify-content-center">
            <div class="col-md-8 col-md-offset-3">
                <form id="msform">
                    <!-- progressbar -->
                    <ul id="progressbar">
                        <li class="active">Place Order</li>
                        <li>Payment</li>
                        <li>Succeed</li>
                    </ul>
                    <!-- fieldsets -->
                    <fieldset>
                        <h2 class="fs-title">Shipping Details</h2>
                        <h3 class="fs-subtitle">Submit Your Full Shippping Address here to place Order</h3>
                        <div class="form-group d-flex">
                            <input type="text" name="fname" placeholder="First Name" class="form-input" />
                            <input type="text" name="lname" placeholder="Last Name" class="form-input" />
                        </div>
                        <input type="text" name="address" placeholder="Address" />
                        <input type="text" name="city" placeholder="City" />
                        <div class="form-group d-flex">
                            <select class="wide">
                                <option>Country/Region</option>
                            </select>
                            <select class="wide">
                                <option>State / Province / Region</option>
                            </select>
                        </div>
                        <div class="form-group d-flex">
                            <input type="text" name="postal-code" placeholder="Postal Code" class="form-input" />
                            <input type="text" name="phone" placeholder="Phone Number(Please provide a valid phone number)" class="form-input" />
                        </div>
                        <input type="text" name="email" placeholder="Email" />
                        <input type="button" name="next" class="next action-button" value="Next" />
                    </fieldset>
                    <fieldset>
                        <h2 class="fs-title">Social Profiles</h2>
                        <h3 class="fs-subtitle">Your presence on the social network</h3>
                        <input type="text" name="twitter" placeholder="Twitter" />
                        <input type="text" name="facebook" placeholder="Facebook" />
                        <input type="text" name="gplus" placeholder="Google Plus" />
                        <input type="button" name="previous" class="previous action-button-previous" value="Previous" />
                        <input type="button" name="next" class="next action-button" value="Next" />
                    </fieldset>
                    <fieldset>
                        <h2 class="fs-title">Create your account</h2>
                        <h3 class="fs-subtitle">Fill in your credentials</h3>
                        <input type="text" name="email" placeholder="Email" />
                        <input type="password" name="pass" placeholder="Password" />
                        <input type="password" name="cpass" placeholder="Confirm Password" />
                        <input type="button" name="previous" class="previous action-button-previous" value="Previous" />
                        <input type="submit" name="submit" class="submit action-button" value="Submit" />
                    </fieldset>
                </form>

            </div>
        </div>
        <!-- /.MultiStep Form -->
    </main>

@endsection
