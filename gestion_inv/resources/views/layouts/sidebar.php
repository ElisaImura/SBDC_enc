 <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">


    <!--Google Icon Font-->
    <link href="http://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">


    <!-- jQuery first, then Popper.js, then Bootstrap JS, then Propeller js -->
    <script src="https://code.jquery.com/jquery-3.3.1.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
	  <script type="text/javascript" src="js/propeller.min.js"></script>




<!-- Fixed Left Sidebar -->
<nav class="navbar navbar-expand-lg fixed-top navbar-dark bg-dark pmd-navbar pmd-z-depth">
    <a href="javascript:void(0);" data-target="basicSidebar" data-placement="left" class="btn btn-sm pmd-btn-fab pmd-btn-flat pmd-ripple-effect pmd-sidebar-toggle"><i class="material-icons md-light">menu</i></a>
    <a class="navbar-brand" href="#">Brand</a>
    
    <!-- Navbar Right icon -->		
    <div class="pmd-navbar-right-icon ml-auto">
        <a href="javascript:void(0);" class="btn btn-sm pmd-btn-fab pmd-btn-flat pmd-ripple-effect"><i class="material-icons pmd-sm md-light">search</i></a>
    </div>
</nav>

<section id="pmd-main">

    <!-- Left sidebar -->
    <aside id="basicSidebar" class="pmd-sidebar pmd-sidebar-dark bg-dark pmd-z-depth" role="navigation">
        <ul class="nav flex-column pmd-sidebar-nav">
            <li class="nav-item pmd-user-info">
                <a data-toggle="collapse" href="#collapseExample" class="nav-link btn-user media align-items-center">
                    <img class="mr-3" src="https://pro.propeller.in/assets/images/avatar-icon-40x40.png" width="40" height="40" alt="avatar">
                    <div class="media-body">
                        User
                    </div>
                    <i class="material-icons md-light ml-2 pmd-sm">more_vert</i>
                </a>
                <ul class="collapse" id="collapseExample" data-parent="#basicSidebar">
                    <li class="nav-item">
                        <a class="nav-link" href="#">
                            <i class="material-icons pmd-list-icon pmd-sm">account_circle</i>
                            <span class="media-body">View Profile</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">
                            <i class="material-icons pmd-list-icon pmd-sm">settings</i>
                            <span class="media-body">Settings</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">
                            <i class="material-icons pmd-list-icon pmd-sm">settings_power</i>
                            <span class="media-body">Logout</span>
                        </a>
                    </li>
                </ul>
            </li>
            <li class="nav-item">
                <a class="nav-link active" href="#">
                    <i class="material-icons pmd-list-icon pmd-sm">star</i>
                    <span class="media-body">Stared</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="#">
                    <i class="material-icons pmd-list-icon pmd-sm">send</i>
                    <span class="media-body">Sent Email</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="#">
                    <i class="material-icons pmd-list-icon pmd-sm">drafts</i>
                    <span class="media-body">Drafts</span>
                </a>
            </li>
        </ul>
    </aside>
    
    <!-- Sidebar Overlay -->
    <div class="pmd-sidebar-overlay"></div>
    
    <!-- Start Content -->
    <div class="pmd-content custom-pmd-content" id="content">
        <h2 class="headline">Sidebar Constructor</h2>
        <p>This structure shows a permanent app bar with a floating action button. The app bar absorbs elements from the tablet and mobile bottom bars.</p>
        <p style="margin-bottom:0;">An optional bottom bar can be added for additional functionality or action overflow. A side nav overlays all other structural elements. A right nav menu can be accessed temporarily or pinned for permanent display.<br><br></p>
    </div>
</section>