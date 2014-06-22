 <?php if (isset($login))
{
  echo '<div class="col-sm-3 col-md-2 sidebar hidden-xs " style="position:relative;top:5em;position: fixed;">
          <ul class="nav nav-pills nav-stacked">';


      echo form_open(base_url()."annuaire/search")."<div class='input-group' style='margin-bottom:1em;'>
      <input type='text' name='search' class='form-control' style='width:100%;' placeholder='Ldap Book'>
      <span class='input-group-btn' >
        <button class='btn btn-success' type='submit' style='position:relative;'><span class='glyphicon glyphicon-search' ></span></button>
      </span>
    </div>".form_close();

              echo "<li ";
              if ( strstr($_SERVER['PHP_SELF'], "profil") )
              {
                echo "class='active'";
              }
                echo '><a href="';
                echo base_url()."user/profil";
                echo '"><span class="glyphicon glyphicon-user" style="color:white;position:relative;right:0.2em;"></span>&nbsp;Profile</a></li>';

                if (isset($root))
                {
                    echo "<li ";
                    if ( strstr($_SERVER['PHP_SELF'], "root_class") )
                    {
                      echo "class='active'";
                    }
                      echo '><a href="';
                      echo base_url()."root_class";
                      echo '"><span class="glyphicon glyphicon-cog" style="color:white;position:relative;right:0.2em;"></span>&nbsp;Settings</a><li/>';
                }

              echo "<li ";
              if ( strstr($_SERVER['PHP_SELF'], "module") || strstr($_SERVER['PHP_SELF'], "activity"))
              {
                echo "class='active'";
              }
                echo '><a href="';
                echo base_url()."module";
                echo '"><span class="glyphicon glyphicon-book" style="color:white;position:relative;right:0.2em;"></span>&nbsp;Modules</a><li/>';

            if ( strstr($_SERVER['PHP_SELF'], "activity") )
            {
                  echo "<li class='active' style='color:white;position:relative;width:90%;left:10%'>";
                  echo '<a href="';
                  if (isset($activity_name))
                    $name = $activity_name;
                  else
                    $name = "Titre_Module";
                  echo base_url()."activity/index/".str_replace(' ', '_',$activity_name);
                  echo '" style="color:white;"><span class="glyphicon glyphicon-download" style="color:white;position:relative;right:0.2em;"></span>&nbsp;'.str_replace('_', ' ', $name).'</a><li/>';
            }

              echo "<li ";
              if ( strstr($_SERVER['PHP_SELF'], "peer_correcting") )
              {
                echo "class='active'";
              }
                echo '><a href="';
                echo base_url()."peer_correcting";
                echo '"><span class="glyphicon glyphicon-stats" style="color:white;position:relative;right:0.2em;"></span>&nbsp;Peer and rating</a></li>';


              echo "<li ";
              if ( strstr($_SERVER['PHP_SELF'], "planning") )
              {
                  echo "class='active'";
              }
                echo '><a href="';
                echo base_url()."planning";
                echo '"><span class="glyphicon glyphicon-calendar" style="color:white;position:relative;right:0.2em;"></span>&nbsp;planning</a><li/>';

                          echo "<li ";
              if ( strstr($_SERVER['PHP_SELF'], "e_learning") )
              {
                  echo "class='active'";
              }
                echo '><a href="';
                echo base_url()."e_learning";
                echo '"><span class="glyphicon glyphicon-eye-open" style="color:white;position:relative;right:0.2em;"></span>&nbsp;e-learning</a><li/>';

              echo "<li ";
              if ( strstr($_SERVER['PHP_SELF'], "ticket") )
              {
                  echo "class='active'";
              }
                echo '><a href="';
                echo base_url()."ticket";
                echo '"><span class="glyphicon glyphicon-envelope" style="color:white;position:relative;right:0.2em;"></span>&nbsp;Tickets</a><li/>';

              echo "<li ";
              if ( strstr($_SERVER['PHP_SELF'], "forum") )
              {
                echo "class='active'";
              }
              echo '><a href="';
              echo base_url()."forum";
              echo '"><span class="glyphicon glyphicon-comment" style="color:white;position:relative;right:0.2em;"></span>&nbsp;Forum</a></li>
            </ul>';
        echo "</div>";
}
else
{
echo '
<div class="col-sm-3 col-md-2 sidebar hidden-xs" style="position:relative;top:5em;">
          <ul class="nav nav-pills nav-stacked">
            <li><a href="';
            echo base_url()."user";
            echo '">Register</a></li>';


              echo "<li ";
              if ( strstr($_SERVER['PHP_SELF'], "contact") )
              {
                  echo "class='active'";
              }
                echo '><a href="';
                echo base_url()."contact_class";
                echo '">Contact</a><li/>';

            echo '<li ';



          if ( strstr($_SERVER['PHP_SELF'], "forum") )
          {
            echo "class='active'";
          }
            echo '><a href="';
            echo base_url()."forum\"";
            echo '>Forum</a>
            </li>
          </ul>
</div>
';
}
?>
