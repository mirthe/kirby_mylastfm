<?php include('gettracks.php'); ?>

<div class="masonry">
<?php $counter = 0;
foreach($rss->recenttracks->track as $item):
  if ($counter == $limit) {break;} ?>
    
      <?php $article_name = str_replace(' ','_',$item->artist);
      $url = "https://en.wikipedia.org/api/rest_v1/page/summary/".$article_name."?limit=1";

      $ch = curl_init( $url );
      curl_setopt( $ch, CURLOPT_RETURNTRANSFER, true );
      $output = curl_exec( $ch );
      curl_close( $ch );

      $wikipage = json_decode($output,true);
      //print_r($wikipage);
      // TODO add +(band) if result is 0 and try again?
      ?>
      
      <div class="block block--compact block--track">
          <?php if (empty($wikipage) || $wikipage['title'] == 'Not found.' || !key_exists('thumbnail',$wikipage)): ?>
            <a href="<?= $item->url ?>" class="block--fallback"></a>
          <?php else: ?>
            <a href="<?= $item->url ?>"
                  title="<?= $item->artist ?> - <?= $item->name ?>">
                  <img class="block--img" width="300" height="250"
                      src="<?= $wikipage['thumbnail']['source'] ?>" alt="<?= $item->artist ?>">
            </a>
          <?php endif ?>
          <div class="block__overlay">
            <?= $item->artist ?><br><?= $item->name ?>
          </div>
      </div>

<?php $counter++;
endforeach ?>
</div>
