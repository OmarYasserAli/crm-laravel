        <nav class="navbar navbar-default" role="navigation">
            <!-- Main Menu -->
            <div class="side-menu-container">
                
                <ul class="nav navbar-nav">
                    @can('show_customers')
                    <li class="active"><a href="{{route('home')}}"><span class="glyphicon glyphicon-dashboard">
                    </span> Dashboard</a></li>
                     @endcan 
                    @can('create_employee')
                    <li><a href="{{route('emplyee.create')}}"><span class="glyphicon glyphicon-user"></span> Create Emplyee</a></li>
                    @endcan
                    @can('create_customer')
                    <li><a href="{{route('customer.create')}}"><span class="glyphicon glyphicon-user"></span> Create Customer</a></li>
                    @endcan
                    <!-- Dropdown-->
                    <!-- <li class="panel panel-default" id="dropdown">
                        <a data-toggle="collapse" href="#dropdown-lvl1">
                            <span class="glyphicon glyphicon-th-list"></span> Action Records</a>

                    </li> -->

                    
                </ul>
            </div><!-- /.navbar-collapse -->
        </nav>