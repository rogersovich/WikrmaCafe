<!DOCTYPE html>

<html lang="en">

	<!-- begin::Head -->
	<head>
		<meta charset="utf-8" />
		<title>CMS | Login</title>
		<meta name="description" content="Latest updates and statistic charts">
		<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no">

		<!--begin::Web font -->
		<script src="{{ asset('assets/js/webfont.js') }}"></script>
		<script>
			WebFont.load({
            google: {"families":[
                "Poppins:300,400,500,600,700",
                "Roboto:300,400,500,600,700"
            ]},
            active: function() {
                sessionStorage.fonts = true;
            }
          });
        </script>

		<!--end::Web font -->

        <link rel="stylesheet" href="{{ asset('assets/css/style.css') }}">
        <link rel="stylesheet" href="{{ asset('/assets/metronic/vendors/base/vendors.bundle.css') }}">
        <link rel="stylesheet" href="{{ asset('/assets/metronic/demo/default/base/style.bundle.css') }}">
        <link rel="stylesheet" href="{{ asset('/assets/metronic/vendors/custom/fullcalendar/fullcalendar.bundle.css') }}">
        <link rel="stylesheet" href="{{ asset('/assets/metronic/demo/default/media/img/logo/favicon.ico') }}">
        <link rel="stylesheet" href="{{ asset('/assets/metronic/customize.css') }}">

        <link rel="icon" type="image/png" sizes="16x16" href="{{ asset('/assets/img/logo_compact.png') }}">

        <style>
            .m-aside-left--fixed .m-body {
                -webkit-transition: width 0.2s ease;
                transition: width 0.2s ease;
                padding-left: 0px;
            }

            .m-footer--push.m-aside-left--enabled:not(.m-footer--fixed) .m-footer {
                -webkit-transition: width 0.2s ease;
                transition: width 0.2s ease;
                margin-left: 0px;
                margin-top: -60px;
            }

        </style>

	</head>

	<!-- end::Head -->

	<!-- begin::Body -->
	<body class="m-page--fluid m--skin- m-content--skin-light2 m-header--fixed m-header--fixed-mobile m-aside-left--enabled m-aside-left--skin-dark m-aside-left--fixed m-aside-left--offcanvas m-footer--push m-aside--offcanvas-default">

        <!-- begin:: Page -->
		<div class="m-grid m-grid--hor m-grid--root m-page">

			<!-- BEGIN: Header -->
			<header id="m_header" class="m-grid__item    m-header " m-minimize-offset="200" m-minimize-mobile-offset="200">
				<div class="m-container m-container--fluid m-container--full-height">
					<div class="m-stack m-stack--ver m-stack--desktop">
						<div class="m-stack__item m-stack__item--fluid m-header-head" id="m_header_nav">

							<!-- BEGIN: Topbar -->
							<div id="m_header_topbar" class="m-topbar m-stack m-stack--ver m-stack--general m-stack--fluid">
								<div class="m-stack__item m-topbar__nav-wrapper">
									<ul class="m-topbar__nav m-nav m-nav--inline flex">

										<li id="avatar" class="m-nav__item m-topbar__user-profile m-topbar__user-profile--img  m-dropdown m-dropdown--medium m-dropdown--arrow m-dropdown--header-bg-fill m-dropdown--align-right m-dropdown--mobile-full-width m-dropdown--skin-light"
										 m-dropdown-toggle="click">
											<a href="#" class="m-nav__link m-dropdown__toggle">
												<span class="m-topbar__username">Administrator</span>
												<span class="m-topbar__userpic">
													<img src="{{ asset('assets/metronic/app/media/img/users/user4.jpg') }}" class="m--img-rounded m--marginless" alt="" />
												</span>

											</a>
											<div class="m-dropdown__wrapper">
												<span class="m-dropdown__arrow m-dropdown__arrow--right m-dropdown__arrow--adjust"></span>
												<div class="m-dropdown__inner">
													<div class="m-dropdown__header m--align-center" style="background: url({{ asset('assets/metronic/app/media/img/misc/user_profile_bg.jpg') }}); background-size: cover;">
														<div class="m-card-user m-card-user--skin-light">
															<div class="m-card-user__pic">
																<img src="{{ asset('assets/metronic/app/media/img/users/user4.jpg') }}" class="m--img-rounded m--marginless" alt="" />
															</div>
															<div class="m-card-user__details">
																<span class="m-card-user__name m--font-weight-500">Administrator</span>
																<a href="" class="m-card-user__email m-link">admin@4visionmedia.com</a>
															</div>
														</div>
													</div>
													<div class="m-dropdown__body">
														<div class="m-dropdown__content">
															<ul class="m-nav m-nav--skin-light">
																<li class="m-nav__section m--hide">
																	<span class="m-nav__section-text">Section</span>
																</li>
																<li class="m-nav__item">
																	<a href="#!" class="m-nav__link">
																		<i class="m-nav__link-icon la la-user"></i>
																		<span class="m-nav__link-text">My Profile</span>
																	</a>
																</li>
																<li class="m-nav__item">
																	<a href="#!" class="m-nav__link">
																		<i class="m-nav__link-icon la la-share-alt"></i>
																		<span class="m-nav__link-title">
																			<span class="m-nav__link-wrap">
																				<span class="m-nav__link-text">Activity</span>
																				<span class="m-nav__link-badge"><span class="m-badge m-badge--success">2</span></span>
																			</span>
																		</span>
																	</a>
																</li>
																<li class="m-nav__item">
																	<a href="#!" class="m-nav__link">
																		<i class="m-nav__link-icon la la-comments"></i>
																		<span class="m-nav__link-text">Messages</span>
																	</a>
																</li>
																<li class="m-nav__separator m-nav__separator--fit">
																</li>
																<li class="m-nav__item">
																	<a href="#!" class="m-nav__link">
																		<i class="m-nav__link-icon la la-question-circle"></i>
																		<span class="m-nav__link-text">FAQ</span>
																	</a>
																</li>
																<li class="m-nav__item">
																	<a href="#!" class="m-nav__link">
																		<i class="m-nav__link-icon la la-life-bouy"></i>
																		<span class="m-nav__link-text">Support</span>
																	</a>
																</li>
																<li class="m-nav__separator m-nav__separator--fit">
																</li>
																<li class="m-nav__item">
																	<a href="#!" class="m-nav__link">
																		<i class="m-nav__link-icon la la-sign-out"></i>
																		<span class="m-nav__link-text">Logout</span>
																	</a>
																</li>
															</ul>
														</div>
													</div>
												</div>
											</div>
										</li>
									</ul>
								</div>
							</div>

							<!-- END: Topbar -->
						</div>
					</div>
				</div>
			</header>

			<!-- END: Header -->

			<!-- begin::Body -->
			<div class="m-grid__item m-grid__item--fluid m-grid m-grid--ver-desktop m-grid--desktop m-body">

				<div class="m-grid__item m-grid__item--fluid m-wrapper">

					<div class="m-content">

						<!--Begin::Section-->

						<div class="row">
							<div class="col-xl-12">
								<div class="m-portlet m-portlet--head-lg">
									<div class="m-portlet__head">
										<div class="m-portlet__head-caption">
											<div class="m-portlet__head-title">
												<a href="{{ route('welcome') }}" class="m-portlet__head-icon">
													<i class="la la-arrow-left"></i>
                                                </a>
												<h3 class="m-portlet__head-text">
													Register
												</h3>
											</div>
										</div>
									</div>

									<!--begin::Form-->
                                    <form class="m-form m-form--state m-form--label-align-left" method="POST" action="{{ route('register') }}>
                                        @csrf
										<div class="m-portlet__body">

											<div class="row">
												<div class="col-xl-12">
													<div class="m-form__section">
														<div class="form-group m-form__group row">

															<div class="col-lg-6 m-form__group-sub">
																<label class="form-control-label">Name</label>
																<input type="text" class="form-control m-input" placeholder="Enter text">
																<div class="form-control-feedback">Sorry, that username's taken. Try another?</div>
																<span class="m-form__help">Please enter your name</span>
                                                            </div>
                                                            <div class="col-lg-6 m-form__group-sub">
																<label class="form-control-label">
                                                                    Email
                                                                </label>
																<input type="email" class="form-control m-input" placeholder="Enter text">
																<div class="form-control-feedback">Sorry, that username's taken. Try another?</div>
																<span class="m-form__help">Please enter your Email</span>
                                                            </div>

                                                        </div>
                                                        <div class="form-group m-form__group row">
                                                            <div class="col-lg-6 m-form__group-sub">
																<label class="form-control-label">
                                                                    Password
                                                                </label>
																<input type="password" class="form-control m-input" placeholder="Enter text">
																<div class="form-control-feedback">Sorry, that username's taken. Try another?</div>
																<span class="m-form__help">Please enter your password</span>
                                                            </div>
                                                            <div class="col-lg-6 m-form__group-sub">
																<label class="form-control-label">
                                                                    Role
                                                                </label>
																<div class="m-form__control">
																	<select class="form-control m-bootstrap-select m_selectpicker">
																		<option>All</option>
																		<option>Dual Language</option>
																		<option>Indonesia</option>
																		<option>English</option>
																	</select>
																</div>
															</div>
                                                        </div>

													</div>
												</div>
											</div>
										</div>
										<div class="m-portlet__foot m-portlet__foot--fit">
											<div class="m-form__actions m-form__actions--solid">
												<div class="row">
													<div class="col-xl-12 m--align-right">
														<button type="submit" class="btn btn-danger btn-sm m-btn--pill m-btn--air m-btn--wide">Submit</button>

													</div>
												</div>
											</div>
										</div>
									</form>

									<!--end::Form-->
								</div>

								<!--End::Portlet-->
							</div>
						</div>

						<!--End::Section-->


					</div>
				</div>
			</div>

			<!-- end:: Body -->
		</div>

		<!-- end:: Page -->


		<!-- begin::Scroll Top -->
		<div id="m_scroll_top" class="m-scroll-top">
			<i class="la la-arrow-up"></i>
		</div>

        <script src="{{ asset('/assets/js/jquery-3.4.1.min.js') }}"></script>
        <script src="{{ asset('assets/metronic/vendors/base/vendors.bundle.js') }}"></script>
        <script src="{{ asset('assets/metronic/demo/default/base/scripts.bundle.js') }}"></script>
        <script src="{{ asset('assets/metronic/customize.js')}}"></script>
        <script src="{{ asset('assets/metronic/demo/default/custom/crud/forms/widgets/autosize.js')}}"></script>
        <script src="{{ asset('assets/metronic/demo/default/custom/crud/forms/widgets/select2.js')}}"></script>
        <script src="{{ asset('assets/metronic/demo/default/custom/crud/forms/widgets/summernote.js')}}"></script>
        <script src="{{ asset('assets/metronic/demo/default/custom/crud/forms/widgets/bootstrap-select.js')}}"></script>
        <script src="{{ asset('assets/metronic/demo/default/custom/crud/forms/widgets/bootstrap-datetimepicker.js')}}"></script>
        <script src="{{ asset('assets/metronic/demo/default/custom/crud/forms/widgets/bootstrap-datepicker.js')}}"></script>
        <script src="{{ asset('assets/metronic/demo/default/custom/crud/forms/widgets/bootstrap-daterangepicker.js')}}"></script>
        <script src="{{ asset('assets/metronic/demo/default/custom/components/base/sweetalert2.js')}}"></script>

	</body>

	<!-- end::Body -->
</html>
