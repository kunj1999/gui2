<!-- 
    File: /Homepage/navbar.php
    E-Tutor
    Kunj Patel, UMass Lowell Computer Science, kunj_patel@student.uml.edu
    Sean Gillis, UMass Lowell Computer Science, sean_gillis1@student.uml.edu
    Copyright (c) 2021 Kunj Patel, Sean Gillis. All rights reserved.

    Last Modified: 04/26/2021
 -->

<!DOCTYPE html>
<html lang="en">

    <body>
        <nav class="navbar navbar-expand-sm col-12 pt-0">
                <a class="navbar-brand" href="/Homepage/home.php">
                    <!-- Website Logo -->
                    <img src="/logo.png" class="logoSize">
                </a>
                
                <!-- navigation Button that will appear when webpage accessed from smaller screen -->
                <button type="button" class="btn btn-navbar navBtn bg-light d-inline-block d-sm-none mt-2" data-toggle="collapse" data-target=".navbar-collapse">
                        <i class="fas fa-bars fa-2x"></i>
                </button>
                
                <!-- search bar embedded in nav bar -->
                <div class="collapse navbar-collapse text-center" id="navbarText">
                    <form class="search ml-3 mt-1" action="/Homepage/search/search.php" method="GET">
                        <div class="input-group">
                            <!-- Search input -->
                            <input class="searchbar ml-2 rounded-left" name="s" required/>
                            <div class="input-group-append">
                                <!-- Form submission -->
                                <button type="submit" class="btn bg-white rounded-right" style="height: 33px;"><i class="fas fa-search"></i></button>
                            </div>
                        </div>
                    </form>

                <div class="collapse navbar-collapse" id="navbarText">
                    <ul class="navbar-nav ml-auto">
                        <!-- Navigation to calendar page -->
                        <li class="nav-item active">
                            <a class="nav-link text-light" href="/Homepage/calendar/calendar.php">Calendar</a>
                        </li>
                        
                        <!-- Logging out of the account -->
                        <li class="nav-item">
                            <a class="nav-link text-light ml-sm-4" href="/Homepage/logout.php">Log out</a>
                        </li>
                    </ul>
                </div>
            </nav>
    </body>

</html>