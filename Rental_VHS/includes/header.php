<div class="navbar navbar-inverse set-radius-zero">
    <div class="container">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle pull-left" data-toggle="collapse" data-target=".navbar-collapse">
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a href="dashboard.php" class="navbar-brand hidden-xs">
                <img src="assets/img/logo.gif" />
            </a>
        </div>
        <?php if (isset($_SESSION['login']) && $_SESSION['login']) { ?>
            <div class="right-div">
                <a href="logout.php" class="btn btn-danger pull-right">DÉCONNEXION</a>
            </div>
        <?php } ?>
    </div>
</div>
<!-- Tableau de bord -->
<?php if (isset($_SESSION['login']) && $_SESSION['login']) { ?>
    <section class="menu-section">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="navbar-collapse collapse">
                        <ul id="menu-top" class="nav navbar-nav navbar-right">
                            <li><a href="dashboard.php" class="menu-top-active">TABLEAU DE BORD</a></li>


                            <li>
                                <a href="#" class="dropdown-toggle" id="ddlmenuItem" data-toggle="dropdown">Compte<i class="fa fa-angle-down"></i></a>
                                <ul class="dropdown-menu" role="menu" aria-labelledby="ddlmenuItem">
                                    <li role="presentation"><a role="menuitem" tabindex="-1" href="my-profile.php">Mon profil</a></li>
                                    <li role="presentation"><a role="menuitem" tabindex="-1" href="change-password.php">Changer le mot de passe</a></li>
                                </ul>
                            </li>
                            <li><a href="issued-vhs.php">VHS Emprunté(s)</a></li>


                        </ul>
                    </div>
                </div>

            </div>
        </div>
    </section>
<?php } else { ?>
    <section class="menu-section">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="navbar-collapse collapse">
                        <ul id="menu-top" class="nav navbar-nav navbar-right">

                            <li><a href="adminlogin.php">Connexion Admin</a></li>
                            <li><a href="signup.php">S'inscrire</a></li>
                            <li><a href="index.php">Connexion Utilisateur</a></li>


                        </ul>
                    </div>
                </div>

            </div>
        </div>
    </section>

<?php } ?>

<!-- Header.php -->