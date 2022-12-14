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

<?php flash('update_success');?>
<?php flash('register_success');?>
<?php flash('product_message');?>
    <div class="d-flex align-items-center p-3 my-3 bg-light text-dark rounded box-shadow">
        <img class="mr-3" src="<?php echo URLROOT; ?>/public/image/esfera_sigcorp.png" alt="" width="48" height="48">
        <div class="lh-100">
            <h6 class="mb-0 lh-100"><?php echo $data['title']; ?></h6>
            <small><?php echo $data['description']; ?></small>
        </div>

    </div>
    <br>
    <div class="row mb-4">

        <div class="col-md-4">
            <h6 class="mb-4">Add new product</h6>
            <form class="needs-validation" novalidate method="post" action="<?php echo URLROOT; ?>/products/create">

            <div class="row">
            <div class="col-md-5 mb-3">
                <label for="code">Code</label>
                <input type="text" class="form-control" name="code" id="code" placeholder="#0000" value="" required="">

            </div>
            <div class="col-md-7 mb-3">
                <label for="title">Title</label>
                <input type="text" class="form-control" name="title" id="title" placeholder="Product title" value="" required="">

            </div>
        </div>

            <div class="row">
                <div class="col mb-3">
                    <label for="description">Description</label>
                    <textarea class="form-control" name="description" id="description" rows="5"></textarea>

                </div>
            </div>

            <div class="row">
                <div class="col mb-3">
                    <label for="price">Price</label>
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text">R$</span>
                        </div>
                        <input type="text" name="price" class="form-control" id="price" placeholder="0.00" required="">

                    </div>
                </div>
            </div>



            <div class="custom-control custom-checkbox">
                <input type="checkbox" name="active" class="custom-control-input" id="active" checked>
                <label class="custom-control-label" for="active">Active</label>
            </div>

            <hr class="mb-4">

            <button class="btn btn-success btn-lg btn-block" type="submit">Create Product</button>

            </form>
        </div>

        <div class="col-md-8">
            <div class="d-flex justify-content-between align-content-center mb-4">
                <h6 class="mt-1">Manage products</h6>
                    <div class="btn-group d-none" role="group">
                        <form id="form-limit" action="<?php echo URLROOT; ?>/products/index" method="POST">
                            <label for="limit-records"></label>
                            <select class="form-control" name="limit-records" id="limit-records">
                                <option disabled selected>Limit records</option>
                                <option value="3">3 Records</option>
                                <option value="10">10 Records</option>
                                <option value="20">20 Records</option>
                            </select>
                        </form>
                    </div>
            </div>


            <table class="table table-striped table-sm" id="sortTable">
                <?php if (isset($data['products'])) : ?>
                    <thead>
                    <tr>
                        <th>Code</th>
                        <th>Title</th>
                        <th>Price</th>
                        <th>Status</th>
                        <th style="width:20%">Actions</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php foreach ($data['products'] as $product): ?>


                        <tr>
                            <td><?= $product->code; ?></td>
                            <td><?= $product->title; ?></td>
                            <td><?= $product->price; ?></td>
                            <td><?= ($product->active === '1') ? 'Activated' : 'Deactivated'; ?></td>
                            <td>
                                <div class="btn-group" role="group" aria-label="Button group with nested dropdown">
                                    <div class="btn-group" role="group">
                                        <button id="actionBtns" type="button" class="btn btn-outline-primary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                            Manage
                                        </button>
                                        <div class="dropdown-menu" aria-labelledby="actionBtns">
                                            <a class="dropdown-item" href="<?= URLROOT . '/products/show/' .$product->id; ?>">View</a>
                                            <a class="dropdown-item" href="<?= URLROOT . '/products/edit/' .$product->id; ?>">Edit</a>

                                            <form action="<?= URLROOT . '/products/delete/' .$product->id; ?>" method="post" style="display: inline-block">
                                                <button class="dropdown-item" data-id="<?= URLROOT . '/products/delete/' .$product->id; ?>">Delete</button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                    </tbody>
            </table>


            <nav aria-label="Page navigation example">
                <ul class="pagination">
                    <li class="page-item">
                        <a class="page-link" href="<?= (isset($data['previous']) && $data['previous'] > 0) ? URLROOT . '/products/?page=' . $data['previous'] : 'javascript:void(0);'; ?>" aria-label="Previous">
                            <span aria-hidden="true">&laquo;</span>
                            <span class="sr-only">Previous</span>
                        </a>
                    </li>

                    <?php if (isset($data['pages'])): ?>
                        <?php for($i = 1; $i <= $data['pages']; $i++) : ?>
                        <li class="page-item"><a class="page-link" href="<?= URLROOT . '/products/?page=' . $i; ?>"><?= $i; ?></a></li>
                        <?php endfor; ?>
                    <?php endif; ?>

                    <li class="page-item">
                        <a class="page-link" href="<?= (isset($data['next']) && !empty($data['products'])) ? URLROOT . '/products/?page=' . $data['next'] : 'javascript:void(0);'; ?>" aria-label="Next">
                            <span aria-hidden="true">&raquo;</span>
                            <span class="sr-only">Next</span>
                        </a>
                    </li>
                </ul>
            </nav>

            <?php else : ?>
            <p>No results to show...</p>
            <?php endif; ?>
        </div>

    </div>

<?php require_once APPROOT . '/views/inc/footer.php'; ?>