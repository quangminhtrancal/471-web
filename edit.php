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

    <h3> Book <?php echo $bookinfo['Title_short']?> ISBN <?php echo $bookinfo['ISBN_13']?> is chosen by </h3>

    <form action="" method="post" class="form-group">
      <dl>
        <dt></dt>
        <dd>
          <select id="list" name="Person_name">
              <?php
              for($i=1; $i <= $person_count; $i++) {
                $information = mysqli_fetch_assoc($person);
                echo "<option value=\"{$information['Person_name']}\"";
                //if($result['Person_name'] == $information['Person_name']) {
                //  $selectid=$information['Person_id'];
                //  echo "selected";
                //}
                echo ">{$information['Person_name']}</option>";
              }
            ?>
          </select>

        </dd>
      </dl>

      <div id="operations">
        <input class="btn btn-info btn-lg" type="submit" name="submit" value="Confirm checkout" />
      </div>
    </form>
    <?php
      if(isset($_POST['submit'])){
        $selected_val = $_POST['Person_name'];  // Storing Selected Value In Variable
        echo $selected_val ;  // Displaying Selected Value
      //  echo " Item id: ".$bookinfo['Item_id'];
        //echo " Person ID: ".$information[Person_id];
        $person=find_all_people();
        $person_count = mysqli_num_rows($person);

        for($i=1; $i <= $person_count; $i++) {
          $information1 = mysqli_fetch_assoc($person);
        //  echo " Person ID: ".$information1[Person_id];
        //  echo " Person ID: ".$information1[Person_name];
          if ($information1['Person_name'] == $selected_val)
          {
            $selectid= $information1['Person_id'];
            break;
          }
        }

        $check=checkout_book($bookinfo['Item_id'],$selectid);
        if($check)
          {
          echo " has successfully checked out!!!!";

          }
          else
          {
          echo " has not successfully checked out. Please contact TA!!!!";

          }
      }
    ?>

  </div>
  <div>
    <button class="btn btn-info btn-lg" onclick="location.href='index.php'">Go Back</button>
  </div>
