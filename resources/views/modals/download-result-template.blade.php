<!-- Modal -->
<div class="modal fade" id="download-result-template" tabindex="-1" role="dialog" aria-labelledby="modal_title" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content">
            <div class="d-flex p-3 justify-content-between">
                <h5 id="modal_title" class="modal-title">Download Template</h5>
                <div type="button" class="ml-auto" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </div>
            </div>
            <form action="{{route('results.template.download')}}" method="post">
                @csrf
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-12 p-3">
                            <div class="row">
                                <div class="col-md-3">
                                    <label for="semester" class="form-label">Semester: </label>
                                    <select name="semester" class="form-control @error('semester') is-invalid @enderror" id=""required autocomplete="semester" autofocus>
                                        <option>- Select an Option -</option>
                                        <option value="First">First Semester</option>
                                        <option value="Second">Second Semester</option>
                                    </select>

                                    @error('semester')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                <div class="col-md-3">
                                    <label for="level_id" class="form-label">Level: </label>
                                    <select name="level_id" class="form-control @error('level') is-invalid @enderror" id="" required autocomplete="level" autofocus>
                                        <option>- Select an Option -</option>
                                        @if ($levels)
                                            @foreach ($levels as $level)
                                                <option value="{{$level->id}}">{{$level->name}}</option>
                                            @endforeach
                                        @endif
                                    </select>

                                    @error('level')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                <div class="col-md-3">
                                    <label for="department_id" class="form-label">Department: </label>
                                    <select name="department_id" class="form-control @error('level') is-invalid @enderror" id="" required autocomplete="level" autofocus>
                                        <option>- Select an Option -</option>
                                        @if ($departments)
                                            @foreach ($departments as $department)
                                                <option value="{{$department->id}}">{{$department->name}}</option>
                                            @endforeach
                                        @endif
                                    </select>

                                    @error('level')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                <div class="col-md-3">
                                <button type="submit" class="btn d-block btn-second" style="width: 100%; margin-top:20px">
                                    {{ __('Download') }}
                                </button>
                            </div>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
