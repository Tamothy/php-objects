<?php
    require_once __DIR__."/../vendor/autoload.php";
    require_once __DIR__."/../src/Rectangle.php";
    require_once __DIR__."/../src/Cd.php";

    $app = new Silex\Application();

    $app['debug'] = true;

    $app->get("/cd_selection", function() {
      $first_cd = new CD("Hot Fuss", "The Killers", "images/the-killers.jpg", 10.99);
      $second_cd = new CD("Three Cheers for the Sweet Revenge", "My Chemical Romance", "images/three-cheers.jpg", 10.99);
      $third_cd = new CD("The Suburbs", "Arcade Fire", "images/arcade-fire.jpg", 10.99);
      $fourth_cd = new CD("You Can't Stop the Bum Rush", "Len", "images/len.jpg", 49.99);
      $cds = array($first_cd, $second_cd, $third_cd, $fourth_cd);

      $output = "";
      foreach ($cds as $album) {
          $output = $output . "<div class='row'>
              <div class='col-md-6'>
                  <img src=" . $album->getCoverArt() . ">
              </div>
              <div class='col-md-6'>
                  <p>" . $album->getTitle() . "</p>
                  <p>By " . $album->getArtist() . "</p>
                  <p>$" . $album->getPrice() . "</p>
              </div>
          </div>
    ";
}
return $output;


    });

    $app->get("/", function() {
      return "
      <!DOCTYPE html>
      <head>
          <link rel='stylesheet' href='https://maxcdn.bootstrapcdn.com/bootstrap/3.3.1/css/bootstrap.min.css'>
          <title>Make a rectangle!</title>
      </head>
      <body>
        <div class='container'>
          <p>Hello world! Welcome to Tam's area calculator! Click <a href='/new_rectangle'>here</a> to get find an area of a polygon!</p>
        </div>
        <div class='container'>
          <p>We also have a CD colection! Click <a href='/cd_selection'>here</a> to browse our selection!</p>
        </div>
      </body>
      </html>
      ";
    });

    $app->get("/new_rectangle", function() {
        return "
        <!DOCTYPE html>
        <html>
        <head>
            <link rel='stylesheet' href='https://maxcdn.bootstrapcdn.com/bootstrap/3.3.1/css/bootstrap.min.css'>
            <title>Make a rectangle!</title>
        </head>
        <body>
            <div class='container'>
                <h1>Geometry Checker</h1>
                <p>Enter the dimensions of your rectangle to see if it's a square.</p>
                <form action='/view_rectangle'>
                    <div class='form-group'>
                      <label for='length'>Enter the length:</label>
                      <input id='length' name='length' class='form-control' type='number'>
                    </div>
                    <div class='form-group'>
                      <label for='width'>Enter the width:</label>
                      <input id='width' name='width' class='form-control' type='number'>
                    </div>
                    <button type='submit' class='btn-success'>Create</button>
                </form>
            </div>
        </body>
        </html>
        ";
    });

    $app->get("/view_rectangle", function() {
    $my_rectangle = new Rectangle($_GET['length'], $_GET['width']);
    $area = $my_rectangle->getArea();
    if ($my_rectangle->isSquare()) {
        return "<h1>Congratulations! You made a square! Its area is $area.</h1>";
    } else {
        return "<h1>Sorry! This isn't a square. Its area is $area.</h1>";
    }
});

    return $app;
?>
