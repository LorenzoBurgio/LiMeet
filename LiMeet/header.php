<style>

      .bd-placeholder-img {
        font-size: 1.125rem;
        text-anchor: middle;
        -webkit-user-select: none;
        -moz-user-select: none;
        user-select: none;
      }

      @media (min-width: 768px) {
        .bd-placeholder-img-lg {
          font-size: 3.5rem;
        }
      }
    </style>



<div class="container">
  <header class="p-3 mb-3 border-bottom">
    <div class="container">
        <div class="d-flex flex-wrap align-items-center justify-content-center justify-content-lg-start">
            <a href="index.php" class="d-flex align-items-center mb-2 mb-lg-0 text-dark text-decoration-none">
            <img alt='Profile_name' width='80' height='80' src='pictures/Logo.png'>
            </a>
            <ul class="nav col-12 col-lg-auto me-lg-auto mb-2 justify-content-center mb-md-0">
            <li><a href="envoie.php"  class="nav-link px-2 link-dark">Chat</a></li>
            <li><a href="AdminPage.php" <?php if($user_data['Admin'] !== "1"){echo "hidden";} ?> class="nav-link px-2 link-dark">Admin Page</a></li>
            </ul>

            


            <a href="research.php" class="nav-link px-2 link-secondary">Search</a>
            <a href="logout.php" class="nav-link px-2 link-secondary">Logout</a>
            <a href="profile.php" class="nav-link px-2 link-secondary"><?php 


                        if ($user_data['Picture'] === null) {
                            print "<img alt='Profile_name' width='32' height='32' class='rounded-circle' src='https://st3.depositphotos.com/15648834/17930/v/600/depositphotos_179308454-stock-illustration-unknown-person-silhouette-glasses-profile.jpg'>";
                        }else{
                            $files = 'pictures/'.$user_data['Picture'];
                            print "<img alt='Profile_name' width='32' height='32' class='rounded-circle' src='".$files."'>";
                        }

                    ?></a>
        </div>
    </div>
  </header>

</div>