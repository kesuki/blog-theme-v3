<?php if ( post_password_required() ) : ?>
<?php _e( 'Enter your password to view comments.' ); ?>
<?php return; endif; ?>

<div id="comments">
    <?php if ( have_comments() ) : ?>
    <div class="commentshow">
      <ol class="commentlist">
        <?php wp_list_comments('type=comment&callback=mytheme_comment'); ?>
      </ol>
    </div>
      <?php if ( get_comment_pages_count() > 1 && get_option( 'page_comments' ) ) : ?>
        <div class="navigation">
          <span class="alignleft"><?php previous_comments_link( __( '&laquo; Older Comments' ) ); ?></span>
          <span class="alignright"><?php next_comments_link( __( 'Newer Comments &raquo;' ) ); ?></span>
        </div>
      <?php endif; ?>
    <?php elseif ( ! comments_open() && ! is_page() && post_type_supports( get_post_type(), 'comments' ) ) : ?>
      <p><?php _e( 'Comments are closed.' ); ?></p>
    <?php endif; ?>
<?php
$args =  array(
'comment_field'=> '<p class="comment-form-comment"><label for="comment">' . _x( 'Comment', 'noun' ) . '</label>
<textarea id="comment" name="comment" cols="45" rows="8"></textarea>
<p class="clear"/>
<a href="javascript:grin(\':?:\')"      ><img src="'.get_template_directory_uri().'/images/smilies/icon_question.gif"  alt="" /></a>
<a href="javascript:grin(\':razz:\')"   ><img src="'.get_template_directory_uri().'/images/smilies/icon_razz.gif"      alt="" /></a>
<a href="javascript:grin(\':sad:\')"    ><img src="'.get_template_directory_uri().'/images/smilies/icon_sad.gif"       alt="" /></a>
<a href="javascript:grin(\':evil:\')"   ><img src="'.get_template_directory_uri().'/images/smilies/icon_evil.gif"      alt="" /></a>
<a href="javascript:grin(\':!:\')"      ><img src="'.get_template_directory_uri().'/images/smilies/icon_exclaim.gif"   alt="" /></a>
<a href="javascript:grin(\':smile:\')"  ><img src="'.get_template_directory_uri().'/images/smilies/icon_smile.gif"     alt="" /></a>
<a href="javascript:grin(\':oops:\')"   ><img src="'.get_template_directory_uri().'/images/smilies/icon_redface.gif"   alt="" /></a>
<a href="javascript:grin(\':grin:\')"   ><img src="'.get_template_directory_uri().'/images/smilies/icon_biggrin.gif"   alt="" /></a>
<a href="javascript:grin(\':eek:\')"    ><img src="'.get_template_directory_uri().'/images/smilies/icon_surprised.gif" alt="" /></a>
<a href="javascript:grin(\':shock:\')"  ><img src="'.get_template_directory_uri().'/images/smilies/icon_eek.gif"       alt="" /></a>
<a href="javascript:grin(\':???:\')"    ><img src="'.get_template_directory_uri().'/images/smilies/icon_confused.gif"  alt="" /></a>
<a href="javascript:grin(\':cool:\')"   ><img src="'.get_template_directory_uri().'/images/smilies/icon_cool.gif"      alt="" /></a>
<a href="javascript:grin(\':lol:\')"    ><img src="'.get_template_directory_uri().'/images/smilies/icon_lol.gif"       alt="" /></a>
<a href="javascript:grin(\':mad:\')"    ><img src="'.get_template_directory_uri().'/images/smilies/icon_mad.gif"       alt="" /></a>
<a href="javascript:grin(\':twisted:\')"><img src="'.get_template_directory_uri().'/images/smilies/icon_twisted.gif"   alt="" /></a>
<a href="javascript:grin(\':roll:\')"   ><img src="'.get_template_directory_uri().'/images/smilies/icon_rolleyes.gif"  alt="" /></a>
<a href="javascript:grin(\':wink:\')"   ><img src="'.get_template_directory_uri().'/images/smilies/icon_wink.gif"      alt="" /></a>
<a href="javascript:grin(\':idea:\')"   ><img src="'.get_template_directory_uri().'/images/smilies/icon_idea.gif"      alt="" /></a>
<a href="javascript:grin(\':arrow:\')"  ><img src="'.get_template_directory_uri().'/images/smilies/icon_arrow.gif"     alt="" /></a>
<a href="javascript:grin(\':neutral:\')"><img src="'.get_template_directory_uri().'/images/smilies/icon_neutral.gif"   alt="" /></a>
<a href="javascript:grin(\':cry:\')"    ><img src="'.get_template_directory_uri().'/images/smilies/icon_cry.gif"       alt="" /></a>
<a href="javascript:grin(\':mrgreen:\')"><img src="'.get_template_directory_uri().'/images/smilies/icon_mrgreen.gif"   alt="" /></a>
</p>',
'label_submit'=> '发 表 评 论',
);
comment_form($args);
?>

<script type="text/javascript">
/* <![CDATA[ */
    function grin(tag) {
      if (document.getElementById('comment') && document.getElementById('comment').type == 'textarea') {
        myField = document.getElementById('comment');
      } else {
        return false;
      }
      tag = ' ' + tag + ' ';
      if (document.selection) {
        myField.focus();
        sel = document.selection.createRange();
        sel.text = tag;
        myField.focus();
      }
      else if (myField.selectionStart || myField.selectionStart == '0') {
        startPos = myField.selectionStart
        endPos = myField.selectionEnd;
        cursorPos = startPos;
        myField.value = myField.value.substring(0, startPos)
                      + tag
                      + myField.value.substring(endPos, myField.value.length);
        cursorPos += tag.length;
        myField.focus();
        myField.selectionStart = cursorPos;
        myField.selectionEnd = cursorPos;
      }
      else {
        myField.value += tag;
        myField.focus();
      }
    }
/* ]]> */
</script>
</div>
