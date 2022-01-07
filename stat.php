<?php ob_start(); ?>
<table id="statTable">

</table>
<?php $content = ob_get_clean();
require_once "./layout/template.php"; ?>