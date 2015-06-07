@extends('app')

@section('content')
    <div class="page-title">
        <div class="container">
            <div class="row">
                <div class="col-md-6">
                    <h3>Create New Question</h3>
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


            <form class="form-horizontal" role="form" method="POST" action="{{ route('questions.store') }}">
                <input type="hidden" name="_token" value="{{ csrf_token() }}">

                <div class="form-group">
                    <label class="col-md-4 control-label">Title :</label>
                    <div class="col-md-6">
                        <input type="text" class="form-control" name="title" value="{{ old('title') }}">
                    </div>
                </div>

                <div class="form-group">
                    <label class="col-md-4 control-label">Body (Actual Question ) :</label>
                    <div class="col-md-6">
                        <textarea name="body" class="form-control" rows="8">{{ old('body') }}</textarea>
                    </div>
                </div>



                <div class="form-group">
                    <label class="col-md-4 control-label">Choose Language :</label>
                    <div class="col-md-6">
                        <select name="language" id="language" class="form-control">
                            <option value="c">C</option>
                            <option value="c++">C++</option>
                            <option value="java">Java</option>
                            <option value="php">Php</option>
                            <option value="python">Python</option>
                        </select>
                    </div>
                </div>

                <div class="form-group">
                    <label class="col-md-4 control-label">Any Note's ? ( Optional ):</label>
                    <div class="col-md-6">
                        <textarea name="note" class="form-control" rows="2">{{ old('notes') }}</textarea>
                    </div>
                </div>

                <div class="form-group">
                    <div class="col-md-6 col-md-offset-4">
                        <input type="hidden" name="created_by" value="{{ Auth::user()->id }}"/>
                        <input type="hidden" name="exam_code" value="{{ Auth::user()->id }}"/>
                        <button type="submit" class="btn btn-lg btn-primary">Create New Question</button>

                        <button type="reset" class="btn btn-link">Clear</button>
                    </div>
                </div>
            </form>
    </div>
@endsection
