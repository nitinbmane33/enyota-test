<?php
if (count($arr_fields) > 0) {
    foreach ($arr_fields as $fields) {
        ?>
        <div class="form-group">
            <label for="<?php echo $fields['field_name'] ?>"><?php echo ucfirst($fields['field_name']) ?>:</label>
            <input type="text" class="form-control" id="<?php echo str_replace(' ', '_', $fields['field_name']) ?>" placeholder="Enter <?php echo ucfirst($fields['field_name']) ?>" name="<?php echo $fields['field_id'];// echo str_replace(' ', '_', $fields['field_name']) ?>" required="">
        </div>

        <?php
    }
}
?>
<button type="submit" class="btn btn-default">Submit</button>