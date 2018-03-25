
                        <div class="innerLR">

                            <div class="msg">
                                <?php
                                if ($this->session->flashdata('Success') != false) {
                                    echo '<div class="alert alert-success">';
                                    echo '<button data-dismiss="alert" class="close" type="button">×</button>';
                                    echo '<p>' . $this->session->flashdata('Success') . '</p>';
                                    echo '</div>';
                                } elseif ($this->session->flashdata('Error') != false) {
                                    echo '<div class="alert alert-danger">';
                                    echo '<button data-dismiss="alert" class="close" type="button">×</button>';
                                    echo '<p>' . $this->session->flashdata('Error') . '</p>';
                                    echo '</div>';
                                } elseif ($this->session->flashdata('Warning') != false) {
                                    echo '<div class="alert alert-warning">';
                                    echo '<button data-dismiss="alert" class="close" type="button">×</button>';
                                    echo '<p>' . $this->session->flashdata('Warning') . '</p>';
                                    echo '</div>';
                                }
                                ?>
                            </div>

                        </div>
                        