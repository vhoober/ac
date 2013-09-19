<?php
    @$fp = fopen("includes/counterlog.txt", "w");
    $count = 0;
    fwrite($fp, $count);
    fclose($fp);
    header("location:website.php?act=action&mod=viewhitcounter");
?>
