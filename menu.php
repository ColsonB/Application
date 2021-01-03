<header class="header">
    <a class="titre" href="">
        <img class="logo" src="src/img/croix-rouge.png" width="25" height="25">
        <p class="inventaire">Inventaire</p>
    </a>
    <!--<button class="navbar-toggler" type="button" data-toggle="collapse">
        <span class="navbar-toggler-icon">
    </button>-->
    <nav class="navbar-collapse">
        <ul class="navbar-gauche">
            <li>
                <a href="pharmacie.php">Pharmacie</a>
            </li>
            <li>
                <a href="main_courante.php">Main Courante</a>
            </li>
        </ul>
        <ul class="navbar-droite">
            <div class="dropdown">
                <button onclick="aidFunction()" class="dropdown-aid-menu">
                    <i class="far fa-question-circle"></i>
                    Aide
                    <i class="fas fa-caret-down"></i>
                </button>
                <div id="dropdown-aid" class="dropdown-aid">
                    <a href="#">
                        <i class="fas fa-envelope"></i>
                        Contacter le support
                    </a>
                    <a href="#">
                        <i class="fas fa-external-link-alt"></i>
                        Guide Utilisateur
                    </a>
                </div>
            </div>
            <div class="dropdown">
                <button onclick="profilFunction()" class="dropdown-profil-menu">
                    <i class="fas fa-user"></i>
                    Clément Cauet
                    <i class="fas fa-caret-down"></i>
                </button>
                <div id="dropdown-profil" class="dropdown-profil">
                    <a href="deconnexion.php">
                        <i class="fas fa-sign-out-alt"></i>
                        Déconnexion
                    </a>
                </div>
            </div>
        </ul>
    </nav>
</header>