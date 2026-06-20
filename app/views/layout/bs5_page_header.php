<!doctype html>
<html lang="en" class="h-100" data-bs-theme="auto">
  <head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <meta name="description" content="" />
    <title><?= $appName ?></title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet"/>
    <link rel="stylesheet" type="text/css" href="<?= $appRoot ?>/css/style.css"/>
</head>
  <body class="d-flex flex-column h-100">
    <svg xmlns="http://www.w3.org/2000/svg" class="d-none">
      <symbol id="check2" viewBox="0 0 16 16">
        <path
          d="M13.854 3.646a.5.5 0 0 1 0 .708l-7 7a.5.5 0 0 1-.708 0l-3.5-3.5a.5.5 0 1 1 .708-.708L6.5 10.293l6.646-6.647a.5.5 0 0 1 .708 0z"
        ></path>
      </symbol>
      <symbol id="house-door-fill" viewBox="0 0 16 16">
      <path 
        d="M6.5 14.5v-3.505c0-.245.25-.495.5-.495h2c.25 0 .5.25.5.5v3.5a.5.5 0 0 0 .5.5h4a.5.5 0 0 0 .5-.5v-7a.5.5 0 0 0-.146-.354L13 5.793V2.5a.5.5 0 0 0-.5-.5h-1a.5.5 0 0 0-.5.5v1.293L8.354 1.146a.5.5 0 0 0-.708 0l-6 6A.5.5 0 0 0 1.5 7.5v7a.5.5 0 0 0 .5.5h4a.5.5 0 0 0 .5-.5"
        ></path>
      </symbol> 
    </svg>
<nav
        class="navbar navbar-expand-sm navbar-dark bg-dark"
        aria-label="Third navbar example"
      >
        <div class="container-fluid">
          <a class="navbar-brand" href="<?= $appRoot ?>"><?= $appName ?> - <?= $userName ?></a>
          <button
            class="navbar-toggler"
            type="button"
            data-bs-toggle="collapse"
            data-bs-target="#navbarsExample03"
            aria-controls="navbarsExample03"
            aria-expanded="false"
            aria-label="Toggle navigation"
          >
            <span class="navbar-toggler-icon"></span>
          </button>

          <div class="collapse navbar-collapse">
            <ul class="navbar-nav me-auto mb-2 mb-sm-0">
              <li class="nav-item">
                <a class="nav-link" href="<?= $appRoot ?>">
                <svg class="bi bi-house-door-fill" width="24" height="24" fill="currentColor"  aria-hidden="true">
                <use href="#house-door-fill"></use>
                </svg> 
                </a>
              </li>
              <li class="nav-item"><a class="nav-link" href="#">Link</a></li>
              <li class="nav-item">
                <a class="nav-link disabled" aria-disabled="true">Disabled</a>
              </li>
              <li class="nav-item dropdown">
                <a
                  class="nav-link dropdown-toggle"
                  href="#"
                  data-bs-toggle="dropdown"
                  aria-expanded="false"
                  >学生メニュー</a
                >
                <ul class="dropdown-menu">
                <?php foreach($appMenu as $_label => $_action) { ?> 
                    <li>
                        <a class="dropdown-item" href="<?= $appRoot . $_action ?>"><?= $_label ?></a>
                    </li>    
                <?php } ?>
                </ul>
              </li>
            </ul>
           <form class="d-flex" role="search">
              <input
                class="form-control me-2"
                type="search"
                placeholder="Search"
                aria-label="Search"
              />
              <button class="btn btn-outline-primary" type="submit">
                Search
              </button>
            </form>
          </div>
        </div>
      </nav>
    <!-- Begin page content -->
    <main>
    <div class="container">   