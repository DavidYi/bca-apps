<?php ?>
<link href='https://fonts.googleapis.com/css?family=Ubuntu:400,700italic,700,500italic,500,400italic,300italic,300' rel='stylesheet' type='text/css'>
<link rel="stylesheet" type="text/css" href="../ss-entry/ss/main.css">
<body>
    <section class="add">
        <h1>Modify Presentation</h1>

        <form action="index.php" method="post">
        <input type="hidden" name="action" value="modify_presentation">

        <div class="input input--add">
            <input class="input-field add-field" title="" type="text" name="title" value='<?php echo $presentation->pres_title ?>'/>
            <label class="input-label add-label" />
            <div class="input__label-content input__label-content--add">Presentation Name</div>
        </div>

        <div class="input input--add">
            <input class="input-field add-field" title="" type="text" name="desc" value='<?php echo $presentation->pres_desc?>' required/>
            <label class="input-label add-label" />
            <div class="input__label-content input__label-content--add">Description</div>
        </div>

        <div class="input input--add">
            <input class="input-field add-field" title="" type="text" name="organization" value='<?php echo $presentation->organization?>' required/>
            <label class="input-label add-label" />
            <div class="input__label-content input__label-content--add">Organization</div>
        </div>

        <div class="input input--add">
            <input class="input-field add-field" title="" type="text" name="location" value='<?php echo $presentation->location ?>'required/>
            <label class="input-label add-label" />
            <div class="input__label-content input__label-content--add">Location</div>
        </div>


        <label>Fields</label>
        <select name="field_id" title="." value='<?php echo $presentation->field_id?>'>
            <?php  foreach ($fields as $field) {?>
                <option value="<?php echo ($field['field_id']);?>"><?php echo($field['field_name']);  ?></option>
            <?php } ?>
        </select>

        <div class="button">
            <button input type="submit" value="Modify">Modify</button>
        </div>

        <div class="button">
            <button input type="submit" value="Cancel">Cancel</button>
        </div>

            <!-- <a href="index.php?" style="text-decoration: none; color: black"><button>Cancel</button></a> !-->
        </form>
    </section>
</body>

