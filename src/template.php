<?php

function writeTag($tag, $content) {
    printf('<%s>%s</%s>', $tag, $content, $tag);
}

function writeLine() {
    echo '<br/>';
}

?>
