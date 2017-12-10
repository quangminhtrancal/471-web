
<?php
require_once('initialize.php');
require_once('query_functions.php');
  $id = $_POST['searchTerm'];
  $result=find_book_available($id);
?>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
<div id="content">
  <div class="Author">
    <h1>AVAILABLE BOOK</h1>

    <table class="table">
      <tr class="danger">
        <th>Title_short</th>
        <th>ISBN_13</th>
        <th>Subject</th>
        <th>Author_name</th>
        <th>Tag</th>
        <th>Location_name</th>
        <th>Storage_name</th>
        <th>Parent_partition_x</th>
        <th>Parent_partition_y</th>
        <th>Person_name</th>
        <th>Checkout_date</th>
        <th>Confirm to Checkout</th>

      </tr>

      <?php while($information = mysqli_fetch_assoc($result)) { ?>

        <tr class="info">
          <td><?php echo $information['Title_short']; ?></td>
          <td><?php echo $information['ISBN_13']; ?></td>
          <td><?php echo $information['Subject']; ?></td>
          <td><?php echo $information['Author_name']; ?></td>
          <td><?php echo $information['Tag']; ?></td>
          <td><?php echo $information['Location_name']; ?></td>
          <td><?php echo $information['Storage_name']; ?></td>
          <td><?php echo $information['Parent_partition_x']; ?></td>
          <td><?php echo $information['Parent_partition_y']; ?></td>
          <td><?php echo $information['Person_name']; ?></td>
          <td><?php echo $information['Checkout_date']; ?></td>
           <td><a href='edit.php?id=<?php echo $information['Item_id']?>'>Checkout</a></td>

        </tr>
      <?php } ?>
    </table>
  </div>

</div>

<?php

  mysqli_free_result($result);

?>
</div>



<!--------- Book unavailable--->

<?php
  $id = $_POST['searchTerm'];
  $result1=find_book_unavailable($id);
?>
<div id="content2">
  <div class="Author2">
    <h1>UNAVAILABLE BOOK</h1>

    <table class="table">
      <tr class="danger">
        <th>Title_short</th>
        <th>ISBN_13</th>
        <th>Subject</th>
        <th>Author_name</th>
        <th>Tag</th>
        <th>Location_name</th>
        <th>Storage_name</th>
        <th>Parent_partition_x</th>
        <th>Parent_partition_y</th>
        <th>Person_name</th>
        <th>Checkout_date</th>
        <th>Confirm to Return</th>

      </tr>

      <?php while($information1 = mysqli_fetch_assoc($result1)) { ?>

        <tr class="info">
          <td><?php echo $information1['Title_short']; ?></td>
          <td><?php echo $information1['ISBN_13']; ?></td>
          <td><?php echo $information1['Subject']; ?></td>
          <td><?php echo $information1['Author_name']; ?></td>
          <td><?php echo $information1['Tag']; ?></td>
          <td><?php echo $information1['Location_name']; ?></td>
          <td><?php echo $information1['Storage_name']; ?></td>
          <td><?php echo $information1['Parent_partition_x']; ?></td>
          <td><?php echo $information1['Parent_partition_y']; ?></td>
          <td><?php echo $information1['Person_name']; ?></td>
          <td><?php echo $information1['Checkout_date']; ?></td>
           <td><a href='delete.php?id=<?php echo $information1['Item_id']?>'>Return</a></td>

        </tr>
      <?php } ?>
    </table>
  </div>

</div>

<?php

  mysqli_free_result($result);

?>
</div>

<!--- END--->


<button class="btn btn-info btn-lg" onclick="goBack()">Go Back</button>

<script>
function goBack() {
    window.history.back();
}
</script>
