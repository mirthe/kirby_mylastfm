<?php include('gettracks.php');
include('ago.php'); ?>

<dl class="tracks-list">
<?php $counter = 0;
foreach($rss->recenttracks->track as $item):
  if ($counter == $limit) {break;} ?>
    <dt>
          <a href="<?= $item->url ?>"><?= $item->name ?></a> 
          <small class="subtiel">
              <?= timeago(date("d-m-Y H:i", intval($item->date['uts']))) ?>
          </small>
    </dt>
    <dd>
      <?= $item->artist ?> - <?= $item->album ?>
    </dd>
<?php $counter++;
endforeach ?>
</dl>
