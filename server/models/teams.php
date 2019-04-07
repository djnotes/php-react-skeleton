<?php

class Teams {
  private $db;

  public function __construct($db_connection) {
    $this->db = $db_connection;
  }

  public function getAll() {
    $query = "SELECT * FROM teams";
    $query_results = $this->db->query($query);

    $this->checkForQueryErrors($query, $query_results);

    $teams = array();

    while ($row = $query_results->fetch_assoc()) {
      array_push($teams, array("id" => $row["id"], "name" => $row["name"]));
    }

    return $teams;
  }

  public function getAllWithImages() {
    $query = "SELECT teams.id, teams.name, team_logos.url  FROM teams JOIN team_logos WHERE teams.id=team_logos.team_id";
    $query_results = $this->db->query($query);

    $this->checkForQueryErrors($query, $query_results);
    
    $teams_with_images = array();

    while ($row = $query_results->fetch_assoc()) {
      $id = $row["id"];
      $name = $row["name"];
      $url = $row["url"];

      if (!$teams_with_images[$id]) {
        $teams_with_images[$id] = array("name" => $name, "images" => array("0" => $url));
      }
      else {
        array_push($teams_with_images[$id]["images"], $url);
      }
    }
    
    return $teams_with_images;
  }

  public function getAllWithoutImages() {
    $query = "SELECT teams.name FROM teams WHERE teams.id NOT IN (SELECT team_logos.team_id FROM team_logos)";
    $query_results = $this->db->query($query);

    $this->checkForQueryErrors($query, $query_results);

    $teams_without_images = array();
    
    while ($row = $query_results->fetch_assoc()) {
      $name = $row["name"];
      array_push($teams_without_images, $name);
    }

    return $teams_without_images;
  }

  public function getNames() {
    $query = "SELECT teams.name FROM teams";
    $query_results = $this->db->query($query);

    $this->checkForQueryErrors($query, $query_results);

    $team_names = array();

    while ($row = $query_results->fetch_assoc()) {
      array_push($team_names, $row["name"]);
    }

    return $team_names;
  }

  private function checkForQueryErrors($query, $query_results) {
    if (!$query_results) {
      echo "Error executing query: " . $query . "\n";
      echo "Errno: " . $this->mysqli->errno . "\n";
      echo "Error: " . $this->mysqli->error . "\n";
      exit;
    }
  }
}

?>