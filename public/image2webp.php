<?php 
if (isset($_GET['source'])) { 
    $source = $_GET['source']; 
    if (strpos($source, '/wp-content/') == true) {
        if (file_exists($source.'.webp')) {  
            if (filesize($source.'.webp') ==0) { 
             generate_webp($source,90);
         }
         get_webp_file($source);
     }
     else { 
        if (file_exists($source)) { 
            if (generate_webp($source,80)) {
                get_webp_file($source);
            } else { 
                header($_SERVER["SERVER_PROTOCOL"] . "404 Not Found");
            }
        } else {
            header($_SERVER["SERVER_PROTOCOL"] . " 404 Not Found");
        }
    }
} else {

    header($_SERVER["SERVER_PROTOCOL"] . " 403 Forbidden");
}
}
function get_webp_file($source){ 
    $path_to_webp = $source.'.webp';
    $file_get = file_get_contents($path_to_webp);
    $file_out = $path_to_webp;
    file_put_contents($file_out,$file_get);
    if (file_exists($file_out)) {
        $image_info = getimagesize($file_out);
        header('Content-Type: image/webp');
        header('Content-Length: ' . filesize($file_out));
        header('Cache-Control: max-age=31536000');
        readfile($file_out);
    }
}
function generate_webp($file,$compression_quality){ //Hàm tạo ảnh .webp
    $output_file = $file . '.webp';
    if (file_exists($output_file) && (filesize($output_file) !==0)) {
        return true;
    }
    $file_type = strtolower(pathinfo($file, PATHINFO_EXTENSION));
    if (function_exists('imagewebp')) {
        switch ($file_type) {
            case 'jpeg':
            case 'jpg':
            $image = @ImageCreateFromJpeg($file);
            if (!$image){$image= imagecreatefromstring(file_get_contents($file));}
            break;
            case 'png':
            $image = imagecreatefrompng($file);
            imagepalettetotruecolor($image);
            imagealphablending($image, true);
            imagesavealpha($image, true);
            break;
            default:
            return false;
        }                
        $result = imagewebp($image, $output_file, $compression_quality);
        if (false === $result) {
                        // Free up memory
            imagedestroy($image);
            return false;
        } else {
                        // Free up memory
            imagedestroy($image);
            return true;
        }
    }
}
?>