<?php
if (isset($_POST) && $_POST){
    echo "<pre>";
    print_r($_POST);
    echo"<pre>";

}
if (isset($_file) && $_file) {
    echo "<pre>";
    print_r($_file);
    echo"<pre>";
}
?>
<html>
<head>
<body>
    <form action="" method="post" enctype="multipart/form-data">
        <div>
            <label>texte</label>
            <input type="text" name="titre">
        </div>
        <div >
            <label>file</label>
            <input type="file" name="file">
        </div>
        <input type="submit" value="Submit">
    </form>


    <form action="" method="" enctype="multipart/form-data">
        <div>
            <label>texte</label>
            <input type="text" name="titre1">
        </div>
        <div >
            <label>file</label>
            <input type="file" name="file1" >
        </div>
        <input type="submit" value="Submit">
    </form>
    
</body>
</head>
</html>