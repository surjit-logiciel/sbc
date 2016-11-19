@extends('layouts.app')

@section('title')
	Personal Dashboard
@endsection


@section('css')
	<link rel="stylesheet" href="{{ url('/css/notie.css') }}">
@endsection

@section('content')

 <div class="container">

 <div class="row">
   <div class="container1">

	 <div class="generic_left col-lg-9  col-md-9  col-sm-8  col-xs-12">

		 <div class="nav_content1 title_icon title_wide icon-program-{{ Session::get('program_id') }}">
			 <h1 class="icon-lg-program-{{ Session::get('program_id') }}">{{ $program->name }} Program <span>/ Day {{ $current_day }}</span></h1>
		 </div>

		 <div class="learn_more learn_more_{{ $phase_number }}">
			<p>Day {{ $phase_day }}  of  {{ $phase }}<a href="{{ url('/program/overview') }}">Learn More</a></p>
		 </div>

		 @if($phase_message)
		 <div class="nav_content1">
			 <p>{{ $phase_message }}</p>
		 </div>
		 @endif

		 @if($current_day == 1)
		 <div class="embed-responsive embed-responsive-16by9">
			<iframe src="https://player.vimeo.com/video/171869028" width="640" height="360" frameborder="0" webkitallowfullscreen mozallowfullscreen allowfullscreen></iframe>
		 </div>
		 @endif

		 @if($current_day % 7 == 0)
		 	<div class="alert alert-warning" role="alert"><a href="{{ url('/measurement') }}">Remember to log your weight today!</a> This will help you see your progress over time.
		 	</div>
		 @endif

		 
		 {{--
		 @if($phase_number == 3) 

		 	<div id="jumpstart_panel">
		 		Sometimes we all need a little bit of a reboot, whether we have a big event coming up, or we just want a little kick in the pants!

				<a href="{{url('/jumpstart')}}" id="jumpstart">Click here to return to the 9-Day Jumpstart.</a>

				<div id="confirm" class="modal hide fade">
					<div class="modal-body">
						<h3>Your program will be reset to the 9-Day Jumpstart.</h3>
					</div>
					<div class="modal-footer">
						<button type="button" data-dismiss="modal" class="btn btn-warning" id="delete">Return to Jumpstart</button>
						<button type="button" data-dismiss="modal" class="btn">Cancel</button>
					</div>
				</div>
		 	</div>

 			@elseif($current_day != 1)

		 	<div id="jumpstart_panel">
		 		<a href="{{url('/jumpstart')}}" id="jumpstart">Click here to reset your start date.</a>
				<div id="confirm" class="modal hide fade">
					<div class="modal-body">
						<h3>Your program will be reset to Day 1.</h3>
					</div>
					<div class="modal-footer">
						<button type="button" data-dismiss="modal" class="btn btn-warning" id="delete">Return to Day 1</button>
						<button type="button" data-dismiss="modal" class="btn">Cancel</button>
					</div>
				</div>
		 	</div>

		 @endif

		 <div id="message" style="display: none">
				<div id="inner-message" class="alert">
					<button type="button" class="close" data-dismiss="alert">&times;</button>
					<span></span>
				</div>
		</div>

	 	--}}

		 <div class="dummy_dev">
			 <div class="progress_cnt side_box">
				<h2 class="bkgd_level_1">YOUR PROGRESS</h2>
			<div class="progress_chart side_box">
				<div style="width:100%; padding-top: 10px;">
					<canvas id="canvasM" height="185" style="cursor:pointer"></canvas>
				</div>
					 <div class="clear"></div>
					 
			</div>

			
				<ul>
					<li>				<h3>Starting Weight:<span>{{ $weight_start }} {{ $weight_unit }}</span></h3>	<div class="clear"></div> </li>
					<li>				<h3>Current Weight:<span>{{ $weight_current }} {{ $weight_unit }}</span></h3>	<div class="clear"></div> </li>
					<li class="no-bor">	<h3>Target Weight:<span>{{ $weight_goal }} {{ $weight_unit }}</span></h3>		<div class="clear"></div> </li>
				</ul>
				<a href="{{ url('/measurement') }}" class="btn">Update</a>
				<div class="clear"></div>
			</div>
		 </div>

		 <div class="meals workout">
			<h2>@if($program->id == 1)Today's Suggested Workout @else Create Your Workout @endif</h2>

			@if($program->id == 1)

				@if($current_day < 6)
					For the first five days of workouts in the Summer Body Club Jumpstart program, you’ll notice that we’re easing you into things. No high intensity training…yet! So even if you live a sedentary lifestyle, these workouts are designed to be easy on your body and prepare you for the work ahead!
				@elseif($current_day > 7)
					You’ll receive workouts for five days straight, and then on off days, you have the option to complete one of our Bonus workouts using a resistance band. <a href="http://www.thebooknook.com/storefrontB2CWEB/categoryDetail.do?ctg_id=70317" target="_blank">Click HERE</a> to purchase a band, or you can use one you already have! These workouts aren’t super high intensity, but they’ll definitely have you feeling that Summer Body burn and help keep you on track. Plus, they’re totally optional, so if you want to do them on some off days and not on others, that’s just fine!
				@endif

				@if($workout->count() != 0)
					<div class="meals_cnt">
						<h4><span>{{ $workout->name }}</span></h4>
						<a href="{{ url('/program/workout/'.$workout->id) }}"><img src="https://s3-us-west-1.amazonaws.com/summerbodyclub/video/{{ $workout->video }}.jpg" class="img-responsive"></a>
						<p>{{ $workout->instructions }}</p>


						<a href="{{ url('/program/workout/'.$workout->id) }}" class="btn btn-info">View Workout</a>

						@if(isset($off_day))
								<a href="http://www.thebooknook.com/storefrontB2CWEB/categoryDetail.do?ctg_id=70317" target="_blank" class="btn btn-info" style="margin-left:10px">Get Your Bonus Workout Resistance Band</a>
						@endif

						@if(isset($off_day))
								<br><br>
								<p>Visit the Exercise Room for all bonus workouts.</p>
								<div class="clear"></div>
								<a href="{{ url('/program/exercise-room/bonus') }}" class="btn-primary">View Bonus Workouts</a>
						@endif

						{{--<small>New to workouts? <a href="{{ url('/program/workout-prep') }}">Try our 5 Day Prep Program</a></small>--}}
					</div>
				@else
					<div class="meals_cnt">
						<p>Visit the Exercise Room for some suggested workouts.</p>
						<div class="clear"></div>
						<a href="{{ url('/program/exercise-room') }}" class="btn-info">View Workouts</a>
						{{--<small>New to workouts?<a href="{{ url('/program/workout-prep') }}">Try our 5 Day Prep Program</a></small>--}}
					</div>
				@endif

			@else

				<div class="meals_cnt">
					<img src="https://s3-us-west-1.amazonaws.com/summerbodyclub/video/{{ $workout->video }}.jpg" class="img-responsive">
					<p>Visit the Exercise Room to create your workout.</p>
					<div class="clear"></div>
					<a href="{{ url('/program/exercise-room') }}" class="btn-info">Create Workout</a>
					{{--<small>New to workouts?<a href="{{ url('/program/workout-prep') }}">Try our 5 Day Prep Program</a></small>--}}
				</div>

			@endif

		 </div>

		 <div class="meals">

			@if($program->id == 1)

				<h2>Today's Suggested Meals</h2>

				@foreach ($recipes_other as $recipe)
					<div class="meals_cnt">


									<h4><span>{{ $recipe->name }}</span></h4>
									<p>{!! nl2br($recipe->instructions) !!}</p>
									@if($recipe->ingredients->count() > 0)
										<a href="{{ url('/program/recipe/'.$recipe->id) }}" class="btn-info">View Recipe</a>
									@endif


					</div>
				@endforeach

				@foreach ($recipes as $recipe_group)
					<div class="meals_cnt">

							<h3>{{ $recipe_group->first()->meal->name }}:</h3>
							@foreach ($recipe_group as $recipe)

									<h4><span>{{ $recipe->name }}</span></h4>
									<p>{!! nl2br($recipe->instructions) !!}</p>
									@if($recipe->ingredients->count() > 0)
										<a href="{{ url('/program/recipe/'.$recipe->id) }}" class="btn-info">View Recipe</a>
									@endif
							@endforeach

					</div>
				@endforeach

					<div class="meals_cnt aligned">
						<h4><span>Looking for a different recommendation? Browse our recipe lounge.</span></h4>
						<a href="{{ url('/program/recipe-lounge') }}" class="btn-info">View All Recipes</a><br>
					</div>

			@else

				<h2>Your Daily Meal Plan</h2>

				<div class="meals_cnt">
					<p>As an Adventurer you can create your own meal plans using the guidelines below.</p>

					@if($phase_number == 1)
						 <div class="overview_block">
							<ol>
								<li><a href="{{ url('/program/food/8') }}">Protein</a> – 3 servings of 3 oz per day</li>
								<li><a href="{{ url('/program/food/4') }}">Healthy Fats</a> – 3 servings per day*</li>
								<li><a href="{{ url('/program/food/9') }}">Vegetables</a> – unlimited</li>
								<li>Water – 8-10 eight ounce glasses per day</li>
							</ol>
						 </div>
					@elseif($phase_number == 2)
						 <div class="overview_block">
							<ol>
								<li>Day 1 & 2 – Same as 9-Day Jumpstart Daily Meal Plan Overview + add in 1 serving of grains*</li>
								<li>Day 3 & 4 - Same as 9-Day Jumpstart Daily Meal Plan Overview + add in 2 servings of fruit** with the grains you added in on Day 1 & 2</li>
								<li>Day 5 – Same as 9-Day Jumpstart Daily Meal Plan Overview + can switch up breakfast to a meal instead of a smoothie in addition to the grains and fruits added on Days 1 – 4.</li>
							</ol>
						 </div>
					@else
						 <div class="overview_block">
							<ol>
								<li><a href="{{ url('/program/food/8') }}">Protein</a> – 3 servings of 3 oz per day</li>
								<li><a href="{{ url('/program/food/4') }}">Healthy Fats</a> – 3 servings per day*</li>
								<li><a href="{{ url('/program/food/9') }}">Vegetables</a> – unlimited</li>
								<li><a href="{{ url('/program/food/2') }}">Fruits</a> – 2 servings per day**</li>
								<li>Water – 8-10 eight ounce glasses per day</li>
								<li><a href="{{ url('/program/food/3') }}">Grains</a> – 1 serving of ½ cup per day***</li>
							</ol>
						 </div>
					@endif



					 <div class="overview_block overview_block_last">

						@if($phase_number == 1)

							* ½ avocado is one serving while one tablespoon of coconut oil is one serving size. Also, one tablespoon of nut butters is one serving while one serving of nuts is a small handful (approximately 10 – 15 nuts).
							<br><br>

						@elseif($phase_number == 2)

							* 1 serving = 1/2 cup of cooked grains; 1 slice of gluten-free bread, 1 medium-sized ear of corn.
							<br><br>

							** For whole fruits like apples, oranges, or bananas, a serving size is one medium-size piece. Fruits that need to be sliced and diced
				like pineapple and melon, one serving size is 1/2 cup. One serving of berries is 1/2 cup.
							<br><br>

						@else

							* ½ avocado is one serving while one tablespoon of coconut oil is one serving size. Also, one tablespoon of nut butters is one serving while one serving of nuts is a small handful (approximately 10 – 15 nuts).
							<br><br>

							** For whole fruits like apples, oranges, or bananas, a serving size is one medium-size piece. Fruits that need to be sliced and diced
				like pineapple and melon, one serving size is 1/2 cup. One serving of berries is 1/2 cup.
							<br><br>

							*** 1 serving = 1/2 cup of cooked grains; 1 slice of gluten-free bread, 1 medium-sized ear of corn.
							<br><br>

						@endif

						<strong>Considerations for Vegetarians and Vegans:</strong>
						If a meal plan references animal protein, you  can substitute a <a href="{{ url('/program/food/7') }}">plant-based protein</a>  based on the list of Summer Body Friendly Foods.

						<br><br>

						<strong>Allergies:</strong>
						If you have any allergies to nuts, try unsalted sunflower seeds or pumpkin seeds. If you have any allergies to fish or shellfish, you can substitute with chicken breast or other lean <a href="{{ url('/program/food/8') }}">protein sources.</a>

					 </div>


					<div class="clear"></div>

					<h4><span>Looking for some ideas? Browse our recipe lounge.</span></h4>
					<a href="{{ url('/program/recipe-lounge') }}" class="btn-info">View Recipes</a><br>

					Looking to add some summer spice to your meal? <a href="{{ url('/program/overview#summer') }}">View some yummy additions.</a>
				</div>

			@endif

		 </div>

		 @if($mindset)
		 <div class="meals excercise no-bor">
			<h2>Today's Mindset</h2>
			<div class="meals_cnt intterupt">
				<h4><span>{!! nl2br($mindset->name) !!}</span></h4>
				<p>{!! nl2br($mindset->instructions) !!}</p>
			</div>
		 </div>
		 @endif

		 <div class="dummy_dev">
			 <div class="shopping side_box">
				<h2 class="bkgd_level_2">SHOPPING LIST</h2>
				<p>Your weekly grocery list, all in one place so there are no surprises.</p>
				<a href="{{ url('/program/shopping-list') }}" class="btn">View List</a>
				<div class="clear"></div>
		
				<hr>
				<div class="clear"></div>

				<p>Your menu for the week.</p>
				<a href="{{ url('/program/recipe-lounge') }}" class="btn">View Menu</a>
				<div class="clear"></div>
			</div>
		 </div>

	 	{{--
	 	@if(Session::get('program_id') == 1)
		 <div class="dummy_dev">
			<div class="shopping event side_box">
				<h2 class="bkgd_level_3">GET "EVENT READY"</h2>
				<p>Want to prepare for a big event? Check out <span> 5 Day Event Ready</span> program to optimize your results.</p>
				<a href="{{ url('/program/event-ready') }}" class="btn">View Event Ready Program</a>
				<div class="clear"></div>
			</div>
		 </div>
		@endif
		--}}



		<div class="dummy_dev">
			<div class="shopping event side_box">
				<h2 class="bkgd_level_4">YOUR PROGRAM</h2>
				<h3>{{ $program->name }} Program</h3>
				<p>{{ $program->short_description }}</p>
				<a href="{{ url('/account/program-options') }}" class="btn">Program Options</a>
				<div class="clear"></div>
		
				<hr>
				<div class="clear"></div>
				
				<h3>Missed a day or need a reboot?</h3>
				<p>Go back a day or two, or start over.</p>
				<a href="{{ url('/account/program-reset') }}" class="btn">Reset Options</a>
				<div class="clear"></div>
			</div>
		</div>



		<div class="dummy_dev">
			<div class="shopping event side_box">
				<h2 class="bkgd_level_4">SBC COMMUNITY</h2>
				<p>Don't forget to check in with your SBC community for exclusive VIP content!</p>
				<a href="https://www.facebook.com/groups/1693250957602899/" target="_blank" class="btn">SBC Community</a>
				<div class="clear"></div>
			</div>
		</div>

	 </div>




	 <div class="generic_right col-lg-3  col-md-3  col-sm-4  col-xs-12">

		 


		<div class="progress_cnt side_box">
			<h2 class="bkgd_level_1">YOUR PROGRESS</h2>
            <input type="hidden" value="{{$weight_unit}}" name="weight_unit" id="weight_unit">
			<div class="progress_chart side_box">
				<div style="width:100%; padding-top: 10px;">
					<canvas id="canvas" height="185" style="cursor:pointer"></canvas>
				</div>
				<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.1.6/Chart.bundle.js"></script>
					 <div class="clear"></div>
					 <script>
							 window.onload = function() {
								 var weight_unit=$('#weight_unit').val();
								 var ctx = document.getElementById("canvas").getContext("2d");
								 var ctx2 = document.getElementById("canvasM").getContext("2d");
								 // window.myLine = new Chart(ctx, config);
								 $.ajax({
									 url: 'program/mini-chart',
									 type: "post",
									 dataType: 'json',
									 data:{'_token': $('input[name=_token]').val()},
									 success: function (data) {
										 console.log(data);
										 if(data.data.labels.length>0){
											data.options.tooltips.callbacks= {
													label: function(tooltipItems, data1) {
														if(data1.datasets[tooltipItems.datasetIndex].label=='Weight'){
															return data1.datasets[tooltipItems.datasetIndex].label +': ' + tooltipItems.yLabel + ' ' + weight_unit;
														}else{
															return 'Weight Goal' +': ' + tooltipItems.yLabel;
														}
													}
												 }
											}
										window.myLine = new Chart(ctx, data);
										window.myLine = new Chart(ctx2, data);
									 }
							 });

							 $('#canvas').on('click',function(){
								window.location = "program/chart";
							 });

							 $('#canvasM').on('click',function(){
								window.location = "program/chart";
							 });
							 };

					 </script>
			</div>
		 
			<ul>
				<li><h3>Starting Weight:<span>{{ $weight_start }} {{ $weight_unit }}</span></h3><div class="clear"></div> </li>
				<li class="highlight"><h3>Current Weight:<span>{{ $weight_current }} {{ $weight_unit }}</span></h3><div class="clear"></div> </li>
				<li class="no-bor"><h3>Target Weight:<span>{{ $weight_goal }} {{ $weight_unit }}</span></h3> <div class="clear"></div> </li>
			</ul>
			<a href="{{ url('/measurement') }}" class="btn">Update</a>
			<div class="clear"></div>
		</div>

		@if(Session::get('program_id') == 1)
		<div class="shopping side_box">
			<h2 class="bkgd_level_2">SHOPPING LIST</h2>
			<p>Your weekly grocery list, all in one place so there are no surprises.</p>
			<a href="{{ url('/program/shopping-list') }}" class="btn">View List</a>
			<div class="clear"></div>
		
			<hr>
			<div class="clear"></div>

			<p>Your menu for the week.</p>
			<a href="{{ url('/program/recipe-lounge') }}" class="btn">View Menu</a>
			<div class="clear"></div>
		</div>
		@endif

		{{--
		<div class="shopping event side_box">
			<h2 class="bkgd_level_3">GET "EVENT READY"</h2>
			<p>Want to prepare for a big event? Check out <span> 5 Day Event Ready</span> program to optimize your results.</p>
			<a href="{{ url('/program/event-ready') }}">View Event Ready Program</a>
			<div class="clear"></div>
		</div>
		--}}

		<div class="shopping event side_box">
			<h2 class="bkgd_level_4">YOUR PROGRAM</h2>
			<h3>{{ $program->name }} Program</h3>
			<p>{{ $program->short_description }}</p>
			<a href="{{ url('/account/program-options') }}" class="btn">Program Options</a>
			<div class="clear"></div>
		
			<hr>
			<div class="clear"></div>

			<h3>Missed a day or need a reboot?</h3>
			<p>Go back a day or two, or start over.</p>
			<a href="{{ url('/account/program-reset') }}" class="btn">Reset Options</a>
			<div class="clear"></div>
		</div>

		<div class="shopping event side_box">
			<h2 class="bkgd_level_4">SBC COMMUNITY</h2>
			<p>Don't forget to check in with your SBC community for exclusive VIP content!</p>
			<a href="https://www.facebook.com/groups/1693250957602899/" target="_blank" class="btn">SBC Community</a>
			<div class="clear"></div>
		</div>

	 </div>



 </div>



 </div>
 </div>
@endsection

@section('js')

    <script src="{{ url('/js/notie.min.js') }}"></script>

  <script>

			notie.setOptions({
				colorSuccess: '#57BF57',
				colorWarning: '#D6A14D',
				colorError: '#E1715B',
				colorInfo: '#4D82D6',
				colorNeutral: '#A0A0A0',
				colorText: '#FFFFFF',
				animationDelay: 300,
				backgroundClickDismiss: true
			});

			@if (Session::has('status'))
				notie.alert(1, "{{ Session::get('status') }}", 2);
			@endif


		</script>


@endsection
