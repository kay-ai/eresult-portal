@extends('layouts.app', [($activePage = 'Account Setup')])

@section('content')
    <div class="me-2">
        <div class="row mt-4">

            <form method="post" id="schlDetailsForm" action="" enctype="multipart/form-data">
                <div class="row">
                    <div class="col-md-4">
                        <div class="card">
                            <div class="card-header">School Logo/Badge</div>
                            <div class="card-body text-center">
                                <img src="{{asset('logo/' . $account ? $account->logo : null)}}" alt="logo"
                                    class="img-fluid round" id="schl-logo" style="height:100px;object-fit: cover;">
                            </div>
                            <div class="card-footer">
                                <div class="input-group">
                                    <input type="file" onchange="imgPreview('schl-logo','school-logo');"
                                        class="form-control" id="school-logo" aria-label="Upload">
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-8">
                        <div class="row g-3 mb-2">
                            <div class="col">
                                <div class="form-group">
                                    <label>School Name</label>
                                    <input type="text" id="schl-name" value="{{$account->school ?? null}}"
                                        class="form-control" required="required">
                                </div>
                            </div>
                        </div>

                        <div class="row g-3 mb-2">

                            <div class="col">
                                <div class="form-group">
                                    <label>Country</label>
                                    <select class="form-control" id="schl-country">
                                        <option value="Nigeria">Nigeria</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col">
                                <div class="form-group">
                                    <label>State</label>
                                    <select class="form-select" id="schl-state">
                                        <option value="{{$account ?? $account->state}}" selected="selected"></option>
                                        <option value="Abia">Abia</option>
                                        <option value="Adamawa">Adamawa</option>
                                        <option value="AkwaIbom">AkwaIbom</option>
                                        <option value="Anambra">Anambra</option>
                                        <option value="Bauchi">Bauchi</option>
                                        <option value="Bayelsa">Bayelsa</option>
                                        <option value="Benue">Benue</option>
                                        <option value="Borno">Borno</option>
                                        <option value="Cross River">Cross River</option>
                                        <option value="Delta">Delta</option>
                                        <option value="Ebonyi">Ebonyi</option>
                                        <option value="Edo">Edo</option>
                                        <option value="Ekiti">Ekiti</option>
                                        <option value="Enugu">Enugu</option>
                                        <option value="FCT">FCT</option>
                                        <option value="Gombe">Gombe</option>
                                        <option value="Imo">Imo</option>
                                        <option value="Jigawa">Jigawa</option>
                                        <option value="Kaduna">Kaduna</option>
                                        <option value="Kano">Kano</option>
                                        <option value="Katsina">Katsina</option>
                                        <option value="Kebbi">Kebbi</option>
                                        <option value="Kogi">Kogi</option>
                                        <option value="Kwara">Kwara</option>
                                        <option value="Lagos">Lagos</option>
                                        <option value="Nasarawa">Nasarawa</option>
                                        <option value="Niger">Niger</option>
                                        <option value="Ogun">Ogun</option>
                                        <option value="Ondo">Ondo</option>
                                        <option value="Osun">Osun</option>
                                        <option value="Oyo">Oyo</option>
                                        <option value="Plateau">Plateau</option>
                                        <option value="Rivers">Rivers</option>
                                        <option value="Sokoto">Sokoto</option>
                                        <option value="Taraba">Taraba</option>
                                        <option value="Yobe">Yobe</option>
                                        <option value="Zamfara">Zamafara</option>
                                    </select>
                                </div>
                            </div>

                        </div>

                        <div class="row g-3 mb-2">

                            <div class="col">
                                <div class="form-group">
                                    <label>School P.O.Box</label>
                                    <input type="text" id="schl-pobox" value="{{$account ?? $account->pob}}"
                                        class="form-control" required="required">
                                </div>
                            </div>
                            <div class="col">
                                <div class="form-group">
                                    <label>School Motto</label>
                                    <input type="text" id="schl-motto" value="{{$account ?? $account->motto}}"
                                        class="form-control" required="required">
                                </div>
                            </div>

                        </div>
                        <div class="row g-3 mb-2">

                            <div class="col">
                                <div class="form-group">
                                    <label>Official Email</label>
                                    <div class="input-group">
                                        <div class="input-group-text">@</div>
                                        <input type="text" id="email" value="{{$account ?? $account->email}}"
                                            class="form-control" required="required" readonly="readonly">
                                    </div>
                                </div>
                            </div>

                        </div>
                        <div class="row text-center p-2">
                            <button type="button" id="saveSetUpBtn" onclick="saveSetup();" class="btn btn-primary">Save
                                Changes</button>
                        </div>
                    </div>

                </div>
            </form>

        </div>
    </div>
@endsection
