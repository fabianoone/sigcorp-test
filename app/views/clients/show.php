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
    <div class="d-flex align-items-center p-3 my-3 bg-light text-dark rounded box-shadow">
        <img class="mr-3" src="<?php echo URLROOT; ?>/public/image/esfera_sigcorp.png" alt="" width="48" height="48">
        <div class="lh-100">
            <h6 class="mb-0 lh-100"><?php echo $data['title']; ?></h6>
            <small><?php echo $data['description']; ?></small>
        </div>
        <a class="btn btn-success" href="<?php echo URLROOT; ?>/clients/create" style="margin-left: auto" >Add new client</a>
    </div>
<?php ( isset($data['client']) ) ? $client = $data['client'] : $client = '';?>
    <div class="row gutters">
        <div class="col-xl-3 col-lg-3 col-md-12 col-sm-12 col-12">
            <div class="card h-100">
                <div class="card-body">
                    <div class="account-settings">
                        <div class="user-profile">
                            <div class="user-avatar">
                                <i class="fa fa-user-circle fa-5x"></i>
                            </div>
                            <h5 class="user-name"><?= $client->name; ?></h5>
                            <h6 class="user-email"><?= $client->email; ?></h6>

                            <h6 class="user-email">Registered in:
                                <?php
                                $date = date_create($client->created_at);
                                echo date_format($date, 'd/m/Y');
                                ?>
                            </h6>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-9 col-lg-9 col-md-12 col-sm-12 col-12">
            <div class="card h-100">
                <div class="card-body">
                    <div class="row gutters">
                        <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                            <h6 class="mb-2 text-primary">Personal Details</h6>
                        </div>
                        <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12">
                            <div class="form-group">
                                <label for="fullName">Full Name</label>
                                <input type="text" disabled class="form-control" id="fullName" placeholder="<?= $client->name . ' ' . $client->last_name; ?>">
                            </div>

                            <div class="form-group">
                                <label for="eMail">Email</label>
                                <input type="email" disabled class="form-control" id="eMail" placeholder="<?= $client->email; ?>">
                            </div>

                            <div class="form-group">
                                <label for="phone">Phone</label>
                                <input type="text" disabled class="form-control" id="phone" placeholder="<?= $client->phone; ?>">
                            </div>


                                <a class="btn btn-warning btn-block" href="<?php echo URLROOT . '/clients/edit/' . $client->id; ?>">Edit client</a>

                        </div>


                        <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12">
                            <h6>Orders</h6>

                            <table class="table table-striped table-sm" id="sortTable">
                                <thead>
                                <tr>
                                    <th>Order ID</th>
                                    <th>Date</th>
                                    <th>Total</th>
                                    <th>Status</th>
                                </tr>
                                </thead>
                                <tbody>
                                <tr>
                                    <td>#01</td>
                                    <td>13/12/2022</td>
                                    <td>$300</td>
                                    <td>payed</td>
                                </tr>
                                </tbody>
                            <?php if (isset($data['orders'])) : ?>
                            <thead>
                            <tr>
                                <th>Order ID</th>
                                <th>Date</th>
                                <th>Total</th>
                                <th>Status</th>
                            </tr>
                            </thead>
                            <tbody>
                            <tr>
                                <td>#01</td>
                                <td>13/12/2022</td>
                                <td>$300</td>
                                <td>payed</td>
                            </tr>
                            <?php foreach ($data['orders'] as $order): ?>
                                <tr>
                                    <td><?= $order->code; ?></td>
                                    <td><?= $order->title; ?></td>
                                    <td><?= $order->price; ?></td>
                                    <td><?= ($order->active == 1) ? 'Activated' : 'Deactivated'; ?></td>
                                    <td>
                                        <div class="btn-group" role="group" aria-label="Button group with nested dropdown">
                                            <div class="btn-group" role="group">
                                                <button id="actionBtns" type="button" class="btn btn-outline-primary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                    Manage
                                                </button>
                                                <div class="dropdown-menu" aria-labelledby="actionBtns">
                                                    <a class="dropdown-item" href="<?= URLROOT . '/products/show/' .$order->id; ?>">View</a>
                                                    <a class="dropdown-item" href="<?= URLROOT . '/products/edit/' .$order->id; ?>">Edit</a>
                                                    <a class="dropdown-item" href="<?= URLROOT . '/products/delete/' .$order->id; ?>">Delete</a>
                                                </div>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                            </tbody>
                            </table>
                            <?php endif; ?>
                        </div>
                    </div>

                </div>
            </div>
        </div>

        <div class="row gutters">
            <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">

            </div>
        </div>
    </div>




<?php require_once APPROOT . '/views/inc/footer.php'; ?>