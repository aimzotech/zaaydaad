<div class="row">
  <?php
  $node=$element['#object']; $lang="und";
  $tname = 'amenities';
  $myvoc = taxonomy_vocabulary_machine_name_load($tname);
  $tree = taxonomy_get_tree($myvoc->vid);

  foreach ($node->field_amenities[$lang] as $key=>$amenity) {
    $target_term[] = $amenity['taxonomy_term']->name;
  }
  ?>
  <h3>Amenities</h3>
  <ul class="check-list">
    <?php
      foreach ($tree as $term) {?>
        <div class="taxonomy-item col-xs-12 col-sm-4">
          <?php
          
              if(in_array($term->name, $target_term)){
            ?>
              <li><i class="fa fa-check"></i> <?php print($term->name); ?></li>
            <?php }else{?>
              <li><i class="fa fa-times"></i> <?php print($term->name); ?></li>
            <?php } ?>
        </div>
    <?php } ?>
  </ul>
</div>
