<?php

  // Subjects

  function find_all_book_authors() {
    global $db;

    $sql = "SELECT Author_name,ISBN_13 FROM BOOK_AUTHORS ORDER BY Author_name";


    $result = mysqli_query($db, $sql);
    confirm_result_set($result);
    return $result;
  }
  function find_all_people() {
    global $db;

    $sql = "SELECT * FROM PERSON as p ORDER BY p.Person_name";
    $result = mysqli_query($db, $sql);
    confirm_result_set($result);
    return $result;
  }

  function find_all_information() {
    global $db;
    $sql = "SELECT b.Title_short,b.ISBN_13, b.Subject,ba.Author_name, it.Tag,l.Location_name, s.Storage_name,s.Parent_partition_x,s.Parent_partition_y,p.Person_name, ic.Checkout_date
FROM BOOK as b LEFT JOIN  ITEM_CHECKOUT as ic ON b.Item_id=ic.Item_id
LEFT JOIN PERSON as p ON p.Person_id=ic.Person_id
JOIN BOOK_AUTHORS as ba ON ba.ISBN_13=b.ISBN_13
JOIN ITEM_TAGS as it on it.Item_id=b.Item_id
JOIN ITEM as i on i.Item_id=b.Item_id
JOIN STORAGE_LOCATION as sl on sl.Storage_id=i.Parent_storage
JOIN STORAGE as s on s.Storage_id=sl.Storage_id
Join LOCATION as l on sl.Location_id=l.Location_id";
    $result = mysqli_query($db, $sql);
    confirm_result_set($result);
    return $result;
  }

  function find_book($id) {
    global $db;
    $sql = "SELECT b.Item_id,b.Title_short,b.ISBN_13, b.Subject,ba.Author_name, it.Tag,l.Location_name, s.Storage_name,s.Parent_partition_x,s.Parent_partition_y,p.Person_name, ic.Checkout_date FROM BOOK as b LEFT JOIN ITEM_CHECKOUT as ic ON b.Item_id=ic.Item_id LEFT JOIN PERSON as p ON p.Person_id=ic.Person_id JOIN BOOK_AUTHORS as ba ON ba.ISBN_13=b.ISBN_13 JOIN ITEM_TAGS as it on it.Item_id=b.Item_id JOIN ITEM as i on i.Item_id=b.Item_id JOIN STORAGE_LOCATION as sl on sl.Storage_id=i.Parent_storage JOIN STORAGE as s on s.Storage_id=sl.Storage_id Join LOCATION as l on sl.Location_id=l.Location_id";
    $sql .= " WHERE b.Title_short like '%" . db_escape($db, $id) . "%'";
    $sql .=" OR b.Title_long like '%" . db_escape($db, $id) . "%'";
    $sql .=" or ba.Author_name like '%" . db_escape($db, $id) . "%'";
    $sql .=" or it.Tag like '%" . db_escape($db, $id) . "%'";

    $result = mysqli_query($db, $sql);
    return $result;
  }

  function find_book_available($id) {
    global $db;
    $sql = "SELECT b.Item_id,b.Title_short,b.ISBN_13, b.Subject,ba.Author_name, it.Tag,l.Location_name, s.Storage_name,s.Parent_partition_x,s.Parent_partition_y,p.Person_name, ic.Checkout_date
FROM BOOK as b LEFT JOIN  ITEM_CHECKOUT as ic ON b.Item_id=ic.Item_id
LEFT JOIN PERSON as p ON p.Person_id=ic.Person_id
JOIN BOOK_AUTHORS as ba ON ba.ISBN_13=b.ISBN_13
JOIN ITEM_TAGS as it on it.Item_id=b.Item_id
JOIN ITEM as i on i.Item_id=b.Item_id
JOIN STORAGE_LOCATION as sl on sl.Storage_id=i.Parent_storage
JOIN STORAGE as s on s.Storage_id=sl.Storage_id
Join LOCATION as l on sl.Location_id=l.Location_id WHERE b.Title_short like '%" . db_escape($db, $id) . "%' and ic.Checkout_date IS NULL";


    $result = mysqli_query($db, $sql);
    return $result;

  }

  function find_book_unavailable($id) {
    global $db;
    $sql = "SELECT b.Item_id,b.Title_short,b.ISBN_13, b.Subject,ba.Author_name, it.Tag,l.Location_name, s.Storage_name,s.Parent_partition_x,s.Parent_partition_y,p.Person_name, ic.Checkout_date
FROM BOOK as b JOIN  ITEM_CHECKOUT as ic ON b.Item_id=ic.Item_id
JOIN PERSON as p ON p.Person_id=ic.Person_id
JOIN BOOK_AUTHORS as ba ON ba.ISBN_13=b.ISBN_13
JOIN ITEM_TAGS as it on it.Item_id=b.Item_id
JOIN ITEM as i on i.Item_id=b.Item_id
JOIN STORAGE_LOCATION as sl on sl.Storage_id=i.Parent_storage
JOIN STORAGE as s on s.Storage_id=sl.Storage_id
Join LOCATION as l on sl.Location_id=l.Location_id";
    $sql .= " WHERE b.Title_short like '%" . db_escape($db, $id) . "%'";
    $sql .=" OR b.Title_long like '%" . db_escape($db, $id) . "%'";
    $sql .=" or ba.Author_name like '%" . db_escape($db, $id) . "%'";
    $sql .=" or it.Tag like '%" . db_escape($db, $id) . "%' and ic.Checkout_date IS NOT NULL";

    $result = mysqli_query($db, $sql);

    return $result;
  }

  function find_book_id($id) {
    global $db;
    $sql = "SELECT b.Item_id,b.Title_short,b.ISBN_13, b.Subject,ba.Author_name, it.Tag,l.Location_name, s.Storage_name,s.Parent_partition_x,s.Parent_partition_y,p.Person_name, ic.Checkout_date FROM BOOK as b LEFT JOIN ITEM_CHECKOUT as ic ON b.Item_id=ic.Item_id LEFT JOIN PERSON as p ON p.Person_id=ic.Person_id JOIN BOOK_AUTHORS as ba ON ba.ISBN_13=b.ISBN_13 JOIN ITEM_TAGS as it on it.Item_id=b.Item_id JOIN ITEM as i on i.Item_id=b.Item_id JOIN STORAGE_LOCATION as sl on sl.Storage_id=i.Parent_storage JOIN STORAGE as s on s.Storage_id=sl.Storage_id Join LOCATION as l on sl.Location_id=l.Location_id";
    $sql .= " WHERE b.Item_id = '" . db_escape($db, $id) . "'";

    $result = mysqli_query($db, $sql);
    return $result;
  }
  function return_book($id) {
    global $db;
    $sql = "DELETE FROM ITEM_CHECKOUT
    WHERE Item_id = '" . db_escape($db, $id) . "'";

    $result = mysqli_query($db, $sql);
    return $result;
  }

function checkout_book($bookid,$personid){
  global $db;
  $date = date('Y-m-d');
  $time=time('H:i:s');
  $sql ="INSERT INTO ITEM_CHECKOUT(Item_id, Person_id, Checkout_date, Checkout_time )
VALUES ('" . db_escape($db, $bookid) . "','" . db_escape($db, $personid) . "','$date','$time')";
$result = mysqli_query($db, $sql);
return $result;
}



?>
