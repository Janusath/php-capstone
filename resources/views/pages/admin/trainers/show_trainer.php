<main id="main" class="main">

    <div class="pagetitle">
        <h1>Data Tables</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="index.html">Home</a></li>
                <li class="breadcrumb-item">Tables</li>
                <li class="breadcrumb-item active">Data</li>
            </ol>
        </nav>
    </div><!-- End Page Title -->

    <section class="section">
        <div class="row">
            <div class="col-lg-12">

                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Datatables</h5>
                        <p>Add lightweight datatables to your project with using the <a href="https://github.com/fiduswriter/Simple-DataTables" target="_blank">Simple DataTables</a> library. Just add <code>.datatable</code> class name to any table you wish to conver to a datatable. Check for <a href="https://fiduswriter.github.io/simple-datatables/demos/" target="_blank">more examples</a>.</p>

                        <!-- Table with stripped rows -->
                        <table class="table datatable">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Name</th>
                                    <th>Subject</th>
                                    <th>description</th>
                                    <th>facebook_link</th>
                                    <th>instagram_link</th>
                                    <th>linkedin_link</th>
                                    <th>twitter_link</th>
                                    <th>Image</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $sql = "SELECT * FROM trainer;";
                                $stmt = mysqli_prepare($conn, $sql);
                                mysqli_stmt_execute($stmt);
                                $result = mysqli_stmt_get_result($stmt);

                                while ($row = mysqli_fetch_assoc($result)) {
                                    echo "<tr>";
                                    echo "<td>" . $row["id"] . "</td>";
                                    echo "<td>" . $row["name"] . "</td>";
                                    echo "<td>" . $row["subject"] . "</td>";
                                    echo "<td>" . $row["description"] . "</td>";
                                    echo "<td>" . $row["facebook_link"] . "</td>";
                                    echo "<td>" . $row["instagram_link"] . "</td>";
                                    echo "<td>" . $row["linkedin_link"] . "</td>";
                                    echo "<td>" . $row["twitter_link"] . "</td>";
                                    
                                    // Show the image
                                    echo "<td><img src='/PHP_CAPSTONE/public/uploads/" . $row["image"] . "' alt='Trainer Image' width='100'></td>";

                                    echo "<td>
                                            <a href='index.php?page=trainers/edit_trainer&id=" . $row['id'] . "' class='link-dark'>
                                                <i class='fa-solid fa-pen-to-square fs-5 me-3'></i> Edit
                                            </a>
                                        <a href='index.php?page=trainers/delete_trainer&id=" . $row['id'] . "' class='link-dark' onclick='return confirmDelete()'>
                                                <i class='fa-solid fa-trash fs-5'></i> Delete
                                            </a>
                                        </td>";
                                    echo "</tr>";
                                }
                                ?>
                            </tbody>

                         
                        </table>
                        <!-- End Table with stripped rows -->

                    </div>
                </div>

            </div>
        </div>
    </section>

</main><!-- End #main -->