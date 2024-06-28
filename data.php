<?php

require 'connection.php';

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Table with Clickable Images</title>
    <!-- Bootstrap CSS for modal -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        /* Optional custom styles */
        .modal-body img {
            max-width: 100%;
            height: auto;
        }
    </style>
</head>
<body>

    <div class="container">
        <h2>Table with Clickable Images</h2>

        <table class="table table-bordered table-striped">
            <thead>
                <tr>
                    <th>Id No.</th>
                    <th>Name</th>
                    <th>Image</th>
                </tr>
            </thead>
            <tbody>

            <?php
                $i = 1;
                $rows = mysqli_query($conn, "SELECT * FROM tbl_upload ORDER BY id DESC") or die(mysqli_error($conn));

                foreach($rows as $row) :
            ?>
                <tr>
                    <td><?php echo $i++; ?></td>
                    <td><?php echo $row['name']; ?></td>
                    <td>
                        <!-- Image link to open modal -->
                        <a href="#" data-toggle="modal" data-target="#imageModal<?php echo $row['id']; ?>">
                            <img src="img/<?php echo $row['image']; ?>" alt="image" height="100px" style="cursor: pointer;">
                        </a>
                    </td>
                </tr>

            <?php endforeach; ?>

            </tbody>
        </table>

        <a href="index.php">Back</a>
    </div>

    <!-- Modal Structure -->
    <?php foreach($rows as $row) : ?>
    <div class="modal fade" id="imageModal<?php echo $row['id']; ?>" tabindex="-1" role="dialog" aria-labelledby="imageModalLabel<?php echo $row['id']; ?>" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="imageModalLabel<?php echo $row['id']; ?>">Image Preview</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body text-center">
                    <img src="img/<?php echo $row['image']; ?>" alt="image" style="max-width: 100%; max-height: 400px;">
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
    <?php endforeach; ?>

    <!-- Bootstrap JS for modal -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@1.16.1/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

</body>
</html>
