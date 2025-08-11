<?php
  ini_set('display_errors', 1);
  ini_set('display_startup_errors', 1);
  error_reporting(E_ALL);
  $protocol = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on') ? 'https://' : 'http://';
  $host = $_SERVER['HTTP_HOST'];
  $request_uri = $_SERVER['REQUEST_URI'];
  
  $current_url = $protocol . $host . $request_uri;  
  //echo $current_url;
  $pagename = $current_url;
  // Connect to the SQLite3 database
  $db = new SQLite3('visitor-counter.sqlite3');

  // Get the user's IP address
  $user_ip = $_SERVER['REMOTE_ADDR'];

  // Check if the IP already exists for this page
  $check_ip = $db->query("SELECT userip FROM pageview WHERE page='$pagename' AND userip='$user_ip'");
  if ($check_ip->fetchArray()) {
    // IP already exists, do nothing
  } else {
    // Insert the new page view
    $db->exec("INSERT INTO pageview VALUES (NULL, '$pagename', '$user_ip')");
  }
  // Update the total visit count
  $db->exec("UPDATE totalview SET totalvisit = totalvisit + 1 WHERE page='$pagename'");
?>
<body>
  <?php
    ini_set('display_errors', 1);
    ini_set('display_startup_errors', 1);
    error_reporting(E_ALL);
    // Fetch the total visit count
    $stmt = $db->query("SELECT totalvisit FROM totalview WHERE page='$pagename'");
    $row = $stmt->fetchArray();
    $totalvisit = $row ? $row['totalvisit'] : 0;
    
    $stmt = $db->query("SELECT COUNT(*) FROM pageview WHERE page='$pagename';");
    $row = $stmt->fetchArray();
    $visitors = $row ? $row[0] : 0;
    // Close the database connection
    $db->close();
  ?>
  <?php 
    if($pagename == "https://amjp.psy-k.org/JPLY/en.php") {
    ?>    
        <div style="display: inline;">Visitor count:</div><div style="border: 2px solid yellow; width: 100px; display: inline; color:yellow"> <?php echo $visitors; ?> </div><div style="display: inline;">.</div>
        <div style="display: inline;">This page has been clicked</div><div style="border: 2px solid yellow; width: 100px; display: inline; color:yellow"> <?php echo $totalvisit; ?> </div><div style="display: inline;"> times. Since August 7, 2025.</div>
    <?php
    } 
    if($pagename == "https://amjp.psy-k.org/JPLY/jp.php") {
    ?>    
        <div style="display: inline;">尋ね人:</div><div style="border: 2px solid yellow; width: 100px; display: inline; color:yellow"> <?php echo $visitors; ?> </div><div style="display: inline;">人。</div>
        <div style="display: inline;">クリック数</div><div style="border: 2px solid yellow; width: 100px; display: inline; color:yellow"> <?php echo $totalvisit; ?> </div><div style="display: inline;"> 回。２０２５年８月７日から。</div>
    <?php 
    }
    if($pagename == "https://amjp.psy-k.org/JPLY/es.php") {
    ?>    
        <div style="display: inline;">Visitantes:</div><div style="border: 2px solid yellow; width: 100px; display: inline; color:yellow"> <?php echo $visitors; ?> </div><div style="display: inline;"> personas.</div>
        <div style="display: inline;">Numero de clicks:</div><div style="border: 2px solid yellow; width: 100px; display: inline; color:yellow"> <?php echo $totalvisit; ?> </div><div style="display: inline;"> veces. Desde el 7 de Agosto del 2025.</div>
    <?php
    }
    ?>