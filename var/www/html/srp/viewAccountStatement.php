<!DOCTYPE html>
<html>
<head>

    <?php

        $hoa_id = $_GET['hoa_id'];
        $community_id = $_GET['community_id'];

    ?>

    <title>Account Statement</title>
</head>
<body>

    <script type="text/javascript">
        
        $(document).ready(function(){

            $.ajax({

                hoa_id = <?php echo $hoa_id; ?>
                community_id = <?php echo $community_id; ?>

                url: "hoaResources/accountStatement.php?hoa_id="+hoa_id+"&community_id="+community_id,
                type: "GET",
                success: function(response){

                    document.write(response);

                }

            });

        });

    </script>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>

</body>
</html>