<style>
  .contact-phone-header {
      color: #fff;
      font-weight: 400 !important;
      font-size: 18px;
  }

  .hamburger-icon {
  font-size: 28px;
  cursor: pointer;
  padding: 10px;
  color: #f51486;
  display: inline-block;
}

.custom-nav-mobile {
    display: none;
    background: #fff;
    position: absolute;
    top: 67px;
    left: -200px;
    right: 0;
    z-index: 1000;
    min-width: 300px;
    max-width: 100vw;
    width: 100%;
    overflow-x: auto;
}


#hamburger-toggle:checked + .hamburger-icon + .custom-nav-mobile {
  display: block;
}

.nav-list {
  list-style: none;
  padding: 0;
  margin: 0;
}

.sbmenu {
  border-bottom: 1px solid #e3e3e3;
}

.menu-links {
  display: block;
  padding: 12px 16px;
  color: #f51486;
  text-decoration: none;
}

.menu-links:hover {
  background: #f51486;
}


</style>
<header class="header-pr nav-bg-b main-header navfix fixed-top menu-white">
  <div class="container-fluid m-pad">
    <div class="menu-header">
        <div class="dsk-logo"><a class="nav-brand" href="index.html">
          <img src="<?= $baseUrl; ?>/assets/images/logotipo-balbao-candy.png" alt="Logo" class="mega-white-logo"/>
          <img src="<?= $baseUrl; ?>/assets/images/logotipo-balbao-candy.png" alt="Logo" class="mega-darks-logo"/>
          </a>
        </div>

        <!-- Menu padrão para desktop (visível em md ou superior) -->
        <div class="custom-nav d-none d-md-block" role="navigation">
          <ul class="nav-list">
            <li class="sbmenu"><a href="<?= $baseUrl; ?>" class="menu-links">Home</a></li>
            <li class="sbmenu"><a href="<?= $baseUrl; ?>/quem-somos.html" class="menu-links">Quem Somos</a></li>
            <li class="sbmenu"><a href="<?= $baseUrl; ?>/produtos.html" class="menu-links">Produtos</a></li>
            <li class="sbmenu"><a href="<?= $baseUrl; ?>/videos.html" class="menu-links">Vídeos</a></li>
            <li class="sbmenu"><a href="<?= $baseUrl; ?>/contato.html" class="menu-links">Contato</a></li>
            <li class="sbmenu"><a href="tel:+551137225031" class="menu-links">055-11-3722-5031</a></li>
          </ul>
        </div>

        <!-- Menu hambúrguer para mobile (visível até md) -->
        <nav class="d-block d-md-none position-relative">
          <input type="checkbox" id="hamburger-toggle" class="d-none">
          <label for="hamburger-toggle" class="hamburger-icon">☰</label>

          <div class="custom-nav-mobile" role="navigation">
            <ul class="nav-list">
              <li class="sbmenu"><a href="<?= $baseUrl; ?>" class="menu-links">Home</a></li>
              <li class="sbmenu"><a href="<?= $baseUrl; ?>/quem-somos.html" class="menu-links">Quem Somos</a></li>
              <li class="sbmenu"><a href="<?= $baseUrl; ?>/produtos.html" class="menu-links">Produtos</a></li>
              <li class="sbmenu"><a href="<?= $baseUrl; ?>/videos.html" class="menu-links">Vídeos</a></li>
              <li class="sbmenu"><a href="<?= $baseUrl; ?>/contato.html" class="menu-links">Contato</a></li>
              <li class="sbmenu"><a href="tel:+551137225031" class="menu-links">055-11-3722-5031</a></li>
            </ul>
          </div>
        </nav>


  </div>

  <nav id="main-nav">
      <ul class="first-nav">
          <li class="sbmenu">
            <a href="<?= $baseUrl; ?>" class="menu-links">Home</a>
          </li>
          <li class="sbmenu">
            <a href="<?= $baseUrl; ?>/quem-somos.html" class="menu-links">Quem Somos</a>
          </li>
          <li class="sbmenu">
            <a href="<?= $baseUrl; ?>/produtos.html" class="menu-links">Produtos</a>
          </li>
          <li class="sbmenu">
            <a href="<?= $baseUrl; ?>/contato.html" class="menu-links">Contato</a>
          </li>
      </ul>
  </nav>

  </div>
</header>   