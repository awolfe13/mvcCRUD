<?php
require APPROOT . '/views/includes/head.php';
?>

<div class="navbar dark">
    <?php
    require APPROOT . '/views/includes/navigation.php';
    ?>
</div>

<div class="animal-container center">
    <h1>Create New Animal</h1>

    <form action="<?= URLROOT?>/animals/create" method="post">
        <!--Name Text-->
        <div class="form-item">
            <input type="text" name="name" placeholder="Name...">
            <span class="invalidFeedback">
                <?= $data['nameError'] ?>
            </span>
        </div>

        <!--Species Drop down-->
        <div class="form-item">
            <label for="species">Choose a Species:</label><br>
            <select name="species" id="species">
                <option value="dog">Dog</option>
                <option value="cat">Cat</option>
                <option value="other">Other</option>
            </select>
        </div>

        <!--Age Drop down-->
        <div class="form-item">
            <label for="age">Choose an Age:</label><br>
            <select name="age" id="age">
                <option value="younger">< 1 year</option>
                <?php foreach(range(1, 20) as $ageOption) { ?>
                <option value="<?=$ageOption?>"><?=$ageOption?></option>
                <?php } ?>
                <option value="unknown">Unknown</option>
            </select>
        </div>

        <!--Gender Radio-->
        <div class="form-item">
            <label for="">Choose a Gender:</label><br>
            <input type="radio" value="M" name="gender" id="gender">
            <label for="male">Male</label>
            <input type="radio" value="F" name="gender" id="gender">
            <label for="female">Female</label>
        </div>

        <!--Breed Text-->
        <div class="form-item">
            <input type="text" name="breed" placeholder="Breed...">
        </div>

        <div class="form-item">
            <textarea name="description" placeholder="Description..."></textarea>
            <span class="invalidFeedback">
                <?= $data['descriptionError'] ?>
            </span>
        </div>

        <button class="btn green" name="submit" type="submit">Submit</button>
    </form>
</div>