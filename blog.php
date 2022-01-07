<?php ob_start() ?>
<script src="js/blog.js"></script>
<?php $content = ob_get_clean();
require_once "./layout/template.php"; ?>