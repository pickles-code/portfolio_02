<?php
$page_slug = 'top';
$page_css = $page_slug; //cssファイル名

//現在ページだけヘッダーに追加したいものがあれば下記のコメントアウトを解除してに中に記入
/* $add_css = <<<CSSDOC
CSSDOC; */

$current_path = dirname(__FILE__);

include_once($current_path . '/assets/inc/header.php');
?>

<!-- コンテンツここから -->
<main class="mainContents page_<?php echo $page_slig; ?>">
  <div class="mainContents_inner">
    <div class="mainContents_inner_box">
      <h2 class="mainContents_inner_box_title">タイトル</h2>
      <p class="mainContents_inner_box_text">テキスト</p>
      <figure>
        <img src="" alt="">
      </figure>
    </div>
    <p>Portfolio</p>
  </div>

  <section class="service">
    <h2>Service</h2>
    <div class="service-box">
      <figure>
        <img src="/assets/img/top/service01.png" alt="">
      </figure>
      <div>
        <h3>Coding</h3>
        <ul>
          <li>HTML/CSS/jQueryを使ったコーディング</li>
          <li>デザインデータ(XD,figma)を元にしたLP制作、ホームページ制作</li>
          <li>レスポンシブ対応したサイト制作</li>
        </ul>
      </div>
    </div>
    <div class="service-box">
      <figure>
        <img src="/assets/img/top/service02.png" alt="">
      </figure>
      <div>
        <h3>Word press</h3>
        <ul>
          <li>WordPressの新規導入から構築、改修など</li>
        </ul>
      </div>
    </div>
    <p>
      <a href="/service">View More</a>
    </p>
  </section>

  <section class="works">
    <h2>Works</h2>
    <ul>
      <li>
        <a href="">
          <figure>
            <img src="" alt="">
          </figure>
          <p>福岡市立児童心理治療施設様</p>
        </a>
      </li>
      <li>
        <a href="">
          <figure>
            <img src="" alt="">
          </figure>
          <p>久世工業団地協同組合様</p>
        </a>
      </li>
      <li>
        <a href="">
          <figure>
            <img src="" alt="">
          </figure>
          <p>オリフタファイル様</p>
        </a>
      </li>
    </ul>
    <p>
      <a href="/works">View More</a>
    </p>
  </section>

  <section class="about">
    <h2>About Me</h2>
    <div>
      <figure>
        <img src="" alt="">
      </figure>
      <div>
        <p>- Profile</p>
        <p>
          岡山生まれ、京都育ち。<br>
          販売職を経験後、36歳の時にコーダーに転身。<br>
          HP制作やWebサービス開発に携わる。
        </p>
      </div>
      <div>
        <p>- Skill</p>
        <p>
          HTML / CSS(Sass) / JavaScript(jQuery) / WordPress
        </p>
      </div>
    </div>
  </section>

  <section class="contact">
    <div>
      <h2>Contact</h2>
      <p>
        <img src="" alt="">
      </p>
    </div>
    <p>
      お仕事のご依頼やご相談はこちらから<br>
      お問い合せください。
    </p>
    <p>
      <a href="/contact">Contact</a>
    </p>
  </section>
</main>


<?php include_once($current_path . '/assets/inc/footer.php'); ?>

<!-- 現在のページのみ使用するJSはここから下に記述 -->


</body>

</html>


<?php //子テーマ用関数
if (!defined('ABSPATH')) exit;

//子テーマ用のビジュアルエディタースタイルを適用
add_editor_style();

// Popup Makerのためにjquery-uiの読込
function theme_name_scripts()
{
  wp_enqueue_script('jquery-ui', 'https://code.jquery.com/ui/1.13.0/jquery-ui.min.js', ['jquery'], '1.13.0', true);
}
add_action('wp_enqueue_scripts', 'theme_name_scripts');

//以下に子テーマ用の関数を書く

// 投稿一覧からSEO設定を非表示する
function my_custom_manage_aio_columns($columns)
{
  unset($columns['seotitle']);      // SEO title
  unset($columns['seokeywords']);   // SEO keyword
  unset($columns['seodesc']);       // SEO descript
  unset($columns['se-actions']);    // SEO action
  return $columns;
}
add_filter('manage_edit-post_columns', 'my_custom_manage_aio_columns');

/**
 * フロントページのみCSS適用 
 */
function front_page_css()
{
  if (is_front_page()) :
    echo '<style type="text/css">h1.entry-title {display: none;}</style>';
    echo '<style type="text/css">div.carousel-in {display: none;}</style>';
  endif;
}
add_action('wp_head', 'front_page_css');

/**
 * お問い合わせバリデーション文言変更
 */
function my_error_message($error, $key, $rule)
{
  if ($key === 'ご用件' && $rule === 'noempty') {
    return '選択して下さい';
  }
  return $error;
}
add_filter('mwform_error_message_mw-wp-form-2933', 'my_error_message', 10, 3);

/*
 * **********************************
 * ポップアップ設置
 * **********************************
 */
function popup($atts, $content)
{
  /*******************************************************************************
	【入力パラメータ$attsの内容】
		enabled => ポップアップ 0=無効 1=有効
		init_display => 0=デフォルトで出さない 1=デフォルトで出す
		modal_option => jQuery.modalに渡すオプション配列をJS連想配列の記述で。
							デフォルト {escapeClose: true, clickClose: true, showClose: true,} 
							escapeClose→Escキーを押したときに閉じるか
							clickClose→暗い背景をクリックしたときに閉じるか
							showClose→閉じる×アイコンを表示するか
		onpopup ポップアップしたときに実行するスクリプト。スクリプトの文字列囲みには'を使用。
		onclick 画像型の場合にクリックしたときに実行するスクリプト。スクリプトの文字列囲みには'を使用。

		①画像型のポップアップ
			以下のURLで設定
			banner_url => バナー画像のURL。URLパラーメータのバインド変数{%パラメータ名}を入力可能
			banner_sp_url => SP用バナー画像のURL。URLパラーメータのバインド変数{%パラメータ名}を入力可能
			link_url => バナークリックしたときのリンク先URL。URLパラーメータのバインド変数{%パラメータ名}を入力可能
		②カスタマイズhtml型のポップアップ
			自由なhtmlを記述。ショートコードブロックは余計なスペースなど入るので非推奨。カスタムhtmlブロックを推奨。
			ショートコードを囲み型にして中のテキストを$contentで受け取れるテキスト型
			URLパラーメータのバインド変数{%パラメータ名}を入力可能
   ********************************************************************************/

  //パラメータ初期化
  extract(shortcode_atts(array(
    'enabled' => 1,
    'modal_id' => 'ss-popup-banner',
    'init_display' => 0,
    'banner_url' => '',
    'banner_sp_url' => '',
    'link_url' => '',
    'modal_option' => '{escapeClose: true, clickClose: true, showClose: true,}',
    'onpopup' => '',
    'onclick' => '',
  ), $atts));

  /***********************************************
   * 入力パラメータチェック
   ************************************************/

  if ($content == null && $banner_url == null) {
    return null;
  }

  if ($enabled == 0) {
    return null;
  }

  if ($init_display != 1) {
    $init_display = 0;
  } else {
    $init_display = 1;
  }


  /***********************************************
   * 囲みの中の文字列があればテキスト型。そのテキストをポップアップに。
   * なければ画像型。引数で指定されたURLを使う
   ************************************************/

  $content_check = trim(strip_tags($content)); //囲みテキストからタグを除く。コメントアウトされていれば空になり無効になる

  if ($content_check != null) { //囲みテキストが空じゃない

    $popup_html = <<<EOF
			
			<!-- ポップアップバナー(囲みテキスト) -->
			<div id="{$modal_id}" class="modal ss-popup-banner-text">
				{$content}
			</div>
			<!-- /ポップアップバナー -->
			
EOF;
  } else {

    $link_url = replace_req_params(array("encode" => "urlencode"), $link_url); //リンクURLパラメータ変換
    $banner_url = replace_req_params(array("encode" => "urlencode"), $banner_url); //バナーURL変換
    $banner_sp_url = replace_req_params(array("encode" => "urlencode"), $banner_sp_url); //バナーURL変換(SP用)

    if ($banner_sp_url != null) { //SP画像が空じゃない

      $popup_html = <<<EOF
			
			<!-- ポップアップバナー(画像型・SP画像有) -->
			<div id="{$modal_id}" class="modal ss-popup-banner-image">
				<a style="display: block; margin: auto;" href="{$link_url}" target="_blank" onClick="{$onclick}">
					<picture>
						<source srcset="{$banner_sp_url}" media="(max-width: 767px)">
						<img style=" width: 100%;  margin: 0;" src="{$banner_url}" />
					</picture>
				</a>
			</div>
			<!-- /ポップアップバナー(画像型・SP画像有) -->
			
EOF;
    } else {
      $popup_html = <<<EOF
	
			<!-- ポップアップバナー(画像型) -->
			<div id="{$modal_id}" class="modal ss-popup-banner-image">
				<a style="display: block; margin: auto;" href="{$link_url}" target="_blank" onClick="{$onclick}">
					<img style="width: 100%;  margin: 0;" src="{$banner_url}" />
				</a>
			</div>
			<!-- /ポップアップバナー(画像型) -->
			
EOF;
    }
  }


  /***********************************************
   * 出力するHTMLを設定
   ************************************************/

  $html = <<<EOF
		
		<style>
			.modal{
				z-index: 3;
				padding: 0;
				border-radius: 0;
				display: none;
		      max-width: 1080px;
				/* width: initial; */
			}
			.modal.ss-popup-banner-image{
				/* width: auto; */
			}
			.modal.ss-popup-banner-text{
				
			}
			.modal img, .modal a{
				display: block;
			}
			.blocker{
				z-index: 2;
			}
			.modal a.close-modal{
				width: 2.4rem;
				height: 2.4rem;
				opacity: 0.5;
				top: -2rem;
				right: -2rem;
				z-index: -1;				
			}
		</style>
			
		<script>
			
			load_count_modal = 0; // ライブラリを読み込んだ回数。グローバル

			jQuery(function(){
				
				var init_display = $init_display;
				
				/* ==============================================
				 * 外部ライブラリjquery.modalを動的にロード
				 * ============================================== */
		
				console.log("load_count_modal=" + load_count_modal);
				if(typeof jQuery.modal != "function" && load_count_modal == 0){ /* 初回のみライブラリを読み込む */

					++load_count_modal;
					var src = 'https://cdnjs.cloudflare.com/ajax/libs/jquery-modal/0.9.1/jquery.modal.min.js';
					var script = jQuery('<script>').attr({
						'type': 'text/javascript',
						'src': src,
					});
					jQuery('head')[0].appendChild(script[0]);
					console.log("load " + src);
					var link = jQuery('<link>').attr({
						'rel': 'stylesheet',
						'href': 'https://cdnjs.cloudflare.com/ajax/libs/jquery-modal/0.9.1/jquery.modal.min.css',
					});
					jQuery('head')[0].appendChild(link[0]);

				}

				
				var count = 0;

				/* ==============================================
				 * 外部ライブラリが実行されている時だけ一度実行するようインターバル実行
				 * ============================================== */
				var timer = setInterval(function(){

					++count;
					if(typeof jQuery.modal == "function"){
						//console.log("■開始 count=" + count + "回目 ----------------------------------------------");
						clearInterval(timer); /* 最初の実行したらインターバル実行キャンセル */
						var modal_option = {$modal_option};
						if(init_display == 1){
							console.log("init_display=1");
							jQuery("#{$modal_id}").modal(modal_option);
							{$onpopup};
						}
					}

				}, 100);

			});	
	
		</script>

		{$popup_html}

EOF;
  $html = do_shortcode($html); //ショートコードの中のショートコードを展開

  return $html;
}
add_shortcode('popup', 'popup');

/*
 * **************************************************************************
 * 文字列の中のURLパラメータバインド変数({%パラメータ名})を実際の値に置換
 * **************************************************************************
 */


function replace_req_params($atts, $content)
{ //こちらをショートコードに登録

  //パラメータ初期化
  extract(shortcode_atts(array(
    'encode' => 'esc_html', //使用するエンコードorエスケープ関数 esc_html, urlencode
  ), $atts));

  if ($encode != "esc_html" && $encode != "urlencode") {
    return null; //それ以外エンコード指定は危ないので出力しない
  }

  return replace_req_params_base($atts, $content);
}



function replace_req_params_base($atts, $content)
{ //こちらはショートコードに登録はしない

  //パラメータ初期化
  extract(shortcode_atts(array(
    'encode' => 'esc_html', //使用するエンコードorエスケープ関数 esc_html, urlencode, none
  ), $atts));

  //複数ヒットするとmatchesはこうなる
  //print_r($matches);
  // Array
  // (
  //     [0] => Array
  //         (
  //             [0] => {%from}
  //             [1] => {%from}
  //             [2] => {%to}
  //         )
  // )

  if ($encode != "esc_html" && $encode != "urlencode" && $encode != "none") {
    return null; //それ以外エンコード指定は出力しない
  }


  $content = do_shortcode($content);

  preg_match_all('|\{%[a-z0-9\-_\[\]]+\}|', $content, $matches); //{%パラメータ名}を全てマッチさせる

  if (count($matches) > 0) {

    //{%パラメータ名}を1つ1つループ
    foreach ($matches[0] as $idx => $param_str) {

      $param_name = str_replace(
        array("{%", "}"),
        "",
        $param_str
      );

      $param_val = null;
      if (isset($_GET[$param_name])) {
        $param_val = $_GET[$param_name];
      }

      //{%パラメータ名}を実際に変換
      if ($encode == "none") {
        $content = str_replace($param_str, $param_val, $content);
      } else {
        $content = str_replace($param_str, $encode($param_val), $content);
      }
    }
  }

  return $content;
}

add_shortcode('replace_req_params', 'replace_req_params'); /* ショートコードを登録 */
