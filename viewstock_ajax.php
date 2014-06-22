<?php 
include 'include/db.php';
//update Category
if(isset($_POST['update_category_name']))
{
	$category_id = $_POST['update_category_id'];
	$category_name = htmlspecialchars(ucfirst($_POST['update_category_name']),ENT_QUOTES);

	$query  = "UPDATE category SET category = '$category_name' WHERE id = '$category_id'";
	$data  = mysql_query($query);

	$query = "SELECT id,category FROM category WHERE status = 1 ORDER BY category ASC";
	$category_data = mysql_query($query);
	
	echo '<select name="category">';
		while ($category_row = mysql_fetch_assoc($category_data)) {
			if($category_row['id'] == 1)
		echo'<option selected value = "'.$category_row['id'].'">'.$category_row['category'].'</option>'; 
			else
		echo'<option value = "'.$category_row['id'].'">'.$category_row['category'].'</option>'; 

		}
	echo '</select>';	
}

//delete category.
if(isset($_POST['delete_category_id']))
{
	$category_id = $_POST['delete_category_id'];
	//update category status into category table..
	$query = "UPDATE category SET status = 0 WHERE id = '$category_id'";
	$data = mysql_query($query);

	//update category into product table
	$query = "UPDATE product SET category = 1 WHERE category = '$category_id'";
	$data = mysql_query($query);


	$query = "SELECT id,category FROM category WHERE status = 1 ORDER BY category ASC";
	$category_data = mysql_query($query);
	
	echo '<select name="category">';
		while ($category_row = mysql_fetch_assoc($category_data)) {
			if($category_row['id'] == 1)
		echo'<option selected value = "'.$category_row['id'].'">'.$category_row['category'].'</option>'; 
			else
		echo'<option value = "'.$category_row['id'].'">'.$category_row['category'].'</option>'; 

		}
	echo '</select>';

}
if(isset($_POST['new_category_name']))
{
	$category =  htmlspecialchars(ucfirst($_POST['new_category_name']),ENT_QUOTES);

	//insert new category into category table..
	$query = "INSERT INTO category (category) VALUES ('$category')";
	$data = mysql_query($query);

	$query = "SELECT id FROM category ORDER BY id DESC LIMIT 1";
	$data = mysql_query($query);
	$row = mysql_fetch_assoc($data);
	$new_category_id = $row['id'];


	$query = "SELECT id,category FROM category WHERE status = 1 ORDER BY category ASC";
	$category_data = mysql_query($query);
	
	$select_start = '<select name="category">';
	$select_option = "";
		while ($category_row = mysql_fetch_assoc($category_data)) {
			if($category_row['id'] == 1)
	$select_option .= '<option selected value = "'.$category_row['id'].'">'.$category_row['category'].'</option>'; 
			else
	$select_option .= '<option value = "'.$category_row['id'].'">'.$category_row['category'].'</option>'; 

		}
	$select_close = '</select>';

	echo $new_category_id . "***kasovious***" . $select_start.$select_option.$select_close;

}

if(isset($_POST['search_text']))
{
	$search_text = $_POST['search_text'];
	$search_text = chunk_split($search_text, 1 , "%" );

	$category_query = "SELECT * FROM category WHERE category LIKE '%$search_text' AND status = '1' ORDER BY category ASC;";
	
	//Execute The Sql Query
	$category_data = mysql_query($category_query);

	$i=1;
	while ($category_row = mysql_fetch_assoc($category_data)) {
	echo "<tr>";
			echo "<td>".$i."</td>";
			echo "<td class='category_edit' id='".$category_row['id']."'>".$category_row['category']."</td>";
			if($category_row['id'] != 1)
			echo "<td class='del'><img src='img/iconmonstr-x-mark-icon.png' alt='del' class='delete_category'></td>";
		echo "</tr>";
		$i++;
	}
}
?>
<?php
//brand modal...

//update category
if(isset($_POST['update_brand_name']))
{
	$brand_id = trim($_POST['update_brand_id']);
	$brand_name =  htmlspecialchars(ucfirst($_POST['update_brand_name']),ENT_QUOTES);
	$query  = "UPDATE brand SET brand = '$brand_name' WHERE id = '$brand_id'";
	$data  = mysql_query($query);

	$query = "SELECT id,brand FROM brand WHERE status = 1 ORDER BY brand ASC";
	$brand_data = mysql_query($query);
	
	echo '<select name="brand">';
		while ($brand_row = mysql_fetch_assoc($brand_data)) {
			if($brand_row['id'] == 1)
		echo'<option selected value = "'.$brand_row['id'].'">'.$brand_row['brand'].'</option>'; 
			else
		echo'<option value = "'.$brand_row['id'].'">'.$brand_row['brand'].'</option>'; 

		}
	echo '</select>';	
}

//delete brand.
if(isset($_POST['delete_brand_id']))
{
	$brand_id = trim($_POST['delete_brand_id']);
	//update brand status into brand table..
	$query = "UPDATE brand SET status = 0 WHERE id = '$brand_id'";
	$data = mysql_query($query);

	//update brand into product table
	$query = "UPDATE product SET brand = 1 WHERE brand = '$brand_id'";
	$data = mysql_query($query);


	$query = "SELECT id,brand FROM brand WHERE status = 1 ORDER BY brand ASC";
	$brand_data = mysql_query($query);
	
	echo '<select name="brand">';
		while ($brand_row = mysql_fetch_assoc($brand_data)) {
			if($brand_row['id'] == 1)
		echo'<option selected value = "'.$brand_row['id'].'">'.$brand_row['brand'].'</option>'; 
			else
		echo'<option value = "'.$brand_row['id'].'">'.$brand_row['brand'].'</option>'; 

		}
	echo '</select>';

}
if(isset($_POST['new_brand_name']))
{
	$brand = htmlspecialchars(ucfirst($_POST['new_brand_name']),ENT_QUOTES);

	//insert new brand into brand table..
	$query = "INSERT INTO brand (brand) VALUES ('$brand')";
	$data = mysql_query($query);

	$query = "SELECT id FROM brand ORDER BY id DESC LIMIT 1";
	$data = mysql_query($query);
	$row = mysql_fetch_assoc($data);
	$new_brand_id = $row['id'];


	$query = "SELECT id,brand FROM brand WHERE status = 1 ORDER BY brand ASC";
	$brand_data = mysql_query($query);
	
	$select_start = '<select name="brand">';
	$select_option = "";
		while ($brand_row = mysql_fetch_assoc($brand_data)) {
			if($brand_row['id'] == 1)
	$select_option .= '<option selected value = "'.$brand_row['id'].'">'.$brand_row['brand'].'</option>'; 
			else
	$select_option .= '<option value = "'.$brand_row['id'].'">'.$brand_row['brand'].'</option>'; 

		}
	$select_close = '</select>';

	echo $new_brand_id . "***kasovious***" . $select_start.$select_option.$select_close;

}

if(isset($_POST['search_text_brand']))
{
	$search_text = $_POST['search_text_brand'];
	$search_text = chunk_split($search_text , 1 , '%');

	$brand_query = "SELECT * FROM brand WHERE brand LIKE '%$search_text' AND status = '1' ORDER BY brand ASC;";
	
	//Execute The Sql Query
	$brand_data = mysql_query($brand_query);

	$i=1;
	while ($brand_row = mysql_fetch_assoc($brand_data)) {
	echo "<tr>";
			echo "<td>".$i."</td>";
			echo "<td class='brand_edit' id='".$brand_row['id']."'>".$brand_row['brand']."</td>";
			if($brand_row['id'] != 1)
			echo "<td class='del'><img src='img/iconmonstr-x-mark-icon.png' alt='del' class='delete_brand'></td>";
		echo "</tr>";
		$i++;
	}
}
?>
<?php
//execute when click on tick button in view stock..
if(isset($_POST['product_update']))
{
	$product_details = $_POST['product_update'];
	$product_id = $product_details[0];
	$category = $product_details[1];
	$brand = $product_details[2];
	$product_name = htmlspecialchars($product_details[3],ENT_QUOTES);
	$product_qty = $product_details[4];
	$price = $product_details[5];
	$color = $product_details[6];
	$size = $product_details[7];
	$type = $product_details[8];
	$query = "UPDATE product SET product_name = '$product_name' , category = '$category' , 
	brand = '$brand' , qty = '$product_qty' , price = '$price' , color = '$color' , size = '$size' ,
	type = '$type'  WHERE product_id = '$product_id' ";
	$data = mysql_query($query);

	$query_category = mysql_query("SELECT id,category FROM category WHERE id = $category");
	$row_category = mysql_fetch_assoc($query_category);

	$query_brand = mysql_query("SELECT id,brand FROM brand WHERE id = $brand");
	$row_brand = mysql_fetch_assoc($query_brand);

	echo trim($row_category['id'].'***kasovious***'.$row_category['category'].'***kasovious***'.$row_brand['id'].'***kasovious***'.$row_brand['brand']);
}
if(isset($_POST['product_delete']))
{
	$product_id = trim($_POST['product_delete']);
	$query = mysql_query("UPDATE product SET status = 0 WHERE product_id = '$product_id'");
}
?>