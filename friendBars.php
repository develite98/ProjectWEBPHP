<?php
    ob_start();
?>
<!doctype html>
<html lang="en">
<?php 
  require_once 'init.php';
  global $db;
  $stm=$db->prepare("SELECT s.displayName, s.image FROM friends f, users s WHERE f.user2id = s.id AND f.user1id = ?");
  $stm->execute(array($currentUser['id']));
  $stm->setFetchMode(PDO::FETCH_ASSOC);
?>
<head>
    <style>
        .FriendBars {
            left: 5px;
            position: absolute;
            top: 65px;
            height: auto;
            width: 200px;
            background-color: #DCDCDC;
            border-radius: 0.5rem;
        }
        .FriendList{
            background-color: white;
            border-radius: 0.5rem;
            padding: 5px;
            overflow: scroll;
            overflow-x: hidden
        }
        .FriendList-Out{
            background-color: #00CC99;
            border-radius: 0.5rem;
            margin: 5px;
        } 
    </style>
</head>
<body>
    <div class="FriendBars"> 
        <div class="FriendList-Out">
            <li style="padding: 10px; list-style: none; text-align: center; color: white;"><Strong style="float: top" >Thông Báo</a></li>
            <div class="FriendList">
            </div>
        </div>
        <div class="FriendList-Out" style="margin-top: 20px;">
            <li style="padding: 10px; list-style: none; text-align: center; color: white;"><Strong style="float: top" >Danh sách bạn</a></li>
            <div class="FriendList">
                <?php while ($row = $stm->fetch()): ?>
                <li style="padding: 5px; list-style: none; ">
                        <?php echo"<img src='".$row['image']."' class='image-cropper' alt='...'>"; ?>
                        <a href="#" style="font-size: 10px;"> <?php echo $row? $row['displayName']:''?> </a>     
                </li>
                <?php endwhile; ?>
            </div>
        </div>
        
    </div>
</body>