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
				<input type="radio" name="category" id="radio_student" value="student "/>Student
			</label>
			<label class="radio-inline">
				<input type="radio" name="category" value="faculty" id="radio_faculty"/>Faculty
			</label>
			<label class="radio-inline">
				<input type="radio" name="category" value="other" id="radio_other" />Other
			</label>
		</div>
		<script type="text/javascript" src="http://code.jquery.com/jquery.min.js"></script>
		<script type="text/javascript">
    	$(document).ready(function(){
    		$('.box').hide();
        	$('#radio_student').click(function(){
            	//if($(this).attr("value")=="student"){
                	$('.box').show();
            	//}
            });
            $('#radio_faculty').click(function(){
            	//if($(this).attr("value")=="student"){
                	$('.box').hide();
            	//}
            });
            $('#radio_other').click(function(){
            	//if($(this).attr("value")=="student"){
                	$('.box').hide();
            	//}
            });
    	});
		</script>
		<div class="box">
			Course: <select class="form-control">
  						<option value="be">B.E.</option>
  						<option value="mba">MBA</option>
  						<option value="mca">MCA</option>
  						<option value="other">Other</option>
					</select>
			Branch: <select class="form-control">
  						<option value="cse">CSE</option>
  						<option value="ee">EE</option>
  						<option value="me">ME</option>
  						<option value="ce">CE</option>
					</select>
			Semester: 
					<select class="form-control">
  						<option value="1">I</option>
  						<option value="2">II</option>
  						<option value="3">III</option>
  						<option value="4">IV</option>
						<option value="5">V</option>
						<option value="6">VI</option>
						<option value="7">VII</option>
						<option value="8">VII (Final)</option>
					</select>
			Class: <select class="form-control">
  						<option value="be">CS1</option>
  						<option value="mba">CS2</option>
  						<option value="mca">CS3</option>
  					</select>
			Enrollment no.:
				<input type="text" value="rollno" />
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
