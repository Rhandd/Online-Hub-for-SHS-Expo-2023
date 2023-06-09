<div class="sidebarinner d-flex justify-content-between">
    <div class="d-flex gap-3">
        <?php
        $sql = "SELECT category_id, category_name FROM category";
        $res = $conn->prepare($sql);
        $res->bind_result($id, $catname);
        $res->execute();
        $res->store_result();
        if ($res->num_rows() > 0) {
            while ($res->fetch()) {
                echo '<button type="button" class="cat-btn btn btn-primary" onclick="location.href=\'category.php?pageid=' . $id . '\'">' . $catname . '</button>';
            }
        }
        ?>
    </div>

    <div class="d-flex gap-3">
        <form action="search.php" method="POST" class="d-flex">
            <input class="cat-search form-control me-2" name="search" id="search" type="text" placeholder="Search Post" autocomplete="off" aria-label="Search">
            <input class="cat-btn btn btn-primary" type="submit" name="searchsub" id="submit" value="Search">
        </form>

        <?php

        if (isset($_SESSION['id'])) {
            echo '<a href="createpost.php" class="cat-btn btn btn-primary">Create Post</a>';
        } else {
            echo '<a href="client-includes\login.php" class="cat-btn btn btn-primary">Create Post</a>';
        }
        ?>
    </div>
</div>