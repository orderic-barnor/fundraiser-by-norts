 <?php
        // comments section
        $comments = get_comments([
          'post_id' => $post->ID,
          'parent'  => 0,
          'status'  => 'approve',
        ]);

        $comments_nbr = count(get_comments([
          'post_id' => $post->ID,
          'status'  => 'approve',
        ]));

        ?>
        <?php if (count($comments) > 0) : ?>
          <div class="pt-5">
            <h3 class="mb-5"><?php echo $comments_nbr . " Commentaire" . ($comments_nbr > 1 ? 's' : ''); ?></h3>
            <ul class="comment-list">
              <?php my_theme_display_comments($comments); ?>
            </ul>
            <!-- END comment-list -->

            <?php
            if (comments_open()) { ?>
              <div class="comment-form-wrap pt-5">
                <?php
                comment_form(array(
                  'title_reply'          => 'Laisser un commentaire',
                  'label_submit'         => 'Envoyer',
                  'fields' => array(
                    'author'  => '
                      <div class="form-group">
                        <label for="name">Name *</label>
                        <input name="author" type="text" class="form-control" id="name">
                      </div>
                    ',
                    'email'  => '
                      <div class="form-group">
                        <label for="email">Email *</label>
                        <input type="email" name="email" class="form-control" id="email">
                      </div>
                    ',
                  ),
                  'comment_field'   => '
                    <div class="form-group">
                      <label for="message">Message</label>
                      <textarea name="comment" id="message" cols="30" rows="10" class="form-control"></textarea>
                    </div>
                  ',
                  'class_submit' => 'btn btn-primary btn-md text-white',
                ));
                ?>
              </div>
            <?php } ?>
          </div>
        <?php endif; ?>