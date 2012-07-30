<urlset xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance" xsi:schemaLocation="http://www.sitemaps.org/schemas/sitemap/0.9 http://www.sitemaps.org/schemas/sitemap/0.9/sitemap.xsd" xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">
    <url>
        <loc><?php echo Router::url('/',true); ?></loc>
        <changefreq>daily</changefreq>
        <priority>1.0</priority>
    </url>
    <!-- events-->
    <?php foreach ($events as $event):?>
    <url>
        <loc><?php echo Router::url(array('controller' => 'events', 'action' => 'view', $event['Event']['id']), true); ?></loc>
        <lastmod><?php echo $time->toAtom($event['Event']['modified']); ?></lastmod>
        <priority>0.8</priority>
    </url>
    <?php endforeach; ?>
    <!-- galleries-->
    <?php foreach ($albums as $album):?>
    <url>
        <loc><?php echo Router::url(array('controller' => 'galleries', 'action' => 'index', $album['Album']['id']), true); ?></loc>
        <lastmod><?php echo $time->toAtom($album['Album']['modified']); ?></lastmod>
        <priority>0.8</priority>
    </url>
    <?php endforeach; ?>
    <!-- items-->
    <?php foreach ($items as $item):?>
    <url>
        <loc><?php echo Router::url(array('controller' => 'items', 'action' => 'view', $item['Item']['id']), true); ?></loc>
        <lastmod><?php echo $time->toAtom($item['Item']['modified']); ?></lastmod>
        <priority>0.8</priority>
    </url>
    <?php endforeach; ?>
    <!-- categories-->
    <?php foreach ($categories as $category):?>
    <url>
        <loc><?php echo Router::url(array('controller' => 'categories', 'action' => 'index', $category['Category']['id']), true); ?></loc>
        <lastmod><?php echo $time->toAtom($category['Category']['modified']); ?></lastmod>
        <priority>0.8</priority>
    </url>
    <?php endforeach; ?>
    <!-- infopages-->
    <?php foreach ($infopages as $infopage):?>
    <url>
        <loc><?php echo Router::url(array('controller' => 'info_pages', 'action' => 'index', $infopage['InfoPage']['id']), true); ?></loc>
        <lastmod><?php echo $time->toAtom($infopage['InfoPage']['modified']); ?></lastmod>
        <priority>0.8</priority>
    </url>
    <?php endforeach; ?>
</urlset>