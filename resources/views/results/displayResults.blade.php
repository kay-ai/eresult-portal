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
                            @if($courses)
                                @foreach($courses as $key => $course)
                                <tr>
                                    <td>{{($key+1)}}</td>
                                    <td>{{$course->title}}</td>
                                    <td>{{$course->code}}</td>
                                    <td>{{$course->unit}}</td>
                                </tr>
                                @endforeach
                            @endif
                        </tbody>
                    </table>
                </th>
                <th style="width:40%;text-align:center">
                    <img src="{{asset('storage/'.auth()->user()->account->logo ?? null)}}" class="img-fluid" style="width:200px;height:200px;border-radius:50%">
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

    <div class="full-width">




    </div>

    <table width="100%" border="1" cellpadding="1" cellspacing="1" style="font-size: 70%;border-collapse:collapse">
        <tr>
            <th scope="col" class="text-center">S/N</th>
            <th scope="col" class="text-center">Full Name </th>
            <th scope="col" class="text-center">Matric Num </th>
            <th scope="col">
                <table border="1" style="width:100%;border-collapse:collapse" cellpadding="1">
                    <tr>
                    @if($courses)
                        @foreach($courses as $key => $course)
                        <th scope="col">{{$course->code}}</th>
                        @endforeach
                    @endif
                    </tr>
                    <tr>
                    @if($courses)
                        @foreach($courses as $key => $course)
                        <td>{{$course->unit}}</td>
                        @endforeach
                    @endif
                    </tr>
                </table>
            </th>
            <th class="text-center">TCC</th>
            <th class="text-center">TCE</th>
            <th class="text-center">TGP</th>
            <th class="text-center">GPA</th>
            <th scope="col" class="text-center">Remarks</th>
        </tr>

        @if ($results)

            @foreach ($results as $key => $r)
                @php
                    $cc1 = $r->cc1;
                    $g1 = $r->grade1;
                    $gp = $r->gpa;
                    $remarks = unserialize($r->remarks);
                    if (empty($remarks)) {
                        $ov_rmk = 'PASS';
                    } else {
                        $ov_rmk = implode(',', $remarks);
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
                                <td class="text-center">{{ $r->cc1 }}
                                </td>
                                <td class="text-center">{{ $r->cc2 }}
                                </td>
                                <td class="text-center">{{ $r->cc3 }}
                                </td>
                                <td class="text-center">{{ $r->cc4 }}
                                </td>
                                <td class="text-center">{{ $r->cc5 }}
                                </td>
                                <td class="text-center">{{ $r->cc6 }}
                                </td>
                                <td class="text-center">
                                    {{ $r->cc7 }}
                                </td>
                                <td class="text-center">
                                    {{ $r->cc8 }}
                                </td>
                                <td class="text-center">{{ $r->cc9 }}
                                </td>
                                <td class="text-center">
                                    {{ $r->cc10 }}
                                </td>
                                <td class="text-center">
                                    {{ $r->cc11 }}
                                </td>
                            </tr>

                            <tr>
                                <td class="text-center">{{ $r->score1 }} {{ $r->grade1 }}</td>
                                <td class="text-center">{{ $r->score2 }} {{ $r->grade2 }}</td>
                                <td class="text-center">{{ $r->score3 }} {{ $r->grade3 }}</td>
                                <td class="text-center">{{ $r->score4 }} {{ $r->grade4 }}</td>
                                <td class="text-center">{{ $r->score5 }} {{ $r->grade5 }}</td>
                                <td class="text-center">{{ $r->score6 }} {{ $r->grade6 }}</td>
                                <td class="text-center">{{ $r->score7 }} {{ $r->grade7 }}</td>
                                <td class="text-center">{{ $r->score8 }} {{ $r->grade8 }}</td>
                                <td class="text-center">{{ $r->score9 }} {{ $r->grade9 }}</td>
                                <td class="text-center">{{ $r->score10 }} {{ $r->grade10 }}</td>
                                <td class="text-center">{{ $r->score11 }} {{ $r->grade11 }}</td>
                            </tr>
                        </table>

                    </td>

                    <td class="text-center">{{ $r->tcu }}</td>
                    <td class="text-center">{{ $r->tce }}</td>
                    <td class="text-center">{{ $r->tgp }}</td>
                    <td class="text-center">{{ $r->gpa }}</td>

                    <td class="text-center">{{ $ov_rmk }}</td>
                </tr>
            @endforeach
        @else
            <tr>
                <td colspan="10">No data found...</td>
            </tr>
        @endif

    </table>

    @php
        // function getCtype($cc)
        // {
        //     $course = App\Models\Course::where('code', $cc)->first();
        //     if($course){
        //         return $course->type;
        //     }
        //     return null;
        // }
    @endphp
    @include('partials.bottom-scripts')
</body>

</html>
