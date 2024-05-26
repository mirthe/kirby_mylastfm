<?php include('gettracks.php'); ?>

<div class="masonry">
<?php $counter = 0;
foreach($rss->recenttracks->track as $item):
  if ($counter == $limit) {break;} ?>
      
      <div class="block block--compact block--track">
        <?php if (!empty($item->image[3])): ?>
            <a href="<?= $item->url ?>" 
              title="<?= $item->artist ?> - <?= $item->name ?>">
              <img class="block--img"
                width="300" height="300"
                src="<?= $item->image[3] ?>" alt="">
          </a>
        <?php else: ?>
            <a href="<?= $item->url ?>" 
              title="<?= $item->artist ?> - <?= $item->name ?>"
              class="block--fallback"></a>
        <?php endif ?>
        <div class="block__overlay">
          <?= $item->artist ?><br><?= $item->name ?>
        </div>
      </div>

<?php $counter++;
endforeach ?>
</div>
