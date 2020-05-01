<span> <?php 
        $diff = time() - strtotime($creation_time);
        
        if ($diff < 60) {
            echo 'just now';
        }
        elseif ($diff < 3600) {
            $diff = floor($diff / 60);
            echo ($diff == 1 ? 'a minute ago' : ($diff . ' minutes ago'));
        }
        elseif ($diff < 86400) {
            $diff = floor($diff / 3600);
            echo ($diff == 1 ? 'an hour ago' : ($diff . ' hours ago'));
        }
        elseif ($diff < 2592000) {
            $diff = floor($diff / 86400);
            echo ($diff == 1 ? 'a day ago' : ($diff . ' days ago'));
        }
        elseif ($diff < 31536000) {
            $diff = floor($diff / 2592000);
            echo ($diff == 1 ? 'a month ago' : ($diff . ' months ago'));
        }
        else {
            $diff = floor($diff / 31536000);
            echo ($diff == 1 ? 'a year ago' : ($diff . ' years ago'));
        }
    ?>
</span>