<?php include('gettracks.php'); 
date_default_timezone_set('Europe/Amsterdam'); 

    function timeago($time, $tense = "ago"){
      if(empty($time)) return "n/a";
       $time=strtotime($time);
       $periods = array("second", "minute", "hour", "day", "week", "month", "year", "decade");
       $lengths = array("60","60","24","7","4.35","12","10");
       $now = time();
         $difference = $now - $time;
         for($j = 0; $difference >= $lengths[$j] && $j < count($lengths)-1; $j++) {
           $difference /= $lengths[$j];
         }
         $difference = round($difference);
         if($difference != 1) {
           $periods[$j].= "s";
         }
       return "$difference $periods[$j] $tense ";
    } 
?>

<div class="masonry masonry--small">
<?php foreach($rss->recenttracks->track as $item): ?>

    <div class="block block--track">

        <?php if (!empty($item->image[2])): ?>
            <a href="<?= $item->url ?>"><img class="block--img" width="174" height="174" src="<?= $item->image[2] ?>" alt="Cover <?= $item->artist->name ?> - <?= $item->name ?>"></a>
        <?php else: ?>
            <a href="<?= $item->url ?>" class="block--fallback"></a>
        <?php endif ?>
        
        <div class="block--body">
            <p><a href="<?= $item->url ?>"><?= $item->name ?></a><br>
            <?= $item->artist ?> - <?= $item->album ?><br>
            <small class="subtiel">
                <!-- <?= date("d-m-Y H:i", intval($item->date['uts'])) ?> -->
                <?= timeago(date("d-m-Y H:i", intval($item->date['uts']))) ?>
            </small>
            </p>
        </div>

    </div>

<?php endforeach ?>
</div>