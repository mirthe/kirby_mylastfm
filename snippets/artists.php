<?php include('getartists.php'); ?>

<div class="grid">
<?php foreach($rss->topartists->artist as $item): ?>

    <?php
        // get image from Wikipedia. Last.fm is not offering one for bands.
        $wikiSummary = function (string $title): array|null {
            $cache = kirby()->cache('mirthe.mylastfm');
            $cacheKey = 'wikipedia-' . sha1($title);
            $cached = $cache->get($cacheKey);

            if ($cached !== null) {
                return $cached;
            }

            $url = 'https://en.wikipedia.org/api/rest_v1/page/summary/' . rawurlencode(str_replace(' ', '_', $title));
            $ch = curl_init($url);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($ch, CURLOPT_USERAGENT, kirby()->site()->title());
            $output = curl_exec($ch);
            curl_close($ch);

            $result = $output ? json_decode($output, true) : null;
            $cache->set($cacheKey, $result, 60 * 60 * 24 * 7);

            return $result;
        };

        $article_name = $item->name;
        $wikipage = $wikiSummary($article_name);

        if (empty($wikipage) || !isset($wikipage['title']) || $wikipage['title'] === 'Not found.' || !array_key_exists('thumbnail', $wikipage)) {
            $fallbackTitle = $article_name;
            if (!preg_match('/\(band\)$/i', $fallbackTitle)) {
                $fallbackTitle .= '_(band)';
            }
            $wikipage = $wikiSummary($fallbackTitle);
        }
    ?>

    <div class="block block--artist">

        <?php if (empty($wikipage) || !isset($wikipage['title']) || $wikipage['title'] == 'Not found.' || !key_exists('thumbnail',$wikipage)): ?>
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
