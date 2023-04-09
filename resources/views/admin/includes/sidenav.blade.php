<!-- Sidebar -->
<div class="sidebar sidebar-style-2">			
			<div class="sidebar-wrapper scrollbar scrollbar-inner">
				<div class="sidebar-content">
					<div class="user">
						<div class="avatar-sm float-left mr-2">
							<img src="{{ url(Auth::user()->userProfile->image ?? 'assets/admin/img/logo.jpeg') }}" alt="..." class="avatar-img rounded-circle">
						</div>
						<div class="info">
							<a data-toggle="collapse" href="#collapseExample" aria-expanded="true">
							
								<span>
									{{ Auth::user()->first_name}}
									@if(Auth::user()->user_type == 'admin')
									<span class="user-level">Administrator</span>
									@endif
									<span class="caret"></span>
								</span>
							
							</a>
							<div class="clearfix"></div>

							<div class="collapse in" id="collapseExample">
								<ul class="nav">
									<li>
										<a href="{{route('admin-profile')}}">
											<span class="link-collapse">My Profile</span>
										</a>
									</li>
									<li>
										<a href="{{route('admin-profile-edit')}}">
											<span class="link-collapse">Edit Profile</span>
										</a>
									</li>
									
								</ul>
							</div>
						</div>
					</div>
					<ul class="nav nav-primary">
						
						<li class="nav-section">
							<span class="sidebar-mini-icon">
								<i class="fa fa-ellipsis-h"></i>
							</span>
							<h4 class="text-section">Menu</h4>
						</li>
						@if(Auth::user()->hasRole(['Admin','Product Manager']))
						<li class="nav-item">
							<a data-toggle="collapse" href="#base">
								<i class="fas fa-layer-group"></i>
								<p>Catalog</p>
								<span class="caret"></span>
							</a>
							<div class="collapse" id="base">
								<ul class="nav nav-collapse">
									<li>
										<a href="{{route('brands')}}">
											<span class="sub-item">Brands</span>
										</a>
									</li>
									<li>
										<a href="{{route('attribute-groups')}}">
											<span class="sub-item">Attribute Groups</span>
										</a>
									</li>
									<li>
									<a href="{{route('attributes')}}">
											<span class="sub-item">Attributes</span>
										</a>
									</li>
									<li>
										<a href="{{route('categories')}}">
											<span class="sub-item">Categories</span>
										</a>
									</li>
									<li>
										<a href="{{route('products')}}">
											<span class="sub-item">Products</span>
										</a>
									</li>
									
								</ul>
							</div>
						</li>
						@endif
						@if(Auth::user()->hasRole(['Admin']))
						<li class="nav-item">
							<a data-toggle="collapse" href="#banners">
								<i class="fas fa-ticket-alt"></i>
								<p>Banners</p>
								<span class="caret"></span>
							</a>
							<div class="collapse" id="banners">
								<ul class="nav nav-collapse">
									<li>
										<a href="{{route('banners')}}">
											<span class="sub-item">Banners</span>
										</a>
									</li>
									
								</ul>
							</div>
						</li>
						@endif
						@if(Auth::user()->hasRole(['Admin']))
						<li class="nav-item">
							<a data-toggle="collapse" href="#coupons">
								<i class="fas fa-box-open"></i>
								<p>Coupons</p>
								<span class="caret"></span>
							</a>
							<div class="collapse" id="coupons">
								<ul class="nav nav-collapse">
									<li>
										<a href="{{route('coupons')}}">
											<span class="sub-item">Coupons</span>
										</a>
									</li>
									<li>
										<a href="{{route('create-coupon')}}">
											<span class="sub-item">Create Coupon</span>
										</a>
									</li>
								</ul>
							</div>
						</li>
						@endif
						@if(Auth::user()->hasRole(['Admin']))
						<li class="nav-item">
							<a data-toggle="collapse" href="#pages">
								<i class="far fa-newspaper"></i>
								<p>Page Management</p>
								<span class="caret"></span>
							</a>
							<div class="collapse" id="pages">
								<ul class="nav nav-collapse">
									<li>
										<a href="{{route('pages')}}">
											<span class="sub-item">Page</span>
										</a>
									</li>
									<li>
										<a href="{{route('create-page')}}">
											<span class="sub-item">Create Page</span>
										</a>
									</li>
								</ul>
							</div>
						</li>
						@endif
						@if(Auth::user()->hasRole(['Admin']))
						 <li class="nav-item">
							<a data-toggle="collapse" href="#sidebarLayouts">
								<i class="fas fa-user"></i>
								<p>User Management</p>
								<span class="caret"></span>
							</a>
							<div class="collapse" id="sidebarLayouts">
								<ul class="nav nav-collapse">
									<!-- <li>
										<a href="{{route('roles')}}">
											<span class="sub-item">Roles</span>
										</a>
									</li> -->
									<!-- <li>
										<a href="{{route('permissions')}}">
											<span class="sub-item">Permissions</span>
										</a>
									</li> -->
									<li>
										<a href="{{route('admin-users')}}">
											<span class="sub-item">Admin Users</span>
										</a>
									</li>
									
								</ul>
							</div>
						</li>
						@endif
						@if(Auth::user()->hasRole(['Admin']))
						<li class="nav-item">
							<a data-toggle="collapse" href="#vendors">
								<i class="fas fa-user-friends"></i>
								<p>Vendor Management</p>
								<span class="caret"></span>
							</a>
							<div class="collapse" id="vendors">
								<ul class="nav nav-collapse">
									<li>
										<a href="{{route('vendors')}}">
											<span class="sub-item">Vendors</span>
										</a>
									</li>
									<li>
										<a href="{{route('create-vendor-user')}}">
											<span class="sub-item">Create Cendor</span>
										</a>
									</li>
								</ul>
							</div>
						</li>
						@endif
						@if(Auth::user()->hasRole(['Admin','Order Manager']))
						<li class="nav-item">
							<a data-toggle="collapse" href="#orders">
								<i class="fas fa-store"></i>
								<p>Order Management</p>
								<span class="caret"></span>
							</a>
							<div class="collapse" id="orders">
								<ul class="nav nav-collapse">
									<li>
										<a href="{{route('vendors')}}">
											<span class="sub-item">Orders</span>
										</a>
									</li>
									<li>
										<!-- <a href="{{route('create-vendor-user')}}"> -->
											<!-- <span class="sub-item">Create Cendor</span> -->
										<!-- </a> -->
									</li>
								</ul>
							</div>
						</li>
						@endif
					<!--	<li class="nav-item">
							<a data-toggle="collapse" href="#forms">
								<i class="fas fa-pen-square"></i>
								<p>Forms</p>
								<span class="caret"></span>
							</a>
							<div class="collapse" id="forms">
								<ul class="nav nav-collapse">
									<li>
										<a href="forms/forms.html">
											<span class="sub-item">Basic Form</span>
										</a>
									</li>
								</ul>
							</div>
						</li>
						<li class="nav-item">
							<a data-toggle="collapse" href="#tables">
								<i class="fas fa-table"></i>
								<p>Tables</p>
								<span class="caret"></span>
							</a>
							<div class="collapse" id="tables">
								<ul class="nav nav-collapse">
									<li>
										<a href="tables/tables.html">
											<span class="sub-item">Basic Table</span>
										</a>
									</li>
									<li>
										<a href="tables/datatables.html">
											<span class="sub-item">Datatables</span>
										</a>
									</li>
								</ul>
							</div>
						</li>
						<li class="nav-item">
							<a data-toggle="collapse" href="#maps">
								<i class="fas fa-map-marker-alt"></i>
								<p>Maps</p>
								<span class="caret"></span>
							</a>
							<div class="collapse" id="maps">
								<ul class="nav nav-collapse">
									<li>
										<a href="maps/jqvmap.html">
											<span class="sub-item">JQVMap</span>
										</a>
									</li>
								</ul>
							</div>
						</li>
						<li class="nav-item">
							<a data-toggle="collapse" href="#charts">
								<i class="far fa-chart-bar"></i>
								<p>Charts</p>
								<span class="caret"></span>
							</a>
							<div class="collapse" id="charts">
								<ul class="nav nav-collapse">
									<li>
										<a href="charts/charts.html">
											<span class="sub-item">Chart Js</span>
										</a>
									</li>
									<li>
										<a href="charts/sparkline.html">
											<span class="sub-item">Sparkline</span>
										</a>
									</li>
								</ul>
							</div>
						</li>
						<li class="nav-item">
							<a href="widgets.html">
								<i class="fas fa-desktop"></i>
								<p>Widgets</p>
								<span class="badge badge-success">4</span>
							</a>
						</li>
						<li class="nav-item">
							<a data-toggle="collapse" href="#submenu">
								<i class="fas fa-bars"></i>
								<p>Menu Levels</p>
								<span class="caret"></span>
							</a>
							<div class="collapse" id="submenu">
								<ul class="nav nav-collapse">
									<li>
										<a data-toggle="collapse" href="#subnav1">
											<span class="sub-item">Level 1</span>
											<span class="caret"></span>
										</a>
										<div class="collapse" id="subnav1">
											<ul class="nav nav-collapse subnav">
												<li>
													<a href="#">
														<span class="sub-item">Level 2</span>
													</a>
												</li>
												<li>
													<a href="#">
														<span class="sub-item">Level 2</span>
													</a>
												</li>
											</ul>
										</div>
									</li>
									<li>
										<a data-toggle="collapse" href="#subnav2">
											<span class="sub-item">Level 1</span>
											<span class="caret"></span>
										</a>
										<div class="collapse" id="subnav2">
											<ul class="nav nav-collapse subnav">
												<li>
													<a href="#">
														<span class="sub-item">Level 2</span>
													</a>
												</li>
											</ul>
										</div>
									</li>
									<li>
										<a href="#">
											<span class="sub-item">Level 1</span>
										</a>
									</li>
								</ul>
							</div>
						</li> -->
						<!-- <li class="mx-4 mt-2">
							<a href="#" class="btn btn-primary btn-block"><span class="btn-label mr-2"> <i class="fa fa-heart"></i> </span>Buy Pro</a> 
						</li> -->
					</ul>
				</div>
			</div>
		</div>
		<!-- End Sidebar -->