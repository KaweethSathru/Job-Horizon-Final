<div class="col-xl-9 col-lg-9 col-md-8">
    <section class="featured-job-area">
        <div class="container">
            <?php

            $query = "SELECT * FROM jobs
            WHERE jobs_recycle_bin = 0
            ORDER BY posted_date DESC
            LIMIT 5";
            

            $result1 = mysqli_query($connection, $query);
            ?>
            <div class="row">
                <div class="col-lg-12">
                    <div class="count-job mb-35">
                        <span><?php echo mysqli_num_rows($result1) ?> Jobs found</span>
                        <!-- <div class="select-job-items">
                            <span>Sort by</span>
                            <select name="select">
                                <option value="">None</option>
                                <option value="">job list</option>
                                <option value="">job list</option>
                                <option value="">job list</option>
                            </select>
                        </div> -->
                    </div>
                </div>
            </div>
            <?php

            if ($result1) { ?>

                <?php

                if (mysqli_num_rows($result1) > 0) { ?>

                    <?php while ($record1 = mysqli_fetch_array($result1)) {

                        $_GET['j_id'] = $record1['job_id'];
                        $com_id = $record1['company_id'];
                        $_GET['com_id'] = $record1['company_id'];

                        $query2 = "SELECT * FROM companies WHERE company_id = '{$com_id}' LIMIT 1";
                        $result2 = mysqli_query($connection, $query2);

                        if ($result2) {

                            while ($record2 = mysqli_fetch_array($result2)) {

                    ?>
                                <div class="single-job-items mb-30">
                                    <div class="job-items">
                                        <div class="company-img">
                                            <a href="job_details.php?job_id=<?= $_GET['j_id'] ?>&company_id=<?= $_GET['com_id'] ?>">
                                            <img class="companyLogo" src="../assets/uploads/companies/company-logo/<?php echo $record2['company_logo'] ?>" alt="<?php echo $record2['company_logo']; ?>">
                                            </a>
                                        </div>
                                        <div class="job-tittle">
                                            <a href="job_details.php?job_id=<?= $_GET['j_id'] ?>&company_id=<?= $_GET['com_id'] ?>">
                                                <h4><?php echo strtoupper($record1['job_role']) ?></h4>
                                            </a>
                                            <ul>
                                                <li><?php echo $record2['company_name'] ?></li>
                                                <li><i class="fas fa-map-marker-alt"></i><?php echo $record1['location'] ?></li>
                                                <li>$<?php echo $record1['salary'] ?></li>
                                            </ul>
                                        </div>
                                    </div>
                                    <div class="items-link f-right">
                                        <a href="job_details.php?job_id=<?= $_GET['j_id'] ?>&company_id=<?= $_GET['com_id'] ?>"><?php echo $record1['job_nature'] ?></a>
                                        <span><?php echo $record1['posted_date'] ?></span>
                                    </div>
                                </div>

                            <?php
                            }

                            ?>

                    <?php

                        }
                    } ?>

            <?php }
            } else {
                echo "DB failed!";
            }

            ?>
        </div>
    </section>
</div>
</div>
</div>
</div>