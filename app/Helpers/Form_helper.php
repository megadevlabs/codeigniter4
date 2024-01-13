<?php
function validation_error($validation, $field)
{
  if (isset($validation)) {
    if ($validation->hasError($field)) {
      return $validation->getError($field);
    } else {
      return false;
    }
  }
}
