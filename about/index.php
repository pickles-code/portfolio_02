<?php
$page_slug = 'about';
$page_name = '児童心理治療施設とは'; //現在のページのタイトルを記入
//$parent_slug = ''; //第3階層の場合入力（親のスラッグを記入）
//$parent_name = ''; //第3階層の場合入力（親のページタイトルを記入）

$page_css = $page_slug; //cssファイル名

//現在ページだけヘッダーに追加したいものがあれば下記のコメントアウトを解除してに中に記入
/* $add_css = <<<CSSDOC
CSSDOC; */

$current_path = dirname(__FILE__);

include_once($current_path.'/../assets/inc/header.php');
?>

<!-- コンテンツここから -->
<main class="mainContents page_<?php echo $page_slig;?>">
</main>


<?php include_once($current_path.'/../assets/inc/footer.php'); ?>

<!-- 現在のページのみ使用するJSはここから下に記述 -->


</body>

</html>