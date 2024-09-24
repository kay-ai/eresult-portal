<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Print Results | E-Result Portal</title>
    <link rel="stylesheet" href="{{ 'css/style.css' }}">
    <!-- Font Awesome for icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/boxicons@latest/css/boxicons.min.css">
    <style>
        *{
            box-sizing: border-box;
        }
        .text-center{
            text-align: center;
        }
        .full-width{
            width: 100%;
            float: left;
        }
    </style>
</head>

<body>

    <div class="full-width">
        <h3 class="text-center">{{$department->name}} Department<br>{{$account->school}}<br>{{$department->faculty->name}}<br>{{$department->name}} Result for {{ $level }} Level, {{ $semester }} Semester, Session:
            {{ $session }}</h3>
    </div>

    <div class="full-width">

        <table style="width:100%">
            <tr>
                <th style="width:30%">
                    <table style="width:100%;float:left;font-size: 11px;border-collapse:collapse;margin-bottom:10px;text-align:left" border="1" cellpadding="1" cellspacing="1">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Course Title</th>
                                <th>Code</th>
                                <th>Unit</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php
                                $total_course_units = [];
                            @endphp
                            @if($courses)
                                @foreach($courses as $key => $course)
                                @php
                                $total_course_units[] = $course->unit;
                                @endphp
                                <tr>
                                    <td>{{($key+1)}}</td>
                                    <td>{{$course->title}}</td>
                                    <td>{{strtoupper($course->code)}}</td>
                                    <td>{{$course->unit}}</td>
                                </tr>
                                @endforeach
                            @endif
                            <tr>
                                <td colspan="2"></td>
                                <td>Total</td>
                                <td>{{array_sum($total_course_units)}}</td>
                            </tr>
                        </tbody>
                    </table>
                </th>
                <th style="width:40%;text-align:center">
                    <img src="{{asset('storage/'.auth()->user()->account->logo ?? null)}}" class="img-fluid" style="width:200px;height:200px;border-radius:50%">
                    <div style="width:100%;float:left;margin-top:15px">
                        <div class="col-md-4 m-auto">
                            <p>NUMBER OF STUDENTS: {{count($results)}}</p>
                        </div>
                    </div>
                </th>
                <th style="width:30%">
                    <table style="width:100%;float:left;font-size: 11px;border-collapse:collapse;margin-bottom:10px;text-align:left" border="1">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Code</th>
                                <th>Meaning</th>
                            </tr>
                        </thead>
                        <tbody>

                            <tr>
                                <td>1</td>
                                <td>CU</td>
                                <td>Credit Unit</td>
                            </tr>
                            <tr>
                                <td>2</td>
                                <td>CCU</td>
                                <td>Cumulative Credit Unit</td>
                            </tr>
                            <tr>
                                <td>3</td>
                                <td>CF</td>
                                <td>Credit Failed</td>
                            </tr>

                            <tr>
                                <td>4</td>
                                <td>CUF</td>
                                <td>Credit Unit Failed</td>
                            </tr>
                            <tr>
                                <td>5</td>
                                <td>%F</td>
                                <td>Percentage of Failure</td>
                            </tr>

                            <tr>
                                <td>6</td>
                                <td>CGP</td>
                                <td>Cumulative Grade Point</td>
                            </tr>

                            <tr>
                                <td>7</td>
                                <td>CGP</td>
                                <td>Cumulative Grade Point Average</td>
                            </tr>

                            <tr>
                                <td>8</td>
                                <td>ECO</td>
                                <td>External Carryover</td>
                            </tr>

                            <tr>
                                <td>9</td>
                                <td>AB</td>
                                <td>Absent</td>
                            </tr>

                        </tbody>
                    </table>
                </th>
            </tr>
        </table>

    </div>

    <table width="100%" border="1" cellpadding="1" cellspacing="1" style="font-size: 70%;border-collapse:collapse;margin-bottom:30px">
        <tr>
            <th scope="col" class="text-center">S/N</th>
            <th scope="col" class="text-center">Full Name </th>
            <th scope="col" class="text-center">Matric Num </th>
            <th scope="col">
                <table border="1" style="width:100%;border-collapse:collapse" cellpadding="1">
                    <tr>
                        @php
                        if(count($courses) < 11){
                            $cells = 11 - count($courses);
                        }else{
                            $cells = 0;
                        }
                        @endphp
                        @if($courses)
                            @foreach($courses as $key => $course)
                            <th scope="col" style="width: 9%">{{strtoupper($course->code)}}</th>
                            @endforeach
                            @for($c = 0; $c < $cells; $c++)
                            <th scope="col"></th>
                            @endfor
                        @endif
                    </tr>
                    <tr>
                    @if($courses)
                        @foreach($courses as $key => $course)
                        <td style="width: 9%">{{$course->unit}}</td>
                        @endforeach
                        @for($c = 0; $c < $cells; $c++)
                            <td scope="col" style="width: 9%"></td>
                        @endfor
                    @endif
                    </tr>
                </table>
            </th>
            <th class="text-center">CCU</th>
            <th class="text-center">CF</th>
            <th class="text-center">CUF</th>
            <th class="text-center">%F</th>
            <th class="text-center">GPA</th>
            <th class="text-center">Prev GPA</th>
            <th class="text-center">CGPA</th>
            <th scope="col" class="text-center">
                <table border="1" style="width:100%;border-collapse:collapse" cellpadding="1">
                    <tr>
                        <th colspan="2">REMARK</th>
                    </tr>
                    <tr>
                        <th style="width:80%">CARRYOVER(S)/<br>REMARk</th>
                        <th style="width:20%">STATUS</th>
                    </tr>
                </table>
            </th>
        </tr>

        @if ($results)

            @foreach ($results as $key => $r)
                @php
                    $cc1 = $r->cc1;
                    $g1 = $r->grade1;
                    $gp = $r->gpa;
                    $cuf = [];
                    $remarks = unserialize($r->remarks);
                    if (empty($remarks)) {
                        $ov_rmk = '';
                        $status = "PASS";
                    } else {
                        $ov_rmk = implode(',', $remarks);
                        $status = "";
                        foreach($remarks as $rmk){
                            foreach ($courses as $course) {
                                if (strtoupper($course['code']) === strtoupper($rmk)) {
                                    $cuf[] = $course['unit'];
                                }
                            }
                        }
                    }

                    $student = App\Models\Student::where('mat_num',$r->mat_num)->first();

                @endphp

                <tr>
                    <td scope="col">{{ $key + 1 }}</td>
                    <td scope="col" class="text-center"><b>{{$student->lname}}</b> {{$student->fname}}</td>
                    <td scope="col" class="text-center">{{ $r->mat_num }}</td>
                    <td scope="col" style="padding: 0!important">

                        <table border="1" style="width:100%;border-collapse:collapse" cellpadding="1">

                            <tr>
                                <td class="text-center" style="width: 9%">{{ $r->score1 }}</td>
                                <td class="text-center" style="width: 9%">{{ $r->score2 }}</td>
                                <td class="text-center" style="width: 9%">{{ $r->score3 }}</td>
                                <td class="text-center" style="width: 9%">{{ $r->score4 }}</td>
                                <td class="text-center" style="width: 9%">{{ $r->score5 }}</td>
                                <td class="text-center" style="width: 9%">{{ $r->score6 }}</td>
                                <td class="text-center" style="width: 9%">{{ $r->score7 }}</td>
                                <td class="text-center" style="width: 9%">{{ $r->score8 }}</td>
                                <td class="text-center" style="width: 9%">{{ $r->score9 }}</td>
                                <td class="text-center" style="width: 9%">{{ $r->score10 }}</td>
                                <td class="text-center" style="width: 9%">{{ $r->score11 }}</td>
                            </tr>
                        </table>

                    </td>

                    <td class="text-center">{{ $r->tcu }}</td>
                    <td class="text-center">{{ count($remarks) < 1 ? '-' : count($remarks) }}</td> <!--removed tce-->
                    <td class="text-center">{{ array_sum($cuf) < 1 ? '-' : array_sum($cuf) }}</td>
                    <td class="text-center">{{ (count($remarks)/count($courses) * 100) == 0 ? '-' : count($remarks)/count($courses) * 100 }}</td>
                    <td class="text-center">{{ $r->gpa }}</td>

                    <td class="text-center">{{$r->pgpa}}</td>
                    <td class="text-center">{{$r->cgpa}}</td>

                    <td scope="col" class="text-center" style="padding: 0!important">
                        <table border="1" style="width:100%;border-collapse:collapse" cellpadding="1">
                            <tr>
                                <td style="width:80%">{{ $ov_rmk }}</td>
                                <td style="width:20%">{{ $status }}</td>
                            </tr>
                        </table>
                    </td>
                </tr>
            @endforeach
        @else
            <tr>
                <td colspan="10">No data found...</td>
            </tr>
        @endif

    </table>

    <table width="100%" style="text-align: center">
        <tr>
            <th style="width: 33%"></th>
            <th style="width: 33%"></th>
            <th style="width: 33%"></th>
        </tr>
        <tr>
            <td>EXAM SUPERVISOR</td>
            <td>HOD/ASST.CHIEF EXAMINER</td>
            <td>DEAN/CHIEF EXAMINER</td>
        </tr>
    </table>

    @include('partials.bottom-scripts')
</body>

</html>
