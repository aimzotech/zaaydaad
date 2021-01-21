<?php 
$reading_time = theme_get_setting('reading_time');
$post_progress = theme_get_setting('post_progress');
?>
<article id="node-<?php print $node->nid; ?>" class="<?php print $classes; ?> clearfix node-mt"<?php print $attributes; ?>>
  
  <?php if (($post_progress && $page) || $display_submitted || (module_exists('comment') && ($node->comment == COMMENT_NODE_OPEN || ($node->comment == COMMENT_NODE_CLOSED && $node->comment_count > 0)))) { ?>
  <!-- node-side -->
  <div class="node-side">
    <?php if ($display_submitted || (module_exists('comment') && ($node->comment == COMMENT_NODE_OPEN || ($node->comment == COMMENT_NODE_CLOSED && $node->comment_count > 0)))) { ?>
    <!-- post-submitted-info -->
    <div class="post-submitted-info">
        <?php if ($display_submitted) { ?>
        <div class="submitted-date">
          <?php $custom_month = format_date($node->created, 'custom', 'M'); ?>
          <?php $custom_day = format_date($node->created, 'custom', 'd'); ?>
          <?php $custom_year = format_date($node->created, 'custom', 'Y'); ?>
          <div class="month"><?php print $custom_month; ?></div>
          <div class="day"><?php print $custom_day; ?></div>
          <div class="year"><?php print $custom_year; ?></div>
        </div>
        <?php } ?>
        <?php if (module_exists('comment') && ($node->comment == COMMENT_NODE_OPEN || ($node->comment == COMMENT_NODE_CLOSED && $node->comment_count > 0))) { ?>
        <div class="comments-count">
          <i class="fa fa-comments"></i>
          <div class="comment-counter"><?php print $node->comment_count; ?></div>
        </div>
        <?php } ?>
    </div>
    <!-- EOF: post-submitted-info -->
    <?php } ?>
    <?php if ($post_progress && $page) { ?>
    <!-- #affix -->
    <div id="affix">
      <!-- post-progress -->
      <div class="post-progress">
        <div class="post-progress-value-wrapper">
          <span class="post-progress-value"></span>
          <div class="post-progressbar"></div>
        </div>
        <?php print t('Read so far')?>
      </div>
      <!-- EOF: post-progress -->
    </div>
    <!-- EOF:#affix -->
    <?php } ?>
  </div>
  <!-- EOF: node-side -->
  <?php } ?>

  <?php if (($post_progress && $page) || $display_submitted || (module_exists('comment') && ($node->comment == COMMENT_NODE_OPEN || ($node->comment == COMMENT_NODE_CLOSED && $node->comment_count > 0)))) { ?>
  <!-- node-main-content -->
  <div class="node-main-content custom-width clearfix">
  <?php } else { ?>
  <div class="node-main-content full-width clearfix">
  <?php } ?>
    <?php if ($title_prefix || $title_suffix || $display_submitted || ($reading_time && $page) || !$page) { ?>
    <!-- header -->
    <header>
      <?php print render($title_prefix); ?>
      <?php if (!$page): ?>
        <h2<?php print $title_attributes; ?>><a href="<?php print $node_url; ?>"><?php print $title; ?></a></h2>
      <?php endif; ?>
      <?php print render($title_suffix); ?>

      <?php if ($display_submitted || ($reading_time && $page)) { ?>
        <!-- header-info -->
        <div class="header-info">
        <?php if ($display_submitted) { ?>
          <div class="submitted-user">
          <?php print t('By !username', array('!username' => $name)); ?>
          </div>
        <?php } ?>
        <?php if ($reading_time && $page) { ?>
          <!-- reading-time -->
          <div class="reading-time">
            <?php 
            $node_content = $content;
            $node_content = render($node_content); 
            $words = str_word_count(strip_tags($node_content));
            $minutes = floor($words / 275);
            if ($minutes<1) { 
            print '<span>' . t('less than 1 minute' . '</span>'); 
            } else {
            print '<span>' . $minutes . t(' min to read') . '</span>'; 
            }
            ?>
          </div>
          <!-- EOF: reading-time -->
        <?php } ?>
        </div>
        <!-- EOF: header-info -->
      <?php } ?>

      <?php print $user_picture; ?> 

    </header>
    <!-- EOF: header -->
    <?php } ?>

    <div class="content"<?php print $content_attributes; ?>>
      <?php
        // We hide the comments and links now so that we can render them later.
        hide($content['comments']);
        hide($content['links']);
        print render($content);
      ?>
    </div>

    <?php if ($links = render($content['links'])): ?>
    <footer class="node-footer">
    <?php print render($content['links']); ?>
    </footer>
    <?php endif; ?>

    <?php print render($content['comments']); ?>
  </div>
  <!-- EOF: node-main-content -->

</article>