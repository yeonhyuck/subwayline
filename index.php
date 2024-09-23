<?php
include "config.php";
?>
<html>
    <head>
    <link rel="stylesheet" href="index.css">
    </head>
    <body>
        <div>
            <ul>
                <?php
                    $sql = "SELECT * FROM `subway`";
                    $result = $conn->query($sql);
                    while($row = $result->fetch_assoc()) {
                        $dnlcl = "right";
                        if($row['idx'] % 2 != 0) {
                            $dnlcl = "left";
                        } 
                        ?>
                        <li class="<?php echo $dnlcl ?>"><a class="button" href="./subway_info.php?line=<?php echo $row['idx']; ?>"><?php echo $row['line']; ?></a></li>
                        <?php
                    }
                ?>
            </ul>
            <div class="clear"></div>
        </div>
    </body>   
</html>