<?php include('getartists.php'); ?>

<div class="masonry">
<?php foreach($rss->topartists->artist as $item): ?>

    <?php // get image from Wikipedia. Last.fm is not offering one for bands..
    $article_name = str_replace(' ','_',$item->name);
    $url = "https://en.wikipedia.org/api/rest_v1/page/summary/".$article_name."?limit=1";
    // TODO add +(band) if result is 0 and try again? 

    $ch = curl_init( $url );
    curl_setopt( $ch, CURLOPT_RETURNTRANSFER, true );
    $output = curl_exec( $ch );
    curl_close( $ch );

    $wikipage = json_decode($output,true);
    // print_r($wikipage); ?>

    <div class="block block--artist">

        <?php if (empty($wikipage) || $wikipage['title'] == 'Not found.' || !key_exists('thumbnail',$wikipage)): ?>
            <a href="<?= $item->url ?>" class="block--fallback"></a>
        <?php else: ?>
            <a href="<?= $item->url ?>"
                    title="<?= $item->name ?>">
                    <img class="block--img" width="300" height="250"
                        src="<?= $wikipage['thumbnail']['source'] ?>" alt="<?= $item->artist ?>">
            </a>
        <?php endif ?>
        
        <div class="block--body">
            <p><a href="<?= $item->url ?>"><?= $item->name ?></a><br>
            <small class="subtiel"><?= $item->playcount ?> nummers gedraaid</small></p>
        </div>

    </div>

<?php endforeach ?>
</div>
