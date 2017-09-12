
<select name='course' class='form-control' id='course'>
    <option value="">select course</option>


    <?php


    $sno=0;
    foreach( $course as $c ) {
        $sno++;
        $techerCode =$c['TEACHER_CODE'];
        $courseTittle =$c['COURSE_TITLE'];
        $REMARKS =$c['REMARKS_PROGRAM_NAME'];
        ?>
        <?php echo form_open('/google_plus_cantroler/accessSheet');	?>
        <option value='<?php echo $techerCode ?>'><?php echo $courseTittle ?></option>");

        <?php
    }

    ?>
</select>
</div>
<div id="myResponse"></div>

<script>

    $("#course").change(function(){
        // alert("ra");
        addResultSheet();
    });

    function addResultSheet(){

        var TEACHER_CODE = $("#course").val();
        $.ajax({
            type: "POST",
            url: "http://localhost/google-plus/index.php/google_plus_cantroler/accessSheet",
            data:{  'TEACHER_CODE' : TEACHER_CODE
            },
            success: function(data){

                $('#myResponse').html(data);
            }
        });
    }
</script>
