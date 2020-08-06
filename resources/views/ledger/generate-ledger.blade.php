<?php
	$homeCls = new App\Http\Controllers\HomeController();

	$className = App\SchoolClass::whereId($class)->first()->title;
	$sectionName = App\Section::whereTitle($section)->first()->title;
	$examName = App\Examination::whereId($exam)->first()->title;

	$subjects = App\Subject::whereClass($class)->get();
	$results = App\Result::whereClass($class)->whereSection($section)->whereExam($exam)->get();
?>
<!DOCTYPE html>
<html>
<head>
	<title> Marks Ledger for Class {{ $className }} &amp; Section {{ $section }} - {{ $examName }} </title>

	<link href="{{ asset('/public/css/app.css') }}" rel="stylesheet">
	<style type="text/css">
		body{
			background:#fff !important;
			font-size:11px;
		}
		table th, td{
			vertical-align: middle !important;
			text-align:center;
		}
		.giveBorder p{
			border-top:2px dotted black;
		}
		.giveBorder{
			margin-top:50px !important;
			text-align: center;
			font-weight: bold;
		}
	</style>
</head>
<body>
	<div class="container-fluid">
		<div class="text-center">
			<h3> GEMS English Boarding School </h3>
			<h4> Class : {{ $className }} , Section : {{ $section }} </h4>
			<h4> {{ $examName }} </h4>
		</div>
		<hr>
		<table class="table table-bordered">
			<thead>
				<tr>
					<th rowspan="2"> Roll </th>
					<th rowspan="2"> Name </th>
					@foreach($subjects as $sub)
						<?php
							$markssetting = App\MarksSetting::whereSubject($sub->id)->whereExam($exam)->first();
						?>
						<th colspan="2"> {{ $sub->title }} ({{ $markssetting->theory + $markssetting->practical }}) </th>
					@endforeach
					<th rowspan="2"> Total Marks </th>
					<th rowspan="2"> Percentage </th>
					<th rowspan="2"> Grade </th>
					<th rowspan="2"> Rank </th>
					<th rowspan="2"> Status </th>
				</tr>
				<tr>
					@foreach($subjects as $sub)
						<?php
							$markssetting = App\MarksSetting::whereSubject($sub->id)->whereExam($exam)->first();
						?>
						<th> Th({{ $markssetting->theory }}) </th>
						<th> Pr({{ $markssetting->practical }}) </th>
					@endforeach
				</tr>
			</thead>
			<tbody>
				<?php $i = 1; ?>
				@foreach($results as $result)
					<?php
						$student = App\Student::whereId($result->student)->first();
						$i = 1;
						$f = 0;
						$pf = 0;
						$fullMarks = 0;
						$totalMarks = 0;
						$totalPractical = 0;
						$totalOfSubjectPr = 0;
						$totalth = 0;
						$totalOfSubjectTh = 0;
						$c=0;
						$status = "Pass";
						$totalGpa = 0;
					 ?>
					<tr>
						<td> {{ $student->roll }} </td>
						<td> {{ $student->name }} </td>
						@foreach($subjects as $sub)
							<?php
								$fieldth = "sub".$sub->order."th";
								$fieldpr = "sub".$sub->order."pr";
								$markssetting = App\MarksSetting::whereSubject($sub->id)->whereExam($exam)->first();
								$totalObtained = 0;
								$marksObtained = 0;
								$gpa = 0;
								$totalOfSubject = 0;
							?>
							@if((float) $result->$fieldth > 0 || $result->$fieldth == 'z' || $result->$fieldth == '-1')
								<?php
									if($result->$fieldth == '-1'){
										$marksObtained = 'Abs';
									}elseif($result->$fieldth == 'z'){
										$marksObtained = '0';
									}else{
										$marksObtained = (float) $result->$fieldth;
									}

									$totalObtained = ((float) $result->$fieldth + (float) $result->$fieldpr);
									$totalOfSubject = ($markssetting->theory + $markssetting->practical);
									$totalOfSubjectTh += $markssetting->theory;
									$totalOfSubjectPr += $markssetting->practical;
									$totalth += $totalObtained;
									$fullMarks += $totalOfSubject;
									$totalMarks += (float) $result->$fieldth;
									$totalPractical += (float) $result->$fieldpr;
								?>
							@endif
							<td>
								@if($result->$fieldth > 0)
									{{ $result->$fieldth }} @if(($result->$fieldth) < $markssetting->pass) <sup> * </sup> @endif
								@elseif($result->$fieldth == '-1')
									Abs <sup> * </sup>
								@elseif($result->$fieldth == 'z')
									0 <sup> * </sup>
								@else
									-
								@endif
							</td>
							<td> {{ ($result->$fieldpr>0)?$result->$fieldpr:'-' }} </td>
							<?php
								if((float)$result->$fieldth > 0 && ($result->$fieldth) < $markssetting->pass || $result->$fieldth == "-1" || $result->$fieldth == 'z'){
									$status = "Fail";
									$f++;
								}
							?>
						@endforeach
						<?php if($fullMarks > 0) $percent = ($totalth/$fullMarks)*100; ?>
						<td> {{ number_format($totalth, 2, '.', ',') }} </td>
						<td> {{ number_format($percent, 2, '.', ',') }} % </td>
						<?php
							if($percent >=90 && $percent <= 100){
								$grade = "A+";
							}elseif($percent >= 80 && $percent < 90){
								$grade = "A";
							}elseif($percent >= 70 && $percent < 80){
								$grade = "B+";
							}elseif($percent >= 60 && $percent < 70){
								$grade = "B";
							}elseif($percent >= 50 && $percent < 60){
								$grade = "C+";
							}elseif($percent >= 40 && $percent < 50){
								$grade = "C";
							}else{
								$grade = "F";
							}
						?>
						<?php
							if($fullMarks > 0) $percent = (($totalMarks + $totalPractical)/$fullMarks)*100;
							if($f == 0){
								$pf = 0;
							}else{
								$pf = 1;
							}
							$homeCls->savePercentForRank($result->student,$class,$section,$exam,$percent,$pf);
							$rank = $homeCls->getPosition($class,$section,$exam,(float)$percent);
						?>
						<td> {{ $grade }} </td>
						<td>  @if($rank>0) {!! $rank !!} @else --- @endif</td>
						<td> {{ $status }} @if($f > 0) ({{ $f }}) @endif </td>
						<?php $i++; ?>
					</tr>
					{{ $homeCls->addRankToPercentageTable($result->student, $class,$section,$exam,$rank) }}
				@endforeach
			</tbody>
		</table>
		<div class="col-md-4 col-sm-4 col-xs-4 giveBorder">
			<p> Class Teacher's Signature </p>
		</div>
		<div class="col-md-4 col-sm-4 col-xs-4 giveBorder">
			<p> Co-ordinator's Signature </p>
		</div>
		<div class="col-md-4 col-sm-4 col-xs-4 giveBorder">
			<p> Principal </p>
		</div>
	</div>
</body>
</html>
