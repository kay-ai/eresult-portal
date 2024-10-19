@extends('layouts.app', [($activePage = 'Transcript')])

@push('css')
    <style>
        .answer{
            border-bottom: 1.5px solid black;
            padding-bottom: 3px;
            width: 170px;
            display: block;
            font-weight: 400;
        }

        .transcript-modal{
            position: relative;
            max-width: 800px;
            min-height: 842px;
            background-color: #fff;
        }

        .transcript-modal::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background-image: url('{{asset('storage/'.auth()->user()->account->logo ?? null)}}');
            background-repeat: no-repeat;
            background-position: center;
            background-size: 700px;
            opacity: 0.1;
        }
    </style>
@endpush

@section('content')
    @include('modals.send-transcript')
    <div class="row justify-content-center">
        <div class="modal-content transcript-modal" style="">
            <div class="d-flex p-3 justify-content-between pb-0" style="z-index: 2;">
                <div class="btn-group btn-group-sm" role="group" aria-label="">
                    <button type="button" class="btn btn-second" onclick="printTranscript()" style="font-size: 12px; height: 35px;">Print <i class='bx bx-printer'></i></button>
                    <button type="button" class="btn btn-secondary" style="font-size: 12px; height: 35px;" data-toggle="modal" data-target="#send-transcript">Send <i class='bx bx-send'></i></button>
                </div>
                <div type="button" class="ml-auto" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </div>
            </div>
            <div class="modal-body pt-0">
                <div class="text-center">
                    <h1 class="text-kdis mb-0" style="font-size: 30px;font-weight: 900;">{{strtoupper($account->school)}}</h1>
                    <h4 class="text-kdis-2" style="font-size: 13px; font-weight: 300; font-style:italic;">{{$account->motto}}</h4>
                    <h4 style="font-size: 18px;font-weight: 300;">(Office of the Registrar)</h4>
                    <div class="d-flex gap-3 justify-content-center align-items-center">
                        <img src="{{asset('storage/'.$account->logo ?? null)}}" class="img-fluid" style="width:80px;height:80px;border-radius:50%; margin-left: 80px;">
                        <div class="school-details" style="text-align: left;">
                            <p style="font-weight: 500;">Address: <span style="font-weight:300">{{$account->address}}</span></p>
                            <p style="font-weight: 500;">Email: <span style="font-weight:300">{{$account->email}}</span></p>
                            <p style="font-weight: 500;">POB: <span style="font-weight:300">{{$account->pob}}</span></p>
                        </div>
                    </div>
                    <h1 class="m-auto mb-0 mt-2 px-4 py-2 text-white" style="font-size: 20px;font-weight: 500; background:#029ee6;width: max-content;border-radius: 10px;">TRANSCRIPT OF ACADEMIC RECORDS</h1>
                </div>
                <div class="row mt-4 mx-auto" style="width: 715px;">
                    <div class="col-md-6 d-flex gap-2 mb-1" style="font-size: 14px;">
                        <span style="font-weight: 500;">Surname:</span>
                        <span class="answer" id="surname" style="width:240px;">{{$student->lname}}</span>
                    </div>
                    <div class="col-md-6 d-flex gap-2 mb-1" style="font-size: 14px;">
                        <span style="font-weight: 500;">Other Names:</span>
                        <span class="answer" id="other_names" style="width:230px;">{{$student->mname . ' ' . $student->fname}}</span>
                    </div>
                    <div class="col-md-6 d-flex gap-2 mb-1" style="font-size: 14px;">
                        <span style="font-weight: 500;">Nationality:</span>
                        <span class="answer" id="nationality" style="width:228px;">Nigerian</span>
                    </div>
                    <div class="col-md-6 d-flex gap-2 mb-1" style="font-size: 14px;">
                        <span style="font-weight: 500;">State (if a Nigerian):</span>
                        <span class="answer" id="state" style="width:189px;"></span>
                    </div>
                    <div class="col-md-6 d-flex gap-2 mb-1" style="font-size: 14px;">
                        <span style="font-weight: 500;">Date of Birth:</span>
                        <span class="answer" id="dob" style="width:217px;"></span>
                    </div>
                    <div class="col-md-6 d-flex gap-2 mb-1" style="font-size: 14px;">
                        <span style="font-weight: 500;">Place of Birth:</span>
                        <span class="answer" id="pob" style="width:105px;"></span>
                        <span style="font-weight: 500;">Sex:</span>
                        <span class="answer" id="sex" style="width:80px;">{{$student->gender}}</span>
                    </div>
                    <div class="col-md-6 d-flex gap-2 mb-1" style="font-size: 14px;">
                        <span style="font-weight: 500;">Matriculation Number:</span>
                        <span class="answer" id="state" style="width:160px;">{{$student->mat_num}}</span>
                    </div>
                    <div class="col-md-6 d-flex gap-2 mb-1" style="font-size: 14px;">
                        <span style="font-weight: 500;">Year of Entry:</span>
                        <span class="answer" id="dob" style="width:235px;">{{$student->created_at->format('Y')}}</span>
                    </div>
                    <div class="col-md-12 d-flex gap-2 mb-1" style="font-size: 14px;">
                        <span style="font-weight: 500;">Department:</span>
                        <span class="answer text-center" id="dob" style="width:600px;">{{$department->name}}</span>
                    </div>
                    <div class="col-md-12 d-flex gap-2 mb-1" style="font-size: 14px;">
                        <span style="font-weight: 500;">School:</span>
                        <span class="answer text-center" id="dob" style="width:600px;">{{$department->faculty->name}}</span>
                        <span style="font-weight: 500;">CGPA:</span>
                        <span class="answer" id="sex" style="width:80px; font-weight:500;">{{$cgpa}}</span>
                    </div>
                </div>

                @foreach($transcript as $transcript)
                    <div class="row mx-4 mt-4 table-responsive">
                        <table class="table table-bordered table-striped table-inverse mb-0" style="font-size: 12px;">
                            <thead>
                                <tr>
                                    <th class="text-center" colspan="7">SESSION: <span id="session">{{$transcript['session']}}</span> | SEMESTER: <span id="semester">{{$transcript['semester']}}</span> </th>
                                </tr>
                                <tr>
                                    <th>Course Code</th>
                                    <th>Course Title</th>
                                    <th>Course Unit</th>
                                    <th>Marks</th>
                                    <th>Grade</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($transcript['courses'] as $course)
                                    <tr>
                                        <td>{{$course['code']}}</td>
                                        <td>{{$course['title']}}</td>
                                        <td>{{$course['cu']}}</td>
                                        <td>{{$course['score']}}</td>
                                        <td>{{$course['grade']}}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                            <tfoot style="font-weight: 500;">
                                <tr>
                                    <td></td>
                                    <td>Total</td>
                                    <td>{{$transcript['tcu']}}</td>
                                    <td></td>
                                    <td></td>
                                </tr>
                            </tfoot>
                        </table>
                        <div class="col-md-12">
                            <div class="d-flex justify-content-end">
                                <span style="font-weight: 500">GPA:&nbsp;</span>
                                <span>{{$transcript['gpa']}}</span>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>

@endsection

@push('js')
<script>
    function printTranscript() {
        var originalContent = document.body.innerHTML;
        var transcriptContent = document.querySelector('.transcript-modal').innerHTML;

        document.body.innerHTML = transcriptContent;
        window.print();
        document.body.innerHTML = originalContent;
        location.reload();
    }
</script>
@endpush
