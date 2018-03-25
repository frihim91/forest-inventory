<nav class="navbar navbar-static-top navbar-fixed-top" role="navigation">

    <ul class="sm sm-blue" style="margin-right:0px !important;" id="main-menu">
        <li><a href="<?php echo base_url(); ?>portal/index">Home</a></li>
        <li class="dropdown">
            <a href="#"> About &nbsp;&nbsp; <span class="caret"></span></a>
            <ul role="menu" class="dropdown-menu">
                <li><a href="#">Information</a></li>
                <li><a href="#">General Information</a></li>
                <li><a href="#">Why Study Here</a></li>
                <li><a href="#">Resources</a></li>
                <li><a href="#">Carrer</a></li>
                <li><a href="#">Convoction</a></li>
                <li><a href="#">Video</a></li>
            </ul>
        </li>
        <li class="dropdown">
            <a href="#">Academic &nbsp;&nbsp;<span class="caret"></span></a>
            <ul role="menu" class="dropdown-menu">

                <li>
                    <a href="#">Academic Programs</a>
                    <ul role="menu" class="dropdown-menu">
                        <?php foreach ($degree as $row): ?>
                            <li><a href="#"><?php echo $row->DEGREE_NAME ?> </a>
                                <ul role="menu" class="dropdown-menu">
                                    <?php
                                    $program = $this->db->query("SELECT a.PROGRAM_ID, a.PROGRAM_NAME
                                      FROM program a
                                      WHERE a.DEGREE_ID =$row->DEGREE_ID")->result();
                                    if (!empty($program)) {
                                        foreach ($program as $pr):
                                            ?>
                                            <li><a href="#"><?php echo $pr->PROGRAM_NAME ?></a></li>
                                        <?php endforeach;
                                    } else {
                                        echo "No data found";
                                    } ?>
                                </ul>
                            </li>
                        <?php endforeach; ?>

                    </ul>
                </li>
                <li><a href="#">Class Scedule</a></li>
                <li><a href="#">Exam Scedule</a></li>

            </ul>
        </li>
        <li class="dropdown">
            <a href="##">Staff/Faculties &nbsp;&nbsp;<span class="caret"></span></a>
            <ul role="menu" class="dropdown-menu">
                <li><a href="<?php echo base_url(); ?>portal/facultyStaff">Administrative</a></li>
                <li><a href="<?php echo base_url(); ?>portal/facultyTeacher">Faculty Member</a></li>

            </ul>
        </li>
        <li><a href="<?php echo base_url(); ?>portal/feature"> Contact</a></li>
    </ul>

</nav>
