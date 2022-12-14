<?php
/**
 * Include header and footer php files
 * php version 7
 *
 * @category PHP
 * @package  Core_Required
 * @author   Fabiano Oliveira <fabiano.one@gmail.com>
 * @license  GNU http://opensource.org/licenses/gpl-license.php
 * @link     https://github.com/fabianoone
 */
require_once APPROOT . '/views/inc/header.php'; ?>

<div class="d-flex align-items-center p-3 my-3 bg-light text-dark rounded box-shadow">
    <img class="mr-3" src="<?php echo URLROOT; ?>/public/image/esfera_sigcorp.png" alt="" width="48" height="48">
    <div class="lh-100">
        <h6 class="mb-0 lh-100"><?php echo $data['title']; ?></h6>
        <small><?php echo $data['description']; ?></small>
    </div>
</div>

<?php require_once APPROOT . '/views/inc/footer.php'; ?>