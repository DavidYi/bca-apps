<?php
/**
 * Created by PhpStorm.
 * User: matth
 * Date: 4/20/2016
 * Time: 10:31 AM
 */

// function needs teacher id
function addCourse($course_name, $course_desc) {
    $query = "INSERT INTO elect_course (course_name, course_desc, teacher_id) 
    VALUES ('$course_name', 'course_desc', '')";
}
?>