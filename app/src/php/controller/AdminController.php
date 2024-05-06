<?php

class AdminController {

  public static function getHome() {
    include dirname(__DIR__) . "/view/AdminHomeView.php";
  }
}