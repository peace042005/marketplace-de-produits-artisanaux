<!doctype html>
<html class="modern fixed has-top-menu has-left-sidebar-half">
	<head>

		<!-- Basic -->
		<meta charset="UTF-8">

		<title>Dashboard | Porto Admin - Responsive HTML5 Template</title>

		<meta name="keywords" content="HTML5 Admin Template" />
		<meta name="description" content="Porto Admin - Responsive HTML5 Template">
		<meta name="author" content="okler.net">

		<!-- Mobile Metas -->
		<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />

		<!-- Web Fonts  -->
		<link href="https://fonts.googleapis.com/css?family=Poppins:100,300,400,600,700,800,900" rel="stylesheet" type="text/css">

		@include('layout.css-js')
		@yield('css')

	</head>
	<body>
		<section class="body">

			<!-- start: header -->
			<header class="header header-nav-menu header-nav-links">
				<div class="logo-container">
					<a href="" class="logo">
						{{-- <i class="fa-solid fa-store"> --}}
							<h6 style="font-size: 28px ;color: white">MARKET'ART</h6>
						{{-- </i> --}}


					</a>

					<!-- start: header nav menu -->
					<div class="header-nav collapse">
						<div class="header-nav-main header-nav-main-effect-1 header-nav-main-sub-effect-1 header-nav-main-square">
							<nav>
								<ul class="nav nav-pills" id="mainNav">
									<li class="">

									<div class="text-center" style=" color:#77b4e6; center; font-weight: bold; font-size: 24px;">
										BIENVENUE SUR VOTRE DASHBOARD

									</div>
									


									</li>

								</ul>
							</nav>
						</div>
					</div>
					<!-- end: header nav menu -->
				</div>

				<!-- start: search & user box -->
				<div class="header-right">

					<form action="pages-search-results.html" class="">

					</form>


				</div>
				<!-- end: search & user box -->
			</header>
			<!-- end: header -->

			<div class="inner-wrapper">
				<!-- start: sidebar -->
				<aside id="sidebar-left" class="sidebar-left">

				    <div class="sidebar-header">
                    <!-- Supprimer ou commenter cette section
				        <div class="sidebar-toggle d-none d-md-flex" data-toggle-class="sidebar-left-collapsed" data-target="html" data-fire-event="sidebar-left-toggle">
				            <i class="fas fa-bars" aria-label="Toggle sidebar"></i>
				        </div>
                    -->
				    </div>

				    <div class="nano">
				        <div class="nano-content">
				            <nav id="menu" class="nav-main" role="navigation">
								<ul class="nav nav-main">
									<li>
									   <a class="nav-link"  href="{{ route('artisan.profil.index') }}">
										   <i class="fa-solid fa-id-card" aria-hidden="true"></i>
										   <span>Profile</span>
									   </a>
								   </li>

								   <li>
									   <a class="nav-link"  href="{{ route('janvier.article.index') }}">
										   <i class="fa-solid fa-boxes-stacked" aria-hidden="true"></i>
										   <span>Inventaire</span>
									   </a>
								   </li>

								   <li>
									   <a class="nav-link"  href="{{ route('janvier.abonnement.index') }}">
										   <i class="fa-solid fa-file-contract" aria-hidden="true"></i>
										   <span>Abonnement</span>
									   </a>
								   </li>
								   <li>
									<a class="nav-link"  href="{{ route('janvier.commande') }}">
										<i class="fa-solid fa-file-contract" aria-hidden="true"></i>
										<span>Commandes</span>
									</a>
								</li>




							   </ul>
							</nav>

							<!-- Custom CSS for attraction and colors -->
							<style>
								/* Basic styles for nav and links */
								.nav-main {
									padding: 0;
									list-style: none;
									margin: 0;
								}

								.nav-main .nav-link {
									display: flex;
									align-items: center;
									padding: 12px 20px;
									font-size: 16px;
									font-weight: 500;
									color: #333;
									text-decoration: none;
									border-radius: 5px;
									transition: all 0.3s ease;
								}

								.nav-main .nav-link i {
									margin-right: 12px;
									font-size: 18px;
									color: #007bff; /* Color of icons */
									transition: color 0.3s ease;
								}

								.nav-main .nav-link span {
									color: #25d425;
								}

								/* Hover effect for the links */
								.nav-main .nav-link:hover {
									background-color: #007bff;
									color: white;
								}

								.nav-main .nav-link:hover i {
									color: #ffffff; /* Change icon color on hover */
								}

								/* Active state (for active menu item) */
								.nav-main .nav-link.active {
									background-color: #0056b3;
									color: white;
								}

								/* Add some spacing between links */
								.nav-main .nav-link + .nav-link {
									margin-top: 5px;
								}

								/* Optional: Subtle shadow effect on hover */
								.nav-main .nav-link:hover {
									box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
									transform: translateX(4px);
								}
							</style>


				            <hr class="separator" />



				        </div>


                        <!-- Déconnexion bouton -->
                        <div class="logout-button" style="position: absolute; bottom: 10px; width: 100%; text-align: center; margin-bottom: 20px;">
                            <form action="{{ route('logout') }}" method="POST">
                                @csrf
                                <button type="submit" class="btn btn-danger">
                                    <i class="fa fa-sign-out-alt" aria-hidden="true"></i> Déconnexion
                                </button>
                            </form>
                        </div>

				        <script>
				            // Maintain Scroll Position
				            if (typeof localStorage !== 'undefined') {
				                if (localStorage.getItem('sidebar-left-position') !== null) {
				                    var initialPosition = localStorage.getItem('sidebar-left-position'),
				                        sidebarLeft = document.querySelector('#sidebar-left .nano-content');

				                    sidebarLeft.scrollTop = initialPosition;
				                }
				            }
				        </script>

				    </div>

				</aside>
				<!-- end: sidebar -->

                @yield('content')
			</div>

		</section>
		@yield('js')
	</body>
</html>
