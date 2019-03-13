<?php 
class Files 
{
    public static function guardar($tmp,$dest)
    {
        return move_uploaded_file($tmp, $dest);
    }
}

?>