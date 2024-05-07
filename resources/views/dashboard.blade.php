@extends('layouts.app', [$activePage = 'Dashboard'])

@section('content')
    <div class="me-2">
        <div class="row">
            <div class="col-md-3">
                <div class="card border-0 shadow-sm">
                    <div class="card-body p-0">
                        <div class="card-text border-bottom p-3">
                            <small class="text-kdis-2">
                                <i class="fa fa-address-book me-2" aria-hidden="true"></i> Total Students
                            </small>
                        </div>
                        <div class="border-bottom px-3 py-2">
                            <div class="d-flex justify-content-between align-items-center">
                                <p style="font-size: 25px; font-weight:600;">2,099</p>
                                <small class="text-dark">
                                    99.29% <i class="fa fa-chevron-up text-success" aria-hidden="true"></i>
                                </small>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-3">
                <div class="card border-0 shadow-sm">
                    <div class="card-body p-0">
                        <div class="card-text border-bottom p-3">
                            <small class="text-kdis-2">
                                <i class='bx bxl-stack-overflow me-2' style="font-size: 15px"></i>
                                Total Results
                            </small>
                        </div>
                        <div class="border-bottom px-3 py-2">
                            <div class="d-flex justify-content-between align-items-center">
                                <p style="font-size: 25px; font-weight:600;">199
                                    {{-- <span class="text-kdis">TB</span> --}}
                                </p>
                                <small class="text-dark">
                                    59.90% <i class="fa fa-chevron-up text-success" aria-hidden="true"></i>
                                </small>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-3">
                <div class="card border-0 shadow-sm">
                    <div class="card-body p-0">
                        <div class="card-text border-bottom p-3">
                            <small class="text-kdis-2">
                                <i class='bx bxl-stack-overflow me-2' style="font-size: 15px"></i>
                                Spillover Results
                            </small>
                        </div>
                        <div class="border-bottom px-3 py-2">
                            <div class="d-flex justify-content-between align-items-center">
                                <p style="font-size: 25px; font-weight:600;">099</p>
                                <small class="text-dark">
                                    12.22% <i class="fa fa-chevron-down text-danger" aria-hidden="true"></i>
                                </small>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-3">
                <div class="card border-0 shadow-sm">
                    <div class="card-body p-0">
                        <div class="card-text border-bottom p-3">
                            <small class="text-kdis-2">
                                <i class="fa fa-user me-2" aria-hidden="true"></i> Total Graduated
                            </small>
                        </div>
                        <div class="border-bottom px-3 py-2">
                            <div class="d-flex justify-content-between align-items-center">
                                <p style="font-size: 25px; font-weight:600;">530</p>
                                <small class="text-dark">
                                    10.29% <i class="fa fa-chevron-up text-success" aria-hidden="true"></i>
                                </small>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="row mt-4">
            <div class="col-md-12">
                <div class="card border-0 shadow p-3 mb-4">
                    <div class="row">
                        <div class="col-md-3">
                            <label for="session" class="form-label">Academic Session: </label>
                            <select name="session" class="form-control @error('session') is-invalid @enderror" id=""required autocomplete="session" autofocus>
                                <option>- Select an Option -</option>
                                <option value=""></option>
                            </select>

                            @error('session')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="col-md-3">
                            <label for="semester" class="form-label">Semester: </label>
                            <select name="semester" class="form-control @error('semester') is-invalid @enderror" id=""required autocomplete="semester" autofocus>
                                <option>- Select an Option -</option>
                                <option value="first">First Semester</option>
                                <option value="second">Second Semester</option>
                            </select>

                            @error('semester')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="col-md-3">
                            <label for="level" class="form-label">Level: </label>
                            <select name="level" class="form-control @error('level') is-invalid @enderror" id=""required autocomplete="level" autofocus>
                                <option>- Select an Option -</option>
                                <option value="first">First level</option>
                                <option value="second">Second level</option>
                            </select>

                            @error('level')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="col-md-3">
                            <button type="submit" class="btn d-block btn-second" style="width: 100%; margin-top:30px">
                                {{ __('Fetch Students') }}
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-12">
                <div class="card border-0 shadow p-3">
                    <h5 class="text-kdis-2">Students</h5>
                    <table class="table datatable-benpoly" style="width:100%">
                        <thead>
                            <tr>
                                <th>S/N</th>
                                <th>Username</th>
                                <th>Device Type</th>
                                <th>Data Usage</th>
                                <th>Duration</th>
                                <th>Time Left</th>
                                <th>Amount</th>
                                <th>Date</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            {{--  --}}
                        </tbody>
                        <tfoot>
                            <tr>
                                <th>S/N</th>
                                <th>Username</th>
                                <th>Device Type</th>
                                <th>Data Usage</th>
                                <th>Duration</th>
                                <th>Time Left</th>
                                <th>Amount</th>
                                <th>Date</th>
                                <th>Action</th>
                            </tr>
                        </tfoot>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
