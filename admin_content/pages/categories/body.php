<main class="page page-categories">
  <h1 class="main__header">Kategorie</h1>

  <section class="page-categories__criteria">
    <h3 class="section__header">Utwórz nową</h3>

    <form action="<?php e_page('/categories/'); ?>" method="POST">
      <div class="buttons">
        <button name="intent-add-category">Utwórz nową kategorię</button>
      </div>
    </form>
  </section>

  <section class="page-categories__results">
    <h3 class="section__header">Kategorie</h3>

    <ul class="category-list">
      <?php
        foreach(s_model('categories') as $category){
          echo '<li> <a href="'.s_page('/edit-category/'.$category["cat_id"]).'">'.$category["cat_name"].'</a> </li>';
        }
      ?>
    </ul>
  </section>
</main>
