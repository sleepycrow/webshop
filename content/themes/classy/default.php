<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">

        <link rel="stylesheet" type="text/css" href="<?php e_theme_uri('/resx/css.css'); ?>">

        <link rel="stylesheet" type="text/css" href="<?php e_theme_uri('/resx/gallery.css'); ?>">
        <script src="<?php e_theme_uri('/resx/gallery.js'); ?>"></script>
        <script src="<?php e_theme_uri('/resx/hotsearch.js'); ?>"></script>
        <script>
            hs.rootUri = "<?php echo ROOT_URI; ?>";
        </script>

        <?php include $s_page->get_head_path(); ?>

        <title><?php echo $s_page->title; ?> • <?php e_sitename(); ?></title>
    </head>
    <body>
        <?php include s_theme_path('/elems/header.php'); ?>

        <?php include $s_page->get_body_path(); ?>

        <footer>
            &copy; <?php echo date('Y').' '.s_sitename(); ?>
        </footer>
    </body>
</html>
