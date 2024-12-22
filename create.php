<?php
#require basic http authentication, built in to most browsers

if (!isset($_SERVER['PHP_AUTH_USER']) || $_SERVER['PHP_AUTH_USER'] !== 'your-username' || $_SERVER['PHP_AUTH_PW'] !== 'your-password') {
   header('WWW-Authenticate: Basic realm="Blog Post"');
   header('HTTP/1.0 401 Unauthorized');
   echo 'Go away';
   exit;
}

#check if form was submitted

if(isset($_POST["title"])){
   #get the values submitted
   $title = $_POST["title"];
   $content = $_POST["content"];

   #only allow letters, numbers, dashes and underscores in the path
   $path = strtolower(preg_replace('/[^0-9a-zA-Z-_]/', '', $_POST["path"]));

   #at this point we'll save a new file with the blog post data in JSON format
   $json = json_encode([
      "title"=>$title,
      "content"=>$content
   ]);

   #save the json data in a file in the "files" folder
   file_put_contents("files/" . $path . ".json", $json);

   #Your blog post is now saved!
}

?>

<!doctype html>
<html>
   <head>
      <title>Create a Blog Post</title>
   </head>
   <body>
      <form method=post>
         <input name="title">
         <textarea name="content">
         <input name="path"><!-- path we'll use to view the blog bost -->
         <button type="submit">Save</button>
      </form>
   </body>
</html>
