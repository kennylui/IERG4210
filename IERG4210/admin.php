<fieldset>
    <legend>New Category</legend>
    <form id="cat_insert" method="POST" action="admin-process.php?action=cat_insert"
    enctype="multipart/from-data">
    <label for="cat_name"> Name <?php echo $action; ?></label>
    <div><input id="name" type="text" name="name" pattern="^[\w\- ]+$" require="true"/>
    </div>
    <input type="submit" value="Submit" />
    </form>
    
</fieldset>
<p></p>
<fieldset>
    <legend>New Product</legend>
    <form id="prod_insert" method="POST" action="admin-process.php?action=prod_insert"
    enctype="multipart/form-data">
    <label for="prod_catid">Category *</label>
    <div> <select id="prod_catid" name="catid">
    <option value='' selected>Select</option>

        <?Php
        require "config.php";// connection to database 
        $sql="select * from categories "; // Query to collect data 

        foreach ($db->query($sql) as $row) {
        echo "<option value=".$row[catid].">".$row[cname]."</option>";
        }
        ?>

    </select></div>

    <label for="prod_name">Name *</label>
    <div><input id="prod_name" type="text" name="name" required="true"
    pattern="^[\w\- ]+$" /></div>
    <label for="prod_price">Price *</label>
    <div><input id="prod_price" type="real" name="price" required="true"></div>
    <label for="prod_description">Description *</label>
    <div><textarea id="prod_description" type="text" name="description" required="true"
    pattern="^[\w\- ]+$" ></textarea></div>
    <label for="prod_name">Image *</label>
    <div><input type="file" name="file" required="true" accept="image/jpeg" /></div>
    <input type="submit" value="Submit" />
    </form>
<?php
if($_SERVER["REQUEST_METHOD"] == "POST")
{
$name = $_POST['name'];
if(empty($name))
{
    echo "Name is empty";
}
else
{
    echo $name;
}
}
?>
</fieldset>