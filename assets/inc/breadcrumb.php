<?php
global $site_url;

global $page_url;
global $page_name;

global $parent_slug;
global $parent_name;

global $grand_slug;
global $grand_name;

$class_cnt = 2; //デフォルト階層構造
?>

<ol class="BreadcrumbList contents_wrp pc_only" itemscope="" itemtype="http://schema.org/BreadcrumbList">
	<li itemprop="itemListElement" itemscope="" itemtype="http://schema.org/ListItem">
		<a href="<?php echo $site_url; ?>" itemprop="item"><span itemprop="name">TOP</span></a>
		<meta itemprop="position" content="1" />
	</li>
<?php if (isset($grand_slug)): $class_cnt = 4; //第4階層?>
	<li itemprop="itemListElement" itemscope="" itemtype="http://schema.org/ListItem">
		<a href="<?php echo $site_url; ?>/<?php echo $grand_slug; ?>/" itemprop="item"><span itemprop="name"><?php echo $grand_name; ?></span></a>
		<meta itemprop="position" content="2" />
	</li>
	<li itemprop="itemListElement" itemscope="" itemtype="http://schema.org/ListItem">
		<a href="<?php echo $site_url; ?>/<?php echo $grand_slug; ?>/<?php echo $parent_slug; ?>/" itemprop="item"><span itemprop="name"><?php echo $parent_name; ?></span></a>
		<meta itemprop="position" content="3" />
	</li>
<?php elseif (isset($parent_slug)): $class_cnt = 3; //第3階層?>
	<li itemprop="itemListElement" itemscope="" itemtype="http://schema.org/ListItem">
		<a href="<?php echo $site_url; ?>/<?php echo $parent_slug; ?>/" itemprop="item"><span itemprop="name"><?php echo $parent_name; ?></span></a>
		<meta itemprop="position" content="2" />
	</li>
<?php endif; ?>
	<li itemprop="itemListElement" itemscope="" itemtype="http://schema.org/ListItem">
		<span itemprop="name"><?php echo $page_name; ?></span>
		<meta itemprop="position" content="<?php echo $class_cnt; ?>" />
	</li>
</ol>
<script type="application/ld+json">
{
	"@context": "http://schema.org",
	"@type": "BreadcrumbList",
	"itemListElement": [
		{
			"@type": "ListItem",
			"position": 1,
			"item": {
				"@id": "<?php echo $site_url; ?>/",
				"name": "ホーム"
			}
		},
		<?php if ( isset( $grand_slug ) ) { //第4階層 ?>
		{
			"@type": "ListItem",
			"position": 2,
			"item": {
				"@id": "<?php echo $site_url; ?>/<?php echo $grand_slug; ?>/",
				"name": "<?php echo $grand_name; ?>"
			}
		},
		{
			"@type": "ListItem",
			"position": 3,
			"item": {
				"@id": "<?php echo $site_url; ?>/<?php echo $grand_slug; ?>/<?php echo $parent_slug; ?>/",
				"name": "<?php echo $parent_name; ?>"
			}
		},
		{
			"@type": "ListItem",
			"position": 4,
			"item": {
				"@id": "<?php echo $page_url; ?>",
				"name": "<?php echo $page_name; ?>"
			}
		}
		<?php } elseif ( isset( $parent_slug ) ) { //第3階層 ?>
		{
			"@type": "ListItem",
			"position": 2,
			"item": {
				"@id": "<?php echo $site_url; ?>/<?php echo $parent_slug; ?>/",
				"name": "<?php echo $parent_name; ?>"
			}
		},
		{
			"@type": "ListItem",
			"position": 3,
			"item": {
				"@id": "<?php echo $page_url; ?>",
				"name": "<?php echo $page_name; ?>"
			}
		}
		<?php } else { ?>
		{
			"@type": "ListItem",
			"position": 2,
			"item": {
				"@id": "<?php echo $page_url; ?>",
				"name": "<?php echo $page_name; ?>"
			}
		}
		<?php } ?>
	]
}
</script>