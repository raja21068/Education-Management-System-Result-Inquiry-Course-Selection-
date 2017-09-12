SELECT COUNT(c.`scheme_detail_COURSE_NO`) AS TOTAL_STUDENT ,C.`scheme_detail_COURSE_NO`,C.`scheme_detail_COURSE_TITTLE`,C.`scheme_detail_SEMESTER`,C.`scheme_detail_PART`
			 FROM `exam_form_paper` AS c 
                         INNER JOIN `exam_form_student_enlorment` AS form ON form.`ID`=c.`exam_form_student_enlorment_ID`
                         WHERE c.`scheme_detail_COURSE_NO`='CS501' AND form.`EXAM_TYPE`='R' AND STATUS='L';
                         