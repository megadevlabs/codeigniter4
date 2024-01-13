<?php
function strRandom()
{
  return substr(str_shuffle('abcdefghijklmnopqrstuvwxyz'), 7, 7);
}
