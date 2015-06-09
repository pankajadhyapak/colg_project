{{--@extends('app')<link href='http://fonts.googleapis.com/css?family=Ubuntu+Mono' rel='stylesheet' type='text/css'>--}}

@section('content')
    <div class="codeContainer">
        <div class="row">
            <div class="col-md-4">
                <div class="panel panel-primary">
                    <div class="panel-heading">Problem Statement</div>
                    <div class="panel-body">
                        <h5>Problem Name: {{ $question->title }}</h5>
                        <h5><strong>Description:</strong></h5>
                        <p> {{ $question->body }}
                        </p>
                        <hr/>
                        <h4>Sample Test Case</h4>
                        <p>
                           <strong> Input : </strong>{{ $question->testCases[0]->input }}
                        </p>
                        <p>
                            <strong> Output : </strong>{{ $question->testCases[0]->output }}
                        </p>
                    </div>
                </div>
            </div>
            <div class="col-md-8">
                <form method="POST" action="/codeExec">

                    <input type="hidden" id="codeEditorToken" name="_token" value="{{ csrf_token() }}">
                <pre id="editor">{{ $template }}</pre>

                <div class="btnactions">
                    <a class="btn btn-small btn-info" id="exeCode"><i class="fa fa-code"></i>Execute Code</a>
					@if($student)
                    <a class="btn btn-small btn-success" id="subCode" href="#"><i class="fa fa-share"></i></i>Submit Code </a>
					@endif
                    <a class="btn btn-small btn-danger" id="quitCode" href="#"><i class="fa fa-times"></i></i>Quit </a>
                </div>
                    </form>
                <div class="console" style="margin-top: 20px">
                    <div class="panel panel-success">
                        <div class="panel-heading">Cosole Output</div>
                        <div id="consoleOutput" class="panel-body">

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('footerJs')
    <script src="{{asset('/js/ace/ace.js')}}" type="text/javascript" charset="utf-8"></script>
    <script src="{{asset('/js/ace/ext-language_tools.js') }}" type="text/javascript" charset="utf-8"></script>
    <script>
        window.onbeforeunload = function (e) {
            e = e || window.event;

            // For IE and Firefox prior to version 4
            if (e) {
                e.returnValue = 'Sure?';
            }

            // For Safari
            return 'Sure?';
        };
    </script>
    <script>



        var code ;
        var editor = ace.edit("editor");

        editor.getSession().setMode("ace/mode/{{ $question->language }}");
        editor.getSession().setTabSize(4);
        editor.getSession().setUseSoftTabs(true);
        editor.getSession().setUseWrapMode(true);
        editor.setHighlightActiveLine(true);
        editor.setShowPrintMargin(false);

        $('#subCode').click(function(e) {
            var value = editor.getValue();
            if ((value == "")) {
                return false;
            }else{
                if (confirm("You Sure to Submit Code ?? It Cannot be Edited Again") == true) {
                    {{--code = value;--}}
                    {{--var token = $('#codeEditorToken').val();--}}
                    {{--var formData = {'_token': token,'code': code,'question_code':{{ $question->id }},'exam_id': '{{ $question->id }}' };--}}
                }
            }
        });
//        document.getElementById('editor').style.fontSize='14px';

        $('#exeCode').click(function(e) {
            var value = editor.getValue();
            if ((value == "")) {
                return false;
            }

            $('#exeCode i').removeClass('fa-code');
            $('#exeCode i').addClass('fa-spinner fa-pulse');


            code = value;
            var token = $('#codeEditorToken').val();
            var formData = {'_token': token,'code': code,'question_code':{{ $question->id }},'lang': '{{ $question->language }}' };
            var outPutDiv = $("#consoleOutput");
            $.ajax({
                url: "codeExec",
                type: "POST",
                data: formData,
                success: function (data, textStatus, jqXHR) {
					
					if(data){
						outPutDiv.html(data);
						$('#exeCode i').removeClass('fa-spinner fa-pulse');
                        $('#exeCode i').addClass('fa-code');
					}
                    /*if(data.return == 255){
                        outPutDiv.html("<h5>Compliation Error</h5><p class='error'>"+ data.stdout+"</p>")
                        console.log(data.stdout);
                        $('#exeCode i').removeClass('fa-spinner fa-pulse');
                        $('#exeCode i').addClass('fa-code');
                    }else if(data.return == 0){
                        outPutDiv.html("<h5>Compliation Success</h5><p>"+ data.stdout+"</p>")
                        console.log(data.stdout);
                        $('#exeCode i').removeClass('fa-spinner fa-pulse');
                        $('#exeCode i').addClass('fa-code');
                    }*/


                },
                error: function (jqXHR, textStatus, errorThrown) {

                    alert('woops !!, SOmething Went Wrong!! Please try again');

                }
            });
        });



//        $('#exeCode').click(function(e){
//
//        $.ajax({
//            url: '/codeExec',
//            dataType: 'json',
//            type: 'get',
//            contentType: 'application/json',
//            data: ,
//            processData: false,
//            success: function( data, textStatus, jQxhr ){
//                $('#response pre').html( JSON.stringify( data ) );
//            },
//            error: function( jqXhr, textStatus, errorThrown ){
//                console.log( errorThrown );
//            }
//        });});
//        function onCodeSubmit(form, editorId){
//            console.log(editorId);
//
//            var Editor = $(editorId);
//            console.log(Editor);
//
//            var code = Editor.val();
//            alert(code);
//
//        }
    </script>
@endsection