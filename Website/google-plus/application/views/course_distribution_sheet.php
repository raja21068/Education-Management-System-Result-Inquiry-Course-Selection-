<h4><b>SELECT COURSE DISTRIBUTION </b></h4><br>

<div class='table-responsive'>
    <?php if($cd!=null){ ?>
    <table class='table table-bordered table-striped' >
        <tr class="info">
            <tH>SNO</tH>
            <th>PROGRAM NAME</th>
            <th>GROUP</th>
            <th>SHIFT</th>
            <th>VIEW</th>
        </tr>

        <?php


        $sno=0;
        $attributes = array('target' => '_blank', 'id' => 'myform');

        foreach( $cd as $c ) {
            $sno++;
            $programTittle =$c['PROGRAM_TITLE'];
            $shift =$c['SHIFT'];
            if($shift=='M'){
                $shift="Morning";
            }else{
                $shift="EVENING";
            }

            $group =$c['GROUP'];
            $schemeId =$c['SCHEME_ID'];
            ?>
            <?php echo form_open('/course_distribution_cantroler/departmentWiseScheme',$attributes);	?>
            <tr>
                <td><?php echo $sno ?></td>
                <td><input type="hidden" name="scheme_id" value="<?php echo $schemeId ?>"><?php echo $programTittle ?></td>
                <td><?php echo $group ?></td>
                <td><?php echo $shift ?></td>
                <td><input type="submit" value="view"></td>
            </tr>
            <?php echo form_close() ?>
            <?php
        }
        } else{ echo ("<h1>NO RECORD FOUND</h1>");}
        ?>
</div>
<div id="myResponse"></div>

