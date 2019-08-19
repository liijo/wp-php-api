<?php
class restApi{
    function getPosts(){
        $url = 'http://localhost/inurture/wp-json/wp/v2/posts';
        $output = '';
        $curl_handle = curl_init();
        curl_setopt($curl_handle, CURLOPT_URL, $url);
        curl_setopt($curl_handle, CURLOPT_CONNECTTIMEOUT, 2);
        curl_setopt($curl_handle, CURLOPT_RETURNTRANSFER, 1);
        $buffer = curl_exec($curl_handle);
        $posts = json_decode($buffer);
        
        return $posts;
    }
    function addPost($title, $content){
        $url = 'http://localhost/inurture/wp-json/wp/v2/posts';
        $username = 'admin';
        $password = 'admin123';
        $fields = array(
            'title' => $title,
            'content' => $content,
            'status' => 'publish'
        );
        $fields_string = 'title='.$title.'&content='.$content.'&status=publish';
        $curl_handle = curl_init();
        curl_setopt($curl_handle, CURLOPT_URL, $url);
        curl_setopt($curl_handle, CURLOPT_CONNECTTIMEOUT, 2);
        curl_setopt($curl_handle, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($curl_handle, CURLOPT_POST, 2);
        curl_setopt($curl_handle, CURLOPT_USERPWD, $username . ":" . $password);
        curl_setopt($curl_handle, CURLOPT_POSTFIELDS, http_build_query($fields));
        curl_setopt($curl_handle, CURLOPT_RETURNTRANSFER, true);
        $result = curl_exec($curl_handle);
        return json_decode($result);
        curl_close($curl_handle);
    }
}
?>