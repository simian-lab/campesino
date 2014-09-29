<?php

    function display_errors($errors = NULL) {
        if (function_exists('validation_errors') && validation_errors() or count($errors) > 0) {
            if (count($errors) > 0 && $errors!='') {
                echo '<div class="message">';
                echo '<ul>';
                echo validation_errors('<li>', '</li>');
                foreach ($errors as $error) {
                    echo "<li>" . $error . "</li>";
                }
                echo '</ul>';
                echo '</div>';
            }
        }
    }

?>
