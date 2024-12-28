<?php

$files = glob("files/*.json");

#sort the files by the date they were created
usort($files, function($a, $b) {
   return filectime($a) < filectime($b);
});

?>

<!doctype html>
   <head>
      <title>My Blog Feed</title>
   </head>
   <body>
<?php

foreach($files as $file){

   $data = json_decode(file_get_contents($file));
   
   $filePath = basename($file, '.json');

   echo '<a href="view.php?post-id=' . $filePath . '">';

   echo '<h1>' . htmlspecialchars($data->title) . '</h1>';

   echo '</a>';

}

?>
   </body>
</html>
