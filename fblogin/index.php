<?php require './fbinit.php'; ?>

<?php if (isset($_SESSION['access_token'])): ?>
<a href="logout.php">Logout</a>
<?php else: ?>
    <a href="<?php echo $login_url; ?>">Login With facebook</a>
<?php endif; ?>
