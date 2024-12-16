<?
if(!@$_SESSION) {
    session_start();
  }

include("../partial/header.php");?>
<section>
    <? include("../partial/navUser.php");?>
</section>
<?
include("../partial/footer.php");
?>