@extends('app')

@section('content')
    <div class="page-title">
        <div class="container">
            <div class="row">
                <div class="col-md-6">
                    <h3>Create Test Case For {{ $question->title }} Question</h3>
                </div>
                <div class="col-md-6">
                    <a href="{{ route('questions.create') }}" style="margin-top: 10px;" class="pull-right btn btn-primary btn-lg "><i class="fa fa-times"></i>Cancel and Go back</a>
                </div>
            </div>
        </div>
    </div>
    <div class="container">
        @if (count($errors) > 0)
            <div class="alert alert-danger">
                <strong>Whoops!</strong> There were some problems with your input.<br><br>
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif


        <form class="form" role="form" method="POST" action="{{ route('questions.testcases.store',[$question->id]) }}">
            <input type="hidden" name="_token" value="{{ csrf_token() }}">



            @for ($i = 0; $i < 5; $i++)

            <div class="panel panel-default">
                <div class="panel-heading">Test Case {{ $i+1 }}</div>
                <div class="panel-body">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="control-label">Input :( Seprate by comma ',' if multiple Input )</label>
                                <input type="text" class="form-control" name="input[]">
                            </div>

                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="control-label">output :( Seprate by comma ',' if multiple Output )</label>
                                <input type="text" class="form-control" name="output[]">
                            </div>
                        </div>
                    </div>

                </div>
            </div>
            @endfor

            <div class="form-group fgTestcases">
                <div class="form-group">
                    <button type="submit" class="btn btn-lg btn-primary">Create Test Case</button>

                    <button type="reset" class="btn btn-link">Clear</button>
                </div>
            </div>
        </form>
    </div>
@endsection
