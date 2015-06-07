@extends('app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-10 col-md-offset-1">
                <h3>Welcome {{ Auth::user()->role }}, {{ Auth::user()->email }}</h3>
                <p>
                    <button type="button" class="btn btn-primary btn-lg btn-home">Take Test</button>
                    <button type="button" class="btn btn-primary btn-lg btn-home" data-toggle="modal" data-target="#myModal">Enter Test Code</button>
                </p>
            </div>
        </div>
    </div>


    <!-- Modal -->
    <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="myModalLabel">Enter Exam Code</h4>
                </div>
                <div class="modal-body">
                    <form class="form-horizontal" role="form" method="get" action="{{ route('exam.create') }}">

                        <div class="form-group">
                            <label class="col-md-4 control-label">Exam Code</label>
                            <div class="col-md-6">
                                <input type="text" class="form-control" name="exam_code" required>
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-md-6 col-md-offset-4">

                                <button type="submit" class="btn btn-lg btn-primary">Start Exam</button>
                            </div>
                        </div>
                    </form>
                </div>

            </div>
        </div>
    </div>
@endsection
