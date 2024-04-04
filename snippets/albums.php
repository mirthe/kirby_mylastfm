<?php include('getalbums.php'); ?>

<div class="masonry">
<?php foreach($rss->topalbums->album as $item): ?>

    <div class="block block--album">

        <?php if (!empty($item->image[3])): ?>
            <a href="<?= $item->url ?>"><img class="block--img" src="<?= $item->image[3] ?>" alt="Cover <?= $item->artist->name ?> - <?= $item->name ?>"></a>
        <?php else: ?>
            <a href="<?= $item->url ?>" class="block--fallback"></a>
        <?php endif ?>
        
        <div class="block--body">
            <p><a href="<?= $item->url ?>"><?= $item->name ?></a><br><?= $item->artist->name ?><br>
            <!-- <small class="subtiel"><?= $item->playcount ?> nummers gedraaid</small> -->
            </p>
        </div>

    </div>

<?php endforeach ?>
</div>