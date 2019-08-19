<?php
include 'functions.php';
$api = new restApi();
$msg = $msg2 = '';
$posts = $api->getPosts(); 
if(isset($_POST['action'])){
    if($_POST['action'] == 'submit-post'){
        if($_POST['post-title'] != '' && $_POST['post-content'] != ''){
            $newPost = $api->addPost($_POST['post-title'], $_POST['post-content']);
            if($newPost->id > 0){
                $msg = 'Post created successfully';
            }
        }
        else{
            $msg = 'Fields are required.';
        }
    }
    if($_POST['action'] == 'delete-post'){
    }
}
?>
    <html>

    <head>
        <title>API</title>
    </head>

    <body>
        <h3>List All Posts</h3>
        <?php
        foreach($posts as $post){
            echo '<h4>'.$post->title->rendered.'</h4>';
            echo $post->content->rendered;
        }
        ?>
        <hr>
        <h3>Submit a Posts</h3>
        <form method="post">
            <p style="color:red"><?php echo $msg;?></p>
            <label>Post Title
                <input type="text" name="post-title" />
            </label><br>
            <label>Content
                <textarea name="post-content"></textarea>
            </label>
            <input type="submit" name="button" value="Submit" />
            <input type="hidden" name="action" value="submit-post" />
        </form>
        <hr>
        <h3>Delete a Posts</h3>
        <form method="post">
            <p style="color:red"><?php echo $msg2;?></p>
            <select name="delete-post">
                <option vlaue="">Select a post</option>
            <?php
            foreach($posts as $post){
                echo '<option value="'.$post->id.'">'.$post->title->rendered.'</option>';
            }
            ?>
            </select>
            <input type="submit" name="button" value="Delete" />
            <input type="hidden" name="action" value="delete-post" />
        </form>
    </body>

    </html>