<?php
require APPROOT . '/views/includes/head.php';
?>

<div class="navbar dark">
    <?php
    require APPROOT . '/views/includes/navigation.php';
    ?>
</div>

<div class="animal-container center">
    <h1>Update Animal</h1>

    <form action="<?= URLROOT . "/animals/update/" . $data['animal']->id ?>" method="post">
        <!--Name Text-->
        <div class="form-item">
            <input type="text" name="name" value="<?= $data['animal']->name?>">
        </div>

        <!--Species Drop down-->
        <div class="form-item">
            <label for="species">Choose a Species:</label><br>
            <select name="species" id="species">
                <option value="dog" <?php if($data['animal']->species === "dog") { ?> selected <? } ?>>Dog</option>
                <option value="cat" <?php if($data['animal']->species === "cat") { ?> selected <? } ?>>Cat</option>
                <option value="other" <?php if($data['animal']->species === "other") { ?> selected <? } ?>>Other</option>
            </select>
        </div>


        <!--Age Drop down-->
        <div class="form-item">
            <label for="age">Choose an Age:</label><br>
            <select name="age" id="age">
                <option value="younger" <?php if($data['animal']->age === "younger") { ?> selected <? } ?>>< 1 year</option>
                <?php foreach(range(1, 20) as $ageOption) { ?>
                    <option value="<?=$ageOption?>" <?php if($data['animal']->age === "$ageOption") { ?> selected <? } ?>><?=$ageOption?></option>
                <?php } ?>
                <option value="unknown" <?php if($data['animal']->age === "unknown") { ?> selected <? } ?>>Unknown</option>
            </select>
        </div>

        <!--Gender Radio-->
        <div class="form-item">
            <label for="">Choose a Gender:</label><br>
            <input type="radio" value="M" name="gender" id="gender" <?php if($data['animal']->gender === "M") { ?> checked <? } ?>>
            <label for="male">Male</label>
            <input type="radio" value="F" name="gender" id="gender" <?php if($data['animal']->gender === "F") { ?> checked <? } ?>>
            <label for="female">Female</label>
        </div>

        <!--Breed Text-->
        <div class="form-item">
            <input type="text" name="breed" value="<?= $data['animal']->breed?>">
        </div>

        <div class="form-item">
            <textarea name="description"><?= $data['animal']->description?></textarea>
        </div>

        <button class="btn green" name="submit" type="submit">Submit</button>
    </form>
</div>
