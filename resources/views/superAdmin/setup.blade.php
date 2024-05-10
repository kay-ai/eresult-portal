@extends('layouts.app', [($activePage = 'Account Setup')])

@section('content')
    <div class="me-2">
        <div class="row mt-4">
            <div class="container text-center mb-4">
                <h4>School Info</h4>
            </div>
            <form method="post" id="schlDetailsForm" action="" enctype="multipart/form-data">
                @csrf
                <input type="hidden" name="id" value="{{$account->id}}">
                <div class="row">
                    <div class="col-md-4">
                        <div class="card">
                            <div class="card-header">School Logo/Badge</div>
                            <div class="card-body text-center">
                                <img src="{{asset('logo/' . $account->logo ?? null)}}" alt="logo"
                                    class="img-fluid round" id="schl-logo" style="height:100px;object-fit: cover;">
                            </div>
                            <div class="card-footer">
                                <div class="input-group">
                                    <input type="file" name="logo" onchange="imgPreview('schl-logo', 'school-logo');"
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
                                    <input type="text" name="school" id="schl-name" value="{{$account->school ?? null}}"
                                        class="form-control" required="required">
                                </div>
                            </div>
                        </div>

                        <div class="row g-3 mb-2">

                            <div class="col">
                                <div class="form-group">
                                    <label>State</label>
                                    <select class="form-select form-control" name="state" id="schl-state">
                                        <option value="{{$account->state ?? null}}" selected="selected">{{$account->state ?? null}}</option>
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

                            <div class="col">
                                <div class="form-group">
                                    <label>Address</label>
                                    <input type="text" class="form-control" name="address" id="schl-address" value="{{$account->address ?? null}}">
                                </div>
                            </div>

                        </div>

                        <div class="row g-3 mb-2">

                            <div class="col">
                                <div class="form-group">
                                    <label>School P.O.Box</label>
                                    <input type="text" name="pob" id="schl-pobox" value="{{$account->pob ?? null}}"
                                        class="form-control" required="required">
                                </div>
                            </div>
                            <div class="col">
                                <div class="form-group">
                                    <label>School Motto</label>
                                    <input type="text" name="motto" id="schl-motto" value="{{$account->motto ?? null}}"
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
                                        <input type="email" name="email" id="email" value="{{$account->email ?? null}}"
                                            class="form-control" required="required">
                                    </div>
                                </div>
                            </div>

                            <div class="col">
                                <div class="form-group">
                                    <label>Official Phone</label>
                                    <div class="input-group">
                                        <div class="input-group-text"><i class="fa fa-telephone"></i></div>
                                        <input type="tel" name="phone" id="phone" value="{{$account->phone ?? null}}"
                                            class="form-control" required="required">
                                    </div>
                                </div>
                            </div>

                        </div>
                        <div class="row text-center p-2">
                            <button type="submit" id="saveSetUpBtn" class="btn btn-primary">Save
                                Changes</button>
                        </div>
                    </div>

                </div>
            </form>

        </div>
    </div>
@endsection
