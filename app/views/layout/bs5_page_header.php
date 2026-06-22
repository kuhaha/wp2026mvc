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
      <symbol id="people-fill" viewBox="0 0 16 16">
        <path
          <path d="M7 14s-1 0-1-1 1-4 5-4 5 3 5 4-1 1-1 1zm4-6a3 3 0 1 0 0-6 3 3 0 0 0 0 6m-5.784 6A2.24 2.24 0 0 1 5 13c0-1.355.68-2.75 1.936-3.72A6.3 6.3 0 0 0 5 9c-4 0-5 3-5 4s1 1 1 1zM4.5 8a2.5 2.5 0 1 0 0-5 2.5 2.5 0 0 0 0 5"/>
        ></path>
      </symbol>
      <symbol id="house-door-fill" viewBox="0 0 16 16">
      <path 
        d="M6.5 14.5v-3.505c0-.245.25-.495.5-.495h2c.25 0 .5.25.5.5v3.5a.5.5 0 0 0 .5.5h4a.5.5 0 0 0 .5-.5v-7a.5.5 0 0 0-.146-.354L13 5.793V2.5a.5.5 0 0 0-.5-.5h-1a.5.5 0 0 0-.5.5v1.293L8.354 1.146a.5.5 0 0 0-.708 0l-6 6A.5.5 0 0 0 1.5 7.5v7a.5.5 0 0 0 .5.5h4a.5.5 0 0 0 .5-.5"
        ></path>
      </symbol> 
      <symbol id="person-fill-lock" viewBox="0 0 16 16">
      <path 
        d="M11 5a3 3 0 1 1-6 0 3 3 0 0 1 6 0m-9 8c0 1 1 1 1 1h5v-1a2 2 0 0 1 .01-.2 4.49 4.49 0 0 1 1.534-3.693Q8.844 9.002 8 9c-5 0-6 3-6 4m7 0a1 1 0 0 1 1-1v-1a2 2 0 1 1 4 0v1a1 1 0 0 1 1 1v2a1 1 0 0 1-1 1h-4a1 1 0 0 1-1-1zm3-3a1 1 0 0 0-1 1v1h2v-1a1 1 0 0 0-1-1"
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

          <div class="containter"> 
          <div class="collapse navbar-collapse">
            <ul class="navbar-nav me-auto mb-2 mb-sm-0">
              <li class="nav-item">
                <a class="nav-link" href="<?= $appRoot ?>">
                <svg class="bi bi-house-door-fill" width="24" height="24" fill="currentColor"  aria-hidden="true">
                <use href="#house-door-fill"></use>
                </svg>ホーム 
                </a>
              </li>
            <!--共通メニュー-->        
            <?php foreach ($appMenu['public']??[] as $_label=>$_action) { ?>
              <li class="nav-item">
              <a class="nav-link" href="<?= $appRoot . $_action ?>">
              <?= $_label ?>
              </a></li>
            <?php } ?>
          <!--プルダウン・メニュー（権限別）-->
            <?php if ($appMenu['dropdown']) { ?>
              <li class="nav-item dropdown">
                <a
                  class="nav-link dropdown-toggle"
                  href="#"
                  data-bs-toggle="dropdown"
                  aria-expanded="false"
                  ><?= $appMenu['dropdown']['name']??'' ?>メニュー</a
                >
                <ul class="dropdown-menu">
                <?php foreach($appMenu['dropdown']['items']??[] as $_label => $_action) { ?> 
                    <li>
                        <a class="dropdown-item" href="<?= $appRoot . $_action ?>"><?= $_label ?></a>
                    </li>    
                <?php } ?>
                </ul>
              </li>
            <?php } ?>
            <!--ログイン・ログアウト-->
            <?php foreach ($appMenu['login']??[] as $_label=>$_action) { ?>
              <li class="nav-item">  
                <a class="nav-link" href="<?= $appRoot . $_action ?>">
                <?= $_label ?>  
                </a>
              </li>
            <?php } ?> 
            </ul>
           <!-- 
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
          -->
          </div>
          </div>
        </div>
      </nav>
    <!-- Begin page content -->
    <main>
    <div class="container">   
