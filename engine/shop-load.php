<?php
session_start();
include_once("database.php");
include_once('../processes/my-functions.php');

if (isset($_POST['m_cat'])) {
    $m_cat_id = $_POST['m_cat'];
?>
    <select class="span4" name="s_cat" id="sub_cat">
      
      <?php
      $sql_ec2 = "SELECT * FROM ec_sub_category WHERE m_cat = $m_cat_id";
      $sql_ec_ini2 = $mycon2->query($sql_ec2);
      if (mysqli_num_rows($sql_ec_ini2) > 0) {
      ?>
      <option value="" disabled selected>Sub Category</option>
      <?php
        while ($cat2 = mysqli_fetch_array($sql_ec_ini2) ) {
        ?> 
        <option value="<?php echo $cat2['id']; ?>"><?php echo $cat2['s_cat'] ?></option>   
      <?php
        }
      }
      else{
      ?>
      <option disabled selected>No sub category</option>
      <?php
      }
      ?>
    </select>

<?php
}
if (isset($_POST['s_cat'])) {
    $s_cat = $_POST['s_cat'];
    $m_cat = $_POST['m_cat_id'];
?>
  <select class="span4" name="l_cat" id="least_cat">
    
    <?php
    $sql_ec3 = "SELECT * FROM ec_least_category WHERE s_cat = $s_cat AND m_cat = $m_cat";
    $sql_ec_ini3 = $mycon2->query($sql_ec3);
    if (mysqli_num_rows($sql_ec_ini3) > 0) {
      ?>
      <option selected disabled>Least category</option>
      <?php
    while ($cat3 = mysqli_fetch_array($sql_ec_ini3) ) {
    ?> 
    <option value="<?php echo $cat3['id']; ?>"><?php echo $cat3['l_cat'] ?></option>   
    <?php
        }
    }
    else{
      ?>
      <option disabled selected>No least category</option>
      <?php
      }
    ?>
  </select>
<?php
}
?>