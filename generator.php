<?php

if (!isset($_GET['data'])) {

	// we're missing something. give back error
	echo 'Data missing..';
	die();

}

$data = json_decode($_GET['data']);
// die(print_r($data));

header('Content-Type: applicatino/rss+xml');

echo "<?xml version='1.0' encoding='UTF-8'?>\n";
?>
	<rss version='2.0' xmlns:atom='http://www.w3.org/2005/Atom'>
	<channel>
		<title><?php echo $data->title; ?></title>
		<description><?php echo $data->description; ?></description>
		<link><?php echo $data->link; ?></link>
		<language>no</language>
		<webMaster>astrofysisk.bibliotek@ub.uio.no (Line Akerholt)</webMaster>
		<pubDate>Fri, 14 Jan 2011 12:00:00 GMT</pubDate>	
		<atom:link href="http://www.ub.uio.no/fag/naturvitenskap-teknologi/astro/nyinnkjop/nyetrykteboker.rss" rel="self" type="application/rss+xml" />
<?php

foreach($data->entries as $entry) {
	echo "
		<item>
		  <title>{$entry->title}</title>
	";
	if (isset($entry->publishedDate)) {
		echo "
			<pubDate>{$entry->publishedDate}</pubDate>
		";
	} else {
		echo "
			<pubDate>" . date('D, d M Y H:i:s e') . "</pubDate>
		";
	}
	echo "
		  <link>{$entry->link}</link>
		</item>
	";
}

?>
	</channel>
</rss>