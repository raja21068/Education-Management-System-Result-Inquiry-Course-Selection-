<?php include("bar.php"); ?>
<div class="container floated">

	<div class="sixteen floated page-title">

	<h1>GPA System </h1>
	
		<p style='margin-bottom:10px; margin-top:10px; font-size:20px;'>Semester Examinations</p>

	</div>
<div>

<p class="lead">Expression for the average performance of the student in the courses he has offered during one or two semesters or at the end of the entire course.</p>
<p class="lead"> G.P.A.=      Sum of all the Quality Points earned / Sum of the Credit Hours of all the courses offered</p>
<P class='lead'>Multiply Grade Point with the Credit Hourse in each course, add up the cumulative Grade Points and divide by the Total Number of credit hours to get the G.P.A. per Semester. In the below example the G.P.A. is 44.3 divided by 17= 2.61</p>

</div>
<TABLE class='standard-table'>
	<tr class='info'>
				<th>Course #</th>
				<th> Credit Hrs</th>
				<th>Score</th>
				<th>Grade</th>
				<th>Grade Point/CH</th>
				<th>Credit Hrs x Grade Point= CGP</th>

			</tr>
			<tr>
				<TD>ENGL 101</TD>
				<TD>3</TD>
				<TD>68%</TD>
				<TD>B</TD>
				<TD>3.4</TD>
				<TD> 3 x 3.4 = 10.2</TD>
			</tr>
		    <tr>
				<TD>ARAB 101</TD>
				<TD>3</TD>
				<TD>57%</TD>
				<TD>C</TD>
				<TD>2.7</TD>
				<TD>3 x 2.7= 8.1</TD>
			</tr>
			
			<tr>
				<TD>ZOOL 101</TD>
				<TD>3+1=4</TD>
				<TD>45%</TD>
				<TD>D</TD>
				<TD>1.5</TD>
				<TD>4 x 1.5= 6.0</TD>
			</tr>			
			<tr>
				<TD>COMP 101 </TD>
				<TD>2+1=3</TD>
				<TD>80%</TD>
				<TD>A</TD>
				<TD>4.0</TD>
				<TD>3 x 4.0= 12.0</TD>
			</tr>			
			<tr>
				<TD>BOTN 101</TD>
				<TD>3+1=4</TD>
				<TD>50%</TD>
				<TD>C</TD>
				<TD>2.0</TD>
				<TD>4 x 2.0= 8.0</TD>
			</tr>
			
			<tr>
				<TD></TD>
				<TD>Total = 17</TD>
				<TD></TD>
				<TD></TD>
				<TD></TD>
				<TD>Total= 44.3</TD>
			</tr>
			<tr>
				<TD COLSPAN='6'>44.3 / 17 = 2.61 GPA</TD>
				
			</tr>

</TABLE>
<OL>
<LI> G.P.A. 2 or above is to be scored for successful completion of the courses offered in one or two semester or at the end of the entire program.</LI>
<LI>G.P.A. 1.75 but < 2 on the other hand qualifies for promotion from 2nd to 3rd or 4th to 5th although failing or having scored ‘D’ grade in some or all courses.</LI>
<LI>With G.P.A. less than 1.75 a student does not qualify for promotion to next higher semester.</LI>
</OL>

<?php include ("footer.php"); ?>