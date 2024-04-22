@extends('layouts.app')

@section('content')
    <div class="me-2">
        <div class="row">
            <div class="col-md-3">
                <div class="card border-0 shadow-sm">
                    <div class="card-body p-0">
                        <div class="card-text border-bottom p-3">
                            <small class="text-secondary">
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
                            <small class="text-secondary">
                                <i class="fa fa-wifi me-2" aria-hidden="true"></i> Total Results
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
                    </div>
                </div>
            </div>

            <div class="col-md-3">
                <div class="card border-0 shadow-sm">
                    <div class="card-body p-0">
                        <div class="card-text border-bottom p-3">
                            <small class="text-secondary">
                                <i class="fa fa-print me-2" aria-hidden="true"></i> Spillover Results
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
                            <small class="text-secondary">
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
