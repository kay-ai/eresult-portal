@extends('layouts.app')

@section('content')
    <div class="me-2">
        <div class="row">
            <div class="col-md-3">
                <div class="card border-0 shadow-sm">
                    <div class="card-body p-0">
                        <div class="card-text border-bottom p-3">
                            <small class="text-secondary">
                                <i class="fa fa-address-book me-2" aria-hidden="true"></i> Total number of subscribers
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
                        <div class="card-text p-3">
                            <div class="d-flex justify-content-between">
                                <small class="text-secondary">Yesterday</small>
                                <small class="text-dark"> 1,011 (9.99%)</small>
                            </div>
                            <div class="d-flex justify-content-between">
                                <small class="text-secondary">Last Week</small>
                                <small class="text-dark"> 8,289 (12.65%)</small>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-3">
                <div class="card border-0 shadow-sm">
                    <div class="card-body p-0">
                        <div class="card-text border-bottom p-3">
                            <small class="text-secondary">
                                <i class="fa fa-wifi me-2" aria-hidden="true"></i> Hotspot Usage
                            </small>
                        </div>
                        <div class="border-bottom px-3 py-2">
                            <div class="d-flex justify-content-between align-items-center">
                                <p style="font-size: 25px; font-weight:600;">199 <span class="text-kdis">TB</span></p>
                                <small class="text-dark">
                                    59.90% <i class="fa fa-chevron-up text-success" aria-hidden="true"></i>
                                </small>
                            </div>
                        </div>
                        <div class="card-text p-3">
                            <div class="d-flex justify-content-between">
                                <small class="text-secondary">Yesterday</small>
                                <small class="text-dark"> 1,011 (9.99%)</small>
                            </div>
                            <div class="d-flex justify-content-between">
                                <small class="text-secondary">Last Week</small>
                                <small class="text-dark"> 8,289 (12.65%)</small>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-3">
                <div class="card border-0 shadow-sm">
                    <div class="card-body p-0">
                        <div class="card-text border-bottom p-3">
                            <small class="text-secondary">
                                <i class="fa fa-print me-2" aria-hidden="true"></i> Support Tickets
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
                        <div class="card-text p-3">
                            <div class="d-flex justify-content-between">
                                <small class="text-secondary">Yesterday</small>
                                <small class="text-dark"> 1,011 (9.99%)</small>
                            </div>
                            <div class="d-flex justify-content-between">
                                <small class="text-secondary">Last Week</small>
                                <small class="text-dark"> 8,289 (12.65%)</small>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-3">
                <div class="card border-0 shadow-sm">
                    <div class="card-body p-0">
                        <div class="card-text border-bottom p-3">
                            <small class="text-secondary">
                                <i class="fa fa-user me-2" aria-hidden="true"></i> Active Users
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
                        <div class="card-text p-3">
                            <div class="d-flex justify-content-between">
                                <small class="text-secondary">Yesterday</small>
                                <small class="text-dark"> 1,011 (9.99%)</small>
                            </div>
                            <div class="d-flex justify-content-between">
                                <small class="text-secondary">Last Week</small>
                                <small class="text-dark"> 8,289 (12.65%)</small>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="row mt-4">
            <div class="col-md-12">
                <p class="py-3 card-title">User Data usage overview</p>
                <div class="card border-0 shadow-sm">
                    <canvas id="dashboardLineChart" style="height: 400px;"></canvas>
                </div>
            </div>
        </div>

        {{-- Users Datatable --}}
        <div class="row mt-4">
            <div class="col-md-12">
                <p class="py-3 card-title">Real time monitoring</p>
                <div class="card border-0 shadow-sm p-3">
                    <table id="users_table" class="table" style="width:100%">
                        <thead>
                            <tr>
                                <th>S/N</th>
                                <th>Username</th>
                                <th>Device Type</th>
                                <th>Data Usage(mb)</th>
                                <th>Duration</th>
                                <th>Amount</th>
                                <th>Date</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @if ($users)
                                @foreach ($users as $key => $user)
                                    <tr>
                                        <td>{{$key+1}}</td>
                                        <td>{{$user->username}}</td>
                                        <td>{{__('macOS')}}</td>
                                        <td>{{__('3049')}}</td>
                                        <td>{{__('1h 25m')}}</td>
                                        <td>{{__('2500')}}</td>
                                        <td>2018/04/25</td>
                                        <td>
                                            <div class="btn-group btn-group-sm" role="group" aria-label="">
                                                <button type="button" class="btn btn-danger">
                                                    <i class="fa fa-trash" aria-hidden="true"></i>
                                                </button>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            @endif
                        </tbody>
                        <tfoot>
                            <tr>
                                <th>S/N</th>
                                <th>Username</th>
                                <th>Device Type</th>
                                <th>Data Usage</th>
                                <th>Duration</th>
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

@push('js')
    <script>
        $(document).ready(function() {
            $('#users_table').DataTable({
                dom: 'Bfrtip',
                buttons: [
                    'copy', 'csv', 'excel', 'pdf', 'print'
                ]
            });
        });
    </script>
@endpush
