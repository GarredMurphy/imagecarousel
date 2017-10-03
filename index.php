<?php
    $backgroundImage = "img/sea.jpg";
    $keyword = $_GET['keyword'];
    $category = $_GET['category'];
    if ($category == "" && $keyword == "")
    {}
    else
    ##if (isset($_GET['keyword']) ||  isset($_GET['category']))
    {
        echo "<h2 >You searched for " . $_GET['keyword'] . "<br /> in the category " . $_GET['category'] . "</h2>";
        include 'api/pixabayAPI.php';
        $imageURLs = getImageURLs($_GET['keyword'], $_GET['category'], $_GET['layout']);
        ## print_r($imageURLs);
        $backgroundImage = $imageURLs[array_rand($imageURLs)];
    }
?>
<!DOCTYPE html>
<html>
    <head>
        <title>Image Carousel</title>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
        <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
        <style>
            @import url("css/styles.css");
            body {
                background-image: url('<?=$backgroundImage ?>');
                background-size: 100% 100%;
                background-attachment: fixed;
            }

        </style>
    </head>
    <body>

        <br /><br />
            <?php
                if (!isset($imageURLs)) {
                    echo "<h2> Type a keyword to display a slideshow <br /> with random images from Pixabay.com </h2>";
                } else {
            ?>
            <div id="carousel-example-generic" class="carousel slide" data-ride="carousel">
                <ol class="carousel-indicators">
                    <?php
                    for ($i=0; $i <7; $i++){
                        echo "<li data-target='#carousel-example-generic' data-slide-to = $i'";
                        echo ($i == 0)?" class = 'active'": "";
                        echo "></li>";
                    }
                    ?>
                </ol>
                
                <div class ="carousel-inner" role="listbox">
                <?php
                    for ($i = 0; $i < 7; $i++) {
                        do {
                            $randomIndex = rand(0,count($imageURLs));
                        }
                        while (!isset($imageURLs[$randomIndex]));
                        echo '<div class=" item ';
                        echo ($i == 0)?"active": "";
                        echo '">';
                        echo '<img src="' . $imageURLs[$randomIndex] . '" >';
                        echo "</div>";
                        unset($imageURLs[$randomIndex]);
                    }
                ?>
                </div>
                <a class ="left carousel-control" href="#carousel-example-generic" role="button" data-slide="prev">
                    <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
                    <span class="sr-only">Previous</span>
                </a>
                <a class ="right carousel-control" href="#carousel-example-generic" role="button" data-slide="next">
                    <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
                    <span class="sr-only">Next</span>
                </a>
            </div>
            <?php 
                }
            ?>
            
            
        <form>
            <input type="text" name="keyword" placeholder="Keyword">
            <br />
            <input type="radio" name = "layout" value = "horizontal" id= layout_h/>
            <label for="layout_h"> Horizontal </label>
            <br />
            <input type="radio" name = "layout" value = "vertical" id= layout_v/>
            <label for="layout_v"> Vertical </label>
            <br />
            <select name="category">
                 <option value=""> CATEGORY </option>
                 <option value="sea"  > Sea </option>
                 <option value="mountains"> Mountains </option>
                 <option value="forest"> Forest </option>
                 <option value="sky"> Sky </option>
            </select>
            <br />
            <br />
            <input type="submit" value ="Submit" />
        </form>
        <br /><br />
    </body>
</html>