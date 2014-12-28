@extends('layout.main')

@section('content')
<div class="container">
	<form class='form-horizontal' action="{{ URL::route('account-create-post') }}" method="post">
		
		<div class='field-control'>
			Email: <input class='form-control' type="text" name="email" {{ (Input::old('email')) ? ' value="' . e(Input::old('email')) . '"' : '' }} />
		</div>
		@if($errors->has('email')) 
				{{ $errors->first('email') }}
		@endif
		
		<div class='field'>
			Username: <input class='form-control' type="text" name="username" {{ (Input::old('username')) ? ' value="' . e(Input::old('username')) . '"' : '' }} />
		</div>
		@if($errors->has('username')) 
				{{ $errors->first('username') }}
		@endif

		<!--- Radio -->
		<div class="radio-inline">
			<label class="radio-inline">
				<input type="radio" name="category" value="student "/>Student
			</label>
			<label class="radio-inline">
				<input type="radio" name="category" value="faculty" />Faculty
			</label>
			<label class="radio-inline">
				<input type="radio" name="category" value="other" />Other
			</label>
		</div>
		<br>
		@if($errors->has('category')) 
				{{ $errors->first('category') }}
		@endif
		<!--- /Radio -->

		<div class='field'>
			Password: <input class='form-control' type="password" name="password" />
		</div>
		@if($errors->has('password')) 
				{{ $errors->first('password') }}
		@endif

		<div class='field'>
			Password again: <input class='form-control' type="password" name="password_again" />
		</div>
		@if($errors->has('password_again')) 
				{{ $errors->first('password_again') }}
		@endif
		
		<button class='btn btn-info' type="submit">Create account</button>
		
		{{ Form::token() }}
	</form>
</div>
@stop
