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

<div class="row justify-content-end">
    <div class="d-flex align-items-center">
        <a class="btn btn-outline-success text-right" href="<?= URLROOT . '/products/'; ?>">List of products</a>
    </div>
</div>
<!-- Product section-->
<section class="pb-5">
    <div class="container my-3">
        <?php if (isset($data['product'])): ?>
        <div class="row gx-4 gx-lg-5 align-items-center">
            <div class="col-md-6"><img class="card-img-top mb-5 mb-md-0" src="https://dummyimage.com/250x250/dee2e6/6c757d.jpg" alt="..." /></div>
            <div class="col-md-6">
                <div class="small mb-1">SKU: <?= $data['product']->code; ?></div>
                <h1 class="display-5 fw-bolder"><?= $data['product']->title; ?></h1>
                <div class="fs-5 mb-5">
                    <span class="text-decoration-line-through">$<?= $data['product']->price; ?></span>

                </div>
                <p class="lead"><?= $data['product']->description; ?></p>
                <div class="d-flex">

                    <button class="btn btn-outline-success btn-block flex-shrink-0" type="button" value="<?= $data['product']->id; ?>">
                        <i class="bi-cart-fill me-1"></i>
                        Add item to order
                    </button>
                </div>
            </div>
        </div>
        <?php endif; ?>
    </div>
</section>

<?php require_once APPROOT . '/views/inc/footer.php'; ?>