@if($errors->any())
    <div class="alert mt-4" role="alert" style="background: #FFF0F0;border-color:#f5c6cb ">
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-hidden="true" aria-label="Close">
            &times;
        </button>
        <div class="row align-items-center justify-content-center">
            <div class="col-1 d-table">
                <i class="fa fa-exclamation-triangle align-middle text-center" style="font-size: 34px;color:#B66866;display: table-cell"></i>
            </div>
            <div class="col-11 pt-2">
                <div style="color: #912d2b;font-weight: 700;">
                    There were some errors with your submission
                </div>
                <ul style="padding-left: 16px;">
                    @foreach($errors->all() as $error)
                        <li style="color:#9f3a38;font-size: 14px;list-style: circle ">{{$error}}</li>
                    @endforeach
                </ul>
            </div>
        </div>
    </div>
@endif
