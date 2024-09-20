<!-- Modal -->
@push('css')
    <style>
        .answer{
            border-bottom: 1.5px solid black;
            padding-bottom: 3px;
            width: 170px;
            display: block;
            font-weight: 300;
        }

        .transcript-modal{
            position: relative;
            min-width: 800px;
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
<div class="modal fade" id="view-transcript" tabindex="-1" role="dialog" aria-labelledby="modal_title" aria-hidden="true">
    <div class="modal-lg modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content transcript-modal" style="">
            <div class="d-flex p-3 justify-content-between pb-0" style="z-index: 2;">
                {{-- <h5 id="modal_title" class="modal-title">View Transcript</h5> --}}
                <button type="button" class="btn btn-second" onclick="printTranscript()" style="font-size: 12px; height: 35px;">Print</button>
                <div type="button" class="ml-auto" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </div>
            </div>
            <div class="modal-body pt-0">
                <div class="text-center">
                    <h1 class="text-kdis mb-0" style="font-size: 30px;font-weight: 900;">BENUE STATE POLYTECHNIC, UBOKOLO</h1>
                    <h4 class="text-kdis-2" style="font-size: 13px; font-weight: 300; font-style:italic;">{{auth()->user()->account->motto}}</h4>
                    <h4 style="font-size: 18px;font-weight: 300;">(Office of the Registrar)</h4>
                    <div class="d-flex gap-3 justify-content-center align-items-center">
                        <img src="{{asset('storage/'.auth()->user()->account->logo ?? null)}}" class="img-fluid" style="width:80px;height:80px;border-radius:50%; margin-left: 80px;">
                        <div class="school-details" style="text-align: left;">
                            <p style="font-weight: 500;">Address: <span style="font-weight:300">{{auth()->user()->account->address}}</span></p>
                            <p style="font-weight: 500;">Email: <span style="font-weight:300">{{auth()->user()->account->email}}</span></p>
                            <p style="font-weight: 500;">POB: <span style="font-weight:300">{{auth()->user()->account->pob}}</span></p>
                        </div>
                    </div>
                    <h1 class="m-auto mb-0 mt-2 px-4 py-2 text-white" style="font-size: 20px;font-weight: 500; background:#029ee6;width: max-content;border-radius: 10px;">TRANSCRIPT OF ACADEMIC RECORDS</h1>
                </div>
                <div class="row mt-4 mx-auto" style="width: 715px;">
                    <div class="col-md-6 d-flex gap-2 mb-1" style="font-size: 14px;">
                        <span style="font-weight: 500;">Surname:</span>
                        <span class="answer" id="surname" style="width:240px;">Ameachi</span>
                    </div>
                    <div class="col-md-6 d-flex gap-2 mb-1" style="font-size: 14px;">
                        <span style="font-weight: 500;">Other Names:</span>
                        <span class="answer" id="other_names" style="width:230px;">Chinonso Abraham</span>
                    </div>
                    <div class="col-md-6 d-flex gap-2 mb-1" style="font-size: 14px;">
                        <span style="font-weight: 500;">Nationality:</span>
                        <span class="answer" id="nationality" style="width:228px;">Nigerian</span>
                    </div>
                    <div class="col-md-6 d-flex gap-2 mb-1" style="font-size: 14px;">
                        <span style="font-weight: 500;">State (if a Nigerian):</span>
                        <span class="answer" id="state" style="width:189px;">Kogi</span>
                    </div>
                    <div class="col-md-6 d-flex gap-2 mb-1" style="font-size: 14px;">
                        <span style="font-weight: 500;">Date of Birth:</span>
                        <span class="answer" id="dob" style="width:217px;"></span>
                    </div>
                    <div class="col-md-6 d-flex gap-2 mb-1" style="font-size: 14px;">
                        <span style="font-weight: 500;">Place of Birth:</span>
                        <span class="answer" id="pob" style="width:105px;"></span>
                        <span style="font-weight: 500;">Sex:</span>
                        <span class="answer" id="sex" style="width:80px;">Male</span>
                    </div>
                    <div class="col-md-6 d-flex gap-2 mb-1" style="font-size: 14px;">
                        <span style="font-weight: 500;">Matriculation Number:</span>
                        <span class="answer" id="state" style="width:160px;">15MS1044</span>
                    </div>
                    <div class="col-md-6 d-flex gap-2 mb-1" style="font-size: 14px;">
                        <span style="font-weight: 500;">Year of Entry:</span>
                        <span class="answer" id="dob" style="width:235px;">2023</span>
                    </div>
                    <div class="col-md-12 d-flex gap-2 mb-1" style="font-size: 14px;">
                        <span style="font-weight: 500;">Department:</span>
                        <span class="answer text-center" id="dob" style="width:600px;">Department of Electrical Electronics</span>
                    </div>
                    <div class="col-md-12 d-flex gap-2 mb-1" style="font-size: 14px;">
                        <span style="font-weight: 500;">School:</span>
                        <span class="answer text-center" id="dob" style="width:600px;">SCHOOL OF ENGINEERING TECHNOLOGY</span>
                        <span style="font-weight: 500;">CGPA:</span>
                        <span class="answer" id="sex" style="width:80px;">2.82</span>
                    </div>
                </div>
                <div class="row mx-4 mt-4 table-responsive">
                    <table class="table table-bordered table-striped table-inverse mb-0" style="font-size: 12px;">
                        <thead>
                            <tr>
                                <th class="text-center" colspan="7">SESSION: <span id="session">2023/2024</span> SEMESTER: <span id="semester">First</span> </th>
                            </tr>
                            <tr>
                                <th>Course Code</th>
                                <th>Course Title</th>
                                <th>Course Unit</th>
                                <th>Marks</th>
                                <th>Grade</th>
                                <th>Point Scored</th>
                                <th>Weighted Points</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>GNS 311</td>
                                <td>English</td>
                                <td>2</td>
                                <td>50</td>
                                <td>CD</td>
                                <td>5.00</td>
                                <td></td>
                            </tr>
                            <tr>
                                <td>GNS 312</td>
                                <td>Assorted</td>
                                <td>2</td>
                                <td>55</td>
                                <td>C</td>
                                <td>5.50</td>
                                <td></td>
                            </tr>
                            <tr>
                                <td>MTH 311</td>
                                <td>Advanced Algebra</td>
                                <td>2</td>
                                <td>71</td>
                                <td>AB</td>
                                <td>7.00</td>
                                <td></td>
                            </tr>
                            <tr>
                                <td>MEC 311</td>
                                <td>Foundamental of Engr. Design</td>
                                <td>3</td>
                                <td>51</td>
                                <td>D</td>
                                <td>7.50</td>
                                <td></td>
                            </tr>
                            <tr>
                                <td>MEC 312</td>
                                <td>Strength of Materials</td>
                                <td>3</td>
                                <td>46</td>
                                <td>E</td>
                                <td>6.75</td>
                                <td></td>
                            </tr>
                            <tr>
                                <td>MEC 313</td>
                                <td>Mechanics of Machines</td>
                                <td>2</td>
                                <td>40</td>
                                <td>CD</td>
                                <td>4.00</td>
                                <td></td>
                            </tr>
                        </tbody>
                        <tfoot style="font-weight: 500;">
                            <tr>
                                <td></td>
                                <td>Total</td>
                                <td>23</td>
                                <td></td>
                                <td></td>
                                <td>59.25</td>
                                <td></td>
                            </tr>
                        </tfoot>
                    </table>
                    <div class="col-md-12">
                        <div class="d-flex justify-content-end">
                            <span style="font-weight: 500">GPA:&nbsp;</span>
                            <span>2.57</span>
                        </div>
                    </div>
                </div>
                <div class="row mx-4 mt-4 table-responsive">
                    <table class="table table-bordered table-striped table-inverse" style="font-size: 12px;">
                        <thead>
                            <tr>
                                <th class="text-center" colspan="7">SESSION: <span id="session">2023/2024</span> SEMESTER: <span id="semester">Second</span> </th>
                            </tr>
                            <tr>
                                <th>Course Code</th>
                                <th>Course Title</th>
                                <th>Course Unit</th>
                                <th>Marks</th>
                                <th>Grade</th>
                                <th>Point Scored</th>
                                <th>Weighted Points</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>GNS 311</td>
                                <td>English</td>
                                <td>2</td>
                                <td>50</td>
                                <td>CD</td>
                                <td>5.00</td>
                                <td></td>
                            </tr>
                            <tr>
                                <td>GNS 312</td>
                                <td>Assorted</td>
                                <td>2</td>
                                <td>55</td>
                                <td>C</td>
                                <td>5.50</td>
                                <td></td>
                            </tr>
                            <tr>
                                <td>MTH 311</td>
                                <td>Advanced Algebra</td>
                                <td>2</td>
                                <td>71</td>
                                <td>AB</td>
                                <td>7.00</td>
                                <td></td>
                            </tr>
                            <tr>
                                <td>MEC 311</td>
                                <td>Foundamental of Engr. Design</td>
                                <td>3</td>
                                <td>51</td>
                                <td>D</td>
                                <td>7.50</td>
                                <td></td>
                            </tr>
                            <tr>
                                <td>MEC 312</td>
                                <td>Strength of Materials</td>
                                <td>3</td>
                                <td>46</td>
                                <td>E</td>
                                <td>6.75</td>
                                <td></td>
                            </tr>
                            <tr>
                                <td>MEC 313</td>
                                <td>Mechanics of Machines</td>
                                <td>2</td>
                                <td>40</td>
                                <td>CD</td>
                                <td>4.00</td>
                                <td></td>
                            </tr>
                        </tbody>
                        <tfoot style="font-weight: 500;">
                            <tr>
                                <td></td>
                                <td>Total</td>
                                <td>23</td>
                                <td></td>
                                <td></td>
                                <td>59.25</td>
                                <td></td>
                            </tr>
                        </tfoot>
                    </table>
                    <div class="col-md-12">
                        <div class="d-flex justify-content-end">
                            <span style="font-weight: 500">GPA:&nbsp;</span>
                            <span>2.75</span>
                        </div>
                    </div>
                </div>
                <div class="row mx-4 mt-4 table-responsive">
                    <table class="table table-bordered table-striped table-inverse" style="font-size: 12px;">
                        <thead>
                            <tr>
                                <th class="text-center" colspan="7">SESSION: <span id="session">2024/2025</span> SEMESTER: <span id="semester">First</span> </th>
                            </tr>
                            <tr>
                                <th>Course Code</th>
                                <th>Course Title</th>
                                <th>Course Unit</th>
                                <th>Marks</th>
                                <th>Grade</th>
                                <th>Point Scored</th>
                                <th>Weighted Points</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>GNS 311</td>
                                <td>English</td>
                                <td>2</td>
                                <td>50</td>
                                <td>CD</td>
                                <td>5.00</td>
                                <td></td>
                            </tr>
                            <tr>
                                <td>GNS 312</td>
                                <td>Assorted</td>
                                <td>2</td>
                                <td>55</td>
                                <td>C</td>
                                <td>5.50</td>
                                <td></td>
                            </tr>
                            <tr>
                                <td>MTH 311</td>
                                <td>Advanced Algebra</td>
                                <td>2</td>
                                <td>71</td>
                                <td>AB</td>
                                <td>7.00</td>
                                <td></td>
                            </tr>
                            <tr>
                                <td>MEC 311</td>
                                <td>Foundamental of Engr. Design</td>
                                <td>3</td>
                                <td>51</td>
                                <td>D</td>
                                <td>7.50</td>
                                <td></td>
                            </tr>
                            <tr>
                                <td>MEC 312</td>
                                <td>Strength of Materials</td>
                                <td>3</td>
                                <td>46</td>
                                <td>E</td>
                                <td>6.75</td>
                                <td></td>
                            </tr>
                            <tr>
                                <td>MEC 313</td>
                                <td>Mechanics of Machines</td>
                                <td>2</td>
                                <td>40</td>
                                <td>CD</td>
                                <td>4.00</td>
                                <td></td>
                            </tr>
                        </tbody>
                        <tfoot style="font-weight: 500;">
                            <tr>
                                <td></td>
                                <td>Total</td>
                                <td>23</td>
                                <td></td>
                                <td></td>
                                <td>59.25</td>
                                <td></td>
                            </tr>
                        </tfoot>
                    </table>
                    <div class="col-md-12">
                        <div class="d-flex justify-content-end">
                            <span style="font-weight: 500">GPA:&nbsp;</span>
                            <span>2.98</span>
                        </div>
                    </div>
                </div>
                <div class="row mx-4 mt-4 table-responsive">
                    <table class="table table-bordered table-striped table-inverse" style="font-size: 12px;">
                        <thead>
                            <tr>
                                <th class="text-center" colspan="7">SESSION: <span id="session">2023/2024</span> SEMESTER: <span id="semester">Second</span> </th>
                            </tr>
                            <tr>
                                <th>Course Code</th>
                                <th>Course Title</th>
                                <th>Course Unit</th>
                                <th>Marks</th>
                                <th>Grade</th>
                                <th>Point Scored</th>
                                <th>Weighted Points</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>GNS 311</td>
                                <td>English</td>
                                <td>2</td>
                                <td>50</td>
                                <td>CD</td>
                                <td>5.00</td>
                                <td></td>
                            </tr>
                            <tr>
                                <td>GNS 312</td>
                                <td>Assorted</td>
                                <td>2</td>
                                <td>55</td>
                                <td>C</td>
                                <td>5.50</td>
                                <td></td>
                            </tr>
                            <tr>
                                <td>MTH 311</td>
                                <td>Advanced Algebra</td>
                                <td>2</td>
                                <td>71</td>
                                <td>AB</td>
                                <td>7.00</td>
                                <td></td>
                            </tr>
                            <tr>
                                <td>MEC 311</td>
                                <td>Foundamental of Engr. Design</td>
                                <td>3</td>
                                <td>51</td>
                                <td>D</td>
                                <td>7.50</td>
                                <td></td>
                            </tr>
                            <tr>
                                <td>MEC 312</td>
                                <td>Strength of Materials</td>
                                <td>3</td>
                                <td>46</td>
                                <td>E</td>
                                <td>6.75</td>
                                <td></td>
                            </tr>
                            <tr>
                                <td>MEC 313</td>
                                <td>Mechanics of Machines</td>
                                <td>2</td>
                                <td>40</td>
                                <td>CD</td>
                                <td>4.00</td>
                                <td></td>
                            </tr>
                        </tbody>
                        <tfoot style="font-weight: 500;">
                            <tr>
                                <td></td>
                                <td>Total</td>
                                <td>23</td>
                                <td></td>
                                <td></td>
                                <td>59.25</td>
                                <td></td>
                            </tr>
                        </tfoot>
                    </table>
                    <div class="col-md-12">
                        <div class="d-flex justify-content-end">
                            <span style="font-weight: 500">GPA:&nbsp;</span>
                            <span>2.73</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

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
