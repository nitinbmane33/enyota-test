<!DOCTYPE html>
<html lang="en">
    <head>
        <title>Enoyta Test</title>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    </head>
    <body>

        <div class="container">
            <h2 class="text-center">Demo Form</h2>
            <div class="col-md-8 col-md-offset-2">
                <form action="<?php echo base_url() ?>insert-fields-data" method="post" id="frm_add_country_details" name="frm_add_country_details">
                    <div class="form-group">
                        <label for="country">Country:</label>
                        <select class="form-control" name="country" id="country">
                            <option value="">Select Country</option>
                            <?php
                            if (count($arr_country) > 0) {
                                foreach ($arr_country as $country) {
                                    ?>
                                    <option value="<?php echo $country['country_id'] ?>"><?php echo $country['country_name'] ?></option>
                                    <?php
                                }
                            }
                            ?>
                        </select>
                    </div>
                    <div id="field_list"></div>
                </form>
            </div>
        </div>
    </body>
    <script>
        $('#country').on('change', function () {
            var country_id = $(this).val();
            $.ajax({
                url: '<?php echo base_url() ?>get-form-data',
                type: 'post',
                data: {
                    country_id: country_id
                },
                dataType: 'html',
                success: function (response) {
                    $('#field_list').html(response);
                }
            })
        })
    </script>
</html>
