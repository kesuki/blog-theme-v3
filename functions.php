<?php

// 加载 AJAX 评论提及
require get_template_directory() . '/wp-ajax-comments.php';

// 站点描述
function bigfa_description() {
    global $s, $post;
    $description = '站点描述...';
    $blog_name = get_bloginfo('name');
    if ( is_singular() ) {
        $ID = $post->ID;
        $title = $post->post_title;
        $author = $post->post_author;
        $user_info = get_userdata($author);
        $post_author = $user_info->display_name;
        if (!get_post_meta($ID, "meta-description", true)) {$description = $title.' - 作者: '.$post_author.',首发于'.$blog_name;}
        else {$description = get_post_meta($ID, "meta-description", true);}
    } elseif ( is_home () )    { $description ;
    } elseif ( is_tag() )      { $description = single_tag_title('', false) . " - ". trim(strip_tags(tag_description()));
    } elseif ( is_category() ) { $description = single_cat_title('', false) . " - ". trim(strip_tags(category_description()));
    } elseif ( is_archive() )  { $description = $blog_name . "'" . trim( wp_title('', false) ) . "'";
    } elseif ( is_search() )   { $description = $blog_name . ": '" . esc_html( $s, 1 ) . "' 的搜索結果";
    } else { $description = $blog_name . "'" . trim( wp_title('', false) ) . "'";
    }
    $description = mb_substr( $description, 0, 220, 'utf-8' );
    echo "<meta itemprop=\"description\" name=\"description\" content=\"$description\" />\n";
}
add_action('wp_head','bigfa_description');

// 七牛云缓存 Gravatar头像（支持头像大小参数）
// function qiniu_avatar($avatar) {
//   $avatar = preg_replace('/.*\/avatar\/(.*)\?s=([\d]+)&.*.srcset=.*/','<img src="http://username.clouddn.com/avatar/$1-$2" class="avatar avatar-$2" height="$2" width="$2">',$avatar);
//   return $avatar;
// }
// add_filter( 'get_avatar', 'qiniu_avatar', 10, 3 );

// 移除后台 Google Font API
function remove_open_sans_from_wp_core() {
    wp_deregister_style('open-sans');
    wp_register_style('open-sans', FALSE);
    wp_enqueue_style('open-sans', '');
}
add_action('init', 'remove_open_sans_from_wp_core');

// 文章形式
add_theme_support( 'post-formats', array( 'aside','link','image','status','video','audio' ) );

// 去除默认相册样式
add_filter( 'use_default_gallery_style', '__return_false' );

//自定义表情路径
add_filter('smilies_src','custom_smilies_src',1,10);
function custom_smilies_src ($img_src, $img, $siteurl){
    return get_template_directory_uri().'/smilies/'.$img;
}

//注册头部导航
if ( function_exists('register_nav_menus') ) {
    register_nav_menus(array('primary' => '头部导航栏'));
}

// 精简 wp_head & 去除无用函数 & 半角转全角
remove_action('wp_head','feed_links',2);
remove_action('wp_head','feed_links_extra',3);
remove_action('wp_head','rsd_link' );
remove_action('wp_head','wlwmanifest_link' );
remove_action('wp_head','adjacent_posts_rel_link_wp_head',10,0);
remove_action('wp_head','wp_generator');
remove_action('wp_head', 'wp_shortlink_wp_head',10,0 );
remove_filter('the_content', 'wptexturize');
remove_filter('the_content','capital_P_dangit',11);
remove_filter('the_title','capital_P_dangit',11);
remove_filter('wp_title','capital_P_dangit',11);
remove_filter('comment_text','capital_P_dangit',31);

// Time Ago by Fanr
function time_ago( $type = 'commennt', $day = 30 ) {
    $d = $type == 'post' ? 'get_post_time' : 'get_comment_time';
    $timediff = time() - $d('U');
    if ($timediff <= 60*60*24*$day){
        echo  human_time_diff($d('U'), strtotime(current_time('mysql', 0))), '前';
    }
    if ($timediff > 60*60*24*$day){
        echo  date('Y/m/d',get_comment_date('U')), ' ', get_comment_time('H:i');
    };
}

// 自定义评论结构
function mytheme_comment($comment, $args, $depth) {
    $GLOBALS['comment'] = $comment;
    global $commentcount,$insertAD;;
    if(!$commentcount) {
        $page = ( !empty($in_comment_loop) ) ? get_query_var('cpage')-1 : get_page_of_comment( $comment->comment_ID, $args )-1;
        $cpp=get_option('comments_per_page');
        $commentcount = $cpp * $page;
    }
?>
    <li <?php comment_class(); ?> id="li-comment-<?php comment_ID(); ?>" itemprop="reviews" itemscope itemtype="http://schema.org/Review">
    <?php if( !$parent_id = $comment->comment_parent){ ?>
        <article id="comment-<?php comment_ID(); ?>" class="comment-body comment-body-parent">
            <div class="comment-author">
                <?php echo get_avatar( $comment, $size = '48');?>
            </div>
            <div class="comment-content">
                <div class="comment-entry">
                    <span class="name author" itemprop="author"><?php echo get_comment_author_link(); ?>： </span>
                    <section itemprop="reviewBody"><?php comment_text() ?></section>
                </div>
                <div class="comment-head">
                    <span class="date"><time datetime="<?php comment_date('Y-m-d'); ?>" itemprop="datePublished"><?php if(!$parent_id = $comment->comment_parent) {echo time_ago();} ?></time></span>
                    <?php comment_reply_link(array_merge( $args, array('reply_text' => '回复','depth' => $depth, 'max_depth' => $args['max_depth']))) ?>
                </div>
            </div>
        </article>
    <?php } else { ?>
        <article id="comment-<?php comment_ID(); ?>" class="comment-body">
            <div class="comment-author">
                <?php echo get_avatar( $comment, $size = '32');?>
            </div>
            <div class="comment-content">
                <div class="comment-entry">
                    <?php comment_reply_link(array_merge( $args, array('reply_text' => '回复','depth' => $depth, 'max_depth' => $args['max_depth']))) ?>
                    <span class="name author" itemprop="author"><?php echo get_comment_author_link(); ?>： </span>
                    <section itemprop="reviewBody"><?php comment_text() ?></section>
                </div>
            </div> 
        </article>
    <?php } ;?>
<?php
}

// @父评论
add_filter('comment_text','comment_add_at_parent');
function comment_add_at_parent($comment_text){
    $comment_ID = get_comment_ID();
    $comment = get_comment($comment_ID);
    if ($comment->comment_parent ) {
        $parent_comment = get_comment($comment->comment_parent);
        $comment_text = '<a href="#comment-' . $comment->comment_parent . '">@'.$parent_comment->comment_author.'</a> ' . $comment_text;
    }
    return $comment_text;
}

// 评论 [img] 插入图片 
function embed_images($content) {
  $content = preg_replace('/\[img=?\]*(.*?)(\[\/img)?\]/e', '"<img src=\"$1\" alt=\"" . basename("$1") . "\" />"', $content);
  return $content;
}
add_filter('comment_text', 'embed_images');

// 评论链接跳转&新窗口打开
function add_redirect_comment_link($text = ''){
    $text=str_replace("href='", "href='".get_option('home')."/?r=", $text);
    $text = preg_replace('/<a (.+?)>/i', "<a $1 target='_blank'>", $text);
    return $text;
}
function redirect_comment_link(){
    $redirect = $_GET['r'];
    if($redirect){
        if(strpos($_SERVER['HTTP_REFERER'],get_option('home')) !== false){
            header("Location: $redirect");
            exit;
        }
        else {
            header("Location: ".bloginfo('url')."/");
            exit;
        }
    }
}
add_action('init', 'redirect_comment_link');
add_filter('get_comment_author_link', 'add_redirect_comment_link', 5);

// 评论回复邮件通知
function comment_mail_notify($comment_id) {
  $admin_notify = '0';
  $admin_email = 'songtao.mai@gmail.com';
  $comment = get_comment($comment_id);
  $comment_author_email = trim($comment->comment_author_email);
  $parent_id = $comment->comment_parent ? $comment->comment_parent : '';
  global $wpdb;
  if ($wpdb->query("Describe {$wpdb->comments} comment_mail_notify") == '')
    $wpdb->query("ALTER TABLE {$wpdb->comments} ADD COLUMN comment_mail_notify TINYINT NOT NULL DEFAULT 0;");
  if (($comment_author_email != $admin_email && isset($_POST['comment_mail_notify'])) || ($comment_author_email == $admin_email && $admin_notify == '1'))
    $wpdb->query("UPDATE {$wpdb->comments} SET comment_mail_notify='1' WHERE comment_ID='$comment_id'");
  $notify = $parent_id ? get_comment($parent_id)->comment_mail_notify : '0';
  $spam_confirmed = $comment->comment_approved;
  if ($parent_id != '' && $spam_confirmed != 'spam' && $notify == '1') {
    $wp_email = 'songtao.mai@gmail.com';
    $to = trim(get_comment($parent_id)->comment_author_email);
	$subject = 'www.mak-blog.com 向您发来被围观通知！';
	$message = '
<div style="margin:1em 40px 1em 40px;background-color:#eef2fa;border:1px solid #d8e3e8;color:#111;padding:0 15px;font-family:Microsoft YaHei,Verdana;font-size:12.5px;">
<p><strong>@' . trim( get_comment( $parent_id )->comment_author) . '</strong> 童鞋，您在 <strong>《' . get_the_title( $comment->comment_post_ID ) . '》</strong> 上的评论被围观了！</p>
</div>
<div style="margin:1em 40px 1em 40px;background-color:#eef2fa;border:1px solid #d8e3e8;color:#111;padding:0 15px;font-family:Microsoft YaHei,Verdana;font-size:12.5px;">
<p><strong>您</strong> 说: ' . trim( get_comment( $parent_id )->comment_content) . '</p>
<p><strong>' . trim($comment->comment_author) . '</strong> 回: ' . trim($comment->comment_content) . '</p>
<p><small><em>反围观，请猛击： <a href="' . htmlspecialchars(get_permalink($comment->comment_post_ID) . "#comment-".$comment->comment_ID) . '">' . htmlspecialchars(get_permalink($comment->comment_post_ID) . "#comment-".$comment->comment_ID) . '</a></em></small></p>
<p style="float:right"><strong> —— By <a href="http://www.mak-blog.com">www.mak-blog.com</a></strong></p>
</div>
';
	$message = convert_smilies($message);
	$from = "From: \"" . get_option('blogname') . "\" <$wp_email>";
	$headers = "$from\nContent-Type: text/html; charset=" . get_option('blog_charset') . "\n";
	wp_mail( $to, $subject, $message, $headers );
}}
add_action('comment_post', 'comment_mail_notify');

function add_checkbox() {
  echo '<input type="checkbox" name="comment_mail_notify" id="comment_mail_notify" value="comment_mail_notify" checked="checked" style="margin:10px;" /><label for="comment_mail_notify">接收回复邮件通知</label>';
}
add_action('comment_form', 'add_checkbox');

//* Mini Pagenavi v1.0 by Willin Kan.
function pagenavi( $p = 2 ) {
  if ( is_singular() ) return;
  global $wp_query, $paged;
  $max_page = $wp_query->max_num_pages;
  if ( $max_page == 1 ) return;
  if ( empty( $paged ) ) $paged = 1;
echo "<div id=\"pagenavi\">\n";
  if ( $paged > $p + 1 ) p_link( 1, '最前页' );
  if ( $paged > $p + 2 ) echo ' <span class="dots"> ... </span>';
  for( $i = $paged - $p; $i <= $paged + $p; $i++ ) {
    if ( $i > 0 && $i <= $max_page ) $i == $paged ? print "<a class='page-numbers current'>{$i}</a> " : p_link( $i );
  }
  if ( $paged < $max_page - $p - 1 ) echo ' <span class="dots"> ... </span>';
  if ( $paged < $max_page - $p ) p_link( $max_page, '最后页' );
echo "</div>\n";
}
function p_link( $i, $title = '' ) {
  if ( $title == '' ) $title = "第 {$i} 页";
  echo "<a class='page-numbers' href='", esc_html( get_pagenum_link( $i ) ), "' title='{$title}'>{$i}</a> ";
}
	
?>
