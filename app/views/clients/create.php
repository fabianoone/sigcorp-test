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
require APPROOT . '/views/inc/header.php';
?>
<div class="row">
    <div class="col-md-6 mx-auto">
        <div class="card card-body bg-light mt-5">
            <h2>Add a new client</h2>
            <p>Please fill out this form</p>
            <form action="<?php echo URLROOT; ?>/clients/create" method="post">
                <div class="form-group">
                    <label for="name">Name: <sup>*</sup></label>
                    <input
                        type="text"
                        name="name"
                        id="name"
                        class="form-control form-control-lg
                    <?php echo (!empty($data['name_err'])) ? 'is-invalid' : ''; ?>"
                        value="<?php echo $data['name']; ?>"
                    >
                    <span class="invalid-feedback">
                        <?php echo $data['name_err']; ?>
                    </span>
                </div>
                <div class="form-group">
                    <label for="last_name">Last Name: <sup>*</sup></label>
                    <input
                        type="text"
                        name="last_name"
                        id="last_name"
                        class="form-control form-control-lg
                    <?php echo (!empty($data['last_name_err'])) ? 'is-invalid' : ''; ?>"
                        value="<?php echo $data['last_name']; ?>"
                    >
                    <span class="invalid-feedback">
                        <?php echo $data['last_name_err']; ?>
                    </span>
                </div>
                <div class="form-group">
                    <label for="email">Email: <sup>*</sup></label>
                    <input
                        type="email"
                        name="email"
                        id="email"
                        class="form-control form-control-lg
                    <?php echo (!empty($data['email_err'])) ? 'is-invalid' : ''; ?>"
                        value="<?php echo $data['email']; ?>"
                    >
                    <span class="invalid-feedback">
                        <?php echo $data['email_err']; ?>
                    </span>
                </div>

                <div class="form-group">
                    <label for="phone">Phone: <sup>*</sup></label>
                    <input
                        type="tel"
                        name="phone"
                        id="phone"
                        class="form-control form-control-lg
                    <?php echo (!empty($data['phone_err'])) ? 'is-invalid' : ''; ?>"
                        value="<?php echo $data['phone']; ?>"
                    >
                    <span class="invalid-feedback">
                        <?php echo $data['phone_err']; ?>
                    </span>
                </div>

                <input type="hidden" name="status" value="1">


                <div class="row">
                    <div class="col">
                        <input type="submit" value="Create" class="btn btn-success btn-block">
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

<?php require_once APPROOT . '/views/inc/footer.php'; ?>
