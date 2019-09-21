@extends('layouts.welcome')
@section('header')
    <div class="kt-header-menu-wrapper" id="kt_header_menu_wrapper">
        <div id="kt_header_menu" class="kt-header-menu kt-header-menu-mobile  kt-header-menu--layout-default ">
            <ul class="kt-menu__nav ">
                <li class="kt-menu__item  kt-menu__item--open kt-menu__item--here kt-menu__item--submenu kt-menu__item--rel kt-menu__item--open kt-menu__item--here kt-menu__item--active" data-ktmenu-submenu-toggle="click" aria-haspopup="true"><a href="javascript:;" class="kt-menu__link kt-menu__toggle"><span class="kt-menu__link-text">Pages</span><i class="kt-menu__ver-arrow la la-angle-right"></i></a>
                    <div class="kt-menu__submenu kt-menu__submenu--classic kt-menu__submenu--left">
                        <ul class="kt-menu__subnav">
                            <li class="kt-menu__item  kt-menu__item--active " aria-haspopup="true"><a href="demo1/index.html" class="kt-menu__link "><span class="kt-menu__link-icon"><svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1" class="kt-svg-icon">
																<g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
																	<rect id="bound" x="0" y="0" width="24" height="24" />
																	<path d="M5.84026576,8 L18.1597342,8 C19.1999115,8 20.0664437,8.79732479 20.1528258,9.83390904 L20.8194924,17.833909 C20.9112219,18.9346631 20.0932459,19.901362 18.9924919,19.9930915 C18.9372479,19.9976952 18.8818364,20 18.8264009,20 L5.1735991,20 C4.0690296,20 3.1735991,19.1045695 3.1735991,18 C3.1735991,17.9445645 3.17590391,17.889153 3.18050758,17.833909 L3.84717425,9.83390904 C3.93355627,8.79732479 4.80008849,8 5.84026576,8 Z M10.5,10 C10.2238576,10 10,10.2238576 10,10.5 L10,11.5 C10,11.7761424 10.2238576,12 10.5,12 L13.5,12 C13.7761424,12 14,11.7761424 14,11.5 L14,10.5 C14,10.2238576 13.7761424,10 13.5,10 L10.5,10 Z" id="Combined-Shape" fill="#000000" />
																	<path d="M10,8 L8,8 L8,7 C8,5.34314575 9.34314575,4 11,4 L13,4 C14.6568542,4 16,5.34314575 16,7 L16,8 L14,8 L14,7 C14,6.44771525 13.5522847,6 13,6 L11,6 C10.4477153,6 10,6.44771525 10,7 L10,8 Z" id="Path-53" fill="#000000" fill-rule="nonzero" opacity="0.3" />
																</g>
															</svg></span><span class="kt-menu__link-text">My Account</span></a></li>
                            <li class="kt-menu__item " aria-haspopup="true"><a href="javascript:;" class="kt-menu__link "><span class="kt-menu__link-icon"><svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1" class="kt-svg-icon">
																<g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
																	<rect id="bound" x="0" y="0" width="24" height="24" />
																	<path d="M2.56066017,10.6819805 L4.68198052,8.56066017 C5.26776695,7.97487373 6.21751442,7.97487373 6.80330086,8.56066017 L8.9246212,10.6819805 C9.51040764,11.267767 9.51040764,12.2175144 8.9246212,12.8033009 L6.80330086,14.9246212 C6.21751442,15.5104076 5.26776695,15.5104076 4.68198052,14.9246212 L2.56066017,12.8033009 C1.97487373,12.2175144 1.97487373,11.267767 2.56066017,10.6819805 Z M14.5606602,10.6819805 L16.6819805,8.56066017 C17.267767,7.97487373 18.2175144,7.97487373 18.8033009,8.56066017 L20.9246212,10.6819805 C21.5104076,11.267767 21.5104076,12.2175144 20.9246212,12.8033009 L18.8033009,14.9246212 C18.2175144,15.5104076 17.267767,15.5104076 16.6819805,14.9246212 L14.5606602,12.8033009 C13.9748737,12.2175144 13.9748737,11.267767 14.5606602,10.6819805 Z" id="Combined-Shape" fill="#000000" opacity="0.3" />
																	<path d="M8.56066017,16.6819805 L10.6819805,14.5606602 C11.267767,13.9748737 12.2175144,13.9748737 12.8033009,14.5606602 L14.9246212,16.6819805 C15.5104076,17.267767 15.5104076,18.2175144 14.9246212,18.8033009 L12.8033009,20.9246212 C12.2175144,21.5104076 11.267767,21.5104076 10.6819805,20.9246212 L8.56066017,18.8033009 C7.97487373,18.2175144 7.97487373,17.267767 8.56066017,16.6819805 Z M8.56066017,4.68198052 L10.6819805,2.56066017 C11.267767,1.97487373 12.2175144,1.97487373 12.8033009,2.56066017 L14.9246212,4.68198052 C15.5104076,5.26776695 15.5104076,6.21751442 14.9246212,6.80330086 L12.8033009,8.9246212 C12.2175144,9.51040764 11.267767,9.51040764 10.6819805,8.9246212 L8.56066017,6.80330086 C7.97487373,6.21751442 7.97487373,5.26776695 8.56066017,4.68198052 Z" id="Combined-Shape" fill="#000000" />
																</g>
															</svg></span><span class="kt-menu__link-text">Task Manager</span><span class="kt-menu__link-badge"><span class="kt-badge kt-badge--success">2</span></span></a></li>
                            <li class="kt-menu__item  kt-menu__item--submenu" data-ktmenu-submenu-toggle="hover" aria-haspopup="true"><a href="javascript:;" class="kt-menu__link kt-menu__toggle"><span class="kt-menu__link-icon"><svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1" class="kt-svg-icon">
																<g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
																	<rect id="bound" x="0" y="0" width="24" height="24" />
																	<path d="M9,15 L7.5,15 C6.67157288,15 6,15.6715729 6,16.5 C6,17.3284271 6.67157288,18 7.5,18 C8.32842712,18 9,17.3284271 9,16.5 L9,15 Z M9,15 L9,9 L15,9 L15,15 L9,15 Z M15,16.5 C15,17.3284271 15.6715729,18 16.5,18 C17.3284271,18 18,17.3284271 18,16.5 C18,15.6715729 17.3284271,15 16.5,15 L15,15 L15,16.5 Z M16.5,9 C17.3284271,9 18,8.32842712 18,7.5 C18,6.67157288 17.3284271,6 16.5,6 C15.6715729,6 15,6.67157288 15,7.5 L15,9 L16.5,9 Z M9,7.5 C9,6.67157288 8.32842712,6 7.5,6 C6.67157288,6 6,6.67157288 6,7.5 C6,8.32842712 6.67157288,9 7.5,9 L9,9 L9,7.5 Z M11,13 L13,13 L13,11 L11,11 L11,13 Z M13,11 L13,7.5 C13,5.56700338 14.5670034,4 16.5,4 C18.4329966,4 20,5.56700338 20,7.5 C20,9.43299662 18.4329966,11 16.5,11 L13,11 Z M16.5,13 C18.4329966,13 20,14.5670034 20,16.5 C20,18.4329966 18.4329966,20 16.5,20 C14.5670034,20 13,18.4329966 13,16.5 L13,13 L16.5,13 Z M11,16.5 C11,18.4329966 9.43299662,20 7.5,20 C5.56700338,20 4,18.4329966 4,16.5 C4,14.5670034 5.56700338,13 7.5,13 L11,13 L11,16.5 Z M7.5,11 C5.56700338,11 4,9.43299662 4,7.5 C4,5.56700338 5.56700338,4 7.5,4 C9.43299662,4 11,5.56700338 11,7.5 L11,11 L7.5,11 Z" id="Path-2" fill="#000000" fill-rule="nonzero" />
																</g>
															</svg></span><span class="kt-menu__link-text">Team Manager</span><i class="kt-menu__hor-arrow la la-angle-right"></i><i class="kt-menu__ver-arrow la la-angle-right"></i></a>
                                <div class="kt-menu__submenu kt-menu__submenu--classic kt-menu__submenu--right">
                                    <ul class="kt-menu__subnav">
                                        <li class="kt-menu__item " aria-haspopup="true"><a href="javascript:;" class="kt-menu__link "><i class="kt-menu__link-bullet kt-menu__link-bullet--dot"><span></span></i><span class="kt-menu__link-text">Add Team Member</span></a></li>
                                        <li class="kt-menu__item " aria-haspopup="true"><a href="javascript:;" class="kt-menu__link "><i class="kt-menu__link-bullet kt-menu__link-bullet--dot"><span></span></i><span class="kt-menu__link-text">Edit Team Member</span></a></li>
                                        <li class="kt-menu__item " aria-haspopup="true"><a href="javascript:;" class="kt-menu__link "><i class="kt-menu__link-bullet kt-menu__link-bullet--dot"><span></span></i><span class="kt-menu__link-text">Delete Team Member</span></a></li>
                                        <li class="kt-menu__item " aria-haspopup="true"><a href="javascript:;" class="kt-menu__link "><i class="kt-menu__link-bullet kt-menu__link-bullet--dot"><span></span></i><span class="kt-menu__link-text">Team Member Reports</span></a></li>
                                        <li class="kt-menu__item " aria-haspopup="true"><a href="javascript:;" class="kt-menu__link "><i class="kt-menu__link-bullet kt-menu__link-bullet--dot"><span></span></i><span class="kt-menu__link-text">Assign Tasks</span></a></li>
                                        <li class="kt-menu__item " aria-haspopup="true"><a href="javascript:;" class="kt-menu__link "><i class="kt-menu__link-bullet kt-menu__link-bullet--dot"><span></span></i><span class="kt-menu__link-text">Promote Team Member</span></a></li>
                                    </ul>
                                </div>
                            </li>
                            <li class="kt-menu__item  kt-menu__item--submenu" data-ktmenu-submenu-toggle="hover" aria-haspopup="true"><a href="#" class="kt-menu__link kt-menu__toggle"><span class="kt-menu__link-icon"><svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1" class="kt-svg-icon">
																<g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
																	<rect id="bound" x="0" y="0" width="24" height="24" />
																	<path d="M22,15 L22,19 C22,20.1045695 21.1045695,21 20,21 L4,21 C2.8954305,21 2,20.1045695 2,19 L2,15 L6.27924078,15 L6.82339262,16.6324555 C7.09562072,17.4491398 7.8598984,18 8.72075922,18 L15.381966,18 C16.1395101,18 16.8320364,17.5719952 17.1708204,16.8944272 L18.118034,15 L22,15 Z" id="Combined-Shape" fill="#000000" />
																	<path d="M2.5625,13 L5.92654389,7.01947752 C6.2807805,6.38972356 6.94714834,6 7.66969497,6 L16.330305,6 C17.0528517,6 17.7192195,6.38972356 18.0734561,7.01947752 L21.4375,13 L18.118034,13 C17.3604899,13 16.6679636,13.4280048 16.3291796,14.1055728 L15.381966,16 L8.72075922,16 L8.17660738,14.3675445 C7.90437928,13.5508602 7.1401016,13 6.27924078,13 L2.5625,13 Z" id="Path" fill="#000000" opacity="0.3" />
																</g>
															</svg></span><span class="kt-menu__link-text">Projects Manager</span><i class="kt-menu__hor-arrow la la-angle-right"></i><i class="kt-menu__ver-arrow la la-angle-right"></i></a>
                                <div class="kt-menu__submenu kt-menu__submenu--classic kt-menu__submenu--right">
                                    <ul class="kt-menu__subnav">
                                        <li class="kt-menu__item " aria-haspopup="true"><a href="javascript:;" class="kt-menu__link "><i class="kt-menu__link-bullet kt-menu__link-bullet--line"><span></span></i><span class="kt-menu__link-text">Latest Projects</span></a></li>
                                        <li class="kt-menu__item " aria-haspopup="true"><a href="javascript:;" class="kt-menu__link "><i class="kt-menu__link-bullet kt-menu__link-bullet--line"><span></span></i><span class="kt-menu__link-text">Ongoing Projects</span></a></li>
                                        <li class="kt-menu__item " aria-haspopup="true"><a href="javascript:;" class="kt-menu__link "><i class="kt-menu__link-bullet kt-menu__link-bullet--line"><span></span></i><span class="kt-menu__link-text">Urgent Projects</span></a></li>
                                        <li class="kt-menu__item " aria-haspopup="true"><a href="javascript:;" class="kt-menu__link "><i class="kt-menu__link-bullet kt-menu__link-bullet--line"><span></span></i><span class="kt-menu__link-text">Completed Projects</span></a></li>
                                        <li class="kt-menu__item " aria-haspopup="true"><a href="javascript:;" class="kt-menu__link "><i class="kt-menu__link-bullet kt-menu__link-bullet--line"><span></span></i><span class="kt-menu__link-text">Dropped Projects</span></a></li>
                                    </ul>
                                </div>
                            </li>
                            <li class="kt-menu__item " aria-haspopup="true"><a href="javascript:;" class="kt-menu__link "><span class="kt-menu__link-icon"><svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1" class="kt-svg-icon">
																<g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
																	<rect id="bound" x="0" y="0" width="24" height="24" />
																	<path d="M4.5,3 L19.5,3 C20.3284271,3 21,3.67157288 21,4.5 L21,19.5 C21,20.3284271 20.3284271,21 19.5,21 L4.5,21 C3.67157288,21 3,20.3284271 3,19.5 L3,4.5 C3,3.67157288 3.67157288,3 4.5,3 Z M8,5 C7.44771525,5 7,5.44771525 7,6 C7,6.55228475 7.44771525,7 8,7 L16,7 C16.5522847,7 17,6.55228475 17,6 C17,5.44771525 16.5522847,5 16,5 L8,5 Z M10.5857864,14 L9.17157288,15.4142136 C8.78104858,15.8047379 8.78104858,16.4379028 9.17157288,16.8284271 C9.56209717,17.2189514 10.1952621,17.2189514 10.5857864,16.8284271 L12,15.4142136 L13.4142136,16.8284271 C13.8047379,17.2189514 14.4379028,17.2189514 14.8284271,16.8284271 C15.2189514,16.4379028 15.2189514,15.8047379 14.8284271,15.4142136 L13.4142136,14 L14.8284271,12.5857864 C15.2189514,12.1952621 15.2189514,11.5620972 14.8284271,11.1715729 C14.4379028,10.7810486 13.8047379,10.7810486 13.4142136,11.1715729 L12,12.5857864 L10.5857864,11.1715729 C10.1952621,10.7810486 9.56209717,10.7810486 9.17157288,11.1715729 C8.78104858,11.5620972 8.78104858,12.1952621 9.17157288,12.5857864 L10.5857864,14 Z" id="Combined-Shape" fill="#000000" />
																</g>
															</svg></span><span class="kt-menu__link-text">Create New Project</span></a></li>
                        </ul>
                    </div>
                </li>
            </ul>
        </div>
    </div>
@stop
@section('content')
    <div class="kt-portlet__body">

        <!--begin: Datatable -->
        <table class="table table-striped- table-bordered table-hover table-checkable" id="kt_table_1">
            <thead>
            <tr>
                <th>Record ID</th>
                <th>Order ID</th>
                <th>Country</th>
                <th>Ship City</th>
                <th>Ship Address</th>
                <th>Company Agent</th>
                <th>Company Name</th>
                <th>Ship Date</th>
                <th>Status</th>
                <th>Type</th>
                <th>Actions</th>
            </tr>
            </thead>
            <tbody>
            <tr>
                <td>1</td>
                <td>61715-075</td>
                <td>China</td>
                <td>Tieba</td>
                <td>746 Pine View Junction</td>
                <td>Nixie Sailor</td>
                <td>Gleichner, Ziemann and Gutkowski</td>
                <td>2/12/2018</td>
                <td>3</td>
                <td>2</td>
                <td nowrap></td>
            </tr>
            <tr>
                <td>2</td>
                <td>63629-4697</td>
                <td>Indonesia</td>
                <td>Cihaur</td>
                <td>01652 Fulton Trail</td>
                <td>Emelita Giraldez</td>
                <td>Rosenbaum-Reichel</td>
                <td>8/6/2017</td>
                <td>6</td>
                <td>3</td>
                <td nowrap></td>
            </tr>
            <tr>
                <td>3</td>
                <td>68084-123</td>
                <td>Argentina</td>
                <td>Puerto Iguazú</td>
                <td>2 Pine View Park</td>
                <td>Ula Luckin</td>
                <td>Kulas, Cassin and Batz</td>
                <td>5/26/2016</td>
                <td>1</td>
                <td>2</td>
                <td nowrap></td>
            </tr>
            <tr>
                <td>4</td>
                <td>67457-428</td>
                <td>Indonesia</td>
                <td>Talok</td>
                <td>3050 Buell Terrace</td>
                <td>Evangeline Cure</td>
                <td>Pfannerstill-Treutel</td>
                <td>7/2/2016</td>
                <td>1</td>
                <td>3</td>
                <td nowrap></td>
            </tr>
            <tr>
                <td>5</td>
                <td>31722-529</td>
                <td>Austria</td>
                <td>Sankt Andrä-Höch</td>
                <td>3038 Trailsway Junction</td>
                <td>Tierney St. Louis</td>
                <td>Dicki-Kling</td>
                <td>5/20/2017</td>
                <td>2</td>
                <td>3</td>
                <td nowrap></td>
            </tr>
            <tr>
                <td>6</td>
                <td>64117-168</td>
                <td>China</td>
                <td>Rongkou</td>
                <td>023 South Way</td>
                <td>Gerhard Reinhard</td>
                <td>Gleason, Kub and Marquardt</td>
                <td>11/26/2016</td>
                <td>5</td>
                <td>3</td>
                <td nowrap></td>
            </tr>
            <tr>
                <td>7</td>
                <td>43857-0331</td>
                <td>China</td>
                <td>Baiguo</td>
                <td>56482 Fairfield Terrace</td>
                <td>Englebert Shelley</td>
                <td>Jenkins Inc</td>
                <td>6/28/2016</td>
                <td>2</td>
                <td>3</td>
                <td nowrap></td>
            </tr>
            <tr>
                <td>8</td>
                <td>64980-196</td>
                <td>Croatia</td>
                <td>Vinica</td>
                <td>0 Elka Street</td>
                <td>Hazlett Kite</td>
                <td>Streich LLC</td>
                <td>8/5/2016</td>
                <td>6</td>
                <td>1</td>
                <td nowrap></td>
            </tr>
            <tr>
                <td>9</td>
                <td>0404-0360</td>
                <td>Colombia</td>
                <td>San Carlos</td>
                <td>38099 Ilene Hill</td>
                <td>Freida Morby</td>
                <td>Haley, Schamberger and Durgan</td>
                <td>3/31/2017</td>
                <td>2</td>
                <td>1</td>
                <td nowrap></td>
            </tr>
            <tr>
                <td>10</td>
                <td>52125-267</td>
                <td>Thailand</td>
                <td>Maha Sarakham</td>
                <td>8696 Barby Pass</td>
                <td>Obed Helian</td>
                <td>Labadie, Predovic and Hammes</td>
                <td>1/26/2017</td>
                <td>1</td>
                <td>3</td>
                <td nowrap></td>
            </tr>
            <tr>
                <td>11</td>
                <td>54092-515</td>
                <td>Brazil</td>
                <td>Canguaretama</td>
                <td>32461 Ridgeway Alley</td>
                <td>Sibyl Amy</td>
                <td>Treutel-Ratke</td>
                <td>3/8/2017</td>
                <td>4</td>
                <td>2</td>
                <td nowrap></td>
            </tr>
            <tr>
                <td>12</td>
                <td>0185-0130</td>
                <td>China</td>
                <td>Jiamachi</td>
                <td>23 Walton Pass</td>
                <td>Norri Foldes</td>
                <td>Strosin, Nitzsche and Wisozk</td>
                <td>4/2/2017</td>
                <td>3</td>
                <td>1</td>
                <td nowrap></td>
            </tr>
            <tr>
                <td>13</td>
                <td>21130-678</td>
                <td>China</td>
                <td>Qiaole</td>
                <td>328 Glendale Hill</td>
                <td>Myrna Orhtmann</td>
                <td>Miller-Schiller</td>
                <td>6/7/2016</td>
                <td>3</td>
                <td>1</td>
                <td nowrap></td>
            </tr>
            <tr>
                <td>14</td>
                <td>40076-953</td>
                <td>Portugal</td>
                <td>Burgau</td>
                <td>52550 Crownhardt Court</td>
                <td>Sioux Kneath</td>
                <td>Rice, Cole and Spinka</td>
                <td>10/11/2017</td>
                <td>4</td>
                <td>1</td>
                <td nowrap></td>
            </tr>
            <tr>
                <td>15</td>
                <td>36987-3005</td>
                <td>Portugal</td>
                <td>Bacelo</td>
                <td>548 Morrow Terrace</td>
                <td>Christa Jacmar</td>
                <td>Brakus-Hansen</td>
                <td>8/17/2017</td>
                <td>1</td>
                <td>2</td>
                <td nowrap></td>
            </tr>
            <tr>
                <td>16</td>
                <td>67510-0062</td>
                <td>South Africa</td>
                <td>Pongola</td>
                <td>02534 Hauk Trail</td>
                <td>Shandee Goracci</td>
                <td>Bergnaum, Thiel and Schuppe</td>
                <td>7/24/2016</td>
                <td>5</td>
                <td>3</td>
                <td nowrap></td>
            </tr>
            <tr>
                <td>17</td>
                <td>36987-2542</td>
                <td>Russia</td>
                <td>Novokizhinginsk</td>
                <td>19427 Sloan Road</td>
                <td>Jerrome Colvie</td>
                <td>Kreiger, Glover and Connelly</td>
                <td>3/4/2016</td>
                <td>3</td>
                <td>1</td>
                <td nowrap></td>
            </tr>
            <tr>
                <td>18</td>
                <td>11673-479</td>
                <td>Brazil</td>
                <td>Conceição das Alagoas</td>
                <td>191 Stone Corner Road</td>
                <td>Michaelina Plenderleith</td>
                <td>Legros-Gleichner</td>
                <td>2/21/2018</td>
                <td>1</td>
                <td>2</td>
                <td nowrap></td>
            </tr>
            <tr>
                <td>19</td>
                <td>47781-264</td>
                <td>Ukraine</td>
                <td>Yasinya</td>
                <td>1481 Sauthoff Place</td>
                <td>Lombard Luthwood</td>
                <td>Haag LLC</td>
                <td>1/21/2016</td>
                <td>1</td>
                <td>2</td>
                <td nowrap></td>
            </tr>
            <tr>
                <td>20</td>
                <td>42291-712</td>
                <td>Indonesia</td>
                <td>Kembang</td>
                <td>9029 Blackbird Point</td>
                <td>Leonora Chevin</td>
                <td>Mann LLC</td>
                <td>9/6/2017</td>
                <td>2</td>
                <td>3</td>
                <td nowrap></td>
            </tr>
            <tr>
                <td>21</td>
                <td>64679-154</td>
                <td>Mongolia</td>
                <td>Sharga</td>
                <td>102 Holmberg Park</td>
                <td>Tannie Seakes</td>
                <td>Blanda Group</td>
                <td>7/31/2016</td>
                <td>6</td>
                <td>3</td>
                <td nowrap></td>
            </tr>
            <tr>
                <td>22</td>
                <td>49348-055</td>
                <td>China</td>
                <td>Guxi</td>
                <td>45 Butterfield Street</td>
                <td>Yardley Wetherell</td>
                <td>Gerlach-Schultz</td>
                <td>4/3/2017</td>
                <td>2</td>
                <td>2</td>
                <td nowrap></td>
            </tr>
            <tr>
                <td>23</td>
                <td>47593-438</td>
                <td>Portugal</td>
                <td>Viso</td>
                <td>97 Larry Center</td>
                <td>Bryn Peascod</td>
                <td>Larkin and Sons</td>
                <td>5/22/2016</td>
                <td>6</td>
                <td>1</td>
                <td nowrap></td>
            </tr>
            <tr>
                <td>24</td>
                <td>54569-0175</td>
                <td>Japan</td>
                <td>Minato</td>
                <td>077 Hoffman Center</td>
                <td>Chrissie Jeromson</td>
                <td>Brakus-McCullough</td>
                <td>11/26/2017</td>
                <td>2</td>
                <td>1</td>
                <td nowrap></td>
            </tr>
            <tr>
                <td>25</td>
                <td>0093-1016</td>
                <td>Indonesia</td>
                <td>Merdeka</td>
                <td>3150 Cherokee Center</td>
                <td>Gusti Clamp</td>
                <td>Stokes Group</td>
                <td>4/12/2018</td>
                <td>6</td>
                <td>2</td>
                <td nowrap></td>
            </tr>
            <tr>
                <td>26</td>
                <td>0093-5142</td>
                <td>China</td>
                <td>Jianggao</td>
                <td>289 Badeau Alley</td>
                <td>Otis Jobbins</td>
                <td>Ruecker, Leffler and Abshire</td>
                <td>3/6/2018</td>
                <td>4</td>
                <td>2</td>
                <td nowrap></td>
            </tr>
            <tr>
                <td>27</td>
                <td>51523-026</td>
                <td>Germany</td>
                <td>Erfurt</td>
                <td>132 Chive Way</td>
                <td>Lonnie Haycox</td>
                <td>Feest Group</td>
                <td>4/24/2018</td>
                <td>1</td>
                <td>3</td>
                <td nowrap></td>
            </tr>
            <tr>
                <td>28</td>
                <td>49035-522</td>
                <td>Australia</td>
                <td>Eastern Suburbs Mc</td>
                <td>074 Algoma Drive</td>
                <td>Heddi Castelli</td>
                <td>Kessler and Sons</td>
                <td>1/12/2017</td>
                <td>5</td>
                <td>1</td>
                <td nowrap></td>
            </tr>
            <tr>
                <td>29</td>
                <td>58411-198</td>
                <td>Ethiopia</td>
                <td>Kombolcha</td>
                <td>91066 Amoth Court</td>
                <td>Tuck O'Dowgaine</td>
                <td>Simonis, Rowe and Davis</td>
                <td>5/6/2017</td>
                <td>1</td>
                <td>1</td>
                <td nowrap></td>
            </tr>
            <tr>
                <td>30</td>
                <td>27495-006</td>
                <td>Portugal</td>
                <td>Arrifes</td>
                <td>3 Fairfield Junction</td>
                <td>Vernon Cosham</td>
                <td>Kreiger-Nicolas</td>
                <td>2/8/2017</td>
                <td>4</td>
                <td>2</td>
                <td nowrap></td>
            </tr>
            <tr>
                <td>31</td>
                <td>55154-8284</td>
                <td>Philippines</td>
                <td>Talisay</td>
                <td>09 Sachtjen Junction</td>
                <td>Bryna MacCracken</td>
                <td>Hyatt-Witting</td>
                <td>7/22/2017</td>
                <td>2</td>
                <td>1</td>
                <td nowrap></td>
            </tr>
            <tr>
                <td>32</td>
                <td>62678-207</td>
                <td>Libya</td>
                <td>Zuwārah</td>
                <td>82 Thackeray Pass</td>
                <td>Freda Arnall</td>
                <td>Dicki, Morar and Stiedemann</td>
                <td>7/22/2016</td>
                <td>3</td>
                <td>3</td>
                <td nowrap></td>
            </tr>
            <tr>
                <td>33</td>
                <td>68428-725</td>
                <td>China</td>
                <td>Zhangcun</td>
                <td>3 Goodland Terrace</td>
                <td>Pavel Kringe</td>
                <td>Goldner-Lehner</td>
                <td>4/2/2017</td>
                <td>4</td>
                <td>1</td>
                <td nowrap></td>
            </tr>
            <tr>
                <td>34</td>
                <td>0363-0724</td>
                <td>Morocco</td>
                <td>Temara</td>
                <td>9550 Weeping Birch Crossing</td>
                <td>Felix Nazaret</td>
                <td>Waters, Quigley and Keeling</td>
                <td>6/4/2016</td>
                <td>5</td>
                <td>3</td>
                <td nowrap></td>
            </tr>
            <tr>
                <td>35</td>
                <td>37000-102</td>
                <td>Paraguay</td>
                <td>Los Cedrales</td>
                <td>1 Ridge Oak Way</td>
                <td>Penrod Allanby</td>
                <td>Rodriguez Group</td>
                <td>3/5/2018</td>
                <td>2</td>
                <td>3</td>
                <td nowrap></td>
            </tr>
            <tr>
                <td>36</td>
                <td>55289-002</td>
                <td>Philippines</td>
                <td>Dologon</td>
                <td>9 Vidon Terrace</td>
                <td>Hubey Passby</td>
                <td>Lemke-Hermiston</td>
                <td>6/29/2017</td>
                <td>2</td>
                <td>3</td>
                <td nowrap></td>
            </tr>
            <tr>
                <td>37</td>
                <td>15127-874</td>
                <td>Tanzania</td>
                <td>Nanganga</td>
                <td>33 Anniversary Parkway</td>
                <td>Magdaia Rotlauf</td>
                <td>Hettinger, Medhurst and Heaney</td>
                <td>2/18/2018</td>
                <td>3</td>
                <td>1</td>
                <td nowrap></td>
            </tr>
            <tr>
                <td>38</td>
                <td>49349-123</td>
                <td>Indonesia</td>
                <td>Pule</td>
                <td>77292 Bonner Plaza</td>
                <td>Alfonse Lawrance</td>
                <td>Schuppe-Harber</td>
                <td>4/14/2017</td>
                <td>1</td>
                <td>3</td>
                <td nowrap></td>
            </tr>
            <tr>
                <td>39</td>
                <td>17089-415</td>
                <td>Palestinian Territory</td>
                <td>Za‘tarah</td>
                <td>42806 Ridgeview Terrace</td>
                <td>Kessiah Chettoe</td>
                <td>Mraz LLC</td>
                <td>3/4/2017</td>
                <td>5</td>
                <td>2</td>
                <td nowrap></td>
            </tr>
            <tr>
                <td>40</td>
                <td>51327-510</td>
                <td>Philippines</td>
                <td>Esperanza</td>
                <td>4 Linden Court</td>
                <td>Natka Fairbanks</td>
                <td>Mueller-Greenholt</td>
                <td>6/21/2017</td>
                <td>3</td>
                <td>3</td>
                <td nowrap></td>
            </tr>
            <tr>
                <td>41</td>
                <td>0187-2201</td>
                <td>Brazil</td>
                <td>Rio das Ostras</td>
                <td>5722 Buhler Place</td>
                <td>Shaw Puvia</td>
                <td>Veum LLC</td>
                <td>6/10/2017</td>
                <td>3</td>
                <td>2</td>
                <td nowrap></td>
            </tr>
            <tr>
                <td>42</td>
                <td>16590-890</td>
                <td>Indonesia</td>
                <td>Krajan Gajahmati</td>
                <td>54 Corry Street</td>
                <td>Alden Dingate</td>
                <td>Heidenreich Inc</td>
                <td>10/27/2016</td>
                <td>5</td>
                <td>1</td>
                <td nowrap></td>
            </tr>
            <tr>
                <td>43</td>
                <td>75862-001</td>
                <td>Indonesia</td>
                <td>Pineleng</td>
                <td>4 Messerschmidt Point</td>
                <td>Cherish Peplay</td>
                <td>McCullough-Gibson</td>
                <td>11/23/2017</td>
                <td>2</td>
                <td>2</td>
                <td nowrap></td>
            </tr>
            <tr>
                <td>44</td>
                <td>24559-091</td>
                <td>Philippines</td>
                <td>Amuñgan</td>
                <td>5470 Forest Parkway</td>
                <td>Nedi Swetman</td>
                <td>Gerhold Inc</td>
                <td>3/23/2017</td>
                <td>5</td>
                <td>1</td>
                <td nowrap></td>
            </tr>
            <tr>
                <td>45</td>
                <td>0007-3230</td>
                <td>Russia</td>
                <td>Bilyarsk</td>
                <td>5899 Basil Place</td>
                <td>Ashley Blick</td>
                <td>Cummings-Goodwin</td>
                <td>10/1/2016</td>
                <td>4</td>
                <td>2</td>
                <td nowrap></td>
            </tr>
            <tr>
                <td>46</td>
                <td>50184-1029</td>
                <td>Peru</td>
                <td>Chocope</td>
                <td>65560 Daystar Center</td>
                <td>Saunders Harmant</td>
                <td>O'Kon-Wiegand</td>
                <td>11/7/2017</td>
                <td>3</td>
                <td>2</td>
                <td nowrap></td>
            </tr>
            <tr>
                <td>47</td>
                <td>10819-6003</td>
                <td>France</td>
                <td>Rivesaltes</td>
                <td>4981 Springs Center</td>
                <td>Mellisa Laurencot</td>
                <td>Jacobs Group</td>
                <td>10/30/2017</td>
                <td>1</td>
                <td>1</td>
                <td nowrap></td>
            </tr>
            <tr>
                <td>48</td>
                <td>62750-003</td>
                <td>Mongolia</td>
                <td>Jargalant</td>
                <td>94 Rutledge Way</td>
                <td>Orland Myderscough</td>
                <td>Gutkowski Inc</td>
                <td>11/2/2016</td>
                <td>5</td>
                <td>3</td>
                <td nowrap></td>
            </tr>
            <tr>
                <td>49</td>
                <td>68647-122</td>
                <td>Philippines</td>
                <td>Cardona</td>
                <td>4765 Service Hill</td>
                <td>Devi Iglesias</td>
                <td>Ullrich-Dibbert</td>
                <td>7/21/2016</td>
                <td>1</td>
                <td>1</td>
                <td nowrap></td>
            </tr>
            <tr>
                <td>50</td>
                <td>36987-3093</td>
                <td>China</td>
                <td>Jiantou</td>
                <td>373 Northwestern Plaza</td>
                <td>Bliss Tummasutti</td>
                <td>Legros-Cummings</td>
                <td>11/27/2017</td>
                <td>5</td>
                <td>1</td>
                <td nowrap></td>
            </tr>
            </tbody>
        </table>

        <!--end: Datatable -->
    </div>
@stop
@section('scripts')

    <!--end::Page Scripts -->
    <script src="{{asset('vendors/custom/datatables/datatables.bundle.js')}}" type="text/javascript"></script>

    <!--end::Page Vendors -->

    <!--begin::Page Scripts(used by this page) -->
    <script src="{{asset('js/demo1/pages/crud/datatables/advanced/multiple-controls.js')}}" type="text/javascript"></script>

@stop
