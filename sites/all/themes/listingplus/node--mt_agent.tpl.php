<article id="node-<?php print $node->nid; ?>" class="<?php print $classes; ?> clearfix node-mt"<?php print $attributes; ?>>

  <?php if ($title_prefix || $title_suffix || $display_submitted || !$page) { ?>
  <!-- header -->
  <header>
    <?php print render($title_prefix); ?>
    <?php if (!$page): ?>
      <h2<?php print $title_attributes; ?>><a href="<?php print $node_url; ?>"><?php print $title; ?></a></h2>
    <?php endif; ?>
    <?php print render($title_suffix); ?>

    <?php if ($display_submitted): ?>
      <div class="submitted">
        <?php print $submitted; ?>
      </div>
    <?php endif; ?>

    <?php print $user_picture; ?> 
  </header>
  <!-- EOF: header -->
  <?php } ?>

  <div class="content"<?php print $content_attributes; ?>>
    <?php print render($content['field_mt_photo']); ?>
    <?php print render($content['body']); ?>
    <?php if (render($content['field_mt_agent_one']) || render($content['field_mt_agent_two']) || render($content['field_mt_agent_three'])) { ?>
    <div class="agent-info">
      <h4><?php print t('Contact Details')?></h4>
      <ul class="list-agent-info">
        <?php if (render($content['field_mt_agent_one'])) { ?>
        <li><i class="fa fa-phone"></i><?php print render($content['field_mt_agent_one']); ?></li>
        <?php } ?>
        <?php if (render($content['field_mt_agent_two'])) { ?>
        <li><i class="fa fa-mobile"></i><?php print render($content['field_mt_agent_two']); ?></li>
        <?php } ?>
        <?php if (render($content['field_mt_agent_three'])) { ?>
        <li><i class="fa fa-fax"></i><?php print render($content['field_mt_agent_three']); ?></li>
        <?php } ?>
      </ul>
    </div>
    <?php } ?>
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

</article>