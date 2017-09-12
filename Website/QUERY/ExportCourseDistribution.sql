SELECT DISTINCT (ld.`COURSE_NO`) ,ld.`SEMESTER`,ld.`SCHEME_ID`,ld.`SCHEME_PART`,
ld.`SL_ID`,p.`DEPT_ID`,p.`PROG_ID`,
b.`GROUP_DESC`,b.`SHIFT` FROM ledger_details AS ld
					 INNER JOIN `seat_list` AS sl  ON sl.`SL_ID`=ld.`SL_ID` AND sl.`YEAR`=2015
					 INNER JOIN `batch` AS b ON b.`BATCH_ID`=sl.`BATCH_ID`
					 INNER JOIN `program` AS p ON p.`PROG_ID`=b.`PROG_ID`;

/*
$group='GNRL';
$shift='E';

if($group!=$group){
$scheme_id= AssignNewSchemeId();
}

*/
					 SELECT * FROM `scheme_detail` AS sd WHERE sd.`COURSE_NO`='BUS301' AND sd.`SCHEME_ID`=1310;