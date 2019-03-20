<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <title><?= NOMBRE_SITIO;?></title>
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link rel="stylesheet" href="<?= RUTA_URL;?>/font/iconsmind/style.css" />
    <link rel="stylesheet" href="<?= RUTA_URL;?>/font/simple-line-icons/css/simple-line-icons.css" />
    <link rel="stylesheet" href="<?= RUTA_URL;?>/css/vendor/bootstrap.min.css" />
    <link rel="stylesheet" href="<?= RUTA_URL;?>/css/vendor/fullcalendar.min.css" />
    <link rel="stylesheet" href="<?= RUTA_URL;?>/css/vendor/dataTables.bootstrap4.min.css" />
    <link rel="stylesheet" href="<?= RUTA_URL;?>/css/vendor/datatables.responsive.bootstrap4.min.css" />
    <link rel="stylesheet" href="<?= RUTA_URL;?>/css/vendor/select2.min.css" />
    <link rel="stylesheet" href="<?= RUTA_URL;?>/css/vendor/perfect-scrollbar.css" />
    <link rel="stylesheet" href="<?= RUTA_URL;?>/css/vendor/owl.carousel.min.css" />
    <link rel="stylesheet" href="<?= RUTA_URL;?>/css/vendor/bootstrap-stars.css" />
    <link rel="stylesheet" href="<?= RUTA_URL;?>/css/vendor/nouislider.min.css" />
    <link rel="stylesheet" href="<?= RUTA_URL;?>/css/vendor/bootstrap-datepicker3.min.css" />
    <link rel="stylesheet" href="<?= RUTA_URL;?>/css/main.css" />
</head>

<body id="app-container" class="menu-default show-spinner">
    <nav class="navbar fixed-top">
        <div class="d-flex align-items-center navbar-left">
            <a href="#" class="menu-button d-none d-md-block">
                <svg class="main" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 9 17">
                    <rect x="0.48" y="0.5" width="7" height="1" />
                    <rect x="0.48" y="7.5" width="7" height="1" />
                    <rect x="0.48" y="15.5" width="7" height="1" />
                </svg>
                <svg class="sub" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 18 17">
                    <rect x="1.56" y="0.5" width="16" height="1" />
                    <rect x="1.56" y="7.5" width="16" height="1" />
                    <rect x="1.56" y="15.5" width="16" height="1" />
                </svg>
            </a>

            <a href="#" class="menu-button-mobile d-xs-block d-sm-block d-md-none">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 26 17">
                    <rect x="0.5" y="0.5" width="25" height="1" />
                    <rect x="0.5" y="7.5" width="25" height="1" />
                    <rect x="0.5" y="15.5" width="25" height="1" />
                </svg>
            </a>

            <div class="search" data-search-path="Layouts.Search.html?q=">
                <input placeholder="Search...">
                <span class="search-icon">
                    <i class="simple-icon-magnifier"></i>
                </span>
            </div>
        </div>


        <a class="navbar-logo" href="Dashboard.Default.html">
            <span class="logo d-none d-xs-block"></span>
            <span class="logo-mobile d-block d-xs-none"></span>
        </a>

        <div class="navbar-right">
            <div class="header-icons d-inline-block align-middle">
                <a class="btn btn-sm btn-outline-primary mr-2 d-none d-md-inline-block mb-2" href="https://1.envato.market/5kAb">&nbsp;BUY&nbsp;</a>

                <div class="position-relative d-none d-sm-inline-block">
                    <button class="header-icon btn btn-empty" type="button" id="iconMenuButton" data-toggle="dropdown"
                        aria-haspopup="true" aria-expanded="false">
                        <i class="simple-icon-grid"></i>
                    </button>
                    <div class="dropdown-menu dropdown-menu-right mt-3  position-absolute" id="iconMenuDropdown">
                        <a href="#" class="icon-menu-item">
                            <i class="iconsmind-Equalizer d-block"></i>
                            <span>Settings</span>
                        </a>

                        <a href="#" class="icon-menu-item">
                            <i class="iconsmind-MaleFemale d-block"></i>
                            <span>Users</span>
                        </a>

                        <a href="#" class="icon-menu-item">
                            <i class="iconsmind-Puzzle d-block"></i>
                            <span>Components</span>
                        </a>

                        <a href="#" class="icon-menu-item">
                            <i class="iconsmind-Bar-Chart d-block"></i>
                            <span>Profits</span>
                        </a>

                        <a href="#" class="icon-menu-item">
                            <i class="iconsmind-File-Chart d-block"></i>
                            <span>Surveys</span>
                        </a>

                        <a href="#" class="icon-menu-item">
                            <i class="iconsmind-Suitcase d-block"></i>
                            <span>Tasks</span>
                        </a>

                    </div>
                </div>

                <div class="position-relative d-inline-block">
                    <button class="header-icon btn btn-empty" type="button" id="notificationButton" data-toggle="dropdown"
                        aria-haspopup="true" aria-expanded="false">
                        <i class="simple-icon-bell"></i>
                        <span class="count">3</span>
                    </button>
                    <div class="dropdown-menu dropdown-menu-right mt-3 scroll position-absolute" id="notificationDropdown">

                        <div class="d-flex flex-row mb-3 pb-3 border-bottom">
                            <a href="#">
                                <img src="<?= RUTA_URL?>/img/profile-pic-l-2.jpg" alt="Notification Image" class="img-thumbnail list-thumbnail xsmall border-0 rounded-circle" />
                            </a>
                            <div class="pl-3 pr-2">
                                <a href="#">
                                    <p class="font-weight-medium mb-1">Joisse Kaycee just sent a new comment!</p>
                                    <p class="text-muted mb-0 text-small">09.04.2018 - 12:45</p>
                                </a>
                            </div>
                        </div>

                        <div class="d-flex flex-row mb-3 pb-3 border-bottom">
                            <a href="#">
                                <img src="<?= RUTA_URL?>/img/notification-thumb.jpg" alt="Notification Image" class="img-thumbnail list-thumbnail xsmall border-0 rounded-circle" />
                            </a>
                            <div class="pl-3 pr-2">
                                <a href="#">
                                    <p class="font-weight-medium mb-1">1 item is out of stock!</p>
                                    <p class="text-muted mb-0 text-small">09.04.2018 - 12:45</p>
                                </a>
                            </div>
                        </div>


                        <div class="d-flex flex-row mb-3 pb-3 border-bottom">
                            <a href="#">
                                <img src="<?= RUTA_URL?>/img/notification-thumb-2.jpg" alt="Notification Image" class="img-thumbnail list-thumbnail xsmall border-0 rounded-circle" />
                            </a>
                            <div class="pl-3 pr-2">
                                <a href="#">
                                    <p class="font-weight-medium mb-1">New order received! It is total $147,20.</p>
                                    <p class="text-muted mb-0 text-small">09.04.2018 - 12:45</p>
                                </a>
                            </div>
                        </div>

                        <div class="d-flex flex-row mb-3 pb-3 ">
                            <a href="#">
                                <img src="<?= RUTA_URL?>/img/notification-thumb-3.jpg" alt="Notification Image" class="img-thumbnail list-thumbnail xsmall border-0 rounded-circle" />
                            </a>
                            <div class="pl-3 pr-2">
                                <a href="#">
                                    <p class="font-weight-medium mb-1">3 items just added to wish list by a user!</p>
                                    <p class="text-muted mb-0 text-small">09.04.2018 - 12:45</p>
                                </a>
                            </div>
                        </div>

                    </div>
                </div>

                <button class="header-icon btn btn-empty d-none d-sm-inline-block" type="button" id="fullScreenButton">
                    <i class="simple-icon-size-fullscreen"></i>
                    <i class="simple-icon-size-actual"></i>
                </button>

            </div>

            <div class="user d-inline-block">
                <button class="btn btn-empty p-0" type="button" data-toggle="dropdown" aria-haspopup="true"
                    aria-expanded="false">
                    <span class="name">Sarah Kortney</span>
                    <span>
                        <img alt="Profile Picture" src="<?= RUTA_URL?>/img/profile-pic-l.jpg" />
                    </span>
                </button>

                <div class="dropdown-menu dropdown-menu-right mt-3">
                    <a class="dropdown-item" href="#">Account</a>
                    <a class="dropdown-item" href="#">Features</a>
                    <a class="dropdown-item" href="#">History</a>
                    <a class="dropdown-item" href="#">Support</a>
                    <a class="dropdown-item" href="#">Sign out</a>
                </div>
            </div>
        </div>
    </nav>
    <div class="sidebar">
        <div class="main-menu">
            <div class="scroll">
                <ul class="list-unstyled">
                    <li class="active">
                        <a href="#dashboard">
                            <i class="iconsmind-Shop-4"></i>
                            <span>Dashboards</span>
                        </a>
                    </li>
                    <li>
                        <a href="#layouts">
                            <i class="iconsmind-Digital-Drawing"></i> Layouts
                        </a>
                    </li>
                    <li>
                        <a href="#applications">
                            <i class="iconsmind-Air-Balloon"></i> Applications
                        </a>
                    </li>
                    <li>
                        <a href="#ui">
                            <i class="iconsmind-Pantone"></i> UI
                        </a>
                    </li>
                    <li>
                        <a href="#landingPage">
                            <i class="iconsmind-Space-Needle"></i> Landing Page
                        </a>
                    </li>
                    <li>
                        <a href="#menu">
                            <i class="iconsmind-Three-ArrowFork"></i> Menu
                        </a>
                    </li>
                </ul>
            </div>
        </div>

        <div class="sub-menu">
            <div class="scroll">
                <ul class="list-unstyled" data-link="dashboard">
                    <li class="active">
                        <a href="Dashboard.Default.html">
                            <i class="simple-icon-rocket"></i> Default
                        </a>
                    </li>
                    <li>
                        <a href="Dashboard.Analytics.html">
                            <i class="simple-icon-pie-chart"></i>Analytics
                        </a>
                    </li>
                    <li>
                        <a href="Dashboard.Ecommerce.html">
                            <i class="simple-icon-basket-loaded"></i> Ecommerce
                        </a>
                    </li>
                    <li>
                        <a href="Dashboard.Content.html">
                            <i class="simple-icon-doc"></i> Content
                        </a>
                    </li>
                </ul>

                <ul class="list-unstyled" data-link="layouts">
                    <li>
                        <a href="Layouts.List.html">
                            <i class="simple-icon-credit-card"></i> Data List
                        </a>
                    </li>
                    <li>
                        <a href="Layouts.Thumbs.html">
                            <i class="simple-icon-list"></i> Thumb List
                        </a>
                    </li>
                    <li>
                        <a href="Layouts.Images.html">
                            <i class="simple-icon-grid"></i> Image List
                        </a>
                    </li>
                    <li>
                        <a href="Layouts.Details.html">
                            <i class="simple-icon-book-open"></i> Details
                        </a>
                    </li>
                    <li>
                        <a href="Layouts.Search.html">
                            <i class="simple-icon-magnifier"></i> Search
                        </a>
                    </li>
                    <li>
                        <a href="Layouts.Login.html">
                            <i class="simple-icon-user-following"></i> Login
                        </a>
                    </li>
                    <li>
                        <a href="Layouts.Register.html">
                            <i class="simple-icon-user-follow"></i> Register
                        </a>
                    </li>
                    <li>
                        <a href="Layouts.ForgotPassword.html">
                            <i class="simple-icon-user-unfollow"></i> Forgot Password
                        </a>
                    </li>
                    <li>
                        <a href="Layouts.Error.html">
                            <i class="simple-icon-exclamation"></i> Error
                        </a>
                    </li>
                </ul>
                <ul class="list-unstyled" data-link="applications">
                    <li>
                        <a href="Apps.MediaLibrary.html">
                            <i class="simple-icon-picture"></i> Library <span class="badge badge-pill badge-outline-primary float-right mr-4">NEW</span>
                        </a>
                    </li>
                    <li>
                        <a href="Apps.Todo.List.html">
                            <i class="simple-icon-check"></i> Todo
                        </a>
                    </li>
                    <li>
                        <a href="Apps.Survey.List.html">
                            <i class="simple-icon-calculator"></i> Survey
                        </a>
                    </li>
                    <li>
                        <a href="Apps.Chat.html">
                            <i class="simple-icon-bubbles"></i> Chat
                        </a>
                    </li>
                </ul>
                <ul class="list-unstyled" data-link="ui">
                    <li>
                        <a href="Ui.Alerts.html">
                            <i class="simple-icon-bell"></i> Alerts
                        </a>
                    </li>
                    <li>
                        <a href="Ui.Badges.html">
                            <i class="simple-icon-badge"></i> Badges
                        </a>
                    </li>
                    <li>
                        <a href="Ui.Buttons.html">
                            <i class="simple-icon-control-play"></i> Buttons
                        </a>
                    </li>
                    <li>
                        <a href="Ui.Cards.html">
                            <i class="simple-icon-layers"></i> Cards
                        </a>
                    </li>

                    <li>
                        <a href="Ui.Carousel.html">
                            <i class="simple-icon-picture"></i> Carousel
                        </a>
                    </li>
                    <li>
                        <a href="Ui.Charts.html">
                            <i class="simple-icon-chart"></i> Charts
                        </a>
                    </li>
                    <li>
                        <a href="Ui.Collapse.html">
                            <i class="simple-icon-arrow-up"></i> Collapse
                        </a>
                    </li>
                    <li>
                        <a href="Ui.Dropdowns.html">
                            <i class="simple-icon-arrow-down"></i> Dropdowns
                        </a>
                    </li>
                    <li>
                        <a href="Ui.Editors.html">
                            <i class="simple-icon-book-open"></i> Editors
                        </a>
                    </li>
                    <li>
                        <a href="Ui.Forms.html">
                            <i class="simple-icon-check mi-forms"></i> Forms
                        </a>
                    </li>
                    <li>
                        <a href="Ui.FormComponents.html">
                            <i class="simple-icon-puzzle"></i> Form Components
                        </a>
                    </li>
                    <li>
                        <a href="Ui.Icons.html">
                            <i class="simple-icon-star"></i> Icons
                        </a>
                    </li>
                    <li>
                        <a href="Ui.InputGroups.html">
                            <i class="simple-icon-note"></i> Input Groups
                        </a>
                    </li>
                    <li>
                        <a href="Ui.Jumbotron.html">
                            <i class="simple-icon-screen-desktop"></i> Jumbotron
                        </a>
                    </li>
                    <li>
                        <a href="Ui.Modal.html">
                            <i class="simple-icon-docs"></i> Modal
                        </a>
                    </li>
                    <li>
                        <a href="Ui.Navigation.html">
                            <i class="simple-icon-cursor"></i> Navigation
                        </a>
                    </li>

                    <li>
                        <a href="Ui.PopoverandTooltip.html">
                            <i class="simple-icon-pin"></i> Popover & Tooltip
                        </a>
                    </li>
                    <li>
                        <a href="Ui.Sortable.html">
                            <i class="simple-icon-shuffle"></i> Sortable
                        </a>
                    </li>
                </ul>
                <ul class="list-unstyled" data-link="landingPage">
                    <li>
                        <a target="_blank" href="LandingPage.Home.html">
                            <i class="simple-icon-docs"></i> Multipage Home
                        </a>
                    </li>
                    <li>
                        <a target="_blank" href="LandingPage.Home.Single.html">
                            <i class="simple-icon-doc"></i> Singlepage Home
                        </a>
                    </li>
                    <li>
                        <a target="_blank" href="LandingPage.About.html">
                            <i class="simple-icon-info"></i> About
                        </a>
                    </li>
                    <li>
                        <a target="_blank" href="LandingPage.Auth.Login.html">
                            <i class="simple-icon-user-following"></i> Auth Login
                        </a>
                    </li>
                    <li>
                        <a target="_blank" href="LandingPage.Auth.Register.html">
                            <i class="simple-icon-user-follow"></i> Auth Register
                        </a>
                    </li>
                    <li>
                        <a target="_blank" href="LandingPage.Blog.html">
                            <i class="simple-icon-bubbles"></i> Blog
                        </a>
                    </li>
                    <li>
                        <a target="_blank" href="LandingPage.Blog.Video.html">
                            <i class="simple-icon-bubble"></i> Blog Detail
                        </a>
                    </li>
                    <li>
                        <a target="_blank" href="LandingPage.Careers.html">
                            <i class="simple-icon-people"></i> Careers
                        </a>
                    </li>
                    <li>
                        <a target="_blank" href="LandingPage.Confirmation.html">
                            <i class="simple-icon-check"></i> Confirmation
                        </a>
                    </li>
                    <li>
                        <a target="_blank" href="LandingPage.Contact.html">
                            <i class="simple-icon-phone"></i> Contact
                        </a>
                    </li>
                    <li>
                        <a target="_blank" href="LandingPage.Content.html">
                            <i class="simple-icon-book-open"></i> Content
                        </a>
                    </li>
                    <li>
                        <a target="_blank" href="LandingPage.Docs.html">
                            <i class="simple-icon-notebook"></i> Docs
                        </a>
                    </li>
                    <li>
                        <a target="_blank" href="LandingPage.Features.html">
                            <i class="simple-icon-chemistry"></i> Features
                        </a>
                    </li>
                    <li>
                        <a target="_blank" href="LandingPage.Prices.html">
                            <i class="simple-icon-wallet"></i> Prices
                        </a>
                    </li>
                    <li>
                        <a target="_blank" href="LandingPage.Videos.html">
                            <i class="simple-icon-film"></i> Videos
                        </a>
                    </li>
                </ul>

                <ul class="list-unstyled" data-link="menu">
                    <li>
                        <a href="Menu.Default.html">
                            <i class="simple-icon-control-pause"></i> Default
                        </a>
                    </li>
                    <li>
                        <a href="Menu.Subhidden.html">
                            <i class="simple-icon-arrow-left mi-subhidden"></i> Subhidden
                        </a>
                    </li>
                    <li>
                        <a href="Menu.Hidden.html">
                            <i class="simple-icon-control-start mi-hidden"></i> Hidden
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </div>

    <main>
        <div class="container-fluid">
 
 