<div class="modal fade colorChartModal" id="colorChartModal" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true"><i class="bx bx-x"></i></span>
            </button>
            <div class="modal-colorChart">
                <h3>Color Chart</h3>

                <div class="colors-tabs-section">

                    <!-- Category Type Tabs -->
                    <ul class="nav nav-pills" id="pills-tab" role="tablist">
                        <li class="nav-item" role="presentation">
                            <a class="nav-link active" id="chiffonType" data-toggle="pill"
                               href="#chiffonColors">Chiffon </a>
                        </li>
                        <li class="nav-item" role="presentation">
                            <a class="nav-link" id="satinType" data-toggle="pill" href="#satinColors">Satin </a>
                        </li>
                        <li class="nav-item" role="presentation">
                            <a class="nav-link" id="tafettaType" data-toggle="pill"
                               href="#tafettaColors">Tafetta</a>
                        </li>
                        <li class="nav-item" role="presentation">
                            <a class="nav-link" id="organzaType" data-toggle="pill" href="#organzaColors">Organza
                            </a>
                        </li>
                        <li class="nav-item" role="presentation">
                            <a class="nav-link" id="charmeuseType" data-toggle="pill"
                               href="#charmeuseColors">Charmeuse </a>
                        </li>
                        <li class="nav-item" role="presentation">
                            <a class="nav-link" id="jerseyType" data-toggle="pill" href="#jerseyColors">Jersey </a>
                        </li>
                        <li class="nav-item" role="presentation">
                            <a class="nav-link" id="satinChiffonType" data-toggle="pill"
                               href="#satinChiffonColors">Satin Chiffon </a>
                        </li>

                    </ul>
                    <hr class="border-bottom-dashed mt-0">

                    <!-- Categorywise Colors -->
                    <div class="tab-content" id="pills-tabContent">
                        <div class="tab-pane fade show active" id="chiffonColors" aria-labelledby="chiffonType">
                            <img src="{{asset('frontend/assets/images/colors/All.JPG')}}" alt="Chiffon Type Colors">
                        </div>
                        <div class="tab-pane fade" id="satinColors" aria-labelledby="satinColors">
                            <div class="color-item">
                                <div class="color-block">
                                </div>
                                <div class="name">Pink</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
