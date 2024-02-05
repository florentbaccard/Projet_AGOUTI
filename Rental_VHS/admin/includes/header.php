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

        <div class="right-div">
            <a href="logout.php" class="btn btn-danger pull-right">DÉCONNECTION</a>
        </div>
    </div>
</div>
<!-- Tableau de Bord -->
<section class="menu-section">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="navbar-collapse collapse">
                    <ul id="menu-top" class="nav navbar-nav navbar-right">
                        <li><a href="dashboard.php" class="menu-top-active">TABLEAU DE BORD</a></li>

                        <li>
                            <a href="#" class="dropdown-toggle" id="ddlmenuItem" data-toggle="dropdown">Catégories<i class="fa fa-angle-down"></i></a>
                            <ul class="dropdown-menu" role="menu" aria-labelledby="ddlmenuItem">
                                <li role="presentation"><a role="menuitem" tabindex="-1" href="add-category.php">Ajouter une Catégories</a></li>
                                <li role="presentation"><a role="menuitem" tabindex="-1" href="manage-categories.php">Gérer les Catégories</a></li>
                            </ul>
                        </li>
                        <li>
                            <a href="#" class="dropdown-toggle" id="ddlmenuItem" data-toggle="dropdown">Diffuseurs<i class="fa fa-angle-down"></i></a>
                            <ul class="dropdown-menu" role="menu" aria-labelledby="ddlmenuItem">
                                <li role="presentation"><a role="menuitem" tabindex="-1" href="add-diffuser.php">Ajouter un Diffuseur</a></li>
                                <li role="presentation"><a role="menuitem" tabindex="-1" href="manage-diffusers.php">Gérer les Diffuseurs</a></li>
                            </ul>
                        </li>
                        <li>
                            <a href="#" class="dropdown-toggle" id="ddlmenuItem" data-toggle="dropdown">VHS<i class="fa fa-angle-down"></i></a>
                            <ul class="dropdown-menu" role="menu" aria-labelledby="ddlmenuItem">
                                <li role="presentation"><a role="menuitem" tabindex="-1" href="add-vhs.php">Ajouter un VHS</a></li>
                                <li role="presentation"><a role="menuitem" tabindex="-1" href="manage-vhs.php">Gérer les VHS</a></li>
                            </ul>
                        </li>

                        <li>
                            <a href="#" class="dropdown-toggle" id="ddlmenuItem" data-toggle="dropdown">VHS Emprunté<i class="fa fa-angle-down"></i></a>
                            <ul class="dropdown-menu" role="menu" aria-labelledby="ddlmenuItem">
                                <li role="presentation"><a role="menuitem" tabindex="-1" href="issue-vhs.php">Ajouter un nouvel Emprunt</a></li>
                                <li role="presentation"><a role="menuitem" tabindex="-1" href="manage-issued-vhs.php">Gérer les VHS Emprunté</a></li>
                            </ul>
                        </li>
                        <li><a href="reg-renters.php">Loueurs Réguliers</a></li>

                        <li><a href="change-password.php">Changer le mot de passe</a></li>
                    </ul>
                </div>
            </div>

        </div>
    </div>
</section>

<!-- Header.php ADMIN -->