<?php
echo 'Hi';
if (!empty($site_info)) {
    echo strip_slashes($site_info->S_INFO_DESC);
}
?>