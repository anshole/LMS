@extends('layout.main')

@section('content')
<div class="container">
	<form class='form-horizontal' action="{{ URL::route('account-create-post') }}" method="post">
		
		<div class='field-control'>
			<label class="control-label col-sm-2" for="email">Email:</label>
			<div class="col-sm-10">
				<input class='form-control' type="text" name="email" {{ (Input::old('email')) ? ' value="' . e(Input::old('email')) . '"' : '' }} />
			</div>
		</div>
		@if($errors->has('email')) 
				{{ $errors->first('email') }}
		@endif
		<br>
		<div class='field'>
			<label class="control-label col-sm-2" for="username">Username:</label>
			<div class="col-sm-10">
				<input class='form-control' type="text" name="username" {{ (Input::old('username')) ? ' value="' . e(Input::old('username')) . '"' : '' }} />
			</div>
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
		<script type="text/javascript">
	    	$(document).ready(function(){
	    		$('#box').hide();
	        	$('#radio_student').click(function(){
	                $('#box').show();
	            });
	            $('#radio_faculty').click(function(){
	                $('#box').hide();
	            });
	            $('#radio_other').click(function(){
	                $('#box').hide();
	            });
	    	});
		</script>
		<br>
		<div class="form-group" id="box">
			<label class="control-label col-sm-2" for="course">Course:</label>
			<div class="col-sm-10">
					<select class="form-control" id="course">
  						<option value="be">B.E.</option>
  						<option value="mba">MBA</option>
  						<option value="mca">MCA</option>
  						<option value="other">Other</option>
					</select>
			</div>
			<label class="control-label col-sm-2" for="branch">Branch</label>
			<div class="col-sm-10">
					 <select class="form-control" id="branch">
  						<option value="cse">CSE</option>
  						<option value="ee">EE</option>
  						<option value="me">ME</option>
  						<option value="ce">CE</option>
					</select>
			</div>	
			<label class="control-label col-sm-2" for="branch">Semester</label>
			<div class="col-sm-10">
					<select class="form-control">
  						<option value="1">I</option>
  						<option value="2">II</option>
  						<option value="3">III</option>
  						<option value="4">IV</option>
						<option value="5">V</option>
						<option value="6">VI</option>
						<option value="7">VII</option>
						<option value="8">VIII (Final)</option>
					</select>
			</div>		
			<label class="control-label col-sm-2" for="branch">Class</label>
			<div class="col-sm-10">
					<select class="form-control">
  						<option value="be">CS1</option>
  						<option value="mba">CS2</option>
  						<option value="mca">CS3</option>
  					</select>
  			</div>
  			<br>
  			<div class="field">
  				<label class="control-label col-sm-2" for="branch">Enrollment no.</label>	
  				<div class="col-sm-10">	
					<input class="form-control" type="text" name="rollno" />
				</div>
			</div>	
		</div>
		<br>
		@if($errors->has('category')) 
				{{ $errors->first('category') }}
		@endif
		<!--- /Radio -->

		<div class='field'>
			<label class="control-label col-sm-2" for="branch">Password</label>
			<div class="col-sm-10">	
				<input class='form-control' type="password" name="password" />
			</div>	
		</div>
		@if($errors->has('password')) 
				{{ $errors->first('password') }}
		@endif

		<div class='field'>
			<label class="control-label col-sm-2" for="branch">Password Again</label>
			<div class="col-sm-10">
				<input class='form-control' type="password" name="password_again" />
			</div>
		</div>
		@if($errors->has('password_again')) 
				{{ $errors->first('password_again') }}
		@endif
		
		<!-- Making it look less ugly for now. this form is temperary and will be redone entirely-->
		<div class="form-group">
			<label class="col-md-4 control-label" for="createbutton"></label>
			<div class="col-md-4 center-block"> 
				<button class='btn btn-info btn-block' type="submit" name="createbutton">Create account</button>
			</div>
		</div>
		{{ Form::token() }}
	</form>
</div>
@stop
