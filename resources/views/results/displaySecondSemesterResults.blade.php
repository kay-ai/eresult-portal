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

    <table width="100%" border="1" cellpadding="1" cellspacing="1" style="font-size: 70%;border-collapse:collapse">
        <tr>
            <th scope="col" class="text-center">S/N</th>
            <th scope="col" class="text-center">Full Name </th>
            <th scope="col" class="text-center">Matric Num </th>
            <th scope="col">

                <h4 style="text-align: center;">Current Semester</h4>

            </th>
            <th class="text-center">TCC</th>
            <th class="text-center">TCE</th>
            <th class="text-center">TGP</th>
            <th class="text-center">GPA</th>

            <th class="text-center">Prev GPA</th>
            <th class="text-center">CGPA</th>
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
                    // $cgpa = getStdntCGPA($r['mat_num'], $level_id, $gp);

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
                                    <br>
                                    {{ $r->cu1 }}
                                </td>
                                <td class="text-center">{{ $r->cc2 }}
                                    <br>
                                    {{ $r->cu2 }}
                                </td>
                                <td class="text-center">{{ $r->cc3 }}
                                    <br>
                                    {{ $r->cu3 }}
                                </td>
                                <td class="text-center">{{ $r->cc4 }}
                                    <br>
                                    {{ $r->cu4 }}
                                </td>
                                <td class="text-center">{{ $r->cc5 }}
                                    <br>
                                    {{ $r->cu5 }}
                                </td>
                                <td class="text-center">{{ $r->cc6 }}
                                    <br>
                                    {{ $r->cu6 }}
                                </td>
                                <td class="text-center">
                                    {{ $r->cc7 }}
                                    <br>
                                    {{ $r->cu7 }}
                                </td>
                                <td class="text-center">
                                    {{ $r->cc8 }}
                                    <br>
                                    {{ $r->cu8 }}
                                </td>
                                <td class="text-center">{{ $r->cc9 }}
                                    <br>
                                    {{ $r->cu9 }}
                                </td>
                                <td class="text-center">
                                    {{ $r->cc10 }}
                                    <br>
                                    {{ $r->cu10 }}
                                </td>
                                <td class="text-center">
                                    {{ $r->cc11 }}
                                    <br>
                                    {{ $r->cu11 }}
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

                    <td class="text-center">{{$r->pgpa}}</td>
                    <td class="text-center">{{$r->cgpa}}</td>

                    <td class="text-center">{{ $ov_rmk }}</td>
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
    @include('partials.bottom-scripts')
</body>

</html>
