@extends('app')

@section('content')
    <div class="page-title">
        <div class="container">
        <div class="row">
            <div class="col-md-6">
                <h3>Welcome {{ Auth::user()->role }}, {{ Auth::user()->email }}</h3>
            </div>
            <div class="col-md-6">
                <a href="{{ route('questions.create') }}" style="margin-top: 10px;" class="pull-right btn btn-primary btn-lg "><i class="fa fa-plus"></i>Create New Test</a>
            </div>
        </div>
        </div>
    </div>
    <div class="container">

        <div class="panel panel-primary">
            <div class="panel-heading">
                <h3 class="panel-title">All Questions</h3>
            </div>
            <div class="panel-body">
                <table id="allQuestions" class="table table-striped header-fixed">
                    <thead>
                    <tr>
                        <th>Title</th>
                        <th>Created on</th>
                        <th>Language</th>
                        <th>Ready For Exam ?</th>
                        <th>Action</th>
                    </tr>
                    </thead>
                    <tbody>
                        @foreach(Auth::user()->questions as $question)
                            <tr>
                                <td>{{ $question->title }}</td>
                                <td>{{ $question->created_at->format('d/m/Y') }}</td>
                                <td>{{ $question->language }}</td>

                                <td>
                                    @if( (count($question->testCases) ) ==  5)
                                        <i data-toggle="tooltip" data-placement="left" title="Yes Ready for exam " class="fa fa-check-circle-o fa-2x" style="color: green;">&nbsp;{{ $question->exam_code }}</i>
                                    @else
                                        <i data-toggle="tooltip" data-placement="right" title="Add all 5 Test Cases" class="fa fa-times-circle-o fa-2x" style="  color: rgb(228, 87, 87);"></i>
                                    @endif

                                </td>
                                <td>
                                    <a class="btn btn-small btn-info" href="{{ route('questions.testcases.create',[$question->id])}}"><i class="fa fa-plus"></i>Add Test Cases</a>
                                    <a class="btn btn-small btn-success" href="{{ route('questions.show',[$question->id]) }}"><i class="fa fa-eye"></i>Show </a>
                                    <a class="btn btn-small btn-warning" href="{{ route('questions.edit',[$question->id])}}"><i class="fa fa-pencil"></i>Edit </a>
                                    <a class="btn btn-small btn-danger" href="{{ route('questions.destroy',[$question->id])}}"><i class="fa fa-trash"></i>Delete</a>
                                </td>
                            </tr>

                        @endforeach



                    </tbody>
                </table>

            </div>
        </div>





    </div>

@endsection
@section('footerJs')

    <script src="https://cdn.datatables.net/1.10.5/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/plug-ins/f2c75b7247b/integration/bootstrap/3/dataTables.bootstrap.js"></script>
    <script>

        $(function () {
            $('[data-toggle="tooltip"]').tooltip()
        });
        $(document).ready(function() {
            //$('#allQuestions').dataTable();
        } );
    </script>
@endsection