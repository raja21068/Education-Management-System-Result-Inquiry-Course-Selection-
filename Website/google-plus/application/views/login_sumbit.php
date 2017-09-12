<h4><b>SELECT YOUR SHEET </b></h4><br>

<div class='table-responsive'>
<?php if($course!=null){ ?>   
   <table class='table table-bordered table-striped' >
        <tr class="info">
            <tH>SNO</tH>
            <th>Course Name</th>
            <th>Batch</th>
            <th>action</th>
        </tr>

        <?php


        $sno=0;
        $attributes = array('target' => '_blank', 'id' => 'myform');
	
        foreach( $course as $c ) {
            $sno++;
            $techerCode =$c['TEACHER_CODE'];
            $courseTittle =$c['COURSE_TITLE'];
            $REMARKS =$c['REMARKS_PROGRAM_NAME'];
            ?>
            <?php echo form_open('/google_plus_cantroler/accessSheet',$attributes);	?>
            <tr>
                <td><?php echo $sno ?></td>
                <td><input type="hidden" name="TEACHER_CODE" value="<?php echo $techerCode ?>"><?php echo $courseTittle ?></td>
                <td><?php echo $REMARKS ?></td>
                <td><input type="submit" value="view"></td>
            </tr>
            <?php echo form_close() ?>
            <?php
        }
		} else{ echo ("<h1>NO RECORD FOUND</h1>");}
        ?>
</div>
<div id="myResponse"></div>

