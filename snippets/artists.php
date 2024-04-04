<?php include('getartists.php'); ?>

<!-- TODO get image from Wikipedia? Last.fm is not offering one for bands.. -->

<div class="masonry">
<?php foreach($rss->topartists->artist as $item): ?>

    <div class="block block--artist">

        <?php if (!empty($item->image[3])): ?>
            <a href="<?= $item->url ?>"><img class="block--img" src="<?= $item->image[3] ?>" alt="Cover <?= $item->artist->name ?> - <?= $item->name ?>"></a>
        <?php else: ?>
            <a href="<?= $item->url ?>" class="block--fallback"></a>
        <?php endif ?>
        
        <div class="block--body">
            <p><a href="<?= $item->url ?>"><?= $item->name ?></a><br>
            <small class="subtiel"><?= $item->playcount ?> nummers gedraaid</small></p>
        </div>

    </div>

<?php endforeach ?>
</div>