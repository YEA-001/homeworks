<link rel="stylesheet" type="text/css" href="CSS\\styleIndex.css">
<?php
/**
 * Created by PhpStorm.
 * User: Y
 * Date: 4/29/2016
 * Time: 3:46 PM
 */
require_once 'Classes\\Image.php';

define('ACTION_IMAGE', 'image');
define('ACTION_SORT', 'sort');
define('FOLDER_GALLERY', 'girls\\');

// initialize _SESSION
session_start();

// check session
if ($_SESSION['session'] === true){
    // session exists
    //echo 'session is set';
} else {
    // sessing doesn't exist - redirect to Login page
    header('Location: http://localhost/GalleryOOP/login.php');
}

// get sortOrder from Cookies
$sortOrder = SORT_BY_NAME;
if (isset($_COOKIE['sortOrder'])){
    $sortOrder = $_COOKIE['sortOrder'];
}

// if gallery folder doesn't exist - create one
if (!file_exists(FOLDER_GALLERY))
    mkdir(FOLDER_GALLERY);

// add new item to gallery
if (isset($_POST['action']) && $_POST['action'] === ACTION_IMAGE){
    // Image posted
    $i = new Image($_FILES['girl']['size'], $_FILES['girl']['type'], $_FILES['girl']['tmp_name']);

    // Check file size
    if ($i->isValid())
        $i->copyToGallery(FOLDER_GALLERY . $_FILES['girl']['name']);

} elseif (isset($_POST['action']) && $_POST['action'] === ACTION_SORT){
    // Sorting changed
    $sortOrder = $_POST['sortBy'];
    setcookie('sortOrder', $sortOrder);
}
?>


<h3>Sort by:</h3>
<form method="post">
    <input type="hidden" name="action" value="<?php echo ACTION_SORT; ?>">

    <input type="radio" name="sortBy" id="SORT_BY_NAME" value="<?php echo SORT_BY_NAME;?>" <?php if ($sortOrder == SORT_BY_NAME) echo 'checked'; ?>>
    <label for="SORT_BY_NAME">name</label>

    <input type="radio" name="sortBy" id="SORT_BY_SIZE" value="<?php echo SORT_BY_SIZE;?>" <?php if ($sortOrder == SORT_BY_SIZE) echo ' checked';  ?>>
    <label for="SORT_BY_SIZE">size</label>

    <input type="radio" name="sortBy" id="SORT_BY_CDATE" value="<?php echo SORT_BY_CDATE;?>" <?php if ($sortOrder == SORT_BY_CDATE) echo ' checked';  ?>>
    <label for="SORT_BY_CDATE">date</label>

    <input type="submit" value="Apply">
</form>

<?php

// sort gallery
$girlsImages = getImageListSorted(FOLDER_GALLERY, $sortOrder)->getFileList();

// show gallery
foreach ($girlsImages as $girlImage){?>
    <div class="container">
        <a target="_blank" href="<?php echo 'http://localhost/GalleryOOP/' . FOLDER_GALLERY . $girlImage; ?>">
            <img width="100px" height="100px" src="<?php echo 'http://localhost/GalleryOOP/' . FOLDER_GALLERY . $girlImage; ?>">
            <div class="deleteButton">X</div>
        </a>
    </div>
    <?php
}
?>



<form method="post" enctype="multipart/form-data">
    <input type="hidden" name="action" value="<?php echo ACTION_IMAGE;?>">
    <input type="file" name="girl" accept="image/*">
    <br>
    <input type="submit" value="Send image">
</form>