<?php
require 'connect.php';
class threads extends connect
{
    public function getAllThreads()
    {
        $sql = "SELECT * FROM threads";
        $result = $this->conn()->query($sql);
        if (mysqli_num_rows($result) >= 1) {
            while ($row = mysqli_fetch_array($result)) {
                $data[] = $row;
            }
            return $data;
        } else {
            return null;
        }
    }
    private function checkMediaType($image)
    {
        $target_dir = "../uploads/";
        $target_file = $target_dir . basename($image);
        $uploadOk = 1;
        $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
        if ($imageFileType == "mp4" || $imageFileType == "m4a") {
            return "video";
        } else {
            return "image";
        }
    }

    //get a youtube link out of a string
    private function getYoutubeLink($string)
    {
        $regex = '/https:\/\/www\.youtube\.com\/watch\?v=([a-zA-Z0-9_-]+)/';
        preg_match($regex, $string, $matches);
        if (isset($matches[1])) {
            return $matches[1];
        } else {
            return false;
        }
    }
    //get full youtube url out of a string
    private function getYoutubeUrl($string)
    {
        $regex = '/https:\/\/www\.youtube\.com\/watch\?v=([a-zA-Z0-9_-]+)/';
        preg_match($regex, $string, $matches);
        if (isset($matches[1])) {
            return "https://www.youtube.com/watch?v=" . $matches[1];
        } else {
            return false;
        }
    }
    private function UploadImg($image)
    {
        $target_dir = "../uploads/";
        $target_file = $target_dir . basename($image);
        $uploadOk = 1;
        $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

        /* Check if image file is a actual image or fake image
        $check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
        if ($check !== false) {
            echo "File is an image - " . $check["mime"] . ".";
            $uploadOk = 1;
        } else {
            echo "File is not an image.";
            $uploadOk = 0;
        }*/

        // Check file size
        if ($_FILES["fileToUpload"]["size"] > 50000000000) {
            echo "Sorry, your file is too large.";
            $uploadOk = 0;
        }

        // Allow certain file formats
        if (
            $imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
            && $imageFileType != "gif" && $imageFileType != "mp4" && $imageFileType != "m4a"
        ) {
            echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
            $uploadOk = 0;
        }
        // Check if file already exists
        if (file_exists($target_file)) {
            echo "Sorry, file already exists.";
            return true;
        }

        // Check if $uploadOk is set to 0 by an error
        if ($uploadOk == 0) {
            echo "Sorry, your file was not uploaded.";
            // if everything is ok, try to upload file
            return false;
        } else {
            if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
                echo "The file " . htmlspecialchars(basename($_FILES["fileToUpload"]["name"])) . " has been uploaded.";
            } else {
                echo "Sorry, there was an error uploading your file.";
            }
        }
    }
    //function to get replies by post id
    public function getRepliesByPostId($id, $thread_id)
    {
        try {
            $sql = "SELECT id FROM posts WHERE replies LIKE '%$id%' AND thread_id = '$thread_id'";
            $result = $this->conn()->query($sql);
            if (mysqli_num_rows($result) >= 1) {
                while ($row = mysqli_fetch_array($result)) {
                    $data[] = $row;
                }
                return $data;
            } else {
                return null;
            }
        } catch (\Throwable $th) {
            return null;
        }
    }
    private function getStringBetween($string, $start, $end)
    {
        $string = ' ' . $string;
        $ini = strpos($string, $start);
        if ($ini == 0) return '';
        $ini += strlen($start);
        $len = strpos($string, $end, $ini) - $ini;
        return substr($string, $ini, $len);
    }
    public function createThread($headline, $content, $author, $image)
    {
        $video = 0;
        if ($image != null) {
            if ($this->checkMediaType($image) == "video") {
                $video = 1;
            }
            $this->UploadImg($image);
        }
        if (!$this->UploadImg($image)) {
            $image = "default.jpg";
        }
        $sql = "INSERT INTO threads (headline,author,content,image,video) VALUES ('$headline','$author','$content','$image','$video')";
        $this->conn()->query($sql);
    }
    public function getPostsByThreadId($id)
    {
        $sql = "SELECT * FROM posts WHERE thread_id = '$id'";
        $result = $this->conn()->query($sql);
        if (mysqli_num_rows($result) >= 1) {
            while ($row = mysqli_fetch_array($result)) {
                $data[] = $row;
            }
            return $data;
        } else {
            return null;
        }
    }
    public function getPosts()
    {
        $id = $_GET['id'];
        $sql = "SELECT * FROM posts WHERE thread_id = '$id'";
        $result = $this->conn()->query($sql);
        if (mysqli_num_rows($result) >= 1) {
            while ($row = mysqli_fetch_array($result)) {
                $data[] = $row;
            }
            return $data;
        } else {
            return null;
        }
    }


    public function getThreadById($id)
    {
        $sql = "SELECT * FROM threads WHERE id = '$id'";
        $result = $this->conn()->query($sql);
        if (mysqli_num_rows($result) == 1) {
            while ($row = mysqli_fetch_array($result)) {
                $data[] = $row;
            }
            return $data;
        } else {
            return header("Location: ../views/home.php");
        }
    }
    public function createPost($thread_id, $content, $author, $image)
    {
        $video = 0;
        $ytcode = 0;
        $rawContent = $content;
        if (strpos($content, "[") !== false && strpos($content, "]") !== false) {
            $replies = [];
            while (strpos($content, "[") !== false && strpos($content, "]") !== false) {
                $reply = $this->getStringBetween($content, "[", "]");
                $content = str_replace("[" . $reply . "]", "", $content);
                array_push($replies, $reply);
            }
            $repliesStr = implode(",", $replies);
        } else {
            $repliesStr = null;
        }
        if ($this->getYoutubeLink($rawContent)) {
            $ytcode = $this->getYoutubeLink($rawContent);
            $youtubeUrl = $this->getYoutubeUrl($rawContent);
            $rawContent = str_replace($youtubeUrl, "", $rawContent);
        }
        if ($image != null) {
            if ($this->checkMediaType($image) === "video") {
                $video = 1;
            }
            $this->UploadImg($image);
        }
        $sql = "INSERT INTO posts (thread_id,content,author,image,replies,video,ytcode) VALUES ('$thread_id','$rawContent','$author','$image','$repliesStr', '$video','$ytcode')";
        $this->conn()->query($sql);
    }
}
