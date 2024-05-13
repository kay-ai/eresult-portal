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
        .text-center{
            text-align: center;
        }
        .full-width{
            width: 100%;
        }
    </style>
</head>

<body>

    <div class="full-width">
        <table style="width:100%">
            <tr>
                <th style="width:10%"><img src="{{asset('storage/'.$account->logo)}}" class="img-fluid" style="width:80px;height:80px"></th>
                <th style="width:90%;text-align:center">
                    <h1 class="text-center">{{$account->school}}</h1>
                    <p class="text-center">Motto: {{$account->motto}}</p>
                </th>
            </tr>
            <tr>
                <td></td>
                <td><h2 class="text-center">{{$department->name}} Result for {{ $level }} Level, {{ $semester }} Semester, Session:
                    {{ $session }}
                </h2></td>
            </tr>
        </table>

    </div>

    <table width="100%" border="1" cellpadding="1" cellspacing="1"
        style="font-size: 70%;border-collapse:collapse">
        <tr>
            <th scope="col">S/N</th>
            <th scope="col">Full Name </th>
            <th scope="col">Matric Num </th>
            <th scope="col">

                <table style="width:100%" border="1" cellspacing="1" cellpadding="1">
                    <tr>
                        <th scope="col" style="text-align: center; width: 72.6%">Current Semester </th>
                    </tr>
                    <tr>
                        <td style="text-align: center" style="width: 72.6%">Core Courses </td>
                        <td style="width: 6.6%">TCC</td>
                        <td style="width: 6.6%">TCE</td>
                        <td style="width: 6.6%">TGP</td>
                        <td style="width: 6.6%">GPA</td>
                    </tr>
                </table>

            </th>
            <th scope="col">Remarks</th>
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
                    // $cgpa = getStdntCGPA($r['mat_num'], $level_id, $gp);

                    $student = App\Models\Student::where('mat_num',$r->mat_num)->first();
                @endphp


                <tr>
                    <th scope="col">{{ $key + 1 }}</th>
                    <th scope="col"><b>{{$student->lname}}</b> {{$student->fname}}</th>
                    <th scope="col">{{ $r->mat_num }}</th>
                    <th scope="col">

                        <table border="1" style="width:100%;border-collapse:collapse" cellspacing="1"
                            cellpadding="1">
                            <tr>
                                <td style="width: 6.6%">{{ $r->cc1 }}
                                    <br>
                                    {{ $r->cu1 }}
                                </td>
                                <td style="width: 6.6%">{{ $r->cc2 }}
                                    <br>
                                    {{ $r->cu2 }}
                                </td>
                                <td style="width: 6.6%">{{ $r->cc3 }}
                                    <br>
                                    {{ $r->cu3 }}
                                </td>
                                <td style="width: 6.6%">{{ $r->cc4 }}
                                    <br>
                                    {{ $r->cu4 }}
                                </td>
                                <td style="width: 6.6%">{{ $r->cc5 }}
                                    <br>
                                    {{ $r->cu5 }}
                                </td>
                                <td style="width: 6.6%">{{ $r->cc6 }}
                                    <br>
                                    {{ $r->cu6 }}
                                </td>
                                <td style="width: 6.6%">
                                    {{ $r->cc7 }}
                                    <br>
                                    {{ $r->cu7 }}
                                </td>
                                <td style="width: 6.6%">
                                    {{ $r->cc8 }}
                                    <br>
                                    {{ $r->cu8 }}
                                </td>
                                <td style="width: 6.6%">{{ $r->cc9 }} <br> {{ $r->cu9 }}</td>
                                <td style="width: 6.6%">{{ $r->cc10 }} <br> {{ $r->cu10 }}</td>
                                <td style="width: 6.6%">{{ $r->cc11 }} <br> {{ $r->cu11 }}</td>
                                <td style="width: 6.6%">{{ $r->tcu }}</td>
                                <td style="width: 6.6%">{{ $r->tce }}</td>
                                <td style="width: 6.6%">{{ $r->tgp }}</td>
                                <td style="width: 6.6%">{{ $r->gpa }}</td>
                            </tr>
                            <tr>
                                <td style="width: 6.6%">{{ $r->score1 }} {{ $r->grade1 }}
                                    {{ getCtype($r->cc1) }}</td>
                                <td style="width: 6.6%">{{ $r->score2 }} {{ $r->grade2 }}
                                    {{ getCtype($r->cc2) }}</td>
                                <td style="width: 6.6%">{{ $r->score3 }} {{ $r->grade3 }}
                                    {{ getCtype($r->cc3) }}</td>
                                <td style="width: 6.6%">{{ $r->score4 }} {{ $r->grade4 }}
                                    {{ getCtype($r->cc4) }}</td>
                                <td style="width: 6.6%">{{ $r->score5 }} {{ $r->grade5 }}
                                    {{ getCtype($r->cc5) }}</td>
                                <td style="width: 6.6%">{{ $r->score6 }} {{ $r->grade6 }}
                                    {{ getCtype($r->cc6) }}</td>
                                <td style="width: 6.6%">{{ $r->score7 }} {{ $r->grade7 }}
                                    {{ getCtype($r->cc7) }}</td>
                                <td style="width: 6.6%">{{ $r->score8 }} {{ $r->grade8 }}
                                    {{ getCtype($r->cc8) }}</td>
                                <td style="width: 6.6%">{{ $r->score9 }} {{ $r->grade9 }}
                                    {{ getCtype($r->cc9) }}</td>
                                <td style="width: 6.6%">{{ $r->score10 }} {{ $r->grade10 }}
                                    {{ getCtype($r->cc10) }}</td>
                                <td style="width: 6.6%">{{ $r->score11 }} {{ $r->grade11 }}
                                    {{ getCtype($r->cc11) }}</td>
                            </tr>
                        </table>
                    </th>

                    <th scope="col">{{ $ov_rmk }}</th>
                </tr>
            @endforeach
        @else
            <tr>
                <td colspan="10">No data found...</td>
            </tr>
        @endif

    </table>

    <table width="100%">
        <thead>
            <tr>
                <th style="width:33%;text-align:center">
                    <h4>HOD</h4>
                </th>
                <th style="width:33%;text-align:center">
                    <h4>Dean</h4>
                </th>
                <th style="width:33%;text-align:center">
                    <h4>Exam Officer</h4>
                </th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td style="text-align:center">{{$department->hod}}<br><img src="{{asset('storage/'.$department->signature)}}" class="img-fluid" style="width:200px;height:50px"></td>
                <td style="text-align:center"></td>
                <td style="text-align:center"></td>
            </tr>
        </tbody>
    </table>

    @php
        function getCtype($cc)
        {
            $course = App\Models\Course::where('code', $cc)->first();
            if($course){
                return $course->type;
            }
            return null;
        }
    @endphp
    @include('partials.bottom-scripts')
</body>

</html>
