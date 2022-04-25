<?php
require APPROOT . '/views/includes/head.php';
?>

<div class="navbar dark">
    <?php
    require APPROOT . '/views/includes/navigation.php';
    ?>
</div>

<div class="animal-container">
    <?php if(isLoggedIn()) {?>
        <a href="<?= URLROOT?>/animals/create" class="btn green">
            Create Animal
        </a>
    <?php } ?>

    <?php foreach($data['animals'] as $animal) { ?>
    <div class="container-item">
        <!--If user logged in and matches animal creation id-->
        <?php if(isset($_SESSION['user_id']) && $_SESSION['user_id'] ==
        $animal->user_id) { ?>
            <a href="<?= URLROOT . "/animals/update/" . $animal->id?>" class="btn blue">
                Update Animal
            </a>
            <!--delete with form-->
            <form action="<?= URLROOT . "/animals/delete/" . $animal->id ?>" method="POST">
                <input type="submit" name="delete" value="Delete" class="btn red">
            </form>
        <?php } ?>
        <h2>
            <?= $animal->name; ?>
        </h2>
        <h3>
            <?= 'Intake at: ' . date('F j, Y', strtotime($animal->intake_date)) ?>
        </h3>
        <p class="info">
            <?= $animal->age; ?>, <?= $animal->gender; ?>, <?= $animal->species; ?>, <?= $animal->breed; ?>
        </p>
        <p>
            <?= $animal->description ?>
        </p>
    </div>
    <?php } ?>
</div>