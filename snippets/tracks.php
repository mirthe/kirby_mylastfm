<?php include('gettracks.php');
include('ago.php'); ?>

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