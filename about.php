<?php
include('header.php');
include('config.php');

// Fetch content and image path from the `about_us` table
$query = "SELECT content, image_path FROM `about_us`";
$result = mysqli_query($conn, $query);
$content = mysqli_fetch_assoc($result);

// Debug output to verify the image path
if (!$content) {
    echo "Error fetching data: " . mysqli_error($conn);
    exit;
}
//tyhytnyn
//hyhyn
//tyhytnyn
//hyhyn
//helloooo
//bhaktiiii hereeeee

$imagePath = 'admin/admin/' . ($content['image_path']);


if (!file_exists($imagePath)) {
    echo "File does not exist: $imagePath";
    exit; // Stop execution if file doesn't exist
}
    
?>

<!doctype html>
<html lang="en">
<body>
<div class="container-fluid pl-0 pr-0 bg-img clearfix parallax-window2" data-parallax="scroll" data-image-src="images/banner2.jpg">
</div>


<div id="about-us" class="container-fluid fh5co-about-us pl-0 pr-0 parallax-window" data-parallax="scroll" data-image-src="images/about-us-bg.jpg">
    <div class="container">
        <div class="row">
            <div class="col-md-6">
                <h2 class="wow bounceInLeft" data-wow-delay=".25s">ABOUT US</h2>
                <hr/>
                <p class="wow bounceInRight" data-wow-delay=".25s" style="color: white;">
                   <br></br> <?php echo ($content["content"]); ?>
                </p>
            </div>
            <div class="col-md-6">
                <img src="<?php echo $imagePath; ?>" alt="gym" class="img-fluid wow bounceInRight" style="margin-top: 150px; width: 1000px; height: 400px; object-fit: cover;" />
            </div>
        </div>
    </div>
</div>


<script src="js/jquery.min.js"></script>
<script src="js/bootstrap.min.js"></script>
<script src="js/parallax.js"></script>
<script src="js/wow.js"></script>
<script src="js/main.js"></script>
</body>
</html>

<?php
include('footer.php');
?>
