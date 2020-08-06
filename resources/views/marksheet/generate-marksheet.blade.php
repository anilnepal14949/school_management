<?php
	$homeCls = new App\Http\Controllers\HomeController();

	$className = App\SchoolClass::whereId($class)->first()->title;
	$sectionName = App\Section::whereTitle($section)->first()->title;
	$examName = App\Examination::whereId($exam)->first()->title;

	$subjects = App\Subject::whereClass($class)->get();
?>
<!DOCTYPE html>
<html>
<head>
	<title> Mark-Sheet for Class {{ $className }} &amp; Section {{ $section }} - {{ $examName }} </title>

	<link href="{{ asset('/public/css/app.css') }}" rel="stylesheet">
	<style type="text/css">
		@font-face {
			font-family: marksheetHeading;
			src: url({{ asset('/public/fonts/SansPosterBold.ttf') }});
		}
		body{
			background:#fff !important;
			font-size:10px;
		}
		.image_logo{
			width:120px; height:100px;
			margin-top:10px;
		}
		.marksheet-body{
			width: 680px;
			height: 1000px;
			margin:0 auto;
			border:2px solid black;
			page-break-after: always;
		}
		.marksheetTable{
			width:92%;
			margin:0 auto;
			margin-bottom:10px;
		}
		table tr{
			padding: 5px !important;
		}
		table th, td{
			vertical-align: middle !important;
			text-align:center;
			border: 1px solid #000 !important;
		}
		table td{
			text-align:center !important;
		}
		.footerTable th, td{
			padding:5px;
			text-align: left !important;
		}
		.formValue{
			width:200px !important;
			font-weight: bolder;
		}
		.giveBorder p{
			border-top:2px dotted black;
		}
		.giveBorder{
			margin-top:30px !important;
			text-align: center;
			font-weight: bold;
		}
		@media print{
			table th,td{
				border:1px solid #000 !important;
			}
			.marksheet-body .image_logo{
				width: 150px !important;
 height:80px !important;			}
		}
	</style>
</head>
<body>
	@foreach($results as $result)
		<div class="container marksheet-body">
			<div class="col-md-2 col-sm-2 col-xs-2">
				<img src="{{ asset('/public/images/logo_gems.jpg') }}" class="image_logo">
			</div>
			<div class="text-center col-md-10 col-sm-10 col-xs-10" style="line-height: 0.8em;">
				<h3><strong> GEMS ENGLISH MEDIUM SCHOOL </h3>
				<p> Hetauda-11, Nawalpur, Makwanpur <br><br> ESTD. 2050</p>
				<h3 style="width:250px; margin:0 auto; padding:5px; background:#000; color:#Fff;"> MARKSHEET </h3>
				<h4 style="margin-bottom:10px;"><em> The Report of {{ $examName }} </em></h4>
			</div>
			<hr>
			<?php
				$student = App\Student::whereId($result->student)->first();
				$rank = App\Percentage::whereStudent($result->student)->whereExam($exam)->whereClass($class)->first()->rank;
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
				$totalGpa = 0;
			 ?>
			<div class="col-md-12 col-sm-12 col-xs-12 formData">
				<p> Name : <span class="formValue"> {{ $student->name }} </span> </p>
			</div>
			<div class="col-md-4 col-sm-4 col-xs-4 formData">
				<p> Class : <span class="formValue"> {{ $className }} </span> </p>
			</div>
			<div class="col-md-4 col-sm-4 col-xs-4 formData">
				<p> Section : <span class="formValue"> {{ $student->section }} </span> </p>
			</div>
			<div class="col-md-4 col-sm-4 col-xs-4 formData">
				<p> Roll No.: <span class="formValue"> {{ $student->roll }} </span> </p>
			</div>
			<table class="marksheetTable">
				<thead>
					<tr>
						<th rowspan="2">S.N.</th>
						<th rowspan="2">Subject</th>
						<th rowspan="2">Full Marks</th>
						<th colspan="2">Marks Obtained</th>
						<th colspan="2">Grade</th>
						<th rowspan="2">Final Grade</th>
						<th rowspan="2">G.P.A</th>
						<th rowspan="2">Remarks</th>
					</tr>
					<tr>
						<th> Th. </th>
						<th> Pr. </th>
						<th> Th. </th>
						<th> Pr. </th>
					</tr>
				</thead>
				<tbody>
					@foreach($subjects as $sub)
						<?php
							$fieldth = "sub".$sub->order."th";
							$fieldpr = "sub".$sub->order."pr";
							$markssetting = App\MarksSetting::whereSubject($sub->id)->whereExam($exam)->first();
							$totalObtained = 0;
							$marksObtained = 0;
							$status = "Pass";
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
						<?php
							if($result->$fieldth > 0 && $result->$fieldth < $markssetting->pass || $result->$fieldth == "-1" || $result->$fieldth == 'z'){
								$status = "Fail";
								$f++;
							}
						?>
						@if($result->$fieldth > 0 || $result->$fieldth == '-1' || $result->$fieldth == 'z')
							<?php
								$gpa = $homeCls->getGradePoint($totalOfSubject, $totalObtained);
								$totalGpa += $gpa;
								$c++;
							?>
							<tr>
								<td> {{ $i++ }} </td>
								<td> {{ $sub->title }} </td>
								<td> {{ $markssetting->theory }} @if($markssetting->practical>0) / {{ $markssetting->practical }} @endif </td>
								<td> {{ $marksObtained }}</td>
								<td> {{ (float)$result->$fieldpr }} </td>
								<td> {{ $homeCls->getGrade($markssetting->theory, (float)$result->$fieldth) }} </td>
								<td> @if($markssetting->practical > 0) {{ $homeCls->getGrade($markssetting->practical, (float) $result->$fieldpr) }} @else - @endif</td>
								<td> {{ $homeCls->getGrade($totalOfSubject, $totalObtained) }} </td>
								<td> {{ number_format($gpa,2,'.',',') }} </td>
								<td> {{ $status }} </td>
							</tr>
						@endif
					@endforeach
					<tr>
						<th colspan="2"> Total </th>
						<th> {{ $fullMarks }} </th>
						<th> {{ $totalMarks }} </th>
						<th> {{ $totalPractical }} </th>
						<th> {{ $homeCls->getGrade($totalOfSubjectTh,$totalMarks) }} </th>
						<th> {{ $homeCls->getGrade($totalOfSubjectPr,$totalPractical) }} </th>
						<th> {{ $homeCls->getGrade($fullMarks,$totalth) }} </th>
						<th> {{ number_format($totalGpa,2,'.',',') }} </th>
						<th> &nbsp; </th>
					</tr>
					@if($class==4)
						<tr>
							<td> {{ $i++ }} </td>
							<td> PT </td>
							<td> &nbsp; </td>
							<td> &nbsp; </td>
							<td> &nbsp; </td>
							<td> &nbsp; </td>
							<td> &nbsp; </td>
							<td> &nbsp; </td>
							<td> &nbsp; </td>
							<td> &nbsp; </td>
						</tr>
						<tr>
							<td> {{ $i++ }} </td>
							<td> Drawing </td>
							<td> &nbsp; </td>
							<td> &nbsp; </td>
							<td> &nbsp; </td>
							<td> &nbsp; </td>
							<td> &nbsp; </td>
							<td> &nbsp; </td>
							<td> &nbsp; </td>
							<td> &nbsp; </td>
						</tr>
					@endif
					@if($class==3)
						<tr>
							<td> {{ $i++ }} </td>
							<td> Rhymes </td>
							<td> &nbsp; </td>
							<td> &nbsp; </td>
							<td> &nbsp; </td>
							<td> &nbsp; </td>
							<td> &nbsp; </td>
							<td> &nbsp; </td>
							<td> &nbsp; </td>
							<td> &nbsp; </td>
						</tr>
						<tr>
							<td> {{ $i++ }} </td>
							<td> Hygiene </td>
							<td> &nbsp; </td>
							<td> &nbsp; </td>
							<td> &nbsp; </td>
							<td> &nbsp; </td>
							<td> &nbsp; </td>
							<td> &nbsp; </td>
							<td> &nbsp; </td>
							<td> &nbsp; </td>
						</tr>
						<tr>
							<td> {{ $i++ }} </td>
							<td> Conversation </td>
							<td> &nbsp; </td>
							<td> &nbsp; </td>
							<td> &nbsp; </td>
							<td> &nbsp; </td>
							<td> &nbsp; </td>
							<td> &nbsp; </td>
							<td> &nbsp; </td>
							<td> &nbsp; </td>
						</tr>
						<tr>
							<td> {{ $i++ }} </td>
							<td> Drawing </td>
							<td> &nbsp; </td>
							<td> &nbsp; </td>
							<td> &nbsp; </td>
							<td> &nbsp; </td>
							<td> &nbsp; </td>
							<td> &nbsp; </td>
							<td> &nbsp; </td>
							<td> &nbsp; </td>
						</tr>
						<tr>
							<td> {{ $i++ }} </td>
							<td> Games/PT </td>
							<td> &nbsp; </td>
							<td> &nbsp; </td>
							<td> &nbsp; </td>
							<td> &nbsp; </td>
							<td> &nbsp; </td>
							<td> &nbsp; </td>
							<td> &nbsp; </td>
							<td> &nbsp; </td>
						</tr>
					@endif
					@if($class == 2 || $class ==1)
						<tr>
							<td> {{ $i++ }} </td>
							<td> Rhymes </td>
							<td> &nbsp; </td>
							<td> &nbsp; </td>
							<td> &nbsp; </td>
							<td> &nbsp; </td>
							<td> &nbsp; </td>
							<td> &nbsp; </td>
							<td> &nbsp; </td>
							<td> &nbsp; </td>
						</tr>
						<tr>
							<td> {{ $i++ }} </td>
							<td> Hygiene </td>
							<td> &nbsp; </td>
							<td> &nbsp; </td>
							<td> &nbsp; </td>
							<td> &nbsp; </td>
							<td> &nbsp; </td>
							<td> &nbsp; </td>
							<td> &nbsp; </td>
							<td> &nbsp; </td>
						</tr>
						<tr>
							<td> {{ $i++ }} </td>
							<td> Conversation </td>
							<td> &nbsp; </td>
							<td> &nbsp; </td>
							<td> &nbsp; </td>
							<td> &nbsp; </td>
							<td> &nbsp; </td>
							<td> &nbsp; </td>
							<td> &nbsp; </td>
							<td> &nbsp; </td>
						</tr>
						<tr>
							<td> {{ $i++ }} </td>
							<td> Drawing </td>
							<td> &nbsp; </td>
							<td> &nbsp; </td>
							<td> &nbsp; </td>
							<td> &nbsp; </td>
							<td> &nbsp; </td>
							<td> &nbsp; </td>
							<td> &nbsp; </td>
							<td> &nbsp; </td>
						</tr>
						<tr>
							<td> {{ $i++ }} </td>
							<td> Games/PT </td>
							<td> &nbsp; </td>
							<td> &nbsp; </td>
							<td> &nbsp; </td>
							<td> &nbsp; </td>
							<td> &nbsp; </td>
							<td> &nbsp; </td>
							<td> &nbsp; </td>
							<td> &nbsp; </td>
						</tr>
					@endif
					<?php
						if($fullMarks > 0) $percent = (($totalMarks + $totalPractical)/$fullMarks)*100;
					?>
				</tbody>
			</table>
			<div class="col-md-5 col-sm-5 col-xs-5">
				<table class="marksheetTable footerTable">
					<tr>
						<th> Average GPA </th><th> {{ number_format($totalGpa / $c,2,'.',',') }} </th>
					</tr>
					<tr>
						<th> Division </th><th> @if($f == 0) {{ $homeCls->getDivision($percent) }} @else Failed @endif</th>
					</tr>
					<tr>
						<th> Percentage </th><th> @if($f == 0) {{ number_format($percent, 2, '.', ',') }} % @else --- @endif
						</th>
					</tr>
					 <tr>
						<th> Attendence </th><th> {{ App\Attendence::whereStudent($result->student)->whereExam($exam)->first()->attendence }} / 153 </th>
					</tr> 			<tr>
						<th> Rank </th><th> @if($rank > 0) {{ $rank }} / {{ $results->count() }} @else --- @endif </th>
					</tr>
				</table>
			</div>
			<div class="col-md-7 col-sm-7 col-xs-7">
				<table class="text-center marksheetTable footerTable">
					<thead>
						<tr>
							<th colspan="4"> 90% to 100% = A+ </th>
						</tr>
					</thead>
					<tbody>
						<tr>
							<th> A </th>
							<th> 80% to 89% </th>
							<th> B+ </th>
							<th> 70% - 79% </th>
						</tr>
						<tr>
							<th> B </th>
							<th> 60% - 69% </th>
							<th> C+ </th>
							<th> 50% - 59%</th>
						</tr>
						<tr>
							<th> C </th>
							<th> 40% - 49%</th>
							<th> D+ </th>
							<th> 30% - 39%</th>
						</tr>
						<tr>
							<th> D </th>
							<th> 20% - 29%</th>
							<th> E </th>
							<th> Below 20% </th>
						</tr>
					</tbody>
				</table>
			</div>
			<div class="clearfix"></div>
			<div class="col-md-12 col-sm-12 col-xs-12">
				<strong> Comment : </strong> <pre> {{ $homeCls->getComment($percent,$pf) }} </pre>
			</div>
			<div class="signature">
				<div class="col-md-4 col-sm-4 col-xs-4 giveBorder">
					<p> Class Teacher's Signature </p>
				</div>
				<div class="col-md-4 col-sm-4 col-xs-4 giveBorder">
					<p> School Seal </p>
				</div>
				<div class="col-md-4 col-sm-4 col-xs-4 giveBorder">
					<p> Principal </p>
				</div>
			</div>
		</div>
	@endforeach
</body>
</html>
