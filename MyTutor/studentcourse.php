        <?php
        require_once 'header.php';
      //display courses available
      $myquery="SELECT * FROM student_course JOIN course ON student_course.course=course.id WHERE student=$userid";
      $selected=queryMysql($myquery);
      if (!$selected->num_rows) {
          echo'<p>No Courses Registered </br> Choose course below to register</p>';
      } else {
       while ($row=$selected->fetch_array(MYSQLI_ASSOC)) { 
        $code=$row['code'];
        $cname=$row['name'];
         echo '<tr><td class="mdl-data-table__cell--non-numeric" >'.$code.'-'.$cname.'</td><td><button name="course" formaction="studentprofile.php" value="'.$code.'">enter</button></td></tr>';
      }
      }
        ?>