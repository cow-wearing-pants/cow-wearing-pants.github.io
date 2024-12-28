<?php

#we'll use the url parameter "post-id" to get the file path
$path = $_GET['post-id'];

#let's serialize the path to prevent people from opening other files we don't want them to open
#we'll use the same code we used on the create.php page
$path = strtolower(preg_replace('/[^0-9a-zA-Z-_]/', '', $_POST["path"]));

#now we can open the json file and read the contents
$filePath = "files/" . $path . ".json";
$data = [];

if(file_exists($filePath)){

   $data = json_decode(file_get_contents($filepPath));

} else {
   #handle errors here
   echo "Post not found";
   exit;
}
?>
<!doctype html>
<html>
   <head>
      <title><?php echo htmlspecialchars($data->title); ?></title>
   </head>
   <body>
      <article>
         <h1><?php echo htmlspecialchars($data->title); ?></h1>
         <p>
            <!-- replace newline chars with closing and opening paragraph tags -->
            <?php echo preg_replace("/\\n/", "</p><p>", htmlspecialchars($data->content)); ?>
         </p>
      </article>
   </body>
</html>
