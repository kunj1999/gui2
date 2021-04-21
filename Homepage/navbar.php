<!DOCTYPE html>
<html lang="en">

    <body>
        <nav class="navbar navbar-expand-sm col-12 pt-0">
                <a class="navbar-brand" href="http://127.0.0.1/Homepage/home.php">
                    <!-- Website Logo -->
                    <img src="http://127.0.0.1/logo.png" class="logoSize">
                </a>
                
                <button type="button" class="btn btn-navbar navBtn bg-light d-inline-block d-sm-none mt-2" data-toggle="collapse" data-target=".navbar-collapse">
                        <i class="fas fa-bars fa-2x"></i>
                </button>
                
                <!-- search bar embedded in nav bar -->
                <div class="collapse navbar-collapse text-center" id="navbarText">
                    <form class="search ml-3 mt-1" action="http://127.0.0.1/Homepage/search/search.php" method="GET">
                        <div class="input-group">
                            <input class="searchbar ml-2 rounded-left" name="s" required/>
                            <div class="input-group-append">
                                <button type="submit" class="btn bg-white rounded-right" style="height: 33px;"><i class="fas fa-search"></i></button>
                            </div>
                        </div>
                    </form>

                <!-- <div class="collapse navbar-collapse" id="navbarText"> -->
                    <ul class="navbar-nav ml-auto">
                        <!-- Navigation to calendar page -->
                        <li class="nav-item active">
                            <a class="nav-link text-light" href="http://127.0.0.1/Homepage/calendar/calendar.php">Calendar</a>
                        </li>
                        <!-- Logging out of the account -->
                        <li class="nav-item">
                            <a class="nav-link text-light ml-sm-4" href="http://127.0.0.1/Homepage/logout.php">Log out</a>
                        </li>
                    </ul>
                </div>
            </nav>
    </body>

</html>