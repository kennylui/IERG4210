<html>
<head>
    <link rel="stylesheet" href="style.css">
    <script src="jquery-3.6.0.min.js"></script>
    <script src="function.js"></script>
</head>

<body>
<script>
$(document).ready(function() {

$.getJSON("student-data.php", function(return_data){
$.each(return_data.data, function(key,value){
$("#student").append(

"<option value=" + value.id +">"+value.name+"</option>"

);
});
});

});
</script>
<select name=student id=student>
</select>

</body>
</html>