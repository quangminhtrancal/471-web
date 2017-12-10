<?php
  require_once('initialize.php');
  require_once('query_functions.php');
  $id = $_GET['id'] ?? 1;
  $book=find_book_id($id);
  $bookinfo=mysqli_fetch_assoc($book);

  $person=find_all_people();
  $person_count = mysqli_num_rows($person);
  global $selectid;
?>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">

<div class="subject edit" class="form-group" class="container">

    <h3> Book <?php echo $bookinfo['Title_short']?> ISBN <?php echo $bookinfo['ISBN_13']?> </h3>
    <?php
      $check=return_book($id);
      if($check)
        {
        echo " Has been successfully returned!!!!";

        }
        else
        {
        echo " Has not been successfully returned. Please contact TA!!!!";

        }
    ?>

  </div>
  <div>
    <button class="btn btn-info btn-lg" onclick="location.href='index.php'">Go Back</button>
  </div>
