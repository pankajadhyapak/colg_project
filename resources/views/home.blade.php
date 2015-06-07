@extends('app')

@section('content')
<div class="container">
	<div class="row">
		<div class="col-md-10 col-md-offset-1">
			<h3>Welcome {{ Auth::user()->role }}, {{ Auth::user()->email }}</h3>
				<p>
					  <button type="button" class="btn btn-primary btn-lg btn-home">Take Test</button>
					  <button type="button" class="btn btn-primary btn-lg btn-home">Enter Test Code</button>
				</p>
		</div>
	</div>
</div>
@endsection
