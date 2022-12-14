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
<?php (isset($data['product'])) ? $product = $data['product'] : $product = ''; ?>
    <div class="row justify-content-end">
        <div class="d-flex align-items-center">
            <a class="btn btn-outline-success text-right" href="<?= URLROOT . '/products/'; ?>">List of products</a>
        </div>
    </div>

<?php if ( isset($data['product'])) : $product = $data['product']; ?>
    <div class="row">
        <div class="col-md-6 mx-auto">
            <div class="card card-body bg-light mt-5">
                <h2><?php echo (!empty($data['description']) ? $data['description'] : ''); ?></h2>

                <form action="<?php echo URLROOT; ?>/products/update" method="post">
                    <div class="form-group">
                        <label for="name">Title: <sup>*</sup></label>
                        <input
                            type="text"
                            name="title"
                            id="title"
                            class="form-control form-control-lg
                    <?php echo (!empty($data['title_err'])) ? 'is-invalid' : ''; ?>"
                            value="<?php echo $product->title; ?>"
                        >
                        <span class="invalid-feedback">
                        <?php echo (!empty($data['title_err']) ? $data['title_err'] : ''); ?>
                    </span>
                    </div>
                    <div class="form-group">
                        <label for="last_name">Code: <sup>*</sup></label>
                        <input
                            type="text"
                            name="code"
                            id="code"
                            class="form-control form-control-lg
                    <?php echo (!empty($data['code_name_err'])) ? 'is-invalid' : ''; ?>"
                            value="<?php echo $product->code; ?>"
                        >
                        <span class="invalid-feedback">
                        <?php echo (!empty($data['code_err']) ? $data['code_err'] : ''); ?>
                    </span>
                    </div>
                    <div class="form-group">
                        <label for="email">Price: <sup>*</sup></label>
                        <input
                            type="text"
                            name="price"
                            id="price"
                            class="form-control form-control-lg
                    <?php echo (!empty($data['price_err'])) ? 'is-invalid' : ''; ?>"
                            value="<?php echo $product->price; ?>"
                        >
                        <span class="invalid-feedback">
                        <?php echo (!empty($data['price_err']) ? $data['price_err'] : ''); ?>
                    </span>
                    </div>

                    <div class="form-group">

                        <label for="email">Status: <sup>*</sup></label>
                        <select class="form-control" name="active" id="active">
                            <option value="0" <?= ($product->active == 0) ? 'selected' : ''; ?>>Deactivate</option>
                            <option value="1" <?= ($product->active == 1) ? 'selected' : ''; ?>>Activate</option>
                        </select>

                    </div>

                    <div class="form-group">
                        <label for="phone">Description: <sup>*</sup></label>
                        <textarea
                            name="description"
                            id="description"
                            cols="30" rows="10"
                            class="form-control
                            <?php echo (!empty($data['description_err'])) ? 'is-invalid' : ''; ?>"
                        ><?php echo $product->description; ?></textarea>
                        <span class="invalid-feedback">
                        <?php echo (!empty($data['description_err']) ? $data['description_err'] : ''); ?>
                    </span>
                    </div>

                    <input type="hidden" name="id" value="<?php echo $product->id; ?>">

                    <div class="row">
                        <div class="col">
                            <input type="submit" value="Save" class="btn btn-success btn-block">
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

<?php else:
redirect('products');
endif;
?>

<?php require_once APPROOT . '/views/inc/footer.php'; ?>