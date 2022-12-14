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
<?php flash('client_message');?>
<div class="d-flex align-items-center p-3 my-3 bg-light text-dark rounded box-shadow">
    <img class="mr-3" src="<?php echo URLROOT; ?>/public/image/esfera_sigcorp.png" alt="" width="48" height="48">
    <div class="lh-100">
        <h6 class="mb-0 lh-100"><?php echo $data['title']; ?></h6>
        <small><?php echo $data['description']; ?></small>
    </div>
    <a class="btn btn-success" href="<?php echo URLROOT; ?>/clients/create" style="margin-left: auto" >Add new client</a>
</div>

<div class="my-3 bg-white rounded box-shadow">
    <div class="table-responsive">
        <table class="table table-striped table-sm">
            <?php if (isset($data['clients'])) : ?>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Phone</th>
                    <th style="width:20%">Actions</th>
                </tr>
                </thead>
                <tbody>
                <?php foreach ($data['clients'] as $client): ?>
                <tr>
                    <td><?= $client->id; ?></td>
                    <td><?= $client->name . ' ' . $client->last_name; ?></td>
                    <td><?= $client->email; ?></td>
                    <td><?= $client->phone; ?></td>
                    <td>
                        <a class="btn btn-outline-primary" href="<?= URLROOT; ?>/clients/show/<?= $client->id; ?>">View</a>
                        <a class="btn btn-outline-warning" href="<?= URLROOT; ?>/clients/edit/<?= $client->id; ?>">Edit</a>
                        <form method="post" action="<?= URLROOT; ?>/clients/delete/<?= $client->id; ?>" style="display: inline-block">
                            <button class="btn btn-outline-danger" data-id="<?= URLROOT; ?>/clients/delete/<?= $client->id; ?>">Delete</button>
                        </form>
                    </td>
                </tr>
                <?php endforeach; ?>
                </tbody>
            <?php else : ?>
            <p>No results to show...</p>
            <?php endif; ?>
        </table>
    </div>
</div>

<?php require_once APPROOT . '/views/inc/footer.php'; ?>